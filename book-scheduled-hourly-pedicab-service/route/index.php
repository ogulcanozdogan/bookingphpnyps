<?php 
require_once('../inc/db.php');
$bookingNumber = $_GET["bookingNumber"];
$sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE bookingNumber=:bookingNumber");
$sorgu->execute(['bookingNumber' => $bookingNumber]);
$sonuc = $sorgu->fetch();

$deneme2 = $sonuc['pickUpCoords'];
$destinationAddress = $sonuc['destinationCoords'];
$hub = $sonuc['hubCoords'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Map Display</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            width: 100%;
            display: block;
        }

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
        zoom: 14,
        center: {lat: 40.712776, lng: -74.005974},
        styles: [{featureType: 'road', elementType: 'geometry', stylers: [{color: '#f5f1e6'}]}]
    });

    var directionsService = new google.maps.DirectionsService();
    var directionsRendererBlack = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: '#000000',
			strokeOpacity: 0.5,     // Line opacity
            strokeWeight: 6
        }
    });
    var directionsRendererBlue = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {
            strokeColor: '#0000FF',
			strokeOpacity: 0.5,     // Line opacity
            strokeWeight: 6
        }
    });

    var pickupAddress = <?php echo json_encode($deneme2); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
    var hubAddress = <?php echo json_encode($hub); ?>;

    // Calculate route from Hub to Start (black)
    calculateAndDisplayRoute(directionsService, directionsRendererBlack, map, hubAddress, pickupAddress, "H", "S", true, 0.0001);
    // Calculate route from Finish to Hub (blue)
    calculateAndDisplayRoute(directionsService, directionsRendererBlue, map, destinationAddress, hubAddress, "F", "H", true, -0.0001);
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, map, origin, destination, startLabel, endLabel, addMarkers = true, offset = 0) {
    directionsService.route({
        origin: offsetLocation(origin, offset),
        destination: offsetLocation(destination, offset),
        travelMode: 'BICYCLING',
        provideRouteAlternatives: true,
    }, function(response, status) {
        if (status === 'OK') {
            var fastestRouteIndex = findFastestRouteIndex(response.routes);
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(fastestRouteIndex);
            if (addMarkers) {
                addCustomMarkers(response.routes[fastestRouteIndex], map, startLabel, endLabel);
            }
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function offsetLocation(location, offset) {
    var geocoder = new google.maps.Geocoder();
    var newLocation = location;
    geocoder.geocode({'address': location}, function(results, status) {
        if (status === 'OK') {
            var latLng = results[0].geometry.location;
            newLocation = {
                lat: latLng.lat() + offset,
                lng: latLng.lng() + offset
            };
        }
    });
    return newLocation;
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&callback=initMap"></script>
</body>
</html>
