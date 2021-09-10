#!/bin/bash

echo "dev.sh"

# cd to project root
cd $(dirname "${BASH_SOURCE[0]}")
cd ../../

# check if node is installed
which npm &> /dev/null

if [ "$?" = "1" ]; then
  echo "This script requires NodeJS"
  exit 1
fi

# watch css
npx node-sass \
  --watch wordpress/themes/generatepress-child/assets/scss \
  --output wordpress/themes/generatepress-child/assets/css \
  --output-style compressed
