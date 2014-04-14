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
$password = 'Fucker!';

// Sets the position for the logfile
$logfile = 'position.cur';

// Display raw data
$raw_output = TRUE;

// Adds some anonymity to your position:
// Where 1 is like continents
// and where 8 is like your actual position (accuracy ~10m).
// (Yep, it goes to 17, but it won't make a real difference…)
$lesser_accuracy = 8; // max = 17 | min = 1 | standard = 8

// How far should the map-view zoom into your position?
// higher is nearer
$zoom = 15;

// Should there be a circle around your current position?
// Number is radius in meters
$circle_width = 0;

// If your $lesser_accuracy is below "7"
// there will be an automatic circle to your position
// change to "FALSE" to deactivate this.
$circle_auto = TRUE;

// Color of the circle
$circle_color = '#6dbcff';

?>
