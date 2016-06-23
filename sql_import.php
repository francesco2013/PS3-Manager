<?php

require_once ('config.php');


$servername = $mysql_host;
$username = $mysql_user;
$password = $mysql_password;
$dbname = $mysql_db;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Europe/Amsterdam');
$directory = $ps3_folder;
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
$x = 0;

foreach ($scanned_directory as $value) {

// Renaming Files;

$newfile =  str_replace(" ", '_', $value);
$newfile =  str_replace("'", '', $newfile);
$newfile =  str_replace("&", '', $newfile);


rename($directory."/".$value, $directory."/".$newfile);

    
    if  (strpos($value, 'iso') AND strpos($newfile, 'CONVERSION') === false) {

        $game_name = str_replace(".iso", "", $newfile);
        $sql = "SELECT * FROM `games` WHERE `name` = '".$game_name."';";
        echo $sql."\n";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
               echo "Record ".$game_name." already exists"."\n\n";
        } else {
        

           $sql = "INSERT INTO `games`(`name`, `isoname`, `covername`,`dateadded`) VALUES ('".$game_name."','".$directory."/".$newfile."','".$directory."/".$newfile.".jpg',CURRENT_TIMESTAMP);";
           echo $sql."\n";
            if ($conn->query($sql) === TRUE) {
             echo $game_name." record created successfully \n\n";
           }

            else {
               echo "Error: " . $sql . " " . $conn->error."\n\n";
           }

        }
    }
}


$conn->close();

// ADDING DETAILS TO game_details

require_once('metacritic.php');


?>
