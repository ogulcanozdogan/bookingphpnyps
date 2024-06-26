<?php
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   
   if ($_POST){
   // Information from the form
       // Information from the form
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
   $operationFare = $_POST["operationFare"];  
     $tourDuration = $_POST["tourDuration"];   
       $pickup1 = $_POST["pickup1"];
       $pickup2 = $_POST["pickup2"];
   $return1 = $_POST["return1"];  
     $return2 = $_POST["return2"];   
     $toursuresi = $_POST["toursuresi"];  
	 $countryCode = $_POST["countryCode"];
 $phoneNumber = '+' . $countryCode . $phoneNumber;	 
   }
   
   
  else if ($_GET){
      // Information from the form
   $firstName = $_GET["firstName"]; // default value 1
   $lastName = $_GET["lastName"]; // default value 1
   $email = $_GET["email"]; // default value 1
   $phoneNumber = $_GET["phoneNumber"]; // default value 1
   $numPassengers = $_GET["numPassengers"] ?? 1; // default value 1
   $pickUpDate = $_GET["pickUpDate"];
   $hours = $_GET["hours"];
   $minutes = $_GET["minutes"];
   $ampm = $_GET["ampm"];
   $deneme2 = $_GET["pickUpAddress"];
   $destinationAddress = $_GET["destinationAddress"];
   $paymentMethod = $_GET["paymentMethod"];
    $rideDuration = $_GET["rideDuration"];
      $bookingFee = $_GET["bookingFee"];
   $driverFare = $_GET["driverFare"];
   $totalFare = $_GET["totalFare"];
      $returnDuration = $_GET["returnDuration"];
   $operationFare = $_GET["operationFare"];
   $tourDuration = $_GET["tourDuration"];
     $pickup1 = $_GET["pickup1"];
         $pickup2 = $_GET["pickup2"];
   $return1 = $_GET["return1"];
      $return2 = $_GET["return2"];
   $toursuresi = $_GET["toursuresi"];
   }
 else {
    header("location: index.php");
		exit;
}
   
      
   $date = DateTime::createFromFormat('m/d/Y', $pickUpDate);

// Gün değerini al
$pickUpDay = $date->format('l');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book Scheduled Central Park Pedicab Tour</title>
	  <meta name="description" content=" Scheduled Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <style>
         .top-controls {
         position: absolute;
         top: 10px; /* 10px below the top of the page */
         right: 50%; /* Center horizontally */
         transform: translateX(-50%); /* Center exactly by moving 50% from the left */
         z-index: 1000; /* Appear above other content */
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
            <input <?php if (!$_GET) {echo 'disabled';}?> title="" type="button" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6">
                  <!-- Center form within a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                      <b>Scheduled<br>Central Park Pedicab Tour<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Type</th>
                           <td>Scheduled Central Park Pedicab Tour</td>
                        </tr>
                        <tr>
                           <th scope="row">First Name</th>
                           <td><?=$firstName?></td>
                        </tr>
                        <tr>
                           <th scope="row">Last Name</th>
                           <td><?=$lastName?></td>
                        </tr>
                        <tr>
                           <th scope="row">Email Address</th>
                           <td><?=$email?></td>
                        </tr>
                        <tr>
                           <th scope="row">Phone Number</th>
                           <td><?=$phoneNumber?></td>
                        </tr>
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?=$numPassengers?></td>
                        </tr>
                        <tr>
                           <th scope="row">Date of Tour</th>
                           <td><?=$pickUpDate . ' ' . $pickUpDay?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Tour</th>
                           <td><?php echo $hours . ":" .  $minutes . " " . $ampm;?></td>
                        </tr>
						<tr>
                           <th scope="row">Duration of Tour</th>
                           <td><?=$tourDuration?> Minutes</td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Ride</th>
                           <td><?=number_format($rideDuration, 2)?> Minutes</td>
                        </tr>
                        <tr>
                           <th scope="row">Start Address</th>
                           <td><?=$deneme2?></td>
                        </tr>
                        <tr>
                           <th scope="row">Finish Address</th>
                           <td><?=$destinationAddress?></td>
                        </tr>
                        <tr>
                           <th scope="row">Booking Fee</th>
                           <td>$<?=number_format($bookingFee, 2)?></td>
                        </tr>
                        <tr>
                           <th scope="row">Driver Fare</th>
                           <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                        </tr>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?=number_format($totalFare, 2)?></b></td>
                        </tr>
                     </tbody>
                  </table>
                  <input title="" type="hidden" name="firstName" value="<?=$firstName?>">
                  <input title="" type="hidden" name="lastName" value="<?=$lastName?>">
                  <input title="" type="hidden" name="email" value="<?=$email?>">
                  <input title="" type="hidden" name="phoneNumber" value="<?=$phoneNumber?>">
				<input title="" type="hidden" name="countryCode" value="<?=$countryCode?>">
                  <input title="" type="hidden" name="numPassengers" value="<?=$numPassengers?>">
                  <input title="" type="hidden" name="pickUpDate" value="<?=$pickUpDate?>">
                  <input title="" type="hidden" name="hours" value="<?=$hours?>">
                  <input title="" type="hidden" name="minutes" value="<?=$minutes?>">
                  <input title="" type="hidden" name="ampm" value="<?=$ampm?>">
                  <input title="" type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
                  <input title="" type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
                  <input title="" type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
                  <input title="" type="hidden" name="rideDuration" value="<?=$rideDuration?>">		
                  <input title="" type="hidden" name="bookingFee" value="<?=number_format($bookingFee, 2)?>">
                  <input title="" type="hidden" name="driverFare" value="<?=number_format($driverFare, 2)?>">
                  <input title="" type="hidden" name="totalFare" value="<?=number_format($totalFare, 2)?>">	
                  <input title="" type="hidden" name="returnDuration" value="<?=$returnDuration?>">
                  <input title="" type="hidden" name="operationFare" value="<?=$operationFare?>">	
                  <input title="" type="hidden" name="tourDuration" value="<?=$tourDuration?>">	
                  <input title="" type="hidden" name="pickup1" value="<?=$pickup1?>">	
                  <input title="" type="hidden" name="pickup2" value="<?=$pickup2?>">
                  <input title="" type="hidden" name="return1" value="<?=$return1?>">	
                  <input title="" type="hidden" name="return2" value="<?=$return2?>">		
                  <input title="" type="hidden" name="toursuresi" value="<?=$toursuresi?>">		
                 <center> <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Book Now"></center>
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
         // Get the phone number input field
         var phoneNumberInput = document.getElementById("phoneNumber");
         
         // Format the phone number on input change
         phoneNumberInput.addEventListener("input", function(event) {
             // Get the user's input
             var input = event.target.value;
             
             // Remove non-digit characters
             var phoneNumber = input.replace(/\D/g, '');
         
             // Check if the phone number matches the 10-digit format
             var phoneNumberRegex = /^(\d{3})(\d{3})(\d{4})$/;
             if (phoneNumberRegex.test(phoneNumber)) {
                 // Format the number and add parentheses
                 var formattedPhoneNumber = phoneNumber.replace(phoneNumberRegex, "($1) $2-$3");
         
                 // Set the formatted number to the input field
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
                     strokeColor: '#FF0000',  // Set the line color to red
                     strokeOpacity: 0,      // Set the opacity of the line
                     strokeWeight: 6          // Set the thickness of the line
                 }
             });
         
             var pickupAddress = <?php echo json_encode($deneme2); ?>;
             var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
         
             calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress);
         }
         
         function calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress) {
             directionsService.route({
                 origin: pickupAddress,
                 destination: destinationAddress,
                 travelMode: 'BICYCLING',
                 provideRouteAlternatives: true  // Provide alternative routes
             }, function(response, status) {
                 if (status === 'OK') {
                     var fastestRouteIndex = findFastestRouteIndex(response.routes);
                     directionsRenderer.setDirections(response);
                     directionsRenderer.setRouteIndex(fastestRouteIndex);
                     addCustomMarkers(response.routes[fastestRouteIndex], map);
         
                     // Calculate the duration of the route
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
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&callback=initMap"></script>  
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script>
         // This function sends the calculated duration to the PHP file
         
      </script>
      <script>
         document.getElementById("prevButton").addEventListener("click", function() {
             // Get parameters from URL
             var urlParams = new URLSearchParams(window.location.search);
         
             // If there are GET parameters, use them
             var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode($_GET["numPassengers"] ?? $_POST["numPassengers"] ?? 1); ?>;
             var pickUpDate = urlParams.has('pickUpDate') ? urlParams.get('pickUpDate') : <?php echo json_encode($_GET["pickUpDate"] ?? $_POST["pickUpDate"] ?? ''); ?>;
             var hours24 = urlParams.has('hours') ? urlParams.get('hours') : <?php echo json_encode($_GET["hours"] ?? $_POST["hours"] ?? ''); ?>; // Hour in 24-hour format
             var minutes = urlParams.has('minutes') ? urlParams.get('minutes') : <?php echo json_encode($_GET["minutes"] ?? $_POST["minutes"] ?? ''); ?>;
             var ampm = urlParams.has('ampm') ? urlParams.get('ampm') : <?php echo json_encode($_GET["ampm"] ?? $_POST["ampm"] ?? ''); ?>;
             var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode($_GET["pickUpAddress"] ?? $_POST["pickUpAddress"] ?? ''); ?>;
             var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode($_GET["destinationAddress"] ?? $_POST["destinationAddress"] ?? ''); ?>;
             var paymentMethod = urlParams.has('paymentMethod') ? urlParams.get('paymentMethod') : <?php echo json_encode($_GET["paymentMethod"] ?? $_POST["paymentMethod"] ?? ''); ?>;
             var firstName = urlParams.has('firstName') ? urlParams.get('firstName') : <?php echo json_encode($_GET["firstName"] ?? $_POST["firstName"] ?? ''); ?>;
             var lastName = urlParams.has('lastName') ? urlParams.get('lastName') : <?php echo json_encode($_GET["lastName"] ?? $_POST["lastName"] ?? ''); ?>;
             var email = urlParams.has('email') ? urlParams.get('email') : <?php echo json_encode($_GET["email"] ?? $_POST["email"] ?? ''); ?>;
             var phoneNumber = urlParams.has('phoneNumber') ? urlParams.get('phoneNumber') : <?php echo json_encode($_GET["phoneNumber"] ?? $_POST["phoneNumber"] ?? ''); ?>;
			var countryCode = urlParams.has('countryCode') ? urlParams.get('countryCode') : <?php echo json_encode($_GET["countryCode"] ?? $_POST["countryCode"] ?? ''); ?>;
             var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode($_GET["bookingFee"] ?? $_POST["bookingFee"] ?? ''); ?>;
             var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode($_GET["driverFare"] ?? $_POST["driverFare"] ?? ''); ?>;
             var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode($_GET["totalFare"] ?? $_POST["totalFare"] ?? ''); ?>;	
         	    var returnDuration = urlParams.has('returnDuration') ? urlParams.get('returnDuration') : <?php echo json_encode($_GET["returnDuration"] ?? $_POST["returnDuration"] ?? ''); ?>;
             var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode($_GET["operationFare"] ?? $_POST["operationFare"] ?? ''); ?>;		
             var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode($_GET["rideDuration"] ?? $_POST["rideDuration"] ?? ''); ?>;	
             var tourDuration = urlParams.has('tourDuration') ? urlParams.get('tourDuration') : <?php echo json_encode($_GET["tourDuration"] ?? $_POST["tourDuration"] ?? ''); ?>;	
         	
         	    var return1 = urlParams.has('return1') ? urlParams.get('return1') : <?php echo json_encode($_GET["return1"] ?? $_POST["return1"] ?? ''); ?>;
             var return2 = urlParams.has('return2') ? urlParams.get('return2') : <?php echo json_encode($_GET["return2"] ?? $_POST["return2"] ?? ''); ?>;
             var pickup1 = urlParams.has('pickup1') ? urlParams.get('pickup1') : <?php echo json_encode($_GET["pickup1"] ?? $_POST["pickup1"] ?? ''); ?>;		
             var pickup2 = urlParams.has('pickup2') ? urlParams.get('pickup2') : <?php echo json_encode($_GET["pickup2"] ?? $_POST["pickup2"] ?? ''); ?>;		
             var toursuresi = urlParams.has('toursuresi') ? urlParams.get('toursuresi') : <?php echo json_encode($_GET["toursuresi"] ?? $_POST["toursuresi"] ?? ''); ?>;
         
             // Convert to 12-hour format
             var hours12 = hours24 % 12 || 12; // Hour in 12-hour format
         
             // Now you can perform necessary operations
             // ...
         
         
             // After your operations, you can redirect
             var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
                               "&pickUpDate=" + encodeURIComponent(pickUpDate) +
                               "&hours=" + encodeURIComponent(hours12) +
                               "&minutes=" + encodeURIComponent(minutes) +
                               "&ampm=" + encodeURIComponent(ampm) +
                               "&pickUpAddress=" + encodeURIComponent(pickUpAddress) +
                               "&destinationAddress=" + encodeURIComponent(destinationAddress) +
                               "&paymentMethod=" + encodeURIComponent(paymentMethod) +
                               "&firstName=" + encodeURIComponent(firstName) +
                               "&lastName=" + encodeURIComponent(lastName) +
                               "&email=" + encodeURIComponent(email) +
                               "&phoneNumber=" + encodeURIComponent(phoneNumber) +
								"&countryCode=" + encodeURIComponent(countryCode) +
                               "&bookingFee=" + encodeURIComponent(bookingFee) +
                               "&driverFare=" + encodeURIComponent(driverFare) +
                               "&totalFare=" + encodeURIComponent(totalFare) +
         					   "&returnDuration=" + encodeURIComponent(returnDuration) +
                               "&operationFare=" + encodeURIComponent(operationFare) +
         					  "&pickup1=" + encodeURIComponent(pickup1) +
                               "&pickup2=" + encodeURIComponent(pickup2) +
                               "&return1=" + encodeURIComponent(return1) +
                               "&return2=" + encodeURIComponent(return2)+
         					  "&toursuresi=" + encodeURIComponent(toursuresi)+
                               "&rideDuration=" + encodeURIComponent(rideDuration) +
         					  "&tourDuration=" + encodeURIComponent(tourDuration)
         
             window.location.href = "step2.php?" + queryString;
         });
         
      </script>
   </body>
</html>
