<?php 
require_once('../inc/db.php');
$bookingNumber = $_GET["bookingNumber"];
$sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE bookingNumber=:bookingNumber");
$sorgu->execute(['bookingNumber' => $bookingNumber]);
$sonuc = $sorgu->fetch();
// Sonucun olup olmadığını kontrol et
if (!$sonuc) {
$sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE bookingNumber=:bookingNumber");
$sorgu->execute(['bookingNumber' => $bookingNumber]);
$sonuc = $sorgu->fetch();
$deneme2 = $sonuc['pickUpCoords'];
$destinationAddress = $sonuc['destinationCoords'];
$hub = $sonuc['hub'];
}
else {
$deneme2 = $sonuc['pickUpCoords'];
$destinationAddress = $sonuc['destinationCoords'];
$hub = $sonuc['hub'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, user-scalable=no"/>
    <title>Map Display</title>
<style>
    /* Body ve html etiketleri için padding ve margin sıfırla */
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden; /* Taşma durumlarını engelle */
        width: 100%;
        display: block;
    }

    /* Harita konteyner stilini tam ekran yap */
    #map {
        height: 100%;
        width: 100%;
    }
</style>


</head>
<body>
    <div id="map" style="margin-top:30px;"></div>
<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {lat: 40.712776, lng: -74.005974},
        styles: [{featureType: 'road', elementType: 'geometry', stylers: [{color: '#f5f1e6'}]}]
    });

    var directionsService = new google.maps.DirectionsService();
    var directionsRendererRed = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: '#FF0000',
            strokeOpacity: 0.8,
            strokeWeight: 6
        }
    });
    var directionsRendererBlue = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: '#0000FF',
            strokeOpacity: 0.8,
            strokeWeight: 6
        }
    });
    var directionsRendererBlack = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: '#000000',
            strokeOpacity: 0.8,
            strokeWeight: 6
        }
    });

    var pickupAddress = <?php echo json_encode($deneme2); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
    var hubAddress = <?php echo json_encode($hub); ?>;

    // Calculate route from A to B (red)
    calculateAndDisplayRoute(directionsService, directionsRendererRed, map, pickupAddress, destinationAddress, "A", "B");
    // Calculate route from B to H (blue)
    calculateAndDisplayRoute(directionsService, directionsRendererBlue, map, destinationAddress, hubAddress, "B", "H");
    // Calculate route from H to A (black)
    calculateAndDisplayRoute(directionsService, directionsRendererBlack, map, hubAddress, pickupAddress, "H", "A");
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, map, origin, destination, startLabel, endLabel) {
    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: 'BICYCLING',
        provideRouteAlternatives: true
    }, function(response, status) {
        if (status === 'OK') {
            var fastestRouteIndex = findFastestRouteIndex(response.routes);
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(fastestRouteIndex);
            addCustomMarkers(response.routes[fastestRouteIndex], map, startLabel, endLabel);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}


function findFastestRouteIndex(routes) {
    var index = 0;
    var minDuration = Number.MAX_VALUE;
    routes.forEach(function(route, i) {
        var routeDuration = route.legs.reduce((sum, leg) => sum + leg.duration.value, 0);
        if (routeDuration < minDuration) {
            minDuration = routeDuration;
            index = i;
        }
    });
    return index;
}

function addCustomMarkers(route, map, startLabel, endLabel) {
    var startMarker = new google.maps.Marker({
        position: route.legs[0].start_location,
        map: map,
        label: startLabel,
        title: 'Start: ' + route.legs[0].start_address
    });

    var endMarker = new google.maps.Marker({
        position: route.legs[0].end_location,
        map: map,
        label: endLabel,
        title: 'End: ' + route.legs[0].end_address
    });
}
</script>

      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&callback=initMap"></script>  
</body>
</html>