#!/usr/bin/env bash

set -e

readonly ROOT=$(dirname $0)
readonly NAME='wp-blogfoster-insights'
readonly PLUGIN_DIR="${ROOT}/../${NAME}"

cd "${ROOT}" # we should be in the buildscripts direcotry now

# cleanup left overs
rm -f "../${NAME}.zip"
rm -rf "./${NAME}"

# copy data
cp -r "../${NAME}/trunk" "${NAME}"
zip -rv "${NAME}.zip" "./${NAME}"

# cleanup copied data
rm -rf "./${NAME}"

# mv zip to root
mv "./${NAME}.zip" ..
