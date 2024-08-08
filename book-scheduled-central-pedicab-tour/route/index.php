<?php 
require_once('../inc/db.php');
$bookingNumber = $_GET["bookingNumber"];
$sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE bookingNumber=:bookingNumber");
$sorgu->execute(['bookingNumber' => $bookingNumber]);
$sonuc = $sorgu->fetch();
$deneme2 = $sonuc['pickUpCoords'];
$deneme22 = $sonuc['pickupAddress'];
$destinationAddress = $sonuc['destinationCoords'];
$destinationAddress2 = $sonuc['destinationAddress'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="minimum-scale=1, initial-scale=1, width=device-width, user-scalable=no"/>
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
        zoom: 12,
        center: {lat: 40.7831, lng: -73.9712},
        styles: [{featureType: 'road', elementType: 'geometry', stylers: [{color: '#f5f1e6'}]}]
    });

    var directionsService = new google.maps.DirectionsService();

    var renderers = [
        new google.maps.DirectionsRenderer({
            map: map,
            polylineOptions: {
                strokeColor: 'black',
                strokeOpacity: 0.5,
                strokeWeight: 6,
                zIndex: 1
            },
            suppressMarkers: true
        }),
        new google.maps.DirectionsRenderer({
            map: map,
            polylineOptions: {
                strokeColor: 'orange',
                strokeOpacity: 0.5,
                strokeWeight: 6,
                zIndex: 2
            },
            suppressMarkers: true
        }),
        new google.maps.DirectionsRenderer({
            map: map,
            polylineOptions: {
                strokeColor: 'blue',
                strokeOpacity: 0.5,
                strokeWeight: 6,
                zIndex: 3
            },
            suppressMarkers: true
        }),
        new google.maps.DirectionsRenderer({
            map: map,
            polylineOptions: {
                strokeColor: 'green',
                strokeOpacity: 0.5,
                strokeWeight: 6,
                zIndex: 4
            },
            suppressMarkers: true
        })
    ];

    var pickupAddress = <?php echo json_encode($deneme2); ?>;
    var pickupAddress2 = <?php echo json_encode($deneme22); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
	var destinationAddress2 = <?php echo json_encode($destinationAddress2); ?>;
    var hub1Address = "40.766941088678855, -73.97899952992152";
    var hub2Address = "6th Avenue and Central Park South New York, NY 10019";

    // Markers for start, hub and destination points
    addMarker(map, hub1Address, 'H1', 'Hub 1');
    addMarker(map, hub2Address, 'H2', 'Hub 2');
    addMarker(map, pickupAddress, 'S', 'Start');
    addMarker(map, destinationAddress, 'F', 'Finish');

    calculateAndDisplayRoute(directionsService, renderers[0], hub1Address, pickupAddress, 'H1', 'S');
    calculateAndDisplayRoute(directionsService, renderers[1], pickupAddress2, hub2Address, 'S', 'H2');
    calculateAndDisplayRoute(directionsService, renderers[2], hub1Address, destinationAddress2, 'F', 'H1');
    calculateAndDisplayRoute(directionsService, renderers[3], destinationAddress2, hub2Address, 'F', 'H2');
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

function addMarker(map, position, label, title) {
    new google.maps.Marker({
        position: parseCoords(position),
        label: label,
        map: map,
        title: title
    });
}

function parseCoords(coords) {
    var parts = coords.split(',');
    return {lat: parseFloat(parts[0]), lng: parseFloat(parts[1])};
}
</script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&callback=initMap"></script>  
</body>
</html>
