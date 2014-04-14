<?php
// Load settings
require 'settings.inc';

// read data OR die if there is no data
$lines = file($logfile);

if (count($lines) < 1){
print "Error! data file $logfile empty.";
die();
}

// split raw data
$data = explode(":", $lines[0]);

// write data to strings
$time = $data[0];
$lat = $data[1];
$lon = $data[2];
$acc = $data[3];
$bat = $data[4];

// lesser the accuracy
if ($lesser_accuracy < 17) {
	$lat = substr($lat, 0, $lesser_accuracy);
	$lon = substr($lon, 0, $lesser_accuracy);
}


if ($lesser_accuracy <= 1) {
	$acc = "∞ ";
	$zoom = 3;
	$circle = 6000000;
} elseif ($lesser_accuracy == 2) {
	$acc = "∞ ";
	$zoom = 5;
	$circle = 500000;
} elseif ($lesser_accuracy == 3) {
	$acc = "∞ ";
	$zoom = 7;
	$circle = 50000;
} elseif ($lesser_accuracy == 4) {
	$acc = 5000;
	$zoom = 12;
	$circle = 5000;
} elseif ($lesser_accuracy == 5) {
	$acc = 1000;
	$zoom = 14;
	$circle = 1000;
} elseif ($lesser_accuracy == 6) {
	$acc = 50;
	$zoom = 15;
	$circle = 50;
} elseif ($lesser_accuracy >= 7) {
	$acc = 10;
	$zoom = 15;
}
if ($circle_auto == FALSE) {
	$circle = 0;
}

$pos = "$lat,$lon";
$time = strftime("%Y-%m-%d %H:%M:%S", $time);
$utime = urlencode($time);

// turn on GZIP-compression
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
?>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui, user-scalable=no" />
	<title>Wo ist Jan? &middot; Live location updates of @Gehirnfussel</title>
	<link href="style.css" rel="stylesheet" />
	<link rel="apple-touch-icon" href="apple-touch-icon.png"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script type="text/javascript">
	function initialize() {
		var latlng = new google.maps.LatLng(<?php echo $pos; ?>);
		var myOptions = {
			zoom: <?php echo $zoom; ?>,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		var image = 'marker.png';
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: image
		});
		var populationOptions = {
			strokeColor: '<?php echo $circle_color; ?>',
			strokeOpacity: 0.8,
			strokeWeight: 2,
			fillColor: '<?php echo $circle_color; ?>',
			fillOpacity: 0.35,
			map: map,
			center: latlng,
			radius: <?php echo $circle; ?>
    };
    // Add the circle for this city to the map.
    cityCircle = new google.maps.Circle(populationOptions);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>
<body>

<div id="info">
<p>Battery: <?php echo substr($bat, -3, 2); ?>% &middot; Accuracy: <?php echo $acc; ?>m<br />
Last seen: <?php echo $time; ?></p>
</div>

<div id="map_canvas"></div>
<noscript>
	<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="http://maps.google.com/?ie=UTF8&amp;q=Last+Update:+<?=$time?>&lt;br&gt;Accuracy:+<?=(int)$acc?>m(<?=$uname?>)@<?=$pos?>&amp;ll=<?=$pos?>&amp;z=13&amp;output=embed">
</iframe>
</noscript>

</body>
</html>
