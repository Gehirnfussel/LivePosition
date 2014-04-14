<?php

/* Get the position data from the POST parameters */
$lat = $_POST["latitude"];
$lon = $_POST["longitude"];
$acc = $_POST["accuracy"];
$secret = $_POST["secret"]; // "Fucker!"

/* Write the position data to a file for the map script */
if ($lat && $lon && $acc && $secret == "Fucker!") {
    $fcur = fopen("position.cur", "w");

    $time = time();
    $out = "$time:$lat:$lon:$acc\n";

    fputs($fcur, $out);

    fclose($fcur);
}
?>
