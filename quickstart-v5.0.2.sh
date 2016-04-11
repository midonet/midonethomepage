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
# This script must be run as root and is intended for CentOS 7 or
# Ubuntu 14.04 LTS
# This script sets up the environment for, and runs, an Ansible playbook
# which installs Midonet 5.0.2 with OpenStack Liberty on a single node.

set -e

if [ -n "$DEBUG" ]; then
  set -x
fi

: ${ANSIBLE_VENV:=$HOME/.ansible-venv}
WORK_PATH=/opt/quickstart-midonet
LOG_FILE=$WORK_PATH/quickstart-midonet.log
TARBALL_URL=https://www.midonet.org/quickstart-v5.0.2.tgz
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
      yum -y install  curl autoconf gcc-c++ python2-devel wget redhat-lsb-core redhat-lsb >>$LOG_FILE 2>&1
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

function get_tarball {
 wget $TARBALL_URL -O /tmp/quickstart-v5.0.2.tgz >>$LOG_FILE 2>&1
 echo -n "* Untarring the installer at $WORK_PATH "
 tar xzf /tmp/quickstart-v5.0.2.tgz -C $WORK_PATH  >>$LOG_FILE 2>&1
 echo "ok."
}

function distro_fail {
  echo ""
  echo "Unsupported distribution/version. Only Ubuntu 14.04 (Trusty) or CentOS 7 (Core) is supported."
  echo ""
  exit 1
}

function check_distro  {
  echo -n "* Checking distribution/version... "
  . /etc/os-release
  echo $NAME
  echo $VERSION
  HORIZON_URL="http://$ETH0_IP/horizon"
  if [[ "$NAME" =~ "Ubuntu" && "$VERSION" =~ "Trusty" ]]; then
    DISTRO='ubuntu14'
    echo "ok."
  elif [[ "$NAME" =~ "CentOS" && "$VERSION" =~ "Core" ]]; then
    DISTRO='centos7'
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
  ansible-playbook $EXTRA_FLAGS -i hosts_localhost_allinone -e deploy=$DISTRO -e os_virt_type=qemu local-allinone.yml >>$LOG_FILE 2>&1
}

function ip_forward {
  echo -n "* Enabling IP forwarding on host... "
  sysctl -w net.ipv4.ip_forward=1 >>$LOG_FILE 2>&1
  iptables -t nat -I POSTROUTING -o eth0 -s 200.200.200.0/24 -j MASQUERADE >>$LOG_FILE 2>&1
  iptables -I FORWARD -s 200.200.200.0/24 -j ACCEPT >>$LOG_FILE 2>&1
  iptables -I FORWARD -d 200.200.200.0/24 -j ACCEPT >>$LOG_FILE 2>&1

}

# Add openstack Liberty APT repo for Ubuntu Trusty
# TODO Create a task for this in quickstart/roles/common/tasks/debian.yml
function configure_repository {
  . /etc/os-release
  echo $NAME
  echo $VERSION
  if [[ "$NAME" =~ "Ubuntu" && "$VERSION" =~ "Trusty" ]]; then
    echo "* Configuring repository for Ubuntu... "
    cat > /etc/apt/sources.list << RE_CONF
    # Ubuntu Main Archive
    deb http://archive.ubuntu.com/ubuntu/ trusty main
    deb http://security.ubuntu.com/ubuntu trusty-updates main
    deb http://security.ubuntu.com/ubuntu trusty-security main

    # Ubuntu Universe Archive
    deb http://archive.ubuntu.com/ubuntu/ trusty universe
    deb http://security.ubuntu.com/ubuntu trusty-updates universe
    deb http://security.ubuntu.com/ubuntu trusty-security universe
RE_CONF

    #Enable the OpenStack repository
    apt-get update >>$LOG_FILE 2>&1
    apt-get -y install software-properties-common >>$LOG_FILE 2>&1
    add-apt-repository -y cloud-archive:liberty >>$LOG_FILE 2>&1
    echo "ok."
  fi
}

export LC_ALL=C
echo "Logging to $LOG_FILE"
check_root
mkdir -p $WORK_PATH
install_deps
configure_repository
get_pip
load_venv
install_ansible
get_tarball
check_distro
run_ansible
ip_forward

cat <<-EOF


        OpenStack Liberty with MidoNet 5.0.2 available in $HORIZON_URL
        To access through Horizon, use one of the following user/passwords:

        * demo/midonet (Demo tenant, demo user)
        * admin/midonet (Admin tenant, admin user)

        Thanks for trying MidoNet!


EOF
