#!/usr/bin/env bash

set -e

readonly ROOT=$(dirname $0)
readonly NAME='wp-blogfoster-insights'
readonly PLUGIN_DIR="${ROOT}/../${NAME}/trunk"

for filename in `find "${PLUGIN_DIR}" -type f -name '*.php'`; do
  php -l "${filename}";
done
