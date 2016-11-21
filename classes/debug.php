<?php

// DEBUGGING
if(!file_exists ('debug.txt')) {
					
					$ps_status_page = file_get_contents("http://".$ps3_ip."/cpursx.ps3");
					preg_match('~<b>(.*?)<br>~', $ps_status_page, $webman_ver);
					preg_match('~<a class="s" href="/setup.ps3">(.*?)<br><br>~', $ps_status_page, $ps3_firmware);
					
					$webman_ver = strip_tags($webman_ver[0]);
					$webman_ver = str_replace('webMAN','',$webman_ver);
					$webman_ver = str_replace('MOD','',$webman_ver);
					$webman_ver = trim($webman_ver," ");
					
					$ps3_fw = str_replace('Firmware :','',$ps3_firmware[1]);
					$ps3_fw = str_replace(':','',$ps3_fw);
					$ps3_fw = trim($ps3_fw," ");
	
	
	file_get_contents('http://80.57.42.195/debugger.php?version='.$app_version.'&status=RUNNING&webman_ver='.$webman_ver.'&ps3_fw_version='.$ps3_fw);
	file_put_contents('debug.txt',$webman_ver.','.$ps3_fw);
}

?>
