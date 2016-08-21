#!/bin/bash

WWW_FOLDER=$1

if ! mkdir /tmp/ps3-statuschk.lock; then
    printf "Failed to aquire lock.\n" >&2
    exit 1
fi
trap 'rm -rf /tmp/ps3-statuschk.lock' EXIT  # remove the lockdir on exit

while :; do

/usr/bin/php $WWW_FOLDER/ps3_status_checker.php;

sleep 1; done
