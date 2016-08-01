<?php

include("mysql_conf.php");

$name = $_GET['name'];


	
	 if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db->connect_errno.' - '.$db->connect_error);
    }

	
$name = str_replace(".iso","",$name);
    $sql = "SELECT id, numplayed FROM games WHERE name='".$name."'";
    $result = $db->query($sql) or die($mysql->error);
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

			$numplayed = $obj->numplayed+1;
			$id = $obj->id;
        }
    }
	
	// Write file with the current mounted game ID
	file_put_contents('mounted_id.txt',$id);
	
	$sql = "UPDATE games SET numplayed=".$numplayed.",lastplayed=CURRENT_TIMESTAMP WHERE id=".$id;
	$result = $db->query($sql) or die($mysql->error);
?>
