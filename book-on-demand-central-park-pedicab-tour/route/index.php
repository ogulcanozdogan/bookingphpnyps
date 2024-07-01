<?php 
require_once('../inc/db.php');
$bookingNumber = $_GET["bookingNumber"];
$sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE bookingNumber=:bookingNumber");
$sorgu->execute(['bookingNumber' => $bookingNumber]);
$sonuc = $sorgu->fetch();
$deneme2 = $sonuc['pickUpCoords'];
$destinationAddress = $sonuc['destinationCoords'];
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
    <div id="map"></div>
<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {lat: 40.7831, lng: -73.9712},
		  styles: [{featureType: 'road', elementType: 'geometry', stylers: [{color: '#f5f1e6'}]}]
    });

    var directionsService = new google.maps.DirectionsService();
    var pickupRenderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
            strokeColor: 'black',
            strokeWeight: 6,
            zIndex: 1
        },
        suppressMarkers: true
    });
    var pickup2Renderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
            strokeColor: 'orange',
            strokeWeight: 6,
            zIndex: 2
        },
        suppressMarkers: true
    });
    var return1Renderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
            strokeColor: 'blue',
            strokeWeight: 6,
            zIndex: 3
        },
        suppressMarkers: true
    });
    var return2Renderer = new google.maps.DirectionsRenderer({
        map: map,
        polylineOptions: {
            strokeColor: 'green',
            strokeWeight: 6,
            zIndex: 4
        },
        suppressMarkers: true
    });

    var pickupAddress = <?php echo json_encode($deneme2); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
    var hub1Address = "West Drive and West 59th Street New York, NY 10019";
    var hub2Address = "6th Avenue and Central Park South New York, NY 10019";

    calculateAndDisplayRoute(directionsService, pickupRenderer, pickupAddress, hub1Address, 'S', 'H');
    calculateAndDisplayRoute(directionsService, pickup2Renderer, pickupAddress, hub2Address, 'S', 'H');
    calculateAndDisplayRoute(directionsService, return1Renderer, destinationAddress, hub1Address, 'F', 'H');
    calculateAndDisplayRoute(directionsService, return2Renderer, destinationAddress, hub2Address, 'F', 'H');
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination, labelOrigin, labelDestination) {
    directionsService.route({
        origin: origin,
        destination: destination,
        travelMode: 'BICYCLING',
        provideRouteAlternatives: true,
    }, function(response, status) {
        if (status === 'OK') {
            var fastestRouteIndex = findFastestRouteIndex(response.routes);
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(fastestRouteIndex);
            addCustomMarkers(response.routes[fastestRouteIndex], directionsRenderer.getMap(), labelOrigin, labelDestination);
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
    new google.maps.Marker({
        position: route.legs[0].start_location,
        label: startLabel,
        map: map,
        title: 'Start: ' + route.legs[0].start_address
    });

    new google.maps.Marker({
        position: route.legs[0].end_location,
        label: endLabel,
        map: map,
        title: 'End: ' + route.legs[0].end_address
    });
}
</script>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&callback=initMap"></script>  
</body>
</html>
