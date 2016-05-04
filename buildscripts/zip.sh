#!/usr/bin/env bash

set -e

readonly ROOT=$(dirname $0)
readonly PLUGIN_DIR="${ROOT}/../blogfoster-insights"

cd "${ROOT}" # we should be in the buildscripts direcotry now

# cleanup left overs
rm -f ../blogfoster-insights.zip
rm -rf ./blogfoster-insights

# copy data
cp -r ../blogfoster-insights/trunk blogfoster-insights
zip -rv blogfoster-insights.zip ./blogfoster-insights

# cleanup copied data
rm -rf ./blogfoster-insights

# mv zip to root
mv ./blogfoster-insights.zip ..
