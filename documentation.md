<center><b>------- HOW TO INSTALL PS3 MANAGER -------</b></center><br><br>

<center><b>[ PLAYSTATION 3 ]</b></center><br><br>

<ul style="text-indent: 0px; margin-left: 24px; list-style-position: outside; list-style-type: disc;">
<li>Install <a href="https://github.com/aldostools/webMAN-MOD" target="_blank"><b>WebMan</b></a> on the PS3 (tested on version 1.43.16). </li>
<li>Enable the <b>PS3MAPI</b> from <b>webMan</b> setup settings.</li>
<li>Configure <b>webMan</b> under Setup to use the network share that we will share later:<br/><br/>
<img alt="" style="padding : 1px; width:90%; height:auto;" src="http://demo-ps3.fazionet.com/images/webMan_Network_Share.png"><br/><br/>
Change IP to the IP Address of the machine running <a href="https://github.com/dirkvdb/ps3netsrv--" target="_blank"><b>PS3NetSrv++</b></a> and sharing the &nbsp;ISOs files to the PS3.</li>
</ul>

<br><br>
<center><b>[ LINUX WEB SERVER ]</b></center><br><br>

<ul style="text-indent: 0px; margin-left: 24px; list-style-position: outside; list-style-type: disc;">
<li><span style="font-size: 20px; color: #55A3EC">Install PS3NetSrv++:</span><br><br>

Follow the steps to compile it that are on the website on GitHub and share the directory that contains the PS3 ISOs files.<br><br>

Once the <b><a href="https://github.com/dirkvdb/ps3netsrv--" target="_blank">PS3NetSrv++</a></b> is installed launch it like follows:<br><br>

For example I run <b>PS3NetSrv++</b> from the command line like that:<br><br>

       <i>root@linuxbox:~# <b>./ps3netsrv-- /path/to/your/ps3/games/PS3/ & </b></i><br><br>

       The typical structure of a directory to be used by <b>PS3NetSrv++</b> is: <br><br>
       
       drwxrwxrwx  2 99 nogroup  4096 Feb  7 03:12 BDISO <br>
       drwxrwxrwx  2 99 nogroup  4096 Feb  7 03:12 DVDISO <br>
       drwxrwxrwx  2 99 nogroup  4096 Feb  7 03:12 GAMES <br>
       drwxrwxrwx  2 99 nogroup  4096 Feb  7 03:12 MUSIC <br>
       drwxrwxrwx  2 99 nogroup  4096 Feb  7 03:12 PICTURE <br>
       drwxrwxrwx  2 99 nogroup  4096 Feb  7 03:13 PKG <br>
       drwxrwxrwx  2 99 nogroup  4096 Apr  6 12:05 PS2ISO <br>
       drwxrwxrwx  2 99 nogroup 81920 Jun 22 09:02 <b>PS3ISO</b><br><br>

       Where <b>PS3ISO</b> is the directory containing the PS3 Games ISOs files.<br><br>

When creating the Games ISOs for the <a href="http://www.ps3hax.net/2015/10/update-ps3-iso-tools-v-2-2" target="_blank"><b>PS ISO Tools</b></a> remember the <b>format for the ISO file</b> to be used by <b>PS3 Manager</b> is like the following example:<br><br>

<b>YAKUZA_3_[BLES00834].iso</b> <br><br>

Dont use spaces in the game name and leave the unique game code (for example [BLES00834]) inside the square brackets. This is will be used by the scripts that you will add to the crontab to recognize the game and to download cover image and all the game details from <b>Metacritic</b>.<br><br>

<font color="red"><b>*** VERY IMPORTANT ***</b></font><br><br>

The directory containing the ISOs must be accessible in reading and writing by PS3 Manager.<br><br>

In order to do this issue the following command:<br><br>

root@linuxbox:~# ln -s <b>/path/to/isos/files</b>/PS3/PS3ISO <b>/path/to/www</b>/ps3-manager/html/covers<br><br>

root@linuxbox:~# chmod -R 755 <b>/path/to/isos/files</b>/PS3/PS3ISO</li>
<br><br>

<li><span style="font-size: 20px; color: #55A3EC">Unzip the package <b>ps3_manager_0.30.zip</b> into your web directory:</span><br><br>

Edit the file <b>config.php</b> as it follows:<br><br>

      <i>// PS3 IP ADDRESS (Put the LAN IP Address of your PS3)<br>
       $ps3_ip = "<b>PS3_IP_ADDRESS</b>";<br><br>

       // PS3 SHARE WHERE THE ISOs ARE (shared also with PS3NetSrv++)<br>
       $ps3_folder = "<b>/path/to/isos/files</b>/PS3/PS3ISO";<br><br>

       // FORCE EXTERNAL GAME DATA OR DISABLE IT<br>
       // Enable it only if you have an external USB drive connected to the PS3 that you use to install the GameData files.<br>
       // Default is "<b>N</b>".<br>
          $game_data_force = "<b>N</b>";<br><br>

       // WWW LOCAL PATH (The WWW path where your PS3 Manager files are)<br>
       $local_path = "<b>/path//to/www/ps3-manager</b>/html";</i><br><br>


Edit the file <b>mysql_conf.php</b> as it follows:<br><br>

<i>// MYSQL Server Details<br>
$mysql_host = "<b>MYSQL_SERVER_IP</b>";<br>
$mysql_user = "<b>MYSQL_USER</b>";<br>
$mysql_password = "<b>MYSQL_PASSWORD</b>";<br>
$mysql_db = "<b>ps3-games</b>"; <---- change this only if you want to call the database in a different way</i>
</li>
<br><br>


<li><span style="font-size: 20px; color: #55A3EC">Creating the MYSQL database:</span><br><br>

The MySQL server can be installed on the same box or in another box reachable by your web server.<br><br>

I suggest (not required) also the installation of PHPMyAdmin. This is in case you might need to correct a game record in the database when something did not work the way you want.<br><br>

You will find the file ps3-games.sql inside the directory "sql".<br><br>

Import the sql file with the following command:<br><br>

root@linuxbox:~# <b>mysqldump -h MYSQL_SERVER_IP -u USER -pPASSWORD ps3-games < ps3-games.sql</b></li>
<br><br>


<li><span style="font-size: 20px; color: #55A3EC">Installing Crontabs.</span><br><br>

In order to run automatic commands and to add automatically a new game present in the ISOs PS3 Manager needs to have the following crons added to the linux box.<br><br>

Issue the following command:<br><br>

root@linuxbox:~#  <b>crontab -e</b><br><br>

Once it is opened edit the following lines on a text editor and paste into it:<br><br>
<span style="font-size: 10px">
*/2 * * * * /usr/bin/php  <b>/path/to/www/ps3-manager</b>/html/covers_resize.php  > /dev/null 2>&1 <br>
*/2 * * * * /usr/bin/php  <b>/path/to/www/ps3-manager</b>/html/covers_downloader.php  > /dev/null 2>&1 <br>
*/2 * * * * /usr/bin/php  <b>/path/to/www/ps3-manager</b>/html/sql_import.php  > /dev/null 2>&1 <br>
*/5 * * * * /usr/bin/php  <b>/path/to/www/ps3-manager</b>/html/ps3_status_checker.php  > /dev/null 2>&1 <br>
*/10 * * * * /usr/bin/perl -le 'map { $sum += -s } @ARGV; print $sum' -- <b>/path/to/isos/files</b>/PS3/PS3ISO/*.iso > <b>/path/to/www/ps3-manager</b>/html/glob_iso_size.txt 2>&1 <br>
*/2 * * * * /usr/bin/php  <b>/path/to/www/ps3-manager</b>/html/date_conv.php  > /dev/null 2>&1 
</span>
</li> <br><br>

<li><span style="font-size: 20px; color: #55A3EC">Go to your <b>http://ps3-manager-host/</b>  and start adding ISOs files to the shared directory.</span></li>
</ul>
