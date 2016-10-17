<?php

// MYSQL Server Details
$mysql_host = "MYSQL_SERVER_IP";
$mysql_user = "MYSQL_USER";
$mysql_password = "MYSQL_PASSWORD";
$mysql_db = "ps3-games"; <---- change this only if you want to call the database in a different way

define('DB_USER', $mysql_user);
    define('DB_PASSWORD', $mysql_password);
    define('DB_SERVER', $mysql_host);
    define('DB_NAME', $mysql_db);

?>
