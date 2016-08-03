#!/bin/bash

WWW_FOLDER=$1

if ! mkdir /tmp/ps3-statuschk.lock; then
    printf "Failed to aquire lock.\n" >&2
    exit 1
fi
trap 'rm -rf /tmp/ps3-statuschk.lock' EXIT  # remove the lockdir on exit



while :; do

# Change /path/to/www/ps3-manager/html with the path of your PS3 Manager Web Root (the same you configured in the config.php file).

/usr/bin/php $WWW_FOLDER/ps3_status_checker.php;

sleep 1; done