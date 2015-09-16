#!/bin/bash
set -e

#
# This script installs and configures MidoNet with OpenStack
# using MidoNet and Stackforge Puppet modules
#

# Set the hostname in /etc/hosts
sed -i "1c\127.0.0.1 $(hostname) localhost" /etc/hosts

export LOG_FILE=/var/log/midonet-allinone.log

cat <<-EOF
=====================================================
MidoNet 2015.01 / OpenStack Juno all-in-one installer
=====================================================

Check out logs at /var/log/midonet-allinone.log file.
Contact to midonet-dev@lists.midonet.org for any question or troubleshooting
------------------------------------------------------

EOF


install_puppet_and_modules() {

	cat <<-EOF
	* Installing 'puppet' and midonet puppet modules...
	EOF

	apt-get -y update | tee $LOG_FILE | cat &> /dev/null
	apt-get install -y puppet | tee -a $LOG_FILE | cat &> /dev/null
	puppet module install midonet-midonet_openstack | tee -a $LOG_FILE | cat &> /dev/null
	puppet module install --force midonet-neutron | tee -a $LOG_FILE | cat &> /dev/null

	cat <<-EOF
	* Puppet modules successfully installed
	EOF

}

create_macvlan() {

	cat <<-EOF
	* Creating macvlan attached to eth0 with IP address '172.28.28.4'
	OS services will listen this IP address
	EOF
	ip l add osservices link eth0 type macvlan ||:
	ip a add 172.28.28.4/24 dev osservices ||:
}

configure_puppet_manifests() {
	mkdir -p /var/lib/hiera

	cat <<-EOF
	* Configuring Puppet manifests before deployment
	EOF

	# common.yaml with hiera data
	cat <<-EOF > /var/lib/hiera/common.yaml
	openstack::region: 'openstack'

	######## Networks
	openstack::network::api: '172.28.28.4/24'
	openstack::network::external: '192.168.22.0/24'
	openstack::network::management: '172.28.28.4/24'
	openstack::network::data: '192.168.22.0/24'

	openstack::network::external::ippool::start: 192.168.22.100
	openstack::network::external::ippool::end: 192.168.22.200
	openstack::network::external::gateway: 192.168.22.2
	openstack::network::external::dns: 192.168.22.2

	######## Private Neutron Network

	openstack::network::neutron::private: '10.0.0.0/24'

	######## Fixed IPs (controllers)

	openstack::controller::address::api: '172.28.28.4'
	openstack::controller::address::management: '172.28.28.4'
	openstack::storage::address::api: '172.28.28.4'
	openstack::storage::address::management: '172.28.28.4'

	######## Database

	openstack::mysql::root_password: 'testmido'
	openstack::mysql::service_password: 'testmido'
	openstack::mysql::allowed_hosts: ['172.28.28.4']

	openstack::mysql::keystone::user: 'keystone'
	openstack::mysql::keystone::pass: 'testmido'

	openstack::mysql::glance::user: 'glance'
	openstack::mysql::glance::pass: 'testmido'
	openstack::glance::api_servers: ['172.28.28.4:9292']

	openstack::mysql::nova::user: 'nova'
	openstack::mysql::nova::pass: 'testmido'

	openstack::mysql::neutron::user: 'neutron'
	openstack::mysql::neutron::pass: 'testmido'

	######## RabbitMQ

	openstack::rabbitmq::user: 'openstack'
	openstack::rabbitmq::password: 'testmido'
	openstack::rabbitmq::hosts: ['172.28.28.4:5672']

	######## Keystone

	openstack::keystone::admin_token: 'testmido'
	openstack::keystone::admin_email: 'mido-dev@lists.midonet.org'
	openstack::keystone::admin_password: 'testmido'

	openstack::keystone::tenants:
	    "midokura":
	        description: "Test tenant"

	openstack::keystone::users:
	    "midoadmin":
	        password: "midoadmin"
	        tenant: "midokura"
	        email: "foo@midokura.com"
	        admin: true
	    "midouser":
	        password: "midouser"
	        tenant: "midokura"
	        email: "bar@midokura.com"
	        admin: false
	    "midonet":
	        password: 'testmido'
	        tenant: 'services'
	        email: "midonet@midokura.com"
	        admin: true

	######## Glance

	openstack::glance::password: 'midokura'

	######## Cinder

	openstack::cinder::password: 'testmido'
	openstack::cinder::volume_size: '8G'

	######## Swift

	openstack::swift::password: 'dexc-flo'
	openstack::swift::hash_suffix: 'pop-bang'

	######## Nova

	openstack::nova::libvirt_type: 'qemu'
	openstack::nova::password: 'testmido'

	######## Neutron

	openstack::neutron::password: 'testmido'
	openstack::neutron::shared_secret: 'testmido'
	openstack::neutron::core_plugin: 'midonet.neutron.plugin.MidonetPluginV2'
	openstack::neutron::service_plugins: []

	######## Horizon

	openstack::horizon::secret_key: 'testmido'
	openstack::horizon::horizon_server_aliases: ['*']
	openstack::horizon::allowed_hosts: ['*']

	# Even some of this data is not deployed, it seems to be mandatory for
	# puppetlabs-openstack project. So let's keep configure it
	######## Tempest

	openstack::tempest::configure_images    : true
	openstack::tempest::image_name          : 'Cirros'
	openstack::tempest::image_name_alt      : 'Cirros'
	openstack::tempest::username            : 'demo'
	openstack::tempest::username_alt        : 'demo2'
	openstack::tempest::username_admin      : 'test'
	openstack::tempest::configure_network   : true
	openstack::tempest::public_network_name : 'public'
	openstack::tempest::cinder_available    : false
	openstack::tempest::glance_available    : true
	openstack::tempest::horizon_available   : true
	openstack::tempest::nova_available      : true
	openstack::tempest::neutron_available   : true
	openstack::tempest::heat_available      : false
	openstack::tempest::swift_available     : false

	######## Log levels
	openstack::verbose: 'True'
	openstack::debug: 'True'

	######## Ceilometer
	openstack::ceilometer::address::management: '0.0.0.0'
	openstack::ceilometer::mongo::username: 'mongo'
	openstack::ceilometer::mongo::password: 'mongosecretkey123'
	openstack::ceilometer::password: 'whi-truz'
	openstack::ceilometer::meteringsecret: 'ceilometersecretkey'

	######## Heat
	openstack::heat::password: 'zap-bang'
	openstack::heat::encryption_key: 'heatsecretkey123'
	EOF

	# Insert hiera configuration file
	cat <<-EOF > /etc/puppet/hiera.yaml
	---
	:backends:
	  - yaml
	  - module_data
	:yaml:
	  :datadir: /var/lib/hiera
	:hierarchy:
	  - common
	EOF

	# Actual manifest to run
	cat <<-EOF > /etc/puppet/manifests/site.pp

	# Most images does not have the fqdn infored via 'facter'. This line
	# tricks the deployment using fqdn as the same value as hostname
    if empty(\$::fqdn) {
	    \$fqdn = \$::hostname
    }
	include midonet_openstack::role::allinone

	EOF
}

apply_manifest() {
	cat <<-EOF
	* Applying puppet manifest... This can take a while (30-40 m)
	EOF
	puppet apply /etc/puppet/manifests/site.pp 2>&1 | tee -a $LOG_FILE | cat &>/dev/null
}

create_init_file() {
	cat <<-EOF
	* Ensure the IP address 172.28.28.4 is available on each restart
	by creating an upstart init file
	EOF

	cat <<-EOF > /etc/init/adapt.conf

	# description "A script to make the system have a device with the fixed snapshot ip and accessible horizon"
	# Author "Antoni Segura Puimedon - toni@midokura.com"

	start on (started networking)
	stop on shutdown

	script
	    ip link add osservices link eth0 type macvlan
	    ip addr add 172.28.28.4/24 dev osservices

	    hostnamectl set-hostname $(facter hostname)
	end script
	EOF
}

patch_horizon() {

	cat <<-EOF
	* Patching Horizon because of https://bugs.launchpad.net/horizon/+bug/1394051
	EOF

	# For some reason, Horizon does not allow all hosts
	sed -i "/^ALLOWED_HOSTS/c\ALLOWED_HOSTS = ['*']" \
		/etc/openstack-dashboard/local_settings.py
	sed -i "/ServerAlias 172.28.28.4/a\ \ ServerAlias *" \
		/etc/apache2/sites-available/15-horizon_vhost.conf
		hostnamectl set-hostname $(facter hostname)


	cat <<-EOF > /tmp/horizon_floating_ip.patch
	diff --git a/openstack_dashboard/api/neutron.py b/openstack_dashboard/api/neutron.py
	index fff61ad..ebe37d1 100644
	--- a/openstack_dashboard/api/neutron.py
	+++ b/openstack_dashboard/api/neutron.py
	@@ -411,10 +411,14 @@ class FloatingIpManager(network_base.FloatingIpManager):
	                           r.external_gateway_info.get('network_id')
	                           in ext_net_ids)]
	         reachable_subnets = set([p.fixed_ips[0]['subnet_id'] for p in ports
	-                                 if ((p.device_owner ==
	-                                      'network:router_interface')
	-                                     and (p.device_id in gw_routers))])
	-        return reachable_subnets
	+                                if ((p.device_owner in
	+                                     ROUTER_INTERFACE_OWNERS)
	+                                    and (p.device_id in gw_routers))])
	+        # we have to include any shared subnets as well because we may not
	+        # have permission to see the router interface to infer connectivity
	+        shared = set([s.id for n in network_list(self.request, shared=True)
	+                      for s in n.subnets])
	+        return reachable_subnets | shared
 
	      def list_targets(self):
	          tenant_id = self.request.user.tenant_id
	-- 
	2.3.7
	diff --git a/openstack_dashboard/api/neutron.py b/openstack_dashboard/api/neutron.py
	index ebe37d1..3a4edd8 100644
	--- a/openstack_dashboard/api/neutron.py
	+++ b/openstack_dashboard/api/neutron.py
	@@ -46,6 +46,11 @@ IP_VERSION_DICT = {4: 'IPv4', 6: 'IPv6'}
	 OFF_STATE = 'OFF'
	 ON_STATE = 'ON'
 
	+ROUTER_INTERFACE_OWNERS = (
	+    'network:router_interface',
	+    'network:router_interface_distributed'
	+)
	+
	 
	 class NeutronAPIDictWrapper(base.APIDictWrapper):
   	  
	-- 
	2.3.7
	EOF

	# Apply the patch
	cd /usr/share/openstack-dashboard
	patch -N -p1 < /tmp/horizon_floating_ip.patch
	cd -

	cat <<-EOF
	* Restarting Horizon...
	EOF
	service apache2 restart
}

install_puppet_and_modules
create_macvlan
configure_puppet_manifests
apply_manifest
create_init_file
patch_horizon

cat <<-EOF
	
	
	    OpenStack Juno with MidoNet available in http://<your-ip-address>
	    To access through Horizon, use one of the following user/passwords:

	    * midoadmin/midoadmin (Midokura tenant, admin user)
	    * midouser/midouser (Midokura tenant, raw user)
	    * admin/testmido (Admin tenant, admin user)

	    Thanks for trying MidoNet!


EOF
