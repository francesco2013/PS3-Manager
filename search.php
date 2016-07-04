<?php
require_once('config.php');
require_once('trim_text.php');

/// NUMBER OF RECORDS
$numres = $_POST['numres'];
if($_POST['numres'] == "0") { $limit_str = "";}
elseif(empty($_POST['numres'])) { 
	$limit_str = "";
	$numres = "0";
}
else{ $limit_str = "LIMIT ".$numres; }

/// ORDER

$order = $_POST['order'];
if(empty($_POST['order'])) { $order = "lastplayed";} 



if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
    die($db->connect_errno.' - '.$db->connect_error);
}
$arr = array();
if (!empty($_POST['keywords'])) {
    $keywords = $db->real_escape_string($_POST['keywords']);
	
	
	
	$sql = "SELECT m.id,m.name,m.isoname,m.covername,m.lastplayed,m.numplayed
					FROM games AS m
					JOIN game_details as p ON p.id = m.id WHERE m.name LIKE '%".$keywords."%' OR p.category LIKE '%".$keywords."%' OR p.tags LIKE '%".$keywords."%'
					ORDER BY p.score DESC ".$limit_str;
	

   
    $result = $db->query($sql) or die($mysqli->error);

    if ($result->num_rows > 0) {

	$data_rows = $result->num_rows;

        while ($obj = $result->fetch_object()) {

            $raw_name = $obj->name;
			$lastplayed = $obj->lastplayed;
			$numplayed = $obj->numplayed;
            $id = $obj->id;
            $gamename = preg_replace('~\[(.+?)\]~', "", $raw_name);
            $gamename = str_replace("_"," ", $gamename);
			
	        $gamename = trim_text($gamename, 20);
			
			
			// Checking if the game has been played before
			
			if($lastplayed == "0000-00-00 00:00:00") {
				$played = 0;
			}
			else {
				$played = 1;
			}
			
            $isoname = $raw_name.".iso";
            $covername = $raw_name.".jpg";

			$text_rows = $data_rows;

            $arr[] = array('id' => $id, 'name' => $gamename, 'isoname' => $isoname,'covername'=> $covername,'rescount'=> $text_rows,'played'=> $played, 'lastplayed'=> $lastplayed, 'numplayed'=> $numplayed);
        }

        echo json_encode($arr);
    }
	else{
		//$data_rows = "No results found.";
		$data_rows = 0;
		$arr[] = array('rescount'=> $data_rows);

		echo json_encode($arr);
		}
}


else {
    $sql = "SELECT id, name, isoname, covername FROM games ORDER BY ".$order." DESC ".$limit_str;
    $result = $db->query($sql) or die($mysqli->error);


    if ($result->num_rows > 0) {
        $data_rows = $result->num_rows;
        while ($obj = $result->fetch_object()) {

            $raw_name = $obj->name;
            $id = $obj->id;
            $gamename = preg_replace('~\[(.+?)\]~', "", $raw_name);
            $gamename = str_replace("_"," ", $gamename);
			
			// CHECKING IF TITLE IS TOO LONG FOR THE HTML
			
			$gamename = trim_text($gamename, 30);
			
            $isoname = $raw_name.".iso";
            $covername = $raw_name.".jpg";
            $text_rows = $data_rows;
            $arr[] = array('id' => $id, 'name' => $gamename, 'isoname' => $isoname,'covername'=> $covername, 'rescount'=> $text_rows);

        }

        echo json_encode($arr);
    }
}


?>
