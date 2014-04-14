<?php
// Debug Mode
error_reporting(E_ALL);
ini_set('display_errors', 1);

// position-file
$logfile = "position.cur";

// read data OR die if there is no data
$lines = file($logfile);

if( count($lines) < 1){
print "Error! data file $logfile empty.";
die();
}

$p = $lines[0];

$p = explode(":", $p);

$time = $p[0];
$lat = $p[1];
$lon = $p[2];
$acc = $p[3];

$acc = (int)$acc;
$pos = "$lat,$lon";
$time = strftime("%Y-%m-%d %H:%M:%S", $time);
$utime = urlencode($time);

// turn on GZIP-compression
if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
?>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<link rel="dns-prefetch" href="//fonts.googleapis.com">
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui, user-scalable=no" />
	<title>Wo ist Jan? &middot; Live location updates of @Gehirnfussel</title>
	<link href="style.css" rel="stylesheet" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script type="text/javascript">
	function initialize() {
		var latlng = new google.maps.LatLng(<?=$lat?>,<?=$lon?>);
		var myOptions = {
			zoom: 15,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		var image = 'me.png';
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: image
		});
	}

	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
</head>
<body>

<div id="info">
<p>Genauigkeit: <?=$acc?>m<br />
	Letztes Update: <?=$time?></p>
</div>

<div id="map_canvas"></div>
<noscript>
	<iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"  src="http://maps.google.com/?ie=UTF8&amp;q=Last+Update:+<?=$utime?>&lt;br&gt;Accuracy:+<?=$acc?>m(<?=$uname?>)@<?=$pos?>&amp;ll=<?=$pos?>&amp;z=13&amp;output=embed">
</iframe>
</noscript>

</body>
</html>
