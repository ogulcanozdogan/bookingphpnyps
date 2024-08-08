<?php
include('inc/init.php');
if ($_POST) {
    // Form data received
    // Form data received
    $firstName = $_POST["firstName"]; // default value 1
    $lastName = $_POST["lastName"]; // default value 1
    $email = $_POST["email"]; // default value 1
    $phoneNumber = $_POST["phoneNumber"]; // default value 1
    $numPassengers = $_POST["numPassengers"] ?? 1; // default value 1
    $pickUpDate = $_POST["pickUpDate"];
    $hours = $_POST["hours"];
    $minutes = $_POST["minutes"];
    $ampm = $_POST["ampm"];
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
    $baseFare = $_POST["baseFare"];
    $operationFare = $_POST["operationFare"];
    $serviceDetails = $_POST["serviceDetails"];
    $serviceDuration = $_POST["serviceDuration"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
} else {
    header("location: index.php");
		exit;
}

$pickUpDateTime = DateTime::createFromFormat("m/d/Y", $pickUpDate);
$dayOfWeek = $pickUpDateTime->format("l");
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
	  <title>Book Scheduled Hourly Pedicab Service</title>
	  <meta name="description" content="Scheduled Hourly Pedicab Service Booking Application">
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
                     <b>Scheduled<br>Hourly Pedicab Service<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
					  <tr>
                           <th scope="row">Type</th>
                           <td>Scheduled Hourly Pedicab Service</td>
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
                           <th scope="row">Date of Service</th>
                           <td><?php echo $pickUpDate . ' ' .$dayOfWeek;?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Service</th>
                           <td><?php echo $hours .
                               ":" .
                               $minutes .
                               " " .
                               $ampm; ?></td>
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
							<?php //if ($paymentMethod != "fullcard") { ?>
                        <tr>
                           <th scope="row">Booking Fee</th>
                           <td>$<?= number_format($bookingFee, 2) ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Driver Fare</th>
                           <td>$<?= number_format($driverFare, 2)  ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                        </tr>
						<?php// } ?>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format(
                               $totalFare,
                               2
                           ); if ($paymentMethod == 'fullcard') { echo ' with debit/credit card'; }?></b></td>
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
    <input title="" type="hidden" name="pickUpDate" value="<?= $pickUpDate ?>">
    <input title="" type="hidden" name="hours" value="<?= $hours ?>">
    <input title="" type="hidden" name="minutes" value="<?= $minutes ?>">
    <input title="" type="hidden" name="ampm" value="<?= $ampm ?>">
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
    $("#phoneNumber").intlTelInput({
        initialCountry: "us", // Automatically selects the user's country
        separateDialCode: true, // Displays the country code as a separate field
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Helper script for formatting code
    });
</script>
<script>
    // Get the phone number input field
    var phoneNumberInput = document.getElementById("phoneNumber");

    // Format the phone number when there is a change
    phoneNumberInput.addEventListener("input", function(event) {
        // Get the user's input
        var input = event.target.value;
        
        // Get only the digits
        var phoneNumber = input.replace(/\D/g, '');

        // Check the 10-digit phone number format
        var phoneNumberRegex = /^(\d{3})(\d{3})(\d{4})$/;
        if (phoneNumberRegex.test(phoneNumber)) {
            // Format the number and return with parentheses
            var formattedPhoneNumber = phoneNumber.replace(phoneNumberRegex, "($1) $2-$3");

            // Place the formatted number in the input field
            event.target.value = formattedPhoneNumber;
        }
    });
</script>

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
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&callback=initMap"></script>  
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	  <script>
// This function sends the calculated duration to the PHP file

</script>
<script>
document.getElementById("prevButton").addEventListener("click", function() {
    // POST verilerini al
    var numPassengers = <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>;
    var pickUpDate = <?php echo json_encode($_POST["pickUpDate"] ?? ""); ?>;
    var hours24 = <?php echo json_encode($_POST["hours"] ?? ""); ?>; // 24 saat formatında saat
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
    var baseFare = <?php echo json_encode($_POST["baseFare"] ?? ""); ?>;
    var operationFare = <?php echo json_encode($_POST["operationFare"] ?? ""); ?>;
    var rideDuration = <?php echo json_encode($_POST["rideDuration"] ?? ""); ?>;
    var serviceDetails = <?php echo json_encode($_POST["serviceDetails"] ?? ""); ?>;
    var serviceDuration = <?php echo json_encode($_POST["serviceDuration"] ?? ""); ?>;

    // 12 saat formatına çevir
    var hours12 = hours24 % 12 || 12; // 12 saat formatında saat

    // Form oluştur ve POST ile gönder
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "step2.php";

    // Form alanlarını ekle
    function createHiddenInput(name, value) {
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        form.appendChild(input);
    }

    createHiddenInput("numPassengers", numPassengers);
    createHiddenInput("pickUpDate", pickUpDate);
    createHiddenInput("hours", hours12);
    createHiddenInput("minutes", minutes);
    createHiddenInput("ampm", ampm);
    createHiddenInput("pickUpAddress", pickUpAddress);
    createHiddenInput("destinationAddress", destinationAddress);
    createHiddenInput("paymentMethod", paymentMethod);
    createHiddenInput("firstName", firstName);
    createHiddenInput("lastName", lastName);
    createHiddenInput("email", email);
    createHiddenInput("phoneNumber", phoneNumber);
    createHiddenInput("countryCode", countryCode);
    createHiddenInput("countryName", countryName);
    createHiddenInput("bookingFee", bookingFee);
    createHiddenInput("driverFare", driverFare);
    createHiddenInput("totalFare", totalFare);
    createHiddenInput("returnDuration", returnDuration);
    createHiddenInput("pickUpDuration", pickUpDuration);
    createHiddenInput("hub", hub);
    createHiddenInput("baseFare", baseFare);
    createHiddenInput("operationFare", operationFare);
    createHiddenInput("rideDuration", rideDuration);
    createHiddenInput("serviceDetails", serviceDetails);
    createHiddenInput("serviceDuration", serviceDuration);

    document.body.appendChild(form);
    form.submit();
});
</script>
   </body>
</html>
