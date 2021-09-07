#!/bin/bash

echo "stop.sh"

# cd to project root
cd $(dirname "${BASH_SOURCE[0]}")
cd ../../

docker-compose -f docker/database/docker-compose.yml down
docker-compose -f docker/wordpress/docker-compose.yml down
