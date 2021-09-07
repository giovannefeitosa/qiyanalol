#!/bin/bash

echo "run.sh"

# cd to project root
cd $(dirname "${BASH_SOURCE[0]}")
cd ../../

# check if doctor is ok
./cli.sh doctor &> /dev/null
if [ "$?" -ne "0" ]; then
  echo "You can not run this software because ./cli.sh doctor returned an error"
  exit 3
fi

# load .env
set -a
source .env
set +a

# run database
if [ "$DOCKER_COMPOSE_DATABASE_ENABLE" = "1" ]; then
  docker-compose \
    --env-file .env \
    -f docker/database/docker-compose.yml \
    up -d
fi

# run wordpress
docker-compose \
  --env-file .env \
  -f docker/wordpress/docker-compose.yml \
  up -d --force-recreate
