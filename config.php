<?php
// PS3 IP ADDRESS (Put the LAN IP Address of your PS3)
$ps3_ip = "PS3_IP_ADDRESS";
// PS3 SHARE WHERE THE ISOs ARE (shared also with PS3NetSrv++)
$ps3_folder = "/path/to/isos/files/PS3/PS3ISO";
// FORCE EXTERNAL GAME DATA OR DISABLE IT
// Enable it only if you have an external USB drive connected to the PS3 that you use to install the GameData files.
// Default is "N".
$game_data_force = "N";
// WWW LOCAL PATH (The WWW path where your PS3 Manager files are)
$local_path = "/path/to/www/ps3-manager/html";

// DON'T CHANGE ANYTHING AFTER THIS LINE
// PS3 Games Manager Version
$app_version ="0.36";
// Include Mysql Configuration
include("mysql_conf.php");
?>
