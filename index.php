<?php


//error_reporting(E_ERROR | E_PARSE);


require_once 'mobiledetect/Mobile_Detect.php';
$detect = new Mobile_Detect;

require_once ('config.php');
//include('classes/debug.php');


// Load global ISO size
require_once('get_total_iso_size.php');

// Load initial search
require_once ('init_search.php');



$directory = $ps3_folder;

$x = 0;

$now = date("F j, Y, g:i a");




// USB EXTERNAL GAMEDATA CALL

require('check_usb.php');

// SHUTDOWN CALL

if(htmlspecialchars($_GET["command"]) == "shutdown") {
    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/shutdown.ps3");
	//$update_status = file_get_contents("http://".$_SERVER['SERVER_NAME']."/ps3_status_checker.php");
    header("Refresh:0; url=index.php");

}

// REBOOT CALL
if(htmlspecialchars($_GET["command"]) == "reboot") {
	$web_call_gamedata = file_get_contents("http://".$ps3_ip."/reboot.ps3?quick");
	//$update_status = file_get_contents("http://".$_SERVER['SERVER_NAME']."/ps3_status_checker.php");
    header("Refresh:0; url=index.php");
}

// MOUNT CALL
if(htmlspecialchars($_GET["mount"])) {

$mount = $_GET["mount"];

$sql_call = file_get_contents("http://".$_SERVER['SERVER_NAME']."/game_update_sql.php?name=".$mount);

   $web_call_unmount = file_get_contents("http://".$ps3_ip."/mount.ps3/unmount");
   $web_call_mount = file_get_contents("http://".$ps3_ip."/mount.ps3/net0/PS3ISO/".$mount);
   
}

// UNMOUNT CALL

if(htmlspecialchars($_GET["command"]) == "unmount") {
	$sql_call = file_get_contents("http://".$_SERVER['SERVER_NAME']."/game_update_timeplay.php?id=".$id);
    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/mount.ps3/unmount");
	//$update_status = file_get_contents("http://".$_SERVER['SERVER_NAME']."/ps3_status_checker.php");
	sleep(3);
    header("Refresh:0; url=index.php");
}


// GETTING STATUS HTML FILE FROM ps3_status_output.php




// CHOOSING HTML FILE ACCORDING TO THE DETECTED DEVICE

// Mobile Devices
if ( $detect->isMobile() && !$detect->isTablet()){

    $webpage = file_get_contents('html_files/mobile.html');
	$menu_html = file_get_contents('html_files/menu_mobile.html');
	$mobile_page = 1;
}

// Any tablet device.
elseif( $detect->isTablet() ){
    $webpage = file_get_contents('html_files/base.html');
	$menu_html = file_get_contents('html_files/menu.html');
}

// Desktops
else {
    $webpage = file_get_contents('html_files/base.html');
	$menu_html = file_get_contents('html_files/menu.html');
}

$version_writer = file_get_contents('js/popups.js');
$version_writer = str_replace("%CURRENT_VERSION%", $app_version, $version_writer);
file_put_contents('js/popups.js',$version_writer);

$popups_control = file_get_contents('html_files/popups.html');


// INJECTING DATA INTO HTML

$webpage = str_replace("%POPUPS_CONTROL%", $popups_control, $webpage); // <--- THIS ONE FOR FIRST
$webpage = str_replace("%GAMES_LIST%", $game_entry, $webpage);
$webpage = str_replace("%GAMES_NUMBER%", $games_number, $webpage);
$webpage = str_replace("%GAMES_NUMBER_NP%", $games_number_np, $webpage);
$webpage = str_replace("%GLOB_SIZE%", $glob_size, $webpage);
$webpage = str_replace("%NAV_MENU%", $menu_html, $webpage);

/// LOADING USB GAME DATA STATUS FILE AND CHANGING MENU 

$game_data_status = file_get_contents("game_data_status.txt");

$output_set_gamedata = '<a href="index.php?command=gamedata" onclick="return confirm(\'Change Gamedata Setup ?\')">'.$game_data_status.'</a>';

if($mobile_page == 1) { 
 $output_set_gamedata = '<a class="links" style="color: black; text-decoration: none" onclick="return confirm(\'Change Gamedata Setup ?\')" href="index.php?command=gamedata">'.$game_data_status.'</a>';
}

if($game_data_status == "NO USB DRIVE") {
	$output_set_gamedata = '<a href="#">'.$game_data_status.'</a>';
	if($mobile_page == 1) { 
		$output_set_gamedata = '<a class="links" style="color: black; text-decoration: none"  href="#">'.$game_data_status.'</a>';
	}
}


$webpage = str_replace("%GAME_DATA_SETTING%", $output_set_gamedata, $webpage);

//SETTING UP SELECT DROP DOWN



$selector = $_GET['order'];
$numres_select = $_GET['numres'];


include("selector_html.php");




 $html_select = $head_select.$html_select.$tail_select;
 $webpage = str_replace("%SELECT_ORD%", $html_select, $webpage);
 
$webpage = str_replace("%SELECT_NUMRES%", $html_numres, $webpage);
 
 $webpage = str_replace("%NUM_RES%", $numres, $webpage);
 
 $webpage = str_replace("%PS3_IP%", $ps3_ip, $webpage);
 



// RENDERING FINAL HTML PAGE
 
echo $webpage;


?>