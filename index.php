<?php

require_once ('config.php');

require_once 'mobiledetect/Mobile_Detect.php';
$detect = new Mobile_Detect;

// Load global ISO size
require_once('get_total_iso_size.php');

// Load initial search
require_once ('init_search.php');



error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Amsterdam');
$directory = $ps3_folder;

$x = 0;

$now = date("F j, Y, g:i a");




// USB EXTERNAL GAMEDATA CALL
if(htmlspecialchars($_GET["command"]) == "gamedata") {
    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/extgd.ps3");

    if(strpos($web_call_gamedata, 'Disabled') === false) {
        $game_data_status = "Enabled";
        file_put_contents("game_data_status.txt", $game_data_status);
        }
     else {
         $game_data_status = "Disabled";
         file_put_contents("game_data_status.txt", $game_data_status);
     }

        header("Refresh:0; url=index.php");
}


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

// MOUNT CALL
if(htmlspecialchars($_GET["mount"])) {

$mount = $_GET["mount"];

$sql_call = file_get_contents("http://".$_SERVER['SERVER_NAME']."/game_update_sql.php?name=".$mount);

   $web_call_unmount = file_get_contents("http://".$ps3_ip."/mount.ps3/unmount");
   sleep(3);
   $web_call_mount = file_get_contents("http://".$ps3_ip."/mount.ps3/net0/PS3ISO/".$mount);

 if($game_data_force == "Y") {
   // ---- FORCING ENABLE GAME DATA -----
   $web_call_gamedata = file_get_contents("http://".$ps3_ip."/extgd.ps3");

   if(strpos($web_call_gamedata, 'Disabled') === false) {
       $game_data_status = "Enabled";
       file_put_contents("game_data_status.txt", $game_data_status);
    }

   else {

       $web_call_gamedata = file_get_contents("http://".$ps3_ip."/extgd.ps3");

       $game_data_status = "Enabled";
       file_put_contents("game_data_status.txt", $game_data_status);
   }
 }
   // -------- END ENABLE GAME DATA -------

    header("Refresh:0; url=index.php");
    }
//}

// UNMOUNT CALL

if(htmlspecialchars($_GET["command"]) == "unmount") {
    $web_call_gamedata = file_get_contents("http://".$ps3_ip."/mount.ps3/unmount");
    header("Refresh:0; url=index.php");
}


// INSERTING SEARCH AJAX SEARCH HTML

$divgame = file_get_contents("ajax_search_div.txt");


// GETTING STATUS HTML FILE FROM ps3_status_output.php

$ps_status = "<table><tr>".file_get_contents("ps3_status_output.txt")."</tr></table>";


// CHOOSING HTML FILE ACCORDING TO THE DETECTED DEVICE

if ( $detect->isMobile() ) {

    $webpage = file_get_contents('mobile.html');
}

// Any tablet device.
elseif( $detect->isTablet() ){
    $webpage = file_get_contents('tablets.html');
}

else {
    $webpage = file_get_contents('base.html');
}

$menu_html = file_get_contents('menu.html');

// INJECTING DATA INTO HTML

$webpage = str_replace("%PS3_INFO%", $ps_status, $webpage);
$webpage = str_replace('%SEARCH_DATA%',"", $webpage);
$webpage = str_replace("%GAMES_LIST%", $game_entry, $webpage);
$webpage = str_replace("%GAME_SEARCH_DIV%", $divgame, $webpage);
$webpage = str_replace("%GAME_SEARCH_DIV%", $divgame, $webpage);
$webpage = str_replace("%GAMES_NUMBER%", $games_number, $webpage);
$webpage = str_replace("%GAMES_NUMBER_NP%", $games_number_np, $webpage);
$webpage = str_replace("%GLOB_SIZE%", $glob_size, $webpage);
$webpage = str_replace("%NAV_MENU%", $menu_html, $webpage);
/// LOADING GAME DATA STATUS FILE

$game_data_set = file_get_contents("game_data_status.txt");

if($game_data_set == "Enabled") {
    $webpage = str_replace("%GAME_DATA_STATUS%", "Disable ", $webpage);
}

else {
    $webpage = str_replace("%GAME_DATA_STATUS%", "Enable ", $webpage);
}

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
