<?php

$check_usb_drive = file_get_contents("http://".$ps3_ip);

// Check if USB drive is connected

$usb_status = 'OFF';  //default value

if(strpos($check_usb_drive,'dev_usb00')) {
	$usb_status = 'ON';
	
	if(!file_exists('game_data_status.txt')) { 
		file_put_contents("game_data_status.txt",'');
	}
}


if($usb_status == "ON") {
  
  $game_data_status = file_get_contents("game_data_status.txt");
	
	if(empty($game_data_status) || $game_data_status == "NO USB DRIVE") { 
				$game_data_status = "Enable USB Gamedata";
				file_put_contents("game_data_status.txt",$game_data_status);
	}
	
	
	
  
		if(htmlspecialchars($_GET["command"]) == "gamedata") {
	
				$web_call_gamedata = file_get_contents("http://".$ps3_ip."/extgd.ps3");
	
				if(strpos($web_call_gamedata, 'Disabled')) {
						$game_data_status = "Enable USB Gamedata";
						file_put_contents("game_data_status.txt", $game_data_status);
				}
	 
				if(strpos($web_call_gamedata, 'Enabled')) { 
						$game_data_status = "Disable USB Gamedata";
						file_put_contents("game_data_status.txt", $game_data_status);
				}
		}
		else {
				$game_data_status = file_get_contents("game_data_status.txt");
				file_put_contents("game_data_status.txt", $game_data_status);
		}
}
	
if($usb_status == "OFF") {
			$game_data_status = "NO USB DRIVE";
			file_put_contents("game_data_status.txt", $game_data_status);
}

?>