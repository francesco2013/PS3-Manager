<?php

include('config.php');


date_default_timezone_set('Europe/Amsterdam');
$now = date('d-m-Y H:i:s');

if (!$db = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
    die($db->connect_errno.' - '.$db->connect_error);
}
    $sql = "SELECT name FROM games";
    $result = $db->query($sql) or die($mysql->error);

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

// Connecting to API Server
// Timeout in seconds
$timeout = 2;

$fp = fsockopen($ps3_ip, 7887, $errno, $errstr, $timeout);

if ($fp) {
    fwrite($fp, "PS3 GETTEMP\r\n");
    fwrite($fp, "DISCONNECT\r\n\r\n");

    stream_set_blocking($fp, TRUE);
    stream_set_timeout($fp,$timeout);
    $info = stream_get_meta_data($fp);

    while ((!feof($fp)) && (!$info['timed_out'])) {
        $res .= fgets($fp, 4096);
        $info = stream_get_meta_data($fp);
        ob_flush;
        flush();
    }


}


$discard_data = "220 OK: PS3 Manager API Server v1.
230 OK: Connected to PS3 Manager API Server.
200 ";

$cpu_temp = str_replace($discard_data,"",$res);
$cpu_temp_expl = explode("|",$cpu_temp);
$cpu_temp = $cpu_temp_expl[0];

// Load Disk Data

$ps_status_page = file_get_contents("http://".$ps3_ip."/cpursx.ps3");
$ps_files_page = file_get_contents("http://".$ps3_ip);


//preg_match('~U: (.*?)�~', $ps_status_page, $cpu);
preg_match('~DD: (.*?)M~', $ps_status_page, $disk_int);
preg_match('~bel> (.*?)<h~', $ps_status_page, $uptime);
preg_match('~<a href="/mount.ps3/dev_usb006"(.*?)MB</a>~', $ps_files_page, $disk_ext);


preg_match('~>(.*?)<~', $disk_ext[0], $disk_ext_free);
$dsk_ext_free[0] =  str_replace('> ','' , $disk_ext_free[0]);
$dsk_ext_free[0] =  str_replace(' MB','' , $disk_ext_free[0]);


$disk_int_free = clean($disk_int[1]);
$disk_ext_free = clean($dsk_ext_free[0]);
$uptime = str_replace("bel> ","",$uptime[0]);
$uptime = preg_replace('/[^A-Za-z0-9\-]/', '', $uptime);

$disk_int_free = str_replace("-", "", $disk_int_free);
$disk_ext_free = str_replace("-", "",$disk_ext_free);

}



/// LOADING PS3 STATUS DATA

$ps_status = "<table>";


 if($ps3_up == "down") {
		
		$ps_status .="
		<tr><td style='color: #3399AA; font-weight: bold;'>PS3 System</td><td style='color: red; font-weight: bold;'>PS3
		OFFLINE !
		</td></tr>";
        
        $cpu_temp = "UNAVAILABLE";
        $disk_int_free = "UNAVAILABLE";
        $disk_ext_free = "UNAVAILABLE";
      }

    else {
        $ps_status .= "<tr><td style='color: #3399AA; font-weight: bold;'>PS3 System</td><td style='color: green; font-weight: bold;'>ONLINE</td></tr>";
        $degrees = "&#176";
        $mb_free = " MB free";
    }

    $ps_status .= "<tr><td><font color='#3399AA'><b>PS3 IP</b></font></td><td style='color: black'>".$ps3_ip."</td>";
    $ps_status .= "<tr><td><font color='#3399AA'><b>CPU Temp</b></font></td><td style='color: black'>".$cpu_temp.$degrees."</td>";
    $ps_status .= "<tr><td><font color='#3399AA'><b>HD Internal</b></font></td><td style='color: black'>".$disk_int_free.$mb_free."</td></tr>";
    $ps_status .= "<tr><td><font color='#3399AA'><b>HD USB</b></font></td><td style='color: black'>".$disk_ext_free.$mb_free."</td></tr>";

    $ps_status .= "<tr><td><font color='#3399AA'><b>Last Check</b></font></td><td style='color: black'>".date('d-m-Y H:i:s')."</td></tr>";
    $ps_status .= "<tr><td><font color='#3399AA'><b>Total Games</b></font></td><td style='color: black'>".$result->num_rows."</td></tr>";
	
file_put_contents($local_path."/ps3_status_output.txt", $ps_status);

?>
