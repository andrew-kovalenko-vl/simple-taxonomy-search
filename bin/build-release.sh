#!/usr/bin/env bash

if [ $# -lt 2 ]; then
    echo "usage: $0 <development-path> <build-path>"
    exit 1
fi

DEVELOP_PATH=$1
BUILD_PATH=$2

if [[ ! -d $BUILD_PATH ]]; then
    mdkir -p "$BUILD_PATH"
fi

rsync -uav "$DEVELOP_PATH/" "$BUILD_PATH" --exclude=bin --exclude=tests --exclude=.gitignore --exclude=.travis.yml --exclude=README.md --exclude=phpunit.xml --exclude=.git
