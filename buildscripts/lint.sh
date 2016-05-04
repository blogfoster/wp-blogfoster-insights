#!/usr/bin/env bash

set -e

readonly ROOT=$(dirname $0)
readonly PLUGIN_DIR="${ROOT}/../blogfoster-insights"

for filename in `find "${PLUGIN_DIR}" -type f -name '*.php'`; do
  php -l "${filename}";
done
