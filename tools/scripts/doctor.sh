#!/bin/bash

echo "doctor.sh"

##################################################
# Color
# https://stackoverflow.com/a/65814978/1791115
NC='\033[0m' # No Color
red() { printf "\033[0;31m$@${NC}\n" ; }
green() { printf "\033[0;32m$@${NC}\n" ; }
yellow() { printf "\033[0;33m$@${NC}\n" ; }
secondary() { printf "\033[0;35m$@${NC}\n" ; }
##################################################

EXIT_STATUS=0

function test_volume () {
  local VOLUME_NAME=$1
  local MESSAGE="$(secondary "•") volume $(secondary $VOLUME_NAME)"

  docker volume inspect $VOLUME_NAME &> /dev/null

  if [ "$?" = "0" ]; then
    echo "$MESSAGE $(green "ok")"
  else
    echo "$MESSAGE $(red "doesn't exist")"
    EXIT_STATUS=2
  fi
}

function test_network () {
  local NETWORK_NAME=$1
  local MESSAGE="$(secondary "•") network $(secondary $NETWORK_NAME)"

  docker network inspect $NETWORK_NAME &> /dev/null

  if [ "$?" = "0" ]; then
    echo "$MESSAGE $(green "ok")"
  else
    echo "$MESSAGE $(red "doesn't exist")"
    EXIT_STATUS=4
  fi
}

test_volume qiyanalol-wordpress-vol
test_volume qiyanalol-db-vol
test_network qiyanalol-network

exit $EXIT_STATUS
