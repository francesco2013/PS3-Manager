<?php

include("mysql_conf.php");
	
	
	 if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db->connect_errno.' - '.$db->connect_error);
    }
	
	
	$sql = "SELECT * from game_details";
	
    $result = $db->query($sql) or die($mysql->error);
	
	
    if ($result->num_rows > 0) {
        while ($obj = $result->fetch_object()) {

            $id = $obj->id;
			$rlsdate = $obj->rlsdate;
			$rlsdate = str_replace('  ',' ',$rlsdate);
			//echo $id."\n\n".
			$rls_arr = explode(" ",$rlsdate);
			$rls_arr[0] = str_replace(" ","",$rls_arr[0]);
			
				if ($rls_arr[0] == "Jan") {$rls_arr_corr['month'] = '01';}
				if ($rls_arr[0] == "Feb") {$rls_arr_corr['month'] = '02';}
				if ($rls_arr[0] == "Mar") {$rls_arr_corr['month'] = '03';}
				if ($rls_arr[0] == "Apr") {$rls_arr_corr['month'] = '04';}
				if ($rls_arr[0] == "May") {$rls_arr_corr['month'] = '05';}
				if ($rls_arr[0] == "Jun") {$rls_arr_corr['month'] = '06';}
				if ($rls_arr[0] == "Jul") {$rls_arr_corr['month'] = '07';}
				if ($rls_arr[0] == "Aug") {$rls_arr_corr['month'] = '08';}
				if ($rls_arr[0] == "Sep") {$rls_arr_corr['month'] = '09';}
				if ($rls_arr[0] == "Oct") {$rls_arr_corr['month'] = '10';}
				if ($rls_arr[0] == "Nov") {$rls_arr_corr['month'] = '11';}
				if ($rls_arr[0] == "Dec") {$rls_arr_corr['month'] = '12';}
					$rls_arr_corr['year'] = $rls_arr[2];
					$rls_arr_corr['day'] = $rls_arr[1];
					
					$sql_string = $rls_arr_corr['year']."-".$rls_arr_corr['month']."-".$rls_arr_corr['day']." 00:00:00";
				
				$sql_up[] = "UPDATE game_details SET rel_date='".$sql_string."' WHERE id=".$id;
			
		}
				
		foreach ($sql_up as $value) {
			echo $value."\n\n";
							$conn_chk = mysqli_connect($mysql_host, $mysql_user, $mysql_password,$mysql_db);
							$result_chk = $conn_chk->query($value);
		}		
					
    }
		
		
?>