#!/bin/bash
#
# Midonet Ansible Quickstart
# Copyright (C) 2015  Midokura SARL
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#

set -e

if [ -n "$DEBUG" ]; then
  set -x
fi

: ${ANSIBLE_VENV:=$HOME/.ansible-venv}
WORK_PATH=/opt/quickstart-midonet
LOG_FILE=$WORK_PATH/quickstart-midonet.log
TARBALL_URL=https://www.midonet.org/quickstart-v5.0.tgz
ETH0_IP=$(ip -4 -o a  show dev eth0  | awk '{ ADDR=$4; gsub("/.+", "", ADDR); print ADDR; }')

if [ -n "$OVERRIDE_URL" ]; then
  TARBALL_URL=$OVERRIDE_URL
fi

# Functions
function get_pip {
  echo -n "* Installing python pip... "
  if [ ! "$(which pip > /dev/null 2>&1)" ]; then
      if curl --silent https://bootstrap.pypa.io/get-pip.py >>$LOG_FILE 2>&1; then
        export GET_PIP_URL='https://bootstrap.pypa.io/get-pip.py'
      elif curl --silent https://raw.github.com/pypa/pip/master/contrib/get-pip.py >>$LOG_FILE 2>&1; then
        export GET_PIP_URL='https://raw.github.com/pypa/pip/master/contrib/get-pip.py'
      else
        echo "A suitable download location for get-pip.py could not be found."
        exit 1
      fi
    # Download and install pip
    curl --silent ${GET_PIP_URL} > /tmp/get-pip.py
    python2 /tmp/get-pip.py  >>$LOG_FILE 2>&1 || python /tmp/get-pip.py  >>$LOG_FILE 2>&1
  fi
  echo "ok."
}

function check_root {
  if [ "$(id -u)" != "0" ]; then
    echo "This script must be run as root."
    exit 1
  fi
}

# Install dependencies
function install_deps {
  echo -n "* Installing basic dependencies... "
  APT=`command -v apt-get` || true
  YUM=`command -v yum` || true
  if [[ "$APT" != "" ]]; then
      apt-get update   >>$LOG_FILE 2>&1
      apt-get -y install python-all python-dev curl autoconf g++ python2.7-dev wget  >>$LOG_FILE 2>&1
  elif [[ "$YUM" != "" ]]; then
      yum -y install  curl autoconf gcc-c++ python2-devel wget  >>$LOG_FILE 2>&1
  else
    distro_fail
  fi
  echo "ok."
}

function load_venv  {
  echo -n "* Installing and loading virtual env... "
  pip install virtualenv  >>$LOG_FILE 2>&1
  virtualenv $ANSIBLE_VENV >>$LOG_FILE 2>&1
  source $ANSIBLE_VENV/bin/activate
  echo "ok."
}

function install_ansible {
  echo -n "* Installing ansible... "
  pip install ansible==1.9.4  >>$LOG_FILE 2>&1
  echo "ok."
}

function install_ost_clients {
  echo -n "* Installing openstack clients... "
  pip install python-keystoneclient python-novaclient python-neutronclient python-glanceclient  >>$LOG_FILE 2>&1 || echo "failed."; exit 1
  echo "ok."
}

function check_kvm {
  # Check if node has virt capabilities
  if egrep -wo 'vmx|svm' /proc/cpuinfo  >>$LOG_FILE 2>&1; then
    QEMU_VIRT='kvm'
  else
    QEMU_VIRT='qemu'
  fi
}

function get_tarball {
 wget $TARBALL_URL -O /tmp/quickstart-ansible.tar.gz >>$LOG_FILE 2>&1
 tar xzf /tmp/quickstart-ansible.tar.gz -C $WORK_PATH  >>$LOG_FILE 2>&1
}

function distro_fail {
  echo ""
  echo "Unsupported distribution/version. Only Ubuntu 14.04 (Trusty) is supported."
  echo ""
  exit 1
}

function check_distro  {
  echo -n "* Checking distribution/version... "
  DISTRONAME=$(lsb_release -is)
  CODENAME=$(lsb_release -cs)
  if [ "$DISTRONAME"="Ubuntu" -a "$CODENAME"="trusty" ]; then
    DISTRO='ubuntu14'
    HORIZON_URL="http://$ETH0_IP/horizon"
    echo "ok."
  else
    distro_fail
  fi

}



function run_ansible {
  echo "* Running ansible... "
  cd $WORK_PATH/quickstart
  if [ -n "$DEBUG" ]; then
    EXTRA_FLAGS="-vvvv"
  fi
  ansible-playbook $EXTRA_FLAGS -i hosts_localhost_allinone -e deploy=$DISTRO -e os_virt_type=$QEMU_VIRT local-allinone.yml >>$LOG_FILE 2>&1
}

function ip_forward {
  echo -n "* Enabling IP forwarding on host... "
  sysctl -w net.ipv4.ip_forward=1 >>$LOG_FILE 2>&1
  iptables -t nat -I POSTROUTING -o eth0 -s 200.200.200.0/24 -j MASQUERADE >>$LOG_FILE 2>&1
  iptables -I FORWARD -s 200.200.200.0/24 -j ACCEPT >>$LOG_FILE 2>&1
  iptables -I FORWARD -d 200.200.200.0/24 -j ACCEPT >>$LOG_FILE 2>&1

}

export LC_ALL=C
echo "Logging to $LOG_FILE"
check_root
mkdir -p $WORK_PATH
install_deps
get_pip
load_venv
install_ansible
check_kvm
get_tarball
check_distro
run_ansible
ip_forward

cat <<-EOF


        OpenStack Kilo with MidoNet available in $HORIZON_URL
        To access through Horizon, use one of the following user/passwords:

        * demo/midonet (Demo tenant, demo user)
        * admin/midonet (Admin tenant, admin user)

        Thanks for trying MidoNet!


EOF
