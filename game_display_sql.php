<?php


include('mysql_conf.php');

$id = $_GET['id'];

	

// FUNCTION TO CONVERT TO READABLE FILESIZE

	function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

	
    if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db->connect_errno.' - '.$db->connect_error);
    }

	
	

$game_record_html = file_get_contents('html_files/game_record.html');

if($id == "random") {
	
	$sql = "SELECT id FROM games";
	$result = $db->query($sql) or die($mysql->error);
	$id = rand(1,$result->num_rows);
	
}

    $sql = "SELECT id, name, isoname, covername, numplayed, lastplayed FROM games WHERE ID='".$id."'";
	$sql_details = "SELECT name,category,developer,publisher,score,rlsdate,description FROM game_details WHERE ID='".$id."'";
	
    $result = $db->query($sql) or die($mysql->error);
	
	
	
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

            $raw_name = $obj->name;
            $id = $obj->id;
			
			$numplayed = $obj->numplayed;
			$lastplayed= $obj->lastplayed;
            $gamename = preg_replace('~\[(.+?)\]~', "", $raw_name);
            $gamename = str_replace("_"," ", $gamename);
            $isoname = $raw_name.".iso";
            $covername = $raw_name.".jpg";
			$isofilesize = filesize($obj->isoname);
			$isofilesize = FileSizeConvert($isofilesize);

            
			$game_record_html = str_replace("%ISO_NAME%",$isoname,$game_record_html);
			$game_record_html = str_replace("%GAME_COVER%",$covername,$game_record_html);
			$game_record_html = str_replace("%NUM_PLAYED%",$numplayed,$game_record_html);
			$game_record_html = str_replace("%LAST_PLAYED%",$lastplayed,$game_record_html);
			$game_record_html = str_replace("%ISO_SIZE%",$isofilesize,$game_record_html);
			
		
        }
		$result_details = $db->query($sql_details) or die($mysql->error);
		
		while ($obj = $result_details->fetch_object()) {
			
			//$gamename = $obj->name;
			$category = $obj->category;
			$developer = $obj->developer;
			$publisher = $obj->publisher;
            $rlsdate = $obj->rlsdate;
			$score = $obj->score;
			$description = $obj->description;
			
			
			$game_record_html = str_replace("%GAME_NAME%",$gamename,$game_record_html);
			$game_record_html = str_replace("%CATEGORY%",$category,$game_record_html);
			$game_record_html = str_replace("%DEVELOPER%",$developer,$game_record_html);
			$game_record_html = str_replace("%PUBLISHER%",$publisher,$game_record_html);
			$game_record_html = str_replace("%RLS_DATE%",$rlsdate,$game_record_html);
			$game_record_html = str_replace("%SCORE%",$score,$game_record_html);
			$game_record_html = str_replace("%GAME_DESC%",$description,$game_record_html);
			
		}
		file_put_contents('html_files/complete_game_record.html',$game_record_html);
    }

?>
