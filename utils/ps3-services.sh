#!/bin/bash

echo -e "\n***** PS3 Games Manager Tools Launcher/Stopper Services *****\n";

WWW_FOLDER="/path/to/www/ps3-manager/html" # Your PS3 Manager WWW Folder
ISO_FOLDER="/path/to/isos/files/PS3/PS3ISO" # Your Games ISOs Folder

if [ $1 == "stop" ]
then

echo -e "Killing running processes:";

	killall -9  ps3-tools.sh
	echo -e "ps3-tools.sh Killed";
	killall -9  ps3-statuschk.sh
	echo -e "ps3-statuschk.sh Killed";


echo -e "\nAll Processes killed.\n";

echo -e "Removing processes lock files:";

	rm -rf  /tmp/ps3-statuschk.lock/
	rm -rf  /tmp/ps3-tools.lock/

echo -e "\nLock files removed.\n";

	echo -e "PS3 Games Manager Services Stopped.\n";


elif [ $1 == "start"  ]
then

echo -e "Starting processes:\n";

	$WWW_FOLDER/utils/ps3-tools.sh $WWW_FOLDER $ISO_FOLDER > /dev/null 2>&1 &
	echo -e "ps3-tools.sh started with PID "$!;
	$WWW_FOLDER/utils/ps3-statuschk.sh $WWW_FOLDER > /dev/null 2>&1 &
	echo -e "ps3-statuschk.sh started with PID "$!"\n";


	echo -e "PS3 Games Manager Services Started.\n";

else
	echo -e "Please specify 'start' or 'stop' as parameters.\n";

fi
