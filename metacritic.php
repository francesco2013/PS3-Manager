<?php
//error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Amsterdam');

include ('config.php');

    define('DB_USER', $mysql_user);
    define('DB_PASSWORD', $mysql_password);
    define('DB_SERVER', $mysql_host);
    define('DB_NAME', $mysql_db);
	

	
	 if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db->connect_errno.' - '.$db->connect_error);
    }


    $sql = "SELECT id, name FROM games";
		
	
    $result = $db->query($sql) or die($mysql->error);
    if ($result->num_rows > 0) {
		$i = 1;
		$count = 0;
		
        while ($obj = $result->fetch_object()) {
				
			$name = preg_replace('~\[(.+?)\]~', "", $obj->name);
			$name = str_replace("_"," ",$name);
			$name = str_replace("-"," ",$name);
		
			// CHECK IF ALREADY IN TABLE game_details
			
			$sql_chk = "SELECT id FROM game_details WHERE id=".$obj->id;
			
			echo $sql_chk. " ";
			
			$conn_chk = mysqli_connect($mysql_host, $mysql_user, $mysql_password,$mysql_db);
			$result_chk = $conn_chk->query($sql_chk) or die($mysql->error);
			
			echo $result_chk->num_rows. "\n\n";
			
			if ($result_chk->num_rows > 0 ) {
				$count = $count+1;
			     echo "ALREADY IN DATABASE game_details ".$name." ID ".$obj->id."\n\n";
				continue;
			 }
			
			
			$id = $obj->id;
		
					

				$name = trim($name);
				echo $name."\n\n";
				
				# Ignore Unirest warning if any (eg. safe mode related)
				error_reporting(E_ERROR | E_PARSE);
				include 'classes/metacritic/metacritic_api-master/metacritic.php';

				$metacritic_api = new MetacriticAPI();
				$response = $metacritic_api->get_metacritic_page($name);
				$json_reponse = $metacritic_api->get_metacritic_scores($response);
		
		

$data = json_decode($json_reponse, TRUE);
var_dump($data);

					
			
					$category = $data['genres'];
					$developer = $data['developers'];
					$developer = str_replace("'","",$developer);
					$publisher = $data['publishers'];
					$publisher = str_replace("'","",$publisher);
					$score = $data['metascritic_score'];				
					$rlsdate = str_replace(",","",$data['release_date']);
					$description = str_replace("'"," ",$data['description']);
					
					
			$sql_ins = "INSERT INTO game_details (id,name,category,developer,publisher,score,rlsdate,description) VALUES ('".$id."','".$name."','".$category."','".$developer."','".$publisher."','".$score."','".$rlsdate."','".$description."')";
			
			echo $sql_ins."\n\n";
					
				$conn_ins = mysqli_connect($mysql_host, $mysql_user, $mysql_password,$mysql_db);
					
				if (mysqli_query($conn_ins, $sql_ins)) {
						echo "New record created successfully\n\n";
				}
					else {
					echo "Error: " . $sql_ins . " ". mysqli_error($conn_ins)."/n/n";
					}
						
			$i = $i+1;
			
			}
		}		


?>	
