#!/bin/sh
source '.env'
# Make key file executable
chmod 400 $KEYFILE

# Create ssh tunnel into instance
ssh -i $KEYFILE bitnami@$SERVER_IP

#ssh -N -L 8888:127.0.0.1:80 bitnami@$SERVER_IP

#PRint content of file to terminal
cat ./bitnami_credentials

sudo cat /opt/bitnami/var/data/bitnami_credentials/credentials