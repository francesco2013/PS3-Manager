<?php

include('mysql_conf.php');

// LOADING SELECTION DEFAULT

$selector = $_GET['order'];

/// NUMBER OF RECORDS
$numres = $_GET['numres'];

if($_GET['numres'] == "All") { $limit_str = "";}
elseif(empty($_GET['numres'])) { 
	$numres = "30";
	$limit_str = "LIMIT ".$numres;
}
else{ $limit_str = "LIMIT ".$numres; }

//file_put_contents("selector.txt", $selector);


$sql = "SELECT id, name, isoname, covername, numplayed FROM games ";

	if($selector == "score") {
		
		$sql = "SELECT m.id,m.name,m.isoname,m.covername,m.numplayed
					FROM games AS m
					JOIN game_details as p ON p.id = m.id
					ORDER BY p.score DESC ".$limit_str;
	}
	
	if($selector == "numplayed") {
		$sql_ext = "ORDER BY numplayed DESC ".$limit_str;
		$sql = $sql.$sql_ext;
	}
	
	if($selector == "lastplayed") {
		$sql_ext = "ORDER BY lastplayed DESC ".$limit_str;
		$sql = $sql.$sql_ext;
	}
	
	if($selector == "name") {
		$sql_ext = "ORDER BY name ".$limit_str;
		$sql = $sql.$sql_ext;
	}
	
	if($selector == "dateadded") {
		
		$sql = "SELECT id, name, isoname, covername, numplayed FROM games ORDER BY dateadded DESC ".$limit_str;
	}
	
	if($selector == "rel_date") {
		
		$sql = "SELECT m.id,m.name,m.isoname,m.covername,m.numplayed 
					FROM games AS m
					JOIN game_details as p ON p.id = m.id
					ORDER BY p.rel_date DESC ".$limit_str;
	}
	
	if($selector == "neverplayed") {
		
	
		$sql = "SELECT m.id,m.name,m.isoname,m.covername,m.numplayed
					FROM games AS m
					JOIN game_details as p ON p.id = m.id where m.numplayed='0'
					ORDER by p.score DESC ".$limit_str;
	}
	
	if($selector == "random") {
		
	
		$sql = "
		
		select * from
		(
		SELECT m.id,m.name,m.isoname,m.covername,m.numplayed,p.score
					FROM games AS m
					JOIN game_details as p ON p.id = m.id
					 ORDER BY rand() ".$limit_str."
		)
		T1 ORDER by score DESC
	 
		";
	}



if(!$_GET['order']) {  $sql = "SELECT id, name, isoname, covername, numplayed FROM games ORDER BY lastplayed DESC ".$limit_str;} 


    if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db->connect_errno.' - '.$db->connect_error);
    }

   
    $result = $db->query($sql) or die($mysql->error);
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

            $raw_name = $obj->name;
            $id = $obj->id;
            $gamename = preg_replace('~\[(.+?)\]~', "", $raw_name);
            $gamename = str_replace("_"," ", $gamename);
            $isoname = $raw_name.".iso";
            $covername = $raw_name.".jpg";
			$numplayed = $obj->numplayed;
			
			
			// CHECKING IF TITLE IS TOO LONG FOR THE HTML
			
			// CHECKING IF TITLE IS TOO LONG FOR THE HTML
			
			if(strlen($gamename) >= 30 AND strlen($gamename) < 40 ) { 
				$gamename = substr($gamename, 0, -5);
			}
			if(strlen($gamename) >= 40 AND strlen($gamename) < 50 ) { 
				$gamename = substr($gamename, 0, -10);
			}
			
			if(strlen($gamename) >= 50 AND strlen($gamename) < 60 ) { 
				$gamename = substr($gamename, 0, -15);
			}
			
			if(strlen($gamename) >= 60 AND strlen($gamename) < 70 ) { 
				$gamename = substr($gamename, 0, -30);
			}
			
			if($numplayed == "0") {
					$game_entry .= '<div class="col-md-4 col-xs-4 gallery-grid" style="margin-bottom: 10px; font-size: 95%"><a class="example-image-link" id="example-image" href="games.php?game='.$id.'"><img class="example-image" src="covers/'.$covername.'"><b><font color="black"><center>'.$gamename.'<center></font></b></a></div>';
			}
			else{
				$game_entry .= '<div class="col-md-4 col-xs-4 gallery-grid" style="margin-bottom: 10px; font-size: 95%"><a class="example-image-link" id="example-image" href="games.php?game='.$id.'">
				<img class="badgex example-image" src="covers/'.$covername.'"><span class="badgex">'.$numplayed.'</span><b><font color="black"><center>'.$gamename.'<center></font></b></a></div>';
			}
        }
    }


?>
