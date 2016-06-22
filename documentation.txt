------- HOW TO INSTALL PS3 MANAGER -------


[ PLAYSTATION 3 ]


Install WebMan on the PS3 (tested on version 1.43.16).
Enable the PS3MAPI from webMan setup settings.
Configure webMan under Setup to use the network share that we will share later:



Change IP to the IP Address of the machine running PS3NetSrv++ and sharing the  ISOs files to the PS3.


[ LINUX WEB SERVER ]


Install PS3NetSrv++:

Follow the steps to compile it that are on the website on GitHub and share the directory that contains the PS3 ISOs files.

Once the PS3NetSrv++ is installed launch it like follows:

For example I run PS3NetSrv++ from the command line like that:

root@linuxbox:~# ./ps3netsrv-- /path/to/your/ps3/games/PS3/ & 

The typical structure of a directory to be used by PS3NetSrv++ is: 

drwxrwxrwx 2 99 nogroup 4096 Feb 7 03:12 BDISO 
drwxrwxrwx 2 99 nogroup 4096 Feb 7 03:12 DVDISO 
drwxrwxrwx 2 99 nogroup 4096 Feb 7 03:12 GAMES 
drwxrwxrwx 2 99 nogroup 4096 Feb 7 03:12 MUSIC 
drwxrwxrwx 2 99 nogroup 4096 Feb 7 03:12 PICTURE 
drwxrwxrwx 2 99 nogroup 4096 Feb 7 03:13 PKG 
drwxrwxrwx 2 99 nogroup 4096 Apr 6 12:05 PS2ISO 
drwxrwxrwx 2 99 nogroup 81920 Jun 22 09:02 PS3ISO

Where PS3ISO is the directory containing the PS3 Games ISOs files.

When creating the Games ISOs for the PS ISO Tools remember the format for the ISO file to be used by PS3 Manager is like the following example:

YAKUZA_3_[BLES00834].iso 

Dont use spaces in the game name and leave the unique game code (for example [BLES00834]) inside the square brackets. This is will be used by the scripts that you will add to the crontab to recognize the game and to download cover image and all the game details from Metacritic.

*** VERY IMPORTANT ***

The directory containing the ISOs must be accessible in reading and writing by PS3 Manager.

In order to do this issue the following command:

root@linuxbox:~# ln -s /path/to/isos/files/PS3/PS3ISO /path/to/www/ps3-manager/html/covers

root@linuxbox:~# chmod -R 755 /path/to/isos/files/PS3/PS3ISO


Unzip the package ps3_manager_0.30.zip into your web directory:

Edit the file config.php as it follows:

// PS3 IP ADDRESS (Put the LAN IP Address of your PS3)
$ps3_ip = "PS3_IP_ADDRESS";

// PS3 SHARE WHERE THE ISOs ARE (shared also with PS3NetSrv++)
$ps3_folder = "/path/to/isos/files/PS3/PS3ISO";

// FORCE EXTERNAL GAME DATA OR DISABLE IT
// Enable it only if you have an external USB drive connected to the PS3 that you use to install the GameData files.
// Default is "N".
$game_data_force = "N";

// WWW LOCAL PATH (The WWW path where your PS3 Manager files are)
$local_path = "/path//to/www/ps3-manager/html";

Edit the file mysql_conf.php as it follows:

// MYSQL Server Details
$mysql_host = "MYSQL_SERVER_IP";
$mysql_user = "MYSQL_USER";
$mysql_password = "MYSQL_PASSWORD";
$mysql_db = "ps3-games"; <---- change this only if you want to call the database in a different way


Creating the MYSQL database:

The MySQL server can be installed on the same box or in another box reachable by your web server.

I suggest (not required) also the installation of PHPMyAdmin. This is in case you might need to correct a game record in the database when something did not work the way you want.

You will find the file ps3-games.sql inside the directory "sql".

Import the sql file with the following command:

root@linuxbox:~# mysqldump -h MYSQL_SERVER_IP -u USER -pPASSWORD ps3-games < ps3-games.sql


Installing Crontabs.

In order to run automatic commands and to add automatically a new game present in the ISOs PS3 Manager needs to have the following crons added to the linux box.

Issue the following command:

root@linuxbox:~# crontab -e

Once it is opened edit the following lines on a text editor and paste into it:

*/2 * * * * /usr/bin/php /path/to/www/ps3-manager/html/covers_resize.php > /dev/null 2>&1 
*/2 * * * * /usr/bin/php /path/to/www/ps3-manager/html/covers_downloader.php > /dev/null 2>&1 
*/2 * * * * /usr/bin/php /path/to/www/ps3-manager/html/sql_import.php > /dev/null 2>&1 
*/5 * * * * /usr/bin/php /path/to/www/ps3-manager/html/ps3_status_checker.php > /dev/null 2>&1 
*/10 * * * * /usr/bin/perl -le 'map { $sum += -s } @ARGV; print $sum' -- /path/to/isos/files/PS3/PS3ISO/*.iso > /path/to/www/ps3-manager/html/glob_iso_size.txt 2>&1 
*/2 * * * * /usr/bin/php /path/to/www/ps3-manager/html/date_conv.php > /dev/null 2>&1


Go to your http://ps3-manager-host/ and start adding ISOs files to the shared directory.
