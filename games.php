<?php

error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Amsterdam');

require_once 'mobiledetect/Mobile_Detect.php';
$detect = new Mobile_Detect;




require_once ('config.php');
include('visits.php');

$id = $_GET['game'];

$sql_call = file_get_contents('http://'.$_SERVER['SERVER_NAME'].'/game_display_sql.php?id='.$id);

$directory = $ps3_folder;

$x = 0;

$now = date("jS F Y, g:i a");



// GAMEDATA CALL
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

    // MESSAGING

    $fp = fsockopen($ps3_ip, 7887, $errno, $errstr, 30);
    if (!$fp) {
        echo "$errstr ($errno)<br />\n";
    } else {
        fwrite($fp, "PS3 NOTIFY Shutting down PS3");
        fclose($fp);
    }




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


   //$web_call_unmount = file_get_contents("http://".$ps3_ip."/mount.ps3/unmount");
   //sleep(1);
   //$web_call_mount = file_get_contents("http://".$ps3_ip."/mount.ps3/net0/PS3ISO/".$mount);

 //if($game_data_force == "Y") {
   // ---- FORCING ENABLE GAME DATA -----
   //$web_call_gamedata = file_get_contents("http://".$ps3_ip."/extgd.ps3");

   //if(strpos($web_call_gamedata, 'Disabled') === false) {
       //$game_data_status = "Enabled";
       //file_put_contents("game_data_status.txt", $game_data_status);
    //}

   //else {

       //$web_call_gamedata = file_get_contents("http://".$ps3_ip."/extgd.ps3");

       //$game_data_status = "Enabled";
       //file_put_contents("game_data_status.txt", $game_data_status);
   //}
 //
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

if ( $detect->isMobile() && !$detect->isTablet()){
    
    $webpage = file_get_contents('html_files/games_mobile.html');
}

// Any tablet device.
elseif( $detect->isTablet() ){
    $webpage = file_get_contents('html_files/games.html');
}

else {
    $webpage = file_get_contents('html_files/games.html');
}

$menu_html = file_get_contents('html_files/menu.html');


// INJECTING DATA INTO HTML

$game_record = file_get_contents('html_files/complete_game_record.html');



$webpage = str_replace("%CURRENT_VERSION%", $app_version, $webpage);
$webpage = str_replace("%PS3_INFO%", $ps_status, $webpage);
$webpage = str_replace("%GAME_SELECTED%", $game_record, $webpage);
$webpage = str_replace("%GAME_ID%", $id, $webpage);
$webpage = str_replace("%NAV_MENU%", $menu_html, $webpage);


/// LOADING GAME DATA STATUS FILE

$game_data_set = file_get_contents("game_data_status.txt");

if($game_data_set == "Enabled") {
    $webpage = str_replace("%GAME_DATA_STATUS%", "Disable ", $webpage);
}

else {
    $webpage = str_replace("%GAME_DATA_STATUS%", "Enable ", $webpage);
}

 $webpage = str_replace("%PS3_IP%", $ps3_ip, $webpage);
 

echo $webpage;


?>