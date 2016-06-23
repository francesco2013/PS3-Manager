<?php

include('config.php');

error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Amsterdam');
$directory = $ps3_folder;
$scanned_directory = array_diff(scandir($directory), array('..', '.'));
$x = 0;
$exists_count = 0;


foreach ($scanned_directory as $value) {

        $found = 0;
        if  (strpos($value, 'iso')) {

                $x  = $x +1;
                echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File  ".$directory."/".$value."\n\n";
                 $value = str_replace(".iso","",$value);

                        if (file_exists($directory."/".$value.".jpg")) {
                            $exists_count = $exists_count +1;
                            echo $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File exists  ".$directory."/".$value.".jpg"."\n\n";
                        }

                        else {

                            preg_match_all("/\[([^\]]*)\]/", $value, $matches);

                                       if ($found == 0 AND fopen("http://damox.net/images/covers/PS3/".$matches[1][0].".JPG", 'r')) {

                                                        echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";
                                                        file_put_contents($directory."/".$value.".jpg", fopen("http://damox.net/images/covers/PS3/".$matches[1][0].".JPG", 'r'));


                                                        if (file_exists($directory."/".$value.".jpg") == false OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                                $found = 0;
                                                        }
                                                        else {
                                                            $found = 1;
                                                        }

                                                        if ($found == 1) {

                                                            echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://damox.net/images/covers/PS3/".$directory."/".$value.".jpg"."\n\n";

                                                        }

                                       }




                                        if ($found == 0 AND fopen("http://art.gametdb.com/ps3/coverHQ/US/".$matches[1][0].".jpg", 'r')) {

                                                         echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";


                                                        file_put_contents($directory."/".$value.".jpg", fopen("http://art.gametdb.com/ps3/coverHQ/US/".$matches[1][0].".jpg", 'r'));

                                         if (file_exists($directory."/".$value.".jpg") == false  OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                                $found = 0;
                                                        }
                                                        else {
                                                            $found = 1;
                                                        }

                                                        if ($found == 1) {

                                                            echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://damox.net/images/covers/PS3/".$directory."/".$value.".jpg"."\n\n";

                                                        }


                                          }

                                          if ($found == 0 AND fopen("http://art.gametdb.com/ps3/coverHQ/EN/".$matches[1][0].".jpg", 'r')) {

                                                         echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";


                                                        file_put_contents($directory."/".$value.".jpg", fopen("http://art.gametdb.com/ps3/coverHQ/EN/".$matches[1][0].".jpg", 'r'));

                                                        if (file_exists($directory."/".$value.".jpg") == false OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                            $found = 0;
                                                        }
                                                        else {
                                                            $found = 1;
                                                        }

                                                        if ($found == 1) {

                                                            echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://art.gametdb.com/ps3/coverHQ/EN/".$directory."/".$value.".jpg"."\n\n";

                                                        }


                                                 }



                                        if ($found == 0 AND  fopen("http://art.gametdb.com/ps3/coverHQ/ZH/".$matches[1][0].".jpg", 'r')) {

                                                         echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";

                                                        file_put_contents($directory."/".$value.".jpg", fopen("http://art.gametdb.com/ps3/coverHQ/ZH/".$matches[1][0].".jpg", 'r'));


                                                        if (file_exists($directory."/".$value.".jpg") == false OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                            $found = 0;
                                                        }
                                                        else {
                                                            $found = 1;
                                                        }

                                                        if ($found == 1) {

                                                            echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://art.gametdb.com/ps3/coverHQ/ZH/".$directory."/".$value.".jpg"."\n\n";

                                                        }


                                           }

                                           if ($found == 0 AND  fopen("http://art.gametdb.com/ps3/coverHQ/NL/".$matches[1][0].".jpg", 'r')) {

                                               echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";

                                               file_put_contents($directory."/".$value.".jpg", fopen("http://art.gametdb.com/ps3/coverHQ/NL/".$matches[1][0].".jpg", 'r'));


                                               if (file_exists($directory."/".$value.".jpg") == false OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                   $found = 0;
                                               }
                                               else {
                                                   $found = 1;
                                               }

                                               if ($found == 1) {

                                                   echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://art.gametdb.com/ps3/coverHQ/NL/".$directory."/".$value.".jpg"."\n\n";

                                               }


                                           }



                                          if ($found == 0 AND  fopen("http://art.gametdb.com/ps3/coverM/US/".$matches[1][0].".jpg", 'r')) {

                                               echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";

                                               file_put_contents($directory."/".$value.".jpg", fopen("http://art.gametdb.com/ps3/coverM/US/".$matches[1][0].".jpg", 'r'));


                                               if (file_exists($directory."/".$value.".jpg") == false OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                   $found = 0;
                                               }
                                               else {
                                                   $found = 1;
                                               }

                                               if ($found == 1) {

                                                   echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://art.gametdb.com/ps3/coverM/US/".$directory."/".$value.".jpg"."\n\n";

                                               }


                                           }

                                        if ($found == 0 AND  fopen("http://art.gametdb.com/ps3/coverM/EN/".$matches[1][0].".jpg", 'r')) {

                                                       echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Creating File  ".$directory."/".$value.".jpg"."\n\n";

                                                       file_put_contents($directory."/".$value.".jpg", fopen("http://art.gametdb.com/ps3/coverM/EN/".$matches[1][0].".jpg", 'r'));


                                                       if (file_exists($directory."/".$value.".jpg") == false OR filesize($directory."/".$value.".jpg")  < 1 ) {
                                                                   $found = 0;
                                                        }
                                                        else {
                                                                $found = 1;
                                                        }

                                                        if ($found == 1) {

                                                                echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."File found on server "."http://art.gametdb.com/ps3/coverM/EN/".$directory."/".$value.".jpg"."\n\n";

                                                        }


                                           }





                                         if ($found == 0) {

                                                    echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Cover not found on remote server for ".$value."\n\n";
                                                        $missing_covers[$x] = $value;


                                        }


                                }

                                 if  (file_exists($directory."/".$value.".jpg") AND filesize($directory."/".$value.".jpg")  < 1) {

                                        echo  $x." - ".date("Y/m/d h:i:sa")." - ".$matches[1][0]." - "."Cover is 0 bytes. Deleting ".$value.".jpg\n\n";
                                        $missing_covers[$x] = $value;
                                        unlink($directory."/".$value.".jpg");
                                }

        }


                        }




               $missing =  $x - $exists_count;
               echo "----------------------------------------------------------------------------------"."\n\n";
               echo "    [Time] ".date("Y/m/d h:i:sa")." [Total ISOs] ".$x." [Covers] ".$exists_count." [Not found] ".$missing."\n\n";
               echo "----------------------------------------------------------------------------------"."\n\n";


foreach ($missing_covers as $game_name) {

              echo "Cover missing for ".$game_name."\n\n";
}


?>
