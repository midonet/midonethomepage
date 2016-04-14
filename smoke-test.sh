# Smoke test for Openstack Liberty with Midonet 5.0.2
# Author: Calsoft Inc.

RANDOM=1
image_name=CirrOS
externalnet=public
tenantname=smoketenant$RANDOM
username=smokeuser$RANDOM
subnetspace=5.5.5.0
routername=smokerouter$RANDOM
privnetname=smokenet$RANDOM
privsubnetname=smokesubnet$RANDOM
SECGROUP=allin$RANDOM

imagename=$(glance image-list | grep "CirrOS\ " | awk '{print $2;}')

# Create a tenant, user and associate a role/tenant to it

# Create tenant
echo "Creating New Tenant"
openstack project create --description 'Smoke Test Project' $tenantname

# Create user
echo "Creating New User"
openstack user create --project $tenantname --password openstack $username

# Create user role
openstack role create user

# Add user role
echo "Adding user role"
openstack role add --user $username --project $tenantname user

# List tenant and user
echo "Project List"; openstack project list
echo "User List"; openstack user list

# Create Environment Variable file for newly created tenant
export OS_PROJECT_NAME=$tenantname
export OS_TENANT_NAME=$tenantname
export OS_USERNAME=$username
export OS_PASSWORD=openstack

# Create new private network, subnet for this user tenant
neutron net-create $privnetname

neutron subnet-create $privnetname \
        $subnetspace/24            \
        --name $privsubnetname


# Create a router
neutron router-create $routername

# Associate the router to the external network by setting its gateway
# NOTE: This assumes the external network name is 'ext'
EXT_NET=$(neutron net-list | grep $externalnet | awk '{print $2;}')
PRIV_NET=$(neutron net-list | grep $privnetname | awk '{print $2;}')
PRIV_SUBNET=$(neutron subnet-list | grep $privsubnetname | awk '{print $2;}')
ROUTER_ID=$(neutron router-list | grep $routername | awk '{print $2;}')

neutron router-gateway-set  \
        $ROUTER_ID $EXT_NET

neutron router-interface-add \
        $ROUTER_ID $PRIV_SUBNET


# Add Neutron security groups for this test tenant
neutron security-group-create $SECGROUP

neutron security-group-rule-create   \
        --protocol icmp              \
        --direction ingress          \
        --remote-ip-prefix 0.0.0.0/0 \
        $SECGROUP

neutron security-group-rule-create   \
        --protocol tcp               \
        --direction ingress          \
        --remote-ip-prefix 0.0.0.0/0 \
        $SECGROUP

neutron security-group-rule-create   \
        --protocol udp               \
        --direction ingress          \
        --remote-ip-prefix 0.0.0.0/0 \
        $SECGROUP

# Add Nova security groups for this tenant
nova secgroup-add-rule default icmp -1 -1 0.0.0.0/0
nova secgroup-add-rule default tcp 22 22 0.0.0.0/0
nova secgroup-add-rule default tcp 80 80 0.0.0.0/0

nova keypair-add test-key > test-key.pem

# Boot some instances
NOVA_BOOT_ARGS="--key-name test-key --image $imagename --flavor m1.tiny --nic net-id=$PRIV_NET"
nova boot ${NOVA_BOOT_ARGS} node1
nova boot ${NOVA_BOOT_ARGS} node2
nova boot ${NOVA_BOOT_ARGS} client1

# Assign floating ips
FIP1=$(nova floating-ip-create $EXT_NET | grep $externalnet | awk '{print $4;}')
FIP2=$(nova floating-ip-create $EXT_NET | grep $externalnet | awk '{print $4;}')
FIP3=$(nova floating-ip-create $EXT_NET | grep $externalnet | awk '{print $4;}')
nova floating-ip-associate node1 $FIP1
nova floating-ip-associate node2 $FIP2
nova floating-ip-associate client1 $FIP3

sleep 10
nova list
ping -c 2 $FIP1
ping -c 2 $FIP2
ping -c 2 $FIP3
ping -c 2 google.com

# Clear up
echo "Starting clean up process"

# Delete instances
NODE1=$(nova list | grep node1 | awk '{print $2;}')
NODE2=$(nova list | grep node2 | awk '{print $2;}')
CLIENT1=$(nova list| grep client1 | awk '{print $2;}')
nova delete $NODE1
nova delete $NODE2
nova delete $CLIENT1

# Remove keypair
echo "Removing keypair"
sudo rm test-key.pem

# Remove Neutron security group
echo "Removing Neutron security group"
neutron security-group-delete $SECGROUP

# Switch to admin for removing user role, user and tenant
export OS_PROJECT_NAME=admin
export OS_TENANT_NAME=admin
export OS_USERNAME=admin
export OS_PASSWORD=midonet

# Remove user role
echo "Removing user role"
openstack role delete user

# Remove user
echo "Removing user"
openstack user delete $username

# Remove tenant
echo "Removing tenant"
openstack project delete $tenantname
