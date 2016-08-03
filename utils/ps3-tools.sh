#!/bin/bash

WWW_FOLDER=$1 # PS3 Manager WWW Folder
ISO_FOLDER=$2 # Games ISOs Folder

if ! mkdir /tmp/ps3-tools.lock; then
    printf "Failed to aquire lock.\n" >&2
    exit 1
fi
trap 'rm -rf /tmp/ps3-tools.lock' EXIT  # remove the lockdir on exit



while :; do 

# Change /path/to/www/ps3-manager/html with the path of your PS3 Manager Web Root (the same you configured in the config.php file).
# Change /path/to/isos/files/ with the path of your Games ISOs Directory (the same you configured in the config.php file).

/usr/bin/php $WWW_FOLDER/sql_import.php;
/usr/bin/php $WWW_FOLDER/covers_resize.php;
/usr/bin/php $WWW_FOLDER/covers_downloader.php;
/usr/bin/perl -le 'map { $sum += -s } @ARGV; print $sum' -- $ISO_FOLDER/*.iso > $WWW_FOLDER/site/glob_iso_size.txt;
/usr/bin/php $WWW_FOLDER/date_conv.php;
sleep 20; done


