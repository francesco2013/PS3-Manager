<?php
include('config.php');
include('mysql_conf.php');
include('time_calc.php');


// Reading last PS3 Status Check file

$id = file_get_contents("mounted_id.txt");

	 if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db->connect_errno.' - '.$db->connect_error);
    }


    $sql = "SELECT id, name, time_played FROM games WHERE id='".$id."'";
	
    $result = $db->query($sql) or die($mysql->error);
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

			$name = $obj->name;
			$time_played = $obj->time_played;
		
        }
    }
	

	
// Time played calculation
		   
		   // Time already played
		   	
				$seconds_past_play = $time_played;
							
			// Played time before Game Unmounting
			
				$ps_status_page = file_get_contents("http://".$ps3_ip."/cpursx.ps3");
				preg_match('~Play">&#9737;</label>(.*?)<br>~', $ps_status_page, $play_time);
				
				
				$play_time = str_replace('Play">&#9737;','',$play_time[1]);
				
				$sDays  = explode(' ',$play_time);
		
				$just_played['days'] = str_replace('d','',$sDays[1]);
				$sTimes = explode(':',$sDays[2]);
				$just_played['hours'] = $sTimes[0];
				$just_played['minutes'] = $sTimes[1];
				$just_played['seconds'] = $sTimes[2];
				
				$seconds_just_play = TimeToSeconds($just_played['days'].":".$just_played['hours'].":".$just_played['minutes'].":".$just_played['seconds']);
				
		   // Making the SUM
				$total_seconds = $seconds_past_play + $seconds_just_play;
				$total_time = secondsToTime($total_seconds);
              		
			$sql = "UPDATE games SET time_played='".$total_seconds."' WHERE id='".$id."'";
			
		
			$result = $db->query($sql) or die($mysql->error);
			
			// Resetting last Game mounted id
			file_put_contents('',"mounted_id.txt");

			
			
?>