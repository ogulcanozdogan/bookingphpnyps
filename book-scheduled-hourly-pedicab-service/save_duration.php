<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// POST verilerini al
$numPassengers = $_POST["numPassengers"] ?? 1; // Varsayılan değer 1
$pickUpDate = $_POST["pickUpDate"] ?? ''; // Varsayılan boş string
$hours = $_POST["hours"] ?? '';
$minutes = $_POST["minutes"] ?? '';
$ampm = $_POST["ampm"] ?? '';
$pickUpAddress = $_POST["pickUpAddress"] ?? ''; // Adres bilgileri, önceki isim 'deneme2' idi
$destinationAddress = $_POST["destinationAddress"] ?? '';
$paymentMethod = $_POST["paymentMethod"] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Map and Directions</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKOygxViJ7v5bzNoEa_EFLOuHiQ8ofO-c"></script> <!-- API anahtarınızı buraya girin -->
</head>
<body>
<div id="map" style="height: 400px; width: 100%;"></div>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $duration = isset($_POST['duration']) ? $_POST['duration'] : null;
    
    if ($duration === null) {
        echo "No duration value provided";
    } else {
        echo "Duration received: " . htmlspecialchars($duration);
    }
} else {
    echo "Invalid request method";
}
?>


<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {lat: 40.712776, lng: -74.005974},
        styles: [{featureType: 'road', elementType: 'geometry', stylers: [{color: '#f5f1e6'}]}]
    });

    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,
        polylineOptions: {strokeColor: '#FF0000', strokeOpacity: 0.8, strokeWeight: 6}
    });

    var pickupAddress = <?php echo json_encode($pickUpAddress); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;

    calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress);
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress) {
    directionsService.route({
        origin: pickupAddress,
        destination: destinationAddress,
        travelMode: 'BICYCLING',
        provideRouteAlternatives: true
    }, function(response, status) {
        if (status === 'OK') {
            var fastestRouteIndex = findFastestRouteIndex(response.routes);
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(fastestRouteIndex);
            addCustomMarkers(response.routes[fastestRouteIndex], map);

            // Rotanın süresini hesapla ve gönder
            var durationMinutes = parseFloat(response.routes[fastestRouteIndex].legs.reduce((sum, leg) => sum + leg.duration.value, 0) / 60);
            console.log("durationMinutes: " + durationMinutes);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}


function findFastestRouteIndex(routes) {
    var index = 0, minDuration = Number.MAX_VALUE;
    routes.forEach(function(route, i) {
        var routeDuration = route.legs.reduce((sum, leg) => sum + leg.duration.value, 0);
        if (routeDuration < minDuration) {
            minDuration = routeDuration;
            index = i;
        }
    });
    return index;
}

function addCustomMarkers(route, map) {
    new google.maps.Marker({position: route.legs[0].start_location, map: map, label: 'A', title: 'Start: ' + route.legs[0].start_address});
    new google.maps.Marker({position: route.legs[0].end_location, map: map, label: 'B', title: 'End: ' + route.legs[0].end_address});
}




document.addEventListener('DOMContentLoaded', initMap);
</script>
</body>
</html>
