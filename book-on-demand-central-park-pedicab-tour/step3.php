<?php
include('inc/init.php');
if ($_POST) {
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
    $operationFare = $_POST["operationFare"];
    $tourDuration = $_POST["tourDuration"];
    $pickup1 = $_POST["pickup1"];
    $pickup2 = $_POST["pickup2"];
    $return1 = $_POST["return1"];
    $return2 = $_POST["return2"];
    $toursuresi = $_POST["toursuresi"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
    $hourlyOperationFare = $_POST["hourlyOperationFare"];
} else {
    header("location: index.php");
		exit;
}


date_default_timezone_set('America/New_York'); // New York saat dilimini ayarla
$hour = (int)date('G');
$minute = (int)date('i');

if ($hour < 11 || ($hour == 18 && $minute > 0) || $hour > 18) {
    // Eğer saat 11:00 AM'den küçükse veya 6:01 PM'den büyükse yönlendir
    header("Location: index.php?error=unavailabletime");
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
      <title>Book On Demand Central Park Pedicab Tour</title>
	  <meta name="description" content=" On Demand Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
	     <link rel="shortcut icon" href="vendor/favicon.ico">
      <link href="css/style.css" rel="stylesheet">
      <style>
         .top-controls {
         position: absolute;
         top: 10px; /* 10px below the top of the page */
         right: 50%; /* Center horizontally */
         transform: translateX(-50%); /* Center by moving 50% back */
         z-index: 1000; /* Appear above other content */
         }
         .centered-title {
         text-align: center;
         margin-top: 70px; /* Margin from top for buttons and title */
         }
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
	  <!-- Google tag (gtag.js) --> <script async src=" https://www.googletagmanager.com/gtag/js?id=AW-16684451653 "></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16684451653'); </script>
   </head>
   <body>
      <form method="post" id="myform" action="step4.php">
         <div class="top-controls">
            <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
            <input <?php if (!$_POST) {
                echo "disabled";
            } ?> title="" type="button" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6">
                  <!-- Center the form in a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
					 <b>On Demand<br>Central Park Pedicab Tour<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Type</th>
                           <td>On Demand Central Park Pedicab Tour</td>
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
                           <th scope="row">Date Of Tour</th>
                           <td><?= $todayDay . ' ' . $todayDayName ?> (Today)</td>
                        </tr>
						<tr>
                           <th scope="row">Time Of Tour</th>
                           <td>As Soon As Possible</td>
                        </tr>
						<tr>
                           <th scope="row">Duration of Tour</th>
                           <td><?php
if ($tourDuration == 60){
	$tourDuration = "1 Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)";
}
else{
	if ($tourDuration == 50){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill + Strawberry Fields)";
	}
	else if ($tourDuration == 45){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill)";
	}
	else if ($tourDuration == 40){
		$tourDuration = $tourDuration . " Minutes (Non Stop)";
	}
}
								echo $tourDuration; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Ride</th>
                           <td><?= number_format($rideDuration, 2) ?> Minutes</td>
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
                                <th scope="row">Booking Fee</th>
                                <td>$<?= number_format($bookingFee, 2) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Driver Fare</th>
                                 <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
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
                  <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">	
                  <input title="" type="hidden" name="tourDuration" value="<?= $tourDuration ?>">	
                  <input title="" type="hidden" name="pickup1" value="<?= $pickup1 ?>">	
                  <input title="" type="hidden" name="pickup2" value="<?= $pickup2 ?>">
                  <input title="" type="hidden" name="return1" value="<?= $return1 ?>">	
                  <input title="" type="hidden" name="return2" value="<?= $return2 ?>">		
                  <input title="" type="hidden" name="toursuresi" value="<?= $toursuresi ?>">	
                  <input title="" type="hidden" name="hourlyOperationFare" value="<?= $hourlyOperationFare ?>">		
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
                     strokeOpacity: 0,      // Set line opacity
                     strokeWeight: 6          // Set line width
                 }
             });
         
             var pickupAddress = <?php echo json_encode($deneme2); ?>;
             var destinationAddress = <?php echo json_encode(
                 $destinationAddress
             ); ?>;
         
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
         
                     // Calculate route duration
         var durationMinutes = parseFloat(response.routes[fastestRouteIndex].legs.reduce((sum, leg) => sum + leg.duration.value, 0) / 60);
         
         
         
         
         
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
        returnDuration: <?php echo json_encode($_POST["returnDuration"] ?? ""); ?>,
        operationFare: <?php echo json_encode($_POST["operationFare"] ?? ""); ?>,
        rideDuration: <?php echo json_encode($_POST["rideDuration"] ?? ""); ?>,
        tourDuration: <?php echo json_encode($_POST["tourDuration"] ?? ""); ?>,
        return1: <?php echo json_encode($_POST["return1"] ?? ""); ?>,
        return2: <?php echo json_encode($_POST["return2"] ?? ""); ?>,
        pickup1: <?php echo json_encode($_POST["pickup1"] ?? ""); ?>,
        pickup2: <?php echo json_encode($_POST["pickup2"] ?? ""); ?>,
        toursuresi: <?php echo json_encode($_POST["toursuresi"] ?? ""); ?>
    };

    // Create a form dynamically
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'step2.php';

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

</script>

   </body>
</html>
