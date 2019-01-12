#!/bin/sh
source '.env'
# Make key file executable
chmod 400 $KEYFILE

# Create ssh tunnel into instance
ssh -N -L 8888:127.0.0.1:80 -i $KEYFILE bitnami@$SERVER_IP

ssh -N -L 8888:127.0.0.1:80 bitnami@$SERVER_IP




