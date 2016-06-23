<?php
# Ignore Unirest warning if any (eg. safe mode related)
error_reporting(E_ERROR | E_PARSE);
include 'metacritic.php';

$metacritic_api = new MetacriticAPI();
$response = $metacritic_api->get_metacritic_page("The Sims 3");
$json_reponse = $metacritic_api->get_metacritic_scores($response);

echo "Json:\n<br/><br/> ". $json_reponse;
?>
