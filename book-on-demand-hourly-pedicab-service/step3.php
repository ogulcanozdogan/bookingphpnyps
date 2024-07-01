<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

if ($_POST) {
    // Form data received
    // Form data received
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
    $serviceDetails = $_POST["serviceDetails"];
    $serviceDuration = $_POST["serviceDuration"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
    $phoneNumber = "+" . $countryCode . $phoneNumber;
} elseif ($_GET) {
    // Form data received
    $firstName = $_GET["firstName"]; // default value 1
    $lastName = $_GET["lastName"]; // default value 1
    $email = $_GET["email"]; // default value 1
    $phoneNumber = $_GET["phoneNumber"]; // default value 1
    $numPassengers = $_GET["numPassengers"] ?? 1; // default value 1
    $deneme2 = $_GET["pickUpAddress"];
    $destinationAddress = $_GET["destinationAddress"];
    $paymentMethod = $_GET["paymentMethod"];
    $rideDuration = $_GET["rideDuration"];
    $bookingFee = $_GET["bookingFee"];
    $driverFare = $_GET["driverFare"];
    $totalFare = $_GET["totalFare"];
    $returnDuration = $_GET["returnDuration"];
    $pickUpDuration = $_GET["pickUpDuration"];
    $hub = $_GET["hub"];
    $operationFare = $_GET["operationFare"];
    $serviceDetails = $_GET["serviceDetails"];
    $serviceDuration = $_GET["serviceDuration"];
    $countryName = $_GET["countryName"];
} else {
    header("location: index.php");
		exit;
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book On Demand Hourly Pedicab Service</title>
	  <meta name="description" content=" On Demand Hourly Pedicab Service Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
	   <style>
        .top-controls {
            position: absolute;
            top: 10px; /* 10px below the top of the page */
            right: 50%; /* Horizontally centered */
            transform: translateX(-50%); /* Perfectly centered by moving 50% back from the left */
            z-index: 1000; /* Appears above other content */
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
                     <b>On Demand<br>Hourly Pedicab Service<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
					  <tr>
                           <th scope="row">Type</th>
                           <td>	On Demand Hourly Pedicab Service</td>
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
                           <td><?= $phoneNumber ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?= $numPassengers ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Service</th>
                           <td><?php if (
                               $serviceDuration == 90 or
                               $serviceDuration == 30
                           ) {
                               echo $serviceDuration . " Minutes";
                           } else {
                               echo $serviceDuration . " Hour";
                           } ?> </td>
                        </tr>
                        <tr>
                           <th scope="row">Start Address</th>
                           <td><?= $deneme2 ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Finish Address</th>
                           <td><?= $destinationAddress ?></td>
                        </tr>
						<tr>
                        <th scope="row">Service Details</th>
                        <td><?= $serviceDetails ?></td>
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
	<input title="" type="hidden" name="baseFare" value="<?= $baseFare ?>">
    <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">	
	<input title="" type="hidden" name="serviceDetails" value="<?= $serviceDetails ?>">	
	<input title="" type="hidden" name="serviceDuration" value="<?= $serviceDuration ?>">		
	
	<center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Book Now"></center>
</form>
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
                strokeColor: '#FF0000',  // Set line color to red
                strokeOpacity: 1,      // Line opacity
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
                var fastestRouteIndex = findFastestRouteIndex(response.routes);
                directionsRenderer.setDirections(response);
                directionsRenderer.setRouteIndex(fastestRouteIndex);
                addCustomMarkers(response.routes[fastestRouteIndex], map);

                // Calculate the route duration
                var durationMinutes = parseFloat(response.routes[fastestRouteIndex].legs.reduce((sum, leg) => sum + leg.duration.value, 0) / 60);
                console.log("durationMinutes: " + durationMinutes);

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
            label: 'S',
            title: 'Start: ' + route.legs[0].start_address
        });

        var endMarker = new google.maps.Marker({
            position: route.legs[0].end_location,
            map: map,
            label: 'F',
            title: 'End: ' + route.legs[0].end_address
        });
    }
</script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&callback=initMap"></script>  
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <script>
// This function sends the calculated duration to the PHP file

</script>
<script>
document.getElementById("prevButton").addEventListener("click", function() {
    // Get the parameters from the URL
    var urlParams = new URLSearchParams(window.location.search);

    // If there are GET parameters, use them
    var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode(
        $_GET["numPassengers"] ?? ($_POST["numPassengers"] ?? 1)
    ); ?>;
    var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode(
        $_GET["pickUpAddress"] ?? ($_POST["pickUpAddress"] ?? "")
    ); ?>;
    var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode(
        $_GET["destinationAddress"] ?? ($_POST["destinationAddress"] ?? "")
    ); ?>;
    var paymentMethod = urlParams.has('paymentMethod') ? urlParams.get('paymentMethod') : <?php echo json_encode(
        $_GET["paymentMethod"] ?? ($_POST["paymentMethod"] ?? "")
    ); ?>;
    var firstName = urlParams.has('firstName') ? urlParams.get('firstName') : <?php echo json_encode(
        $_GET["firstName"] ?? ($_POST["firstName"] ?? "")
    ); ?>;
    var lastName = urlParams.has('lastName') ? urlParams.get('lastName') : <?php echo json_encode(
        $_GET["lastName"] ?? ($_POST["lastName"] ?? "")
    ); ?>;
    var email = urlParams.has('email') ? urlParams.get('email') : <?php echo json_encode(
        $_GET["email"] ?? ($_POST["email"] ?? "")
    ); ?>;
    var phoneNumber = urlParams.has('phoneNumber') ? urlParams.get('phoneNumber') : <?php echo json_encode(
        $_GET["phoneNumber"] ?? ($_POST["phoneNumber"] ?? "")
    ); ?>;
	var countryCode = urlParams.has('countryCode') ? urlParams.get('countryCode') : <?php echo json_encode(
     $_GET["countryCode"] ?? ($_POST["countryCode"] ?? "")
 ); ?>;
   var countryName = urlParams.has('countryName') ? urlParams.get('countryName') : <?php echo json_encode(
     $_GET["countryName"] ?? ($_POST["countryName"] ?? "")
 ); ?>;
    var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode(
        $_GET["bookingFee"] ?? ($_POST["bookingFee"] ?? "")
    ); ?>;
    var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode(
        $_GET["driverFare"] ?? ($_POST["driverFare"] ?? "")
    ); ?>;
    var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode(
        $_GET["totalFare"] ?? ($_POST["totalFare"] ?? "")
    ); ?>;	
	    var returnDuration = urlParams.has('returnDuration') ? urlParams.get('returnDuration') : <?php echo json_encode(
         $_GET["returnDuration"] ?? ($_POST["returnDuration"] ?? "")
     ); ?>;
    var pickUpDuration = urlParams.has('pickUpDuration') ? urlParams.get('pickUpDuration') : <?php echo json_encode(
        $_GET["pickUpDuration"] ?? ($_POST["pickUpDuration"] ?? "")
    ); ?>;
    var hub = urlParams.has('hub') ? urlParams.get('hub') : <?php echo json_encode(
        $_GET["hub"] ?? ($_POST["hub"] ?? "")
    ); ?>;
    var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode(
        $_GET["operationFare"] ?? ($_POST["operationFare"] ?? "")
    ); ?>;		
    var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode(
        $_GET["rideDuration"] ?? ($_POST["rideDuration"] ?? "")
    ); ?>;		
	var serviceDetails = urlParams.has('serviceDetails') ? urlParams.get('serviceDetails') : <?php echo json_encode(
     $_GET["serviceDetails"] ?? ($_POST["serviceDetails"] ?? "")
 ); ?>;	
    var serviceDuration = urlParams.has('serviceDuration') ? urlParams.get('serviceDuration') : <?php echo json_encode(
        $_GET["serviceDuration"] ?? ($_POST["serviceDuration"] ?? "")
    ); ?>;	


    // Then, after your operations are completed, you can redirect
    var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
                      "&pickUpAddress=" + encodeURIComponent(pickUpAddress) +
                      "&destinationAddress=" + encodeURIComponent(destinationAddress) +
                      "&paymentMethod=" + encodeURIComponent(paymentMethod) +
                      "&firstName=" + encodeURIComponent(firstName) +
                      "&lastName=" + encodeURIComponent(lastName) +
                      "&email=" + encodeURIComponent(email) +
                      "&phoneNumber=" + encodeURIComponent(phoneNumber) +
					  "&countryCode=" + encodeURIComponent(countryCode) +
					  "&countryName=" + encodeURIComponent(countryName) +
                      "&bookingFee=" + encodeURIComponent(bookingFee) +
                      "&driverFare=" + encodeURIComponent(driverFare) +
                      "&totalFare=" + encodeURIComponent(totalFare) +
					   "&returnDuration=" + encodeURIComponent(returnDuration) +
                      "&pickUpDuration=" + encodeURIComponent(pickUpDuration) +
                      "&hub=" + encodeURIComponent(hub) +
                      "&operationFare=" + encodeURIComponent(operationFare) +
					  "&serviceDetails=" + encodeURIComponent(serviceDetails) +
                      "&serviceDuration=" + encodeURIComponent(serviceDuration) +
                      "&rideDuration=" + encodeURIComponent(rideDuration);

    window.location.href = "step2.php?" + queryString;
});

</script>




   </body>
</html>