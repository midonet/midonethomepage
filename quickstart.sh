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

MIDONET_VERSION=5.0.2
WORK_PATH=/opt/quickstart-midonet
LOG_FILE=$WORK_PATH/quickstart-midonet.log
DEB_PKGS="curl wget git"
RPM_PKGS="curl wget redhat-lsb-core redhat-lsb epel-release git"
DEFAULT_NIC=$(ip r | grep default | grep -o "dev [a-z0-9]*" | awk '{ print $2 }')
ETH0_IP=$(ip -4 -o a  show dev $DEFAULT_NIC  | awk '{ ADDR=$4; gsub("/.+", "", ADDR); print ADDR; }')
VIRT="qemu"

# Functions
function check_root {
  if [ "$(id -u)" != "0" ]; then
    echo "This script must be run as root."
    exit 1
  fi
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
    DISTRO="ubuntu14"
  elif [[ "$NAME" =~ "CentOS" && "$VERSION_ID" =~ "7" ]]; then
    DISTRO="centos7"
  else
    distro_fail
  fi
  echo "ok."
}

# Install dependencies
function install_deps {
  echo -n "* Installing basic dependencies... "
  if [[ "$DISTRO" == "ubuntu14" ]]; then
    apt-get update >>$LOG_FILE 2>&1
    apt-get -y install $DEB_PKGS >>$LOG_FILE 2>&1
  elif [[ "$DISTRO" == "centos7" ]]; then
    yum -y install $RPM_PKGS >>$LOG_FILE 2>&1
  else
    distro_fail
  fi
  echo "ok."
}

function install_ansible {
  echo -n "* Installing ansible... "
  if [[ "$DISTRO" == "ubuntu14" ]]; then
    apt-add-repository -y ppa:ansible/ansible >>$LOG_FILE 2>&1
    apt-get update >>$LOG_FILE 2>&1
    apt-get install -y ansible >>$LOG_FILE 2>&1
  elif [[ "$DISTRO" == "centos7" ]]; then
	  yum install -y ansible >>$LOG_FILE 2>&1
  else
    distro_fail
  fi
  echo "ok."
}

function clone {
  echo -n "* Cloning the installer at $WORK_PATH "
  cd $WORK_PATH/
  git clone https://github.com/midonet/ansible-midonet >>$LOG_FILE 2>&1
  cd ansible-midonet
  git checkout quickstart >>$LOG_FILE 2>&1
  git submodule update --init >>$LOG_FILE 2>&1
  echo "ok."
}

function run_ansible {
  echo "* Running ansible... "
  cd $WORK_PATH/ansible-midonet
  if [ -n "$DEBUG" ]; then
    EXTRA_FLAGS="-vvvv"
  fi
  ansible-playbook $EXTRA_FLAGS -i hosts_localhost_allinone -e deploy=$DISTRO -e os_virt_type=$VIRT local-allinone.yml >>$LOG_FILE 2>&1
}

function ip_forward {
  echo -n "* Enabling IP forwarding on host... "
  sysctl -w net.ipv4.ip_forward=1 >>$LOG_FILE 2>&1
  iptables -t nat -I POSTROUTING -o $DEFAULT_NIC -s 200.200.200.0/24 -j MASQUERADE >>$LOG_FILE 2>&1
  iptables -I FORWARD -s 200.200.200.0/24 -j ACCEPT >>$LOG_FILE 2>&1
  iptables -I FORWARD -d 200.200.200.0/24 -j ACCEPT >>$LOG_FILE 2>&1

}

export LC_ALL=C
echo "Logging to $LOG_FILE"
check_root
mkdir -p $WORK_PATH
check_distro
install_deps
install_ansible
clone
run_ansible
ip_forward

cat <<-EOF


        OpenStack Liberty with MidoNet $MIDONET_VERSION available in $HORIZON_URL
        To access through Horizon, use one of the following user/passwords:

        * demo/midonet (Demo tenant, demo user)
        * admin/midonet (Admin tenant, admin user)

        Thanks for trying MidoNet!


EOF
