<?php


include('config.php');

$now = date('d-m-Y H:i:s');
$row_cnt = 0;


if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
    die($db->connect_errno.' - '.$db->connect_error);
}
    $sql = "SELECT name FROM games";
    $result = $db->query($sql) or die($mysql->error);
	$row_cnt = $result->num_rows;
	
// CHECKING IF WEBMAN IS ONLINE

function ping($host, $port, $timeout)
{
    $tB = microtime(true);
    $fP = fSockOpen($host, $port, $errno, $errstr, $timeout);
    if (!$fP) { 
		return "down"; 
	}
    $tA = microtime(true);
    return "up";
	
}

$ps3_up = ping($ps3_ip, 80,2);

echo "CHECK DOWN ".$ps3_up;


// FUNCTION TO CLEAN STRINGS

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

if($ps3_up == "up") {

$ps_status_page = file_get_contents("http://".$ps3_ip."/cpursx.ps3");

preg_match('~up">CPU:(.*?)<~', $ps_status_page, $cpu_temp);
$cpu_temp = str_replace(' ','',$cpu_temp[1]);
// Load Disk Data


$ps_files_page = $ps_status_page;



//webMAN 1.45.00 MOD

preg_match('~New">(.*?)<br>~', $ps_status_page, $webman_ver);
preg_match('~DD: (.*?)M~', $ps_status_page, $disk_int);
preg_match('~bel> (.*?)<h~', $ps_status_page, $uptime);
preg_match('~MEM: (.*?)<br~', $ps_status_page, $memory_free);
preg_match('~/a>/(.*?)</font><hr>~', $ps_status_page, $mounted_game);
preg_match('~Play">&#9737;</label>(.*?)<br>~', $ps_status_page, $play_time);
preg_match('~Startup">&#8986;</label>(.*?)<hr>~', $ps_status_page, $ps3_uptime);
preg_match('~<a class="s" href="/setup.ps3">(.*?)<br><br>~', $ps_status_page, $ps3_firmware);


preg_match('~\[(.*?)\]~', $mounted_game[0], $game_code);

// WEBMAN VERSION 1.43.33 

// <a href="/dev_usb000">USB000: 547,515 MB free</a>
preg_match('~/dev_usb000">USB000:(.*?)MB free</a><hr>~', $ps_files_page, $disk_ext);


$memory_free = str_replace('MEM: ','',$memory_free);

$play_time = str_replace('Play">','',$play_time[0]);
$play_time = strip_tags($play_time);

$ps3_uptime = str_replace('Startup">','',$ps3_uptime[0]);
$ps3_uptime = strip_tags($ps3_uptime);

$ps3_firmware = str_replace('Firmware :','',$ps3_firmware[1]);
$ps3_firmware = str_replace(':','',$ps3_firmware);

$webman_ver = strip_tags($webman_ver[0]);
$webman_ver = str_replace('webMAN','',$webman_ver);
$webman_ver = str_replace('MOD','',$webman_ver);
$webman_ver = str_replace('New">','',$webman_ver);

// Adjusting Mounted Game Name

$mounted_game = str_replace('/a>/PS3ISO/','',strip_tags($mounted_game[0]));
$mounted_game = str_replace('_',' ',$mounted_game);
$mounted_game = str_replace('[','',$mounted_game);
$mounted_game = str_replace(']','',$mounted_game);
$mounted_game = str_replace($game_code[1],'',$mounted_game);
$mounted_game = str_replace('.iso','',$mounted_game);

$disk_int_free = clean($disk_int[1]);
$disk_ext_free = clean($disk_ext[1]);

$disk_int_free = str_replace("-", "", $disk_int_free);
$disk_ext_free = str_replace("-", "",$disk_ext_free);

}


$ps_status = "<table >";


 if($ps3_up == "down") {
		
		$ps_status .="
		<tr><td style='color: #3399AA;'><b>PS3 System</b></td><td style='color: red; font-weight: bold; text-align: center; width: auto;'>OFFLINE</td></tr>";
        
        $cpu_temp = "UNAVAILABLE";
        $disk_int_free = "UNAVAILABLE";
        $disk_ext_free = "UNAVAILABLE";
	$memory_free[0] = "UNAVAILABLE";
	$ps3_uptime = "UNAVAILABLE";
	$ps3_firmware = "UNAVAILABLE";
	$webman_ver = "UNAVAILABLE";
      }

    else {
        $ps_status .= "<tr><td style='color: #3399AA;'><b>PS3 System</b></td><td style='color: green; font-weight: bold; text-align: center; width: auto;'>ONLINE</td></tr>";
        $mb_free = " MB free";
    }

    $ps_status .= "<tr><td><font color='#3399AA'><b>PS3 IP</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$ps3_ip."</td>";
	$ps_status .= "<tr><td><font color='#3399AA'><b>PS3 Uptime</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$ps3_uptime."</td>";
	$ps_status .= "<tr><td><font color='#3399AA'><b>PS3 FW</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$ps3_firmware."</td>";
	$ps_status .= "<tr><td><font color='#3399AA'><b>webMAN Version</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$webman_ver."</td>";
	$ps_status .= "<tr><td><font color='#3399AA'><b>CPU Temp</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$cpu_temp."</td>";
	$ps_status .= "<tr><td><font color='#3399AA'><b>Free RAM</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$memory_free[0]."</td>";
    $ps_status .= "<tr><td><font color='#3399AA'><b>HD Internal</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$disk_int_free.$mb_free."</td></tr>";
    
	if ($disk_ext_free != '') {
		$ps_status .= "<tr><td><font color='#3399AA'><b>HD USB</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$disk_ext_free.$mb_free."</td></tr>";
	}
	
	if($mounted_game != '') {
		$ps_status .= "<tr id='game_mounted'><td><font color='#3399AA'><b>Mounted Game</b></font></td><td style='color: black; text-align: center; font-size: normal; padding-right: 10px; width: auto;'>".$mounted_game."</td></tr>";
		if($play_time != '')  { 
			$ps_status .= "<tr id='time_play'><td><font color='#3399AA'><b>Game Play Time</b></font></td><td style='color: black; text-align: center; width: auto;'>".$play_time."</td></tr>";
		}
		else{
			$ps_status .= "<tr id='time_play'><td><font color='#3399AA'><b>Game Play Time</b></font></td><td style='color: black; text-align: center; width: auto;'>&#9737; 0d 00:00:00</td></tr>";
		}
	}
	
	
	
	$ps_status .= "<tr><td><font color='#3399AA'><b>Total Games</b></font></td><td style='color: black; text-align: center;  width: auto;'>".$row_cnt."</td></tr>";
	//$ps_status .= "<tr><td><font color='#3399AA'><b>PS3 Manager</b></font></td><td style='color: black; text-align: center;  width: auto;'>v.".$app_version."</td>";
	$ps_status .= "<tr><td><font color='#3399AA'><b>Last Check</b></font></td><td style='color: black; text-align: center;  width: auto;'>".date('d-m-Y H:i:s')."</td></tr>";
	
	echo $row_cnt;
file_put_contents($local_path."/ps3_status_output.txt", $ps_status);

?>
