#!/bin/bash

WWW_FOLDER=$1 # PS3 Manager WWW Folder
ISO_FOLDER=$2 # Games ISOs Folder

if ! mkdir /tmp/ps3-tools.lock; then
    printf "Failed to aquire lock.\n" >&2
    exit 1
fi
trap 'rm -rf /tmp/ps3-tools.lock' EXIT  # remove the lockdir on exit

# STARTING PS3NETSRV
PS3_NETSRV_PID=$(pgrep ps3netsrv)

#if [ -z "$PS3_NETSRV_PID" ]
#then
#  /opt/ps3netsrv--/ps3netsrv++ -d $ISO_FOLDER;  
#fi

while :; do 

/usr/bin/php $WWW_FOLDER/sql_import.php;
/usr/bin/php $WWW_FOLDER/covers_resize.php;
/usr/bin/php $WWW_FOLDER/covers_downloader.php;
/usr/bin/perl -le 'map { $sum += -s } @ARGV; print $sum' -- $ISO_FOLDER/*.iso > $WWW_FOLDER/glob_iso_size.txt;
/usr/bin/php $WWW_FOLDER/date_conv.php;

sleep 5; done

