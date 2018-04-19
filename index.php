<?php
include 'settings.inc.php';

$phonetrack_api_key = substr($phonetrack_json_url, -32);
$location_json = utf8_encode(file_get_contents($phonetrack_json_url));
$location_decoded = json_decode($location_json, true);

$location_decoded_latitude = $location_decoded[$phonetrack_api_key][$phonetrack_device_name]['lat'];
$location_decoded_longitude = $location_decoded[$phonetrack_api_key][$phonetrack_device_name]['lon'];
$location_decoded_timestamp = $location_decoded[$phonetrack_api_key][$phonetrack_device_name]['timestamp'];
$location_decoded_battery = $location_decoded[$phonetrack_api_key][$phonetrack_device_name]['batterylevel'];
$location_decoded_accuracy = $location_decoded[$phonetrack_api_key][$phonetrack_device_name]['accuracy'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Wo ist Jan? &middot; Live tracking</title>
	<link href='//maps.googleapis.com' rel='preconnect' crossorigin />
	<link rel="apple-touch-icon" href="apple-touch-icon.png" type="image/png" />
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="viewport" content="initial-scale=1, user-scalable=no, width=device-width" />
	<meta http-equiv="refresh" content="3600" />
	<meta http-equiv="x-ua-compatible" content="ie=edge" />
	<meta name="author" content="Jan Jastrow" />
	<meta name="description" content="Live location tracking on Google Maps" />
	<meta property="og:title" content="Wo ist Jan? &middot; Live tracking" />
    <meta property="og:description" content="See the location of Jan Jastrow live an on a map" />
    <meta property="og:type" content="website"/>
    <meta property="og:image" content="img/opengraph.jpg" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta name="robots" content="index, follow" />
	<style>
		#map {
		height: 100%;
		}

		html, body {
			box-sizing: border-box;
			height: 100%;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
			font-size: 16px;
		}

		#info {
			background: rgba(255,255,255,0.7);
			color: #222;
			font-size: 0.65em;
			left: 0.4em;
			padding: 0.4em;
			position: absolute;
			top: 0.4em;
			z-index: 10;
		}

		#info p {
			margin: 0;
		}
	</style>
</head>
<body>
	<div id="map"></div>
	<div id="info">
		<p>Last location update:<br />
		<?php echo strftime('%Y-%m-%d %H:%M:%S', $location_decoded_timestamp); ?>
		</p>
	</div>
	<script>
	function initMap() {
		var myLatLng = {lat: <?=$location_decoded_latitude?>, lng: <?=$location_decoded_longitude?>};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: myLatLng,
			disableDefaultUI: true,
			zoomControl: true,
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: "Jan ist hier",
			icon: 'img/marker.png',
		});
	}
	</script>
	<script async defer	src="https://maps.googleapis.com/maps/api/js?key=<?=$googlemaps_api_key?>&callback=initMap"></script>
</body>
</html>