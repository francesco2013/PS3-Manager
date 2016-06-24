<?php

include('mysql_conf.php');

// FUNCTION TO CONVERT TO READABLE FILESIZE

	function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

// Get games number

$sql_count = "SELECT id FROM games";

    if (!$db_count = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db_count->connect_errno.' - '.$db_count->connect_error);
    }

   
    $result_count = $db_count->query($sql_count) or die($mysql->error);

	$games_number = $result_count->num_rows;
	
	
// Get never played games number 

$sql_count_np = "SELECT id FROM games where numplayed='0'";



    if (!$db_count_np = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME)) {
        die($db_count_np->connect_errno.' - '.$db_count_np->connect_error);
    }

   
    $result_count_np = $db_count_np->query($sql_count_np) or die($mysql->error);

	$games_number_np = $result_count_np->num_rows;	
	
	
// GET SUM SIZE OF ALL GAMES
$glob_size = file_get_contents('glob_iso_size.txt');

$glob_size = FileSizeConvert($glob_size);


?>

