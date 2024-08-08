<?php
include('inc/init.php');
if ($_POST) {
    // Formdan alınan bilgiler
    // Formdan alınan bilgiler
    $firstName = $_POST["firstName"]; // varsayılan değer 1
    $lastName = $_POST["lastName"]; // varsayılan değer 1
    $email = $_POST["email"]; // varsayılan değer 1
    $phoneNumber = $_POST["phoneNumber"]; // varsayılan değer 1
    $numPassengers = $_POST["numPassengers"] ?? 1; // varsayılan değer 1
    $deneme2 = $_POST["pickUpAddress"];
    $destinationAddress = $_POST["destinationAddress"];
    $paymentMethod = $_POST["paymentMethod"];
    $serviceDetails = $_POST["serviceDetails"];
    $serviceDuration = $_POST["serviceDuration"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
} else {
    header("location: index.php");
	exit;
}

$zipCodes = [
    "10000",
    "10001",
    "10002",
    "10003",
    "10004",
    "10005",
    "10006",
    "10007",
    "10008",
    "10009",
    "10010",
    "10011",
    "10012",
    "10013",
    "10014",
    "10015",
    "10016",
    "10017",
    "10018",
    "10019",
    "10020",
    "10021",
    "10022",
    "10023",
    "10024",
    "10025",
    "10026",
    "10028",
    "10029",
    "10036",
    "10038",
    "10041",
    "10043",
    "10045",
    "10055",
    "10060",
    "10065",
    "10069",
    "10075",
    "10080",
    "10081",
    "10087",
    "10090",
    "10101",
    "10102",
    "10103",
    "10104",
    "10105",
    "10106",
    "10107",
    "10108",
    "10109",
    "10110",
    "10111",
    "10112",
    "10113",
    "10114",
    "10116",
    "10117",
    "10118",
    "10119",
    "10120",
    "10121",
    "10122",
    "10123",
    "10124",
    "10126",
    "10128",
    "10129",
    "10130",
    "10131",
    "10132",
    "10133",
    "10138",
    "10151",
    "10152",
    "10153",
    "10154",
    "10155",
    "10156",
    "10157",
    "10158",
    "10159",
    "10160",
    "10162",
    "10163",
    "10164",
    "10165",
    "10166",
    "10167",
    "10168",
    "10169",
    "10170",
    "10171",
    "10172",
    "10173",
    "10174",
    "10175",
    "10176",
    "10177",
    "10178",
    "10179",
    "10185",
    "10199",
    "10203",
    "10211",
    "10212",
    "10242",
    "10249",
    "10256",
    "10258",
    "10259",
    "10260",
    "10261",
    "10265",
    "10268",
    "10269",
    "10270",
    "10271",
    "10272",
    "10273",
    "10274",
    "10275",
    "10276",
    "10277",
    "10278",
    "10279",
    "10280",
    "10281",
    "10282",
    "10285",
    "10286",
];

// Belirtilen zip kodlarının olup olmadığını kontrol et
$checkZipCodes = function ($address) use ($zipCodes) {
    foreach ($zipCodes as $zipCode) {
        if (strpos($address, $zipCode) !== false) {
            return true;
        }
    }
    return false;
};

if (!$checkZipCodes($deneme2) || !$checkZipCodes($destinationAddress)) {
    $queryParams = http_build_query([
        "firstName" => $firstName,
        "lastName" => $lastName,
        "email" => $email,
        "phoneNumber" => $phoneNumber,
        "countryCode" => $countryCode,
        "countryName" => $countryName,
        "numPassengers" => $numPassengers,
        "pickUpAddress" => $deneme2,
        "destinationAddress" => $destinationAddress,
        "paymentMethod" => $paymentMethod,
        "error" => "yes",
    ]);
    header("location: index.php?$queryParams");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
      <title>Book On Demand Hourly Pedicab Service</title>
	  <meta name="description" content=" On Demand Hourly Pedicab Service Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
      
	  
         <div class="container">
            <div class="row justify-content-center">
               
               <div class="col-md-6">
                  <!-- Formu daha dar bir sütuna sığdırarak merkezle -->
                  
                  <div id="map" style="margin-top:30px;display:none;"></div>
              
				  
	<form method="post" id="myform" action="">
	<input type="hidden" name="firstName" value="<?= $firstName ?>">
    <input type="hidden" name="lastName" value="<?= $lastName ?>">
    <input type="hidden" name="email" value="<?= $email ?>">
    <input type="hidden" name="phoneNumber" value="<?= $phoneNumber ?>">	
    <input type="hidden" name="countryCode" value="<?= $countryCode ?>">	
	<input type="hidden" name="countryName" value="<?= $countryName ?>">
    <input type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
    <input type="hidden" name="pickUpAddress" value="<?= $deneme2 ?>">
    <input type="hidden" name="destinationAddress" value="<?= $destinationAddress ?>">
    <input type="hidden" name="paymentMethod" value="<?= $paymentMethod ?>">
	<input type="hidden" name="serviceDuration" value="<?= $serviceDuration ?>">
	<input type="hidden" name="serviceDetails" value="<?= $serviceDetails ?>">
	<input type="hidden" id="jsData" name="min" value="">
	
	<input type="submit" class="btn" style="background-color: #0909ff; color:white; display:none;" value="Review">
</form>
               </div>
            </div>
         </div>
      </form>
<script>
function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: {lat: 40.712776, lng: -74.005974},
        styles: [
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#f5f1e6'}]
            }
        ]
    });

    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
        suppressMarkers: true,  // Varsayılan işaretçileri kaldır
        polylineOptions: {
            strokeColor: '#FF0000',  // Çizgi rengini kırmızı yap
            strokeOpacity: 0.8,      // Çizginin opaklığı
            strokeWeight: 6          // Çizgi kalınlığı
        }
    });

    var geocoder = new google.maps.Geocoder();
    var pickupAddress = <?php echo json_encode($deneme2); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;

    geocodeAddress(geocoder, pickupAddress, function(pickupLocation) {
        geocodeAddress(geocoder, destinationAddress, function(destinationLocation) {
            calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupLocation, destinationLocation);
        });
    });
}

function geocodeAddress(geocoder, address, callback) {
    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
            callback(results[0].geometry.location);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupLocation, destinationLocation) {
    directionsService.route({
        origin: pickupLocation,
        destination: destinationLocation,
        travelMode: 'BICYCLING',
        provideRouteAlternatives: true  // Alternatif rotaları sağla
    }, function(response, status) {
        if (status === 'OK') {
            var fastestRouteIndex = findFastestRouteIndex(response.routes);
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(fastestRouteIndex);
            addCustomMarkers(response.routes[fastestRouteIndex], map);

            // Rotanın süresini hesapla
            var durationMinutes = parseFloat(response.routes[fastestRouteIndex].legs.reduce((sum, leg) => sum + leg.duration.value, 0) / 60);

            console.log("durationMinutes: " + durationMinutes);
            document.getElementById('jsData').value = durationMinutes;
            var form = document.getElementById('myform');
            form.action = 'step2.php'; // Formun action'ını ayarla
            form.submit(); // Formu submit et
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

function addCustomMarkers(route, map) {
    var startMarker = new google.maps.Marker({
        position: route.legs[0].start_location,
        map: map,
        label: 'A',
        title: 'Start: ' + route.legs[0].start_address
    });

    var endMarker = new google.maps.Marker({
        position: route.legs[0].end_location,
        map: map,
        label: 'B',
        title: 'End: ' + route.legs[0].end_address
    });
}
</script>

      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&callback=initMap"></script>
<script>
document.getElementById("prevButton").addEventListener("click", function() {
    // Prepare the data to send
    var formData = {
        numPassengers: <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>,
        pickUpAddress: <?php echo json_encode($_POST["pickUpAddress"] ?? ""); ?>,
        destinationAddress: <?php echo json_encode($_POST["destinationAddress"] ?? ""); ?>,
        paymentMethod: <?php echo json_encode($_POST["paymentMethod"] ?? ""); ?>,
        firstName: <?php echo json_encode($_POST["firstName"] ?? ""); ?>,
        lastName: <?php echo json_encode($_POST["lastName"] ?? ""); ?>,
        email: <?php echo json_encode($_POST["email"] ?? ""); ?>,
        phoneNumber: <?php echo json_encode($_POST["phoneNumber"] ?? ""); ?>,
        countryCode: <?php echo json_encode($_POST["countryCode"] ?? ""); ?>,
        countryName: <?php echo json_encode($_POST["countryName"] ?? ""); ?>,
        bookingFee: <?php echo json_encode($_POST["bookingFee"] ?? ""); ?>,
        driverFare: <?php echo json_encode($_POST["driverFare"] ?? ""); ?>,
        totalFare: <?php echo json_encode($_POST["totalFare"] ?? ""); ?>,
        rideDuration: <?php echo json_encode($_POST["rideDuration"] ?? ""); ?>,
        tourDuration: <?php echo json_encode($_POST["tourDuration"] ?? ""); ?>,
        pickup1: <?php echo json_encode($_POST["pickup1"] ?? ""); ?>,
        pickup2: <?php echo json_encode($_POST["pickup2"] ?? ""); ?>,
        return1: <?php echo json_encode($_POST["return1"] ?? ""); ?>,
        return2: <?php echo json_encode($_POST["return2"] ?? ""); ?>,
        toursuresi: <?php echo json_encode($_POST["toursuresi"] ?? ""); ?>
    };

    // Create a form dynamically
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'index.php';

    // Add the data to the form
    for (var key in formData) {
        if (formData.hasOwnProperty(key)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = formData[key];
            form.appendChild(input);
        }
    }

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
});
</script>

   </body>
</html>