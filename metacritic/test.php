<?php

include('vendor/mashape/unirest-php/src/Unirest.php');

$response = Unirest\Request::get("https://ahmedakhan-game-review-information-v1.p.mashape.com/api/v1/information?console=ps3&game_name=lego+indiana+jones+2+the+adventure+continues",
  array(
    "X-Mashape-Key" => "dkhXyKmrbxmshtD1kycRIK4H9Pwup1rvqJ6jsntCO0W1xpUahY",
    "Accept" => "application/json"
  )
);

$json = json_encode($response);

$data = json_decode($json, TRUE);
var_dump($data);
?>
