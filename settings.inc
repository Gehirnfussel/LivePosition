<?php
//______________________________
//==**-- Debug Mode --**==//
//‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾
error_reporting(E_ALL);
ini_set('display_errors', 1);

//______________________________
//==**-- Settings --**==//
//‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾‾

// Password for updating files
$password = "Fucker!";

// Sets the position for the logfile
$logfile = "position.cur";

// Adds some anonymity to your position
// where 1 is like continents
// and where 8 is like your house (accuracy ~10m)
$lesser_accuracy = "8"; // max = 17 | min = 1 | standard = 8

// How far should the map-view zoom into your position?
// higher is nearer
$zoom = 15;

// Should there be a circle around your current position?
// Number is radius in meters
$circle = 0;

?>
