#!/bin/bash

echo "install.sh"

docker volume create qiyanalol-wordpress-vol
docker volume create qiyanalol-db-vol
docker network create qiyanalol-network
