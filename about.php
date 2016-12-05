<?php

require_once ('config.php');

require_once 'mobiledetect/Mobile_Detect.php';
$detect = new Mobile_Detect;


error_reporting(E_ERROR | E_PARSE);

$directory = $ps3_folder;

$x = 0;

$now = date("F j, Y, g:i a");



// USB EXTERNAL GAMEDATA CALL

require('check_usb.php');

// SHUTDOWN CALL

if(htmlspecialchars($_GET["command"]) == "shutdown") {

    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/shutdown.ps3");
    header("Refresh:0; url=index.php");

}

// REBOOT CALL
if(htmlspecialchars($_GET["command"]) == "reboot") {

    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/restart.ps3");
    header("Refresh:0; url=index.php");
}


// UNMOUNT CALL

if(htmlspecialchars($_GET["command"]) == "unmount") {
	$sql_call = file_get_contents("http://".$_SERVER['SERVER_NAME']."/game_update_timeplay.php?id=".$id);
    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/mount.ps3/unmount");
    header("Refresh:0; url=index.php");
}




// GETTING STATUS HTML FILE FROM ps3_status_output.php

$ps_status = "<table><tr>".file_get_contents("ps3_status_output.txt")."</tr></table>";


// CHOOSING HTML FILE ACCORDING TO THE DETECTED DEVICE

// Mobile Devices
if ( $detect->isMobile() && !$detect->isTablet()){
    
    
	header("Refresh:0; url=index.php");
}

// Any tablet device.
elseif( $detect->isTablet() ){
    $webpage = file_get_contents('html_files/about.html');
	$menu_html = file_get_contents('html_files/menu.html');
}

// Desktops
else {
    $webpage = file_get_contents('html_files/about.html');
	$menu_html = file_get_contents('html_files/menu.html');
}

$popups_control = file_get_contents('html_files/popups.html');


// INJECTING DATA INTO HTML



$webpage = str_replace("%PS3_INFO%", $ps_status, $webpage);
$webpage = str_replace("%LATEST_VERSION%", $app_version, $webpage);
$webpage = str_replace("%NAV_MENU%", $menu_html, $webpage);


/// LOADING USB GAME DATA STATUS FILE AND CHANGING MENU 

$game_data_status = file_get_contents("game_data_status.txt");

$output_set_gamedata = '<a href="index.php?command=gamedata" onclick="return confirm(\'Change Gamedata Setup ?\')">'.$game_data_status.'</a>';

if($mobile = 1) { 
 $output_set_gamedata = '<a class="links" style="color: black; text-decoration: none" onclick="return confirm(\'Change Gamedata Setup ?\')" href="index.php?command=gamedata">'.$game_data_status.'</a>';
}

if($game_data_status == "NO USB DRIVE") {
	$output_set_gamedata = '<a href="#">'.$game_data_status.'</a>';
	if($mobile = 1) { 
		$output_set_gamedata = '<a class="links" style="color: black; text-decoration: none"  href="#">'.$game_data_status.'</a>';
	}
}

$webpage = str_replace("%GAME_DATA_SETTING%", $output_set_gamedata, $webpage);


$webpage = str_replace("%PS3_IP%", $ps3_ip, $webpage);
 

echo $webpage;


?>