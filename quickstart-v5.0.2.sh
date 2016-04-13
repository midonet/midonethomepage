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

WORK_PATH=/opt/quickstart-midonet
LOG_FILE=$WORK_PATH/quickstart-midonet.log
TARBALL_URL=https://www.midonet.org/quickstart-v5.0.2.tgz
ETH0_IP=$(ip -4 -o a  show dev eth0  | awk '{ ADDR=$4; gsub("/.+", "", ADDR); print ADDR; }')

if [ -n "$OVERRIDE_URL" ]; then
  TARBALL_URL=$OVERRIDE_URL
fi

APT=`command -v apt-get` || true
YUM=`command -v yum` || true

# Functions
function check_root {
  if [ "$(id -u)" != "0" ]; then
    echo "This script must be run as root."
    exit 1
  fi
}

# Install dependencies
function install_deps {
  echo -n "* Installing basic dependencies... "
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

function install_ansible {
  echo -n "* Installing ansible... "
  if [[ "$APT" != "" ]]; then
    apt-get -y install software-properties-common >>$LOG_FILE 2>&1
    apt-add-repository -y ppa:ansible/ansible-1.9 >>$LOG_FILE 2>&1
    apt-get update >>$LOG_FILE 2>&1
    apt-get install -y ansible >>$LOG_FILE 2>&1
  elif [[ "$YUM" != "" ]]; then
    yum install -y epel-release >>$LOG_FILE 2>&1
    yum install -y ansible-1.9.4-1.el7 >>$LOG_FILE 2>&1
  else
    distro_fail
  fi
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
  echo $NAME >>$LOG_FILE 2>&1
  echo $VERSION >>$LOG_FILE 2>&1
  HORIZON_URL="http://$ETH0_IP/horizon"
  if [[ "$NAME" =~ "Ubuntu" && "$VERSION" =~ "Trusty" ]]; then
    DISTRO='ubuntu14'
  elif [[ "$NAME" =~ "CentOS" && "$VERSION" =~ "Core" ]]; then
    DISTRO='centos7'
  else
    distro_fail
  fi
  echo "ok."
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

export LC_ALL=C
echo "Logging to $LOG_FILE"
check_root
mkdir -p $WORK_PATH
install_deps
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
