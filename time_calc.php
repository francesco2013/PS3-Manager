<?php
date_default_timezone_set('Europe/Amsterdam');
	function secondsToTime($seconds) {
					$dtF = new \DateTime('@0');
					$dtT = new \DateTime("@$seconds");
					return $dtF->diff($dtT)->format('%ad %hh:%im:%ss');
	}

	function TimeToSeconds($time_str) {
		$time_arr = explode(':',$time_str);	
		return ($time_arr[0] * 86400) + ($time_arr[1]*3600) + ($time_arr[2]*60) + $time_arr[3];
	}
	
	
?>