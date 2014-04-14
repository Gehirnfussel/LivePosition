<?php
/* PHP file to generate a Google Map using version 3 of the javascript API.
  It will place a marker where the last location update was, and draw polylines
  to all other location updates. You can specify how many location updates
  are kept in the bbg_recv.php file.
  jay@summet.com
*/

$name = "Jan";
$logfile = "/tmp/position.cur";


/**********************************************************************/
/* We assume the first line exists...if it doesn't we can't show anything */

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
$uname = urlencode($name);

?>

<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function initialize() {
    var latlng = new google.maps.LatLng(<?=$lat?>,<?=$lon?>);
    var myOptions = {
      zoom: 16,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var marker = new google.maps.Marker({
      position: latlng,
      map: map,
      title:"<?=$name?>"
  });
    var previousLocations = [
<?php
 /*Draw a polyline to each previous data point*/
 for($i=0; $i < count($lines); $i++) {
    $p = $lines[$i];
    $p = explode(":", $p);
    $time = $p[0];
    $lat = $p[1];
    $lon = $p[2];
    $acc = $p[3];
    $acc = (int)$acc;
    $time = strftime("%Y-%m-%d %H:%M:%S", $time);
    echo "new google.maps.LatLng($lat,$lon),\n" ;
 }
?>
  ]; /* end array of previous positions */

 var prevPos = new google.maps.Polyline( {
   path: previousLocations,
   strokeColor: "#FF0000",
   strokeOpacity: 1.0,
   strokeWeight: 2,
   map: map
  });


  } // end Initialize

</script>
</head>
<body onload="initialize()">

<p>
  Latitude: <?=$lat?>  Longitude: <?=$lon?> <br />
  Accuracy: <?=$acc?> m<br />
  Updated: <?=$time?> <br />
</p>

  <div id="map_canvas" style="width:90%; height:80%"></div>

</body>
</html>
