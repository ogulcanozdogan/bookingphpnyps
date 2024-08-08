<?php
include('inc/init.php');
if ($_POST) {
    // Information received from the form
    $firstName = $_POST["firstName"]; // default value 1
    $lastName = $_POST["lastName"]; // default value 1
    $email = $_POST["email"]; // default value 1
    $phoneNumber = $_POST["phoneNumber"]; // default value 1
    $numPassengers = $_POST["numPassengers"] ?? 1; // default value 1
    $deneme2 = $_POST["pickUpAddress"];
    $destinationAddress = $_POST["destinationAddress"];
    $paymentMethod = $_POST["paymentMethod"];
    $rideDuration = $_POST["rideDuration"];
    $bookingFee = $_POST["bookingFee"];
    $driverFare = $_POST["driverFare"];
    $totalFare = $_POST["totalFare"];
    $returnDuration = $_POST["returnDuration"];
    $pickUpDuration = $_POST["pickUpDuration"];
    $hub = $_POST["hub"];
    $operationFare = $_POST["operationFare"];
    $dayOfWeek = $_POST["dayOfWeek"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
	$hourlyOperationFare = $_POST["hourlyOperationFare"];	
} else {
    header("location: index.php");
		exit;
}
$todayDay = date("m/d/Y");
$todayDayName = date("l", strtotime($todayDay));
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
	  <title>Book On Demand Point A to B Pedicab Ride</title>
	  <meta name="description" content="On Demand Point A to B Pedicab Ride Booking Application">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <style>
         .top-controls {
            position: absolute;
            top: 10px; /* 10px below the top of the page */
            right: 50%; /* Centered horizontally */
            transform: translateX(-50%); /* Exactly centered by shifting 50% to the left */
            z-index: 1000; /* Visible above other content */
         }
         .centered-title {
            text-align: center;
            margin-top: 70px; /* Top margin for buttons and title */
         }
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
   </head>
   <body>
      <form method="post" id="myform" action="step4.php">
         <div class="top-controls">
            <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
            <input <?php if (!$_GET) {
                echo "disabled";
            } ?> title="" type="button" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6">
                  <!-- Center the form by fitting it into a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>On Demand<br>Point A to B Pedicab Ride<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Type</th>
                           <td>On Demand Point A to B Pedicab Ride</td>
                        </tr>
                        <tr>
                           <th scope="row">First Name</th>
                           <td><?= $firstName ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Last Name</th>
                           <td><?= $lastName ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Email Address</th>
                           <td><?= $email ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Phone Number</th>
                           <td>+<?= $countryCode . $phoneNumber ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?= $numPassengers ?></td>
                        </tr>
						<tr>
                           <th scope="row">Date Of Pick Up</th>
                           <td><?= $todayDay . ' ' . $todayDayName ?> (Today)</td>
                        </tr>
						<tr>
                           <th scope="row">Time Of Pick Up</th>
                           <td>As Soon As Possible</td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Ride</th>
                           <td><?= $rideDuration ?> Minutes</td>
                        </tr>
                        <tr>
                           <th scope="row">Pick Up Address</th>
                           <td><?= $deneme2 ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Destination Address</th>
                           <td><?= $destinationAddress ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Booking Fee</th>
                           <td>$<?= number_format($bookingFee, 2) ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Driver Fare</th>
                           <td>$<?= number_format($driverFare, 2)  ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                        </tr>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format(
                               $totalFare,
                               2
                           );?></b></td>
                        </tr>
                     </tbody>
                  </table>
                  <input title="" type="hidden" name="firstName" value="<?= $firstName ?>">
                  <input title="" type="hidden" name="lastName" value="<?= $lastName ?>">
                  <input title="" type="hidden" name="email" value="<?= $email ?>">
                  <input title="" type="hidden" name="phoneNumber" value="<?= $phoneNumber ?>">
					<input title="" type="hidden" name="countryCode" value="<?= $countryCode ?>">
				<input title="" type="hidden" name="countryName" value="<?= $countryName ?>">
                  <input title="" type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
                  <input title="" type="hidden" name="pickUpAddress" value="<?= $deneme2 ?>">
                  <input title="" type="hidden" name="destinationAddress" value="<?= $destinationAddress ?>">
                  <input title="" type="hidden" name="paymentMethod" value="<?= $paymentMethod ?>">
                  <input title="" type="hidden" name="rideDuration" value="<?= $rideDuration ?>">
                  <input title="" type="hidden" name="bookingFee" value="<?= number_format(
                      $bookingFee,
                      2
                  ) ?>">
                  <input title="" type="hidden" name="driverFare" value="<?= number_format(
                      $driverFare,
                      2
                  ) ?>">
                  <input title="" type="hidden" name="totalFare" value="<?= number_format(
                      $totalFare,
                      2
                  ) ?>">
                  <input title="" type="hidden" name="returnDuration" value="<?= $returnDuration ?>">
                  <input title="" type="hidden" name="pickUpDuration" value="<?= $pickUpDuration ?>">
                  <input title="" type="hidden" name="hub" value="<?= $hub ?>">
                  <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">
				  <input title="" type="hidden" name="dayOfWeek" value="<?= $dayOfWeek ?>">	
				<input title="" type="hidden" name="hourlyOperationFare" value="<?= $hourlyOperationFare ?>">					  
				  
                  <center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Book Now"></center>
               </div>
            </div>
         </div>
      </form>
      <script>
         document.getElementById("nextButton").addEventListener("click", function() {
             document.getElementById("myform").submit();
         });
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput-jquery.min.js"></script>
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
            suppressMarkers: true,  // Remove default markers
            polylineOptions: {
                strokeColor: '#FF0000',  // Make the line color red
                strokeOpacity: 0.8,      // Line opacity
                strokeWeight: 6          // Line thickness
            }
        });

        var geocoder = new google.maps.Geocoder();
        var pickupAddress = <?php echo json_encode($deneme2); ?>;
        var destinationAddress = <?php echo json_encode(
            $destinationAddress
        ); ?>;

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
            provideRouteAlternatives: true  // Provide alternative routes
        }, function(response, status) {
            if (status === 'OK') {
                var shortestRouteIndex = findShortestRouteIndex(response.routes);
                directionsRenderer.setDirections(response);
                directionsRenderer.setRouteIndex(shortestRouteIndex);
                addCustomMarkers(response.routes[shortestRouteIndex], map);

                // Calculate the duration of the route
                var durationMinutes = parseFloat(response.routes[shortestRouteIndex].legs.reduce((sum, leg) => sum + leg.duration.value, 0) / 60);

                console.log("durationMinutes: " + durationMinutes);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

    function findShortestRouteIndex(routes) {
        var index = 0;
        var minDistance = Number.MAX_VALUE;

        routes.forEach(function(route, i) {
            var routeDistance = route.legs.reduce((sum, leg) => sum + leg.distance.value, 0);
            if (routeDistance < minDistance) {
                minDistance = routeDistance;
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script>
         // This function sends the calculated duration to the PHP file
      </script>
<script>
document.getElementById("prevButton").addEventListener("click", function() {
    // POST verilerini kullan
    var numPassengers = <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>;
    var pickUpDate = <?php echo json_encode($_POST["pickUpDate"] ?? ""); ?>;
    var hours24 = <?php echo json_encode($_POST["hours"] ?? ""); ?>; // 24 saatlik formatta saat
    var minutes = <?php echo json_encode($_POST["minutes"] ?? ""); ?>;
    var ampm = <?php echo json_encode($_POST["ampm"] ?? ""); ?>;
    var pickUpAddress = <?php echo json_encode($_POST["pickUpAddress"] ?? ""); ?>;
    var destinationAddress = <?php echo json_encode($_POST["destinationAddress"] ?? ""); ?>;
    var paymentMethod = <?php echo json_encode($_POST["paymentMethod"] ?? ""); ?>;
    var firstName = <?php echo json_encode($_POST["firstName"] ?? ""); ?>;
    var lastName = <?php echo json_encode($_POST["lastName"] ?? ""); ?>;
    var email = <?php echo json_encode($_POST["email"] ?? ""); ?>;
    var phoneNumber = <?php echo json_encode($_POST["phoneNumber"] ?? ""); ?>;
    var countryCode = <?php echo json_encode($_POST["countryCode"] ?? ""); ?>;
    var countryName = <?php echo json_encode($_POST["countryName"] ?? ""); ?>;
    var bookingFee = <?php echo json_encode($_POST["bookingFee"] ?? ""); ?>;
    var driverFare = <?php echo json_encode($_POST["driverFare"] ?? ""); ?>;
    var totalFare = <?php echo json_encode($_POST["totalFare"] ?? ""); ?>;
    var returnDuration = <?php echo json_encode($_POST["returnDuration"] ?? ""); ?>;
    var pickUpDuration = <?php echo json_encode($_POST["pickUpDuration"] ?? ""); ?>;
    var hub = <?php echo json_encode($_POST["hub"] ?? ""); ?>;
    var operationFare = <?php echo json_encode($_POST["operationFare"] ?? ""); ?>;
    var rideDuration = <?php echo json_encode($_POST["rideDuration"] ?? ""); ?>;
    var dayOfWeek = <?php echo json_encode($_POST["dayOfWeek"] ?? ""); ?>;

    // 12 saatlik formata çevir
    var hours12 = hours24 % 12 || 12; // 12 saatlik formatta saat

    // Şimdi gerekli işlemleri yapabilirsiniz
    // ...

    // Ardından, işlemleriniz tamamlandıktan sonra yönlendirme yapabilirsiniz
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "step2.php";

    // Append form fields
    form.appendChild(createHiddenInput("numPassengers", numPassengers));
    form.appendChild(createHiddenInput("pickUpDate", pickUpDate));
    form.appendChild(createHiddenInput("hours", hours12));
    form.appendChild(createHiddenInput("minutes", minutes));
    form.appendChild(createHiddenInput("ampm", ampm));
    form.appendChild(createHiddenInput("pickUpAddress", pickUpAddress));
    form.appendChild(createHiddenInput("destinationAddress", destinationAddress));
    form.appendChild(createHiddenInput("paymentMethod", paymentMethod));
    form.appendChild(createHiddenInput("firstName", firstName));
    form.appendChild(createHiddenInput("lastName", lastName));
    form.appendChild(createHiddenInput("email", email));
    form.appendChild(createHiddenInput("phoneNumber", phoneNumber));
    form.appendChild(createHiddenInput("countryCode", countryCode));
    form.appendChild(createHiddenInput("countryName", countryName));
    form.appendChild(createHiddenInput("bookingFee", bookingFee));
    form.appendChild(createHiddenInput("driverFare", driverFare));
    form.appendChild(createHiddenInput("totalFare", totalFare));
    form.appendChild(createHiddenInput("returnDuration", returnDuration));
    form.appendChild(createHiddenInput("pickUpDuration", pickUpDuration));
    form.appendChild(createHiddenInput("hub", hub));
    form.appendChild(createHiddenInput("operationFare", operationFare));
    form.appendChild(createHiddenInput("rideDuration", rideDuration));
    form.appendChild(createHiddenInput("dayOfWeek", dayOfWeek));

    document.body.appendChild(form);
    form.submit();
});

function createHiddenInput(name, value) {
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = name;
    input.value = value;
    return input;
}
</script>

   </body>
</html>
