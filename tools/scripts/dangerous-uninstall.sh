#!/bin/bash

echo "dangerous-uninstall.sh"
echo ""

./stop.sh
./backup.sh

docker volume rm qiyanalol-wordpress-vol
docker volume rm qiyanalol-db-vol
docker network rm qiyanalol-network
