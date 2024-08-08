<?php  
include('inc/init.php');
   if ($_POST){
   $firstName = $_POST["firstName"]; // default value 1
   $lastName = $_POST["lastName"]; // default value 1
   $email = $_POST["email"]; // default value 1
   $phoneNumber = $_POST["phoneNumber"]; // default value 1
	$phoneNumber = substr($phoneNumber, -10);
   $numPassengers = $_POST["numPassengers"] ?? 1; // default value 1
   $pickUpDate = $_POST["pickUpDate"];
   $hours = $_POST["hours"];
   $minutes = $_POST["minutes"];
   $ampm = $_POST["ampm"];
   $deneme2 = $_POST["pickUpAddress"];
   $destinationAddress = $_POST["destinationAddress"];
   $paymentMethod = $_POST["paymentMethod"];
   $rideDuration = $_POST["min"];
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
   }
 else {
    header("location: index.php");
		exit;
}

   
$hub1 = "40.766941088678855, -73.97899952992152";
$hub2 = "6th Avenue and Central Park South New York, NY 10019";

$pickUpDate = date("m/d/Y", strtotime($pickUpDate));
// Process date and time information
$pickupDateTime = DateTime::createFromFormat('m/d/Y H:i', $pickUpDate . " " . $hours . ":" . $minutes);
if (!$pickupDateTime) {
    die("Invalid date format. Please check the date and time information.");
}
$dayOfWeek = $pickupDateTime->format('l');
$month = $pickupDateTime->format('F');
$hour24 = (int) $pickupDateTime->format('G'); // 24-hour format

// Define hourly operation fares
$operationFareRates = [
    'default' => [
        'weekday' => 30,
        'weekend' => 35
    ],
    'december' => [
        'weekday' => 40,
        'weekend' => 45
    ]
];

// Base Fare calculation
$isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
$baseFare = $isWeekend ? 35 : 30;
if ($month == "December") {
    $baseFare += 10;
}

// Determine hourly operation fare
$isWeekend = in_array($dayOfWeek, ['Friday', 'Saturday', 'Sunday']);
if ($month == "December") {
    $hourlyOperationFare = $isWeekend ? $operationFareRates['december']['weekend'] : $operationFareRates['december']['weekday'];
} else {
    $hourlyOperationFare = $isWeekend ? $operationFareRates['default']['weekend'] : $operationFareRates['default']['weekday'];
}

function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo"; // Enter your API key here
    $origin = urlencode($origin);
    $destination = urlencode($destination);

    // Adding bicycle mode parameter and request for alternative routes
    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origin&destination=$destination&mode=bicycling&alternatives=true&key=$apiKey";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $data = json_decode($response, true);
        if (isset($data["routes"]) && count($data["routes"]) > 0) {
            // Find the shortest duration
            $shortestDuration = PHP_INT_MAX;
            $fastestRouteIndex = -1;

            foreach ($data["routes"] as $index => $route) {
                $routeDuration = 0;
                foreach ($route["legs"] as $leg) {
                    $routeDuration += $leg["duration"]["value"];
                }
                if ($routeDuration < $shortestDuration) {
                    $shortestDuration = $routeDuration;
                    $fastestRouteIndex = $index;
                }
            }

            // Calculate the shortest duration in minutes
            if ($fastestRouteIndex !== -1) {
                $minutes = floor($shortestDuration / 60);
                $seconds = $shortestDuration % 60;
                return sprintf("%.2f", $minutes + $seconds / 60); // Return the duration in "24.11" format
            }
        }
    }

    return false; // Return false if no suitable route is found
}
// Pick Up 1 duration
$origin = $hub1;
$destination = $deneme2;
$pickup1suresi = getShortestBicycleRouteDuration($origin, $destination);

// Pick Up 2 duration
$origin = $deneme2;
$destination = $hub2;
$pickup2suresi = getShortestBicycleRouteDuration($origin, $destination);

// Tour duration
$origin = $deneme2;
$destination = $destinationAddress;
$toursuresi = getShortestBicycleRouteDuration($origin, $destination);

// Return 1 duration
$origin = $hub1;
$destination = $destinationAddress;
$return1suresi = getShortestBicycleRouteDuration($origin, $destination);

// Return 2 duration
$origin = $destinationAddress;
$destination = $hub2;
$return2suresi = getShortestBicycleRouteDuration($origin, $destination);

// Adjust durations by multiplier
$pickup1 = $pickup1suresi * 2.5;
$pickup2 = $pickup2suresi * 2.5;
$return1 = $return1suresi * 2.5;
$return2 = $return2suresi * 2.5;

// Total duration (in minutes) for Ride Duration
$rideDuration = $pickup2 + $tourDuration + $return1;

// Total duration (in minutes) for Operation Fare
$totalOperationDuration = $pickup1 + $pickup2 + $tourDuration + $return1 + $return2;

// Calculate Operation Fare based on total duration and hourly rate
$totalHours = $totalOperationDuration / 60;
$operationFare = $totalHours * $hourlyOperationFare;

// Calculate Booking Fee
$bookingFee = 0.2 * $operationFare;

// Calculate Driver Fare with CASH
if ($paymentMethod == "CASH") {
    $driverFare = 0.8 * $operationFare;
}

// Calculate Driver Fare with CARD
if ($paymentMethod == "card") {
    $driverFare = 0.8 * $operationFare;
    $driverFare *= 1.1;
}

// Calculate Total Fare
$totalFare = $baseFare + $bookingFee + $driverFare;
   
$date = DateTime::createFromFormat('m/d/Y', $pickUpDate);

// Gün değerini al
$pickUpDay = $date->format('l');

require('inc/countryselect.php');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
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
         top: 10px; /* 10px from the top of the page */
         right: 50%; /* Center horizontally */
         transform: translateX(-50%); /* Will be perfectly centered */
         z-index: 1000; /* Visible above other content */
         }
         .centered-title {
         text-align: center;
         margin-top: 70px; /* Space above buttons and title */
         }

        .country-list {
            position: relative;
            flex: 1;
        }

        .country-select {
            display: block;
            width: 100%;
            padding: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .country-options {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 10;
            display: none;
        }

        .country-options div {
            padding: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .country-options div:hover {
            background-color: #f1f1f1;
        }


        .form-control {
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
      </style>
   </head>
   <body>
      <form method="post" id="myform" autocomplete="off" action="step3.php">
         <div class="top-controls">
            <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
            <input <?php if (!$_GET) {echo 'disabled';}?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6">
                  <!-- Center form in a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                      <b>Scheduled<br>Central Park Pedicab Tour<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
					 <tr>
					 <th scope="row">hubs</th>
					 <td>Hub1: West Drive and West 59th Street New York, NY 10019</td>
					 <td>Hub2: 6th Avenue and Central Park South New York, NY 10019</td>
					 </tr>
					 	<tr>
						<th scope="row">Debug Area</th>
						<td>Pickup1 hub1 to pickup Duration: <?=$pickup1?></td>
						<td>Pickup2 pcikup to hub2 Duration: <?=$pickup2?></td>
						<td>Tour Duration: <?=$tourDuration?></td>
						<td>Return1 hub1 to destination Duration: <?=$return1?></td>
						<td>Return2 destination to hub 2 Duration: <?=$return2?></td>
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
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Passenger Details</h2>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
        <?php if (isset($_POST['firstName']) && !empty($_POST['firstName'])) { ?>
            value="<?php echo htmlspecialchars($_POST['firstName']); ?>"
        <?php } ?> 
        required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="lastName">Last Name</label>
    <input title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
        <?php if (isset($_POST['lastName']) && !empty($_POST['lastName'])) { ?>
            value="<?php echo htmlspecialchars($_POST['lastName']); ?>"
        <?php } ?> 
        required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="email">Email Address</label>
    <input title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
        <?php if (isset($_POST['email']) && !empty($_POST['email'])) { ?>
            value="<?php echo htmlspecialchars($_POST['email']); ?>"
        <?php } ?> 
        required 
        oninvalid="this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid');" 
        oninput="setCustomValidity(''); this.classList.remove('invalid');" 
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
        onchange="if(!this.value.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) { this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid'); } else { this.setCustomValidity(''); this.classList.remove('invalid'); }">
</div>
<div class="form-group">
    <label for="countrySelect">Phone</label>
    <div style="display: flex;">
        <?=countrySelector();?>
        <input title="" style="flex: 2; margin-left: 10px;" type="tel" pattern=".{10,10}" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber" 
            onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter a 10 digit phone number.'); this.classList.add('invalid');" 
            oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" 
            <?php if (isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])) { ?>
                value="<?php echo htmlspecialchars($_POST['phoneNumber']); ?>"
            <?php } ?>
            placeholder="Enter your phone number" required >
    </div>
</div>

                  <input title="" type="hidden" name="numPassengers" value="<?=$numPassengers?>">
                  <input title="" type="hidden" name="pickUpDate" value="<?=$pickUpDate?>">
                  <input title="" type="hidden" name="hours" value="<?=$hours?>">
                  <input title="" type="hidden" name="minutes" value="<?=$minutes?>">
                  <input title="" type="hidden" name="ampm" value="<?=$ampm?>">
                  <input title="" type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
                  <input title="" type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
                  <input title="" type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
                  <input title="" type="hidden" name="rideDuration" value="<?=$rideDuration?>">	
                  <input title="" type="hidden" name="bookingFee" value="<?=$bookingFee?>">
                  <input title="" type="hidden" name="driverFare" value="<?=$driverFare?>">
                  <input title="" type="hidden" name="totalFare" value="<?=$totalFare?>">	
                  <input title="" type="hidden" name="returnDuration" value="<?=$returnDuration?>">
                  <input title="" type="hidden" name="operationFare" value="<?=$operationFare?>">	
                  <input title="" type="hidden" name="tourDuration" value="<?=$tourDuration?>">	
                  <input title="" type="hidden" name="pickup1" value="<?=$pickup1?>">	
                  <input title="" type="hidden" name="pickup2" value="<?=$pickup2?>">
                  <input title="" type="hidden" name="return1" value="<?=$return1?>">	
                  <input title="" type="hidden" name="return2" value="<?=$return2?>">		
                  <input title="" type="hidden" name="toursuresi" value="<?=$toursuresi?>">		
                  <input title="" type="hidden" name="baseFare" value="<?=$baseFare?>">			
                  <center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
      </form>
      </div>
      </div>
      </div>
      </form>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                     strokeOpacity: 0,      // Line opacity
                     strokeWeight: 6          // Line thickness
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
        // Get parameters from URL
        var urlParams = new URLSearchParams(window.location.search);
        
        // If there are GET parameters, use them
        var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>;
        var pickUpDate = urlParams.has('pickUpDate') ? urlParams.get('pickUpDate') : <?php echo json_encode($_POST["pickUpDate"] ?? ''); ?>;
        var hours = urlParams.has('hours') ? urlParams.get('hours') : <?php echo json_encode($_POST["hours"] ?? ''); ?>; // Hour in 24-hour format
        var minutes = urlParams.has('minutes') ? urlParams.get('minutes') : <?php echo json_encode($_POST["minutes"] ?? ''); ?>;
        var ampm = urlParams.has('ampm') ? urlParams.get('ampm') : <?php echo json_encode($_POST["ampm"] ?? ''); ?>;
        var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode($_POST["pickUpAddress"] ?? ''); ?>;
        var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode($_POST["destinationAddress"] ?? ''); ?>;
        var paymentMethod = urlParams.has('paymentMethod') ? urlParams.get('paymentMethod') : <?php echo json_encode($_POST["paymentMethod"] ?? ''); ?>;
        var firstName = urlParams.has('firstName') ? urlParams.get('firstName') : <?php echo json_encode($_POST["firstName"] ?? ''); ?>;
        var lastName = urlParams.has('lastName') ? urlParams.get('lastName') : <?php echo json_encode($_POST["lastName"] ?? ''); ?>;
        var email = urlParams.has('email') ? urlParams.get('email') : <?php echo json_encode($_POST["email"] ?? ''); ?>;
        var phoneNumber = urlParams.has('phoneNumber') ? urlParams.get('phoneNumber') : <?php echo json_encode($_POST["phoneNumber"] ?? ''); ?>;
        var countryCode = urlParams.has('countryCode') ? urlParams.get('countryCode') : <?php echo json_encode($_POST["countryCode"] ?? ''); ?>;
        var countryName = urlParams.has('countryName') ? urlParams.get('countryName') : <?php echo json_encode($_POST["countryName"] ?? ''); ?>;
        var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode($_POST["bookingFee"] ?? ''); ?>;
        var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode($_POST["driverFare"] ?? ''); ?>;
        var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode($_POST["totalFare"] ?? ''); ?>;
        var returnDuration = urlParams.has('returnDuration') ? urlParams.get('returnDuration') : <?php echo json_encode($_POST["returnDuration"] ?? ''); ?>;
        var hub = urlParams.has('hub') ? urlParams.get('hub') : <?php echo json_encode($_POST["hub"] ?? ''); ?>;
        var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode($_POST["operationFare"] ?? ''); ?>;
        var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode($_POST["rideDuration"] ?? ''); ?>;
        var tourDuration = urlParams.has('tourDuration') ? urlParams.get('tourDuration') : <?php echo json_encode($_POST["tourDuration"] ?? ''); ?>;
        var return1 = urlParams.has('return1') ? urlParams.get('return1') : <?php echo json_encode($_POST["return1"] ?? ''); ?>;
        var return2 = urlParams.has('return2') ? urlParams.get('return2') : <?php echo json_encode($_POST["return2"] ?? ''); ?>;
        var pickup1 = urlParams.has('pickup1') ? urlParams.get('pickup1') : <?php echo json_encode($_POST["pickup1"] ?? ''); ?>;
        var pickup2 = urlParams.has('pickup2') ? urlParams.get('pickup2') : <?php echo json_encode($_POST["pickup2"] ?? ''); ?>;
        var toursuresi = urlParams.has('toursuresi') ? urlParams.get('toursuresi') : <?php echo json_encode($_POST["toursuresi"] ?? ''); ?>;
        
        // Create form element
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "index.php";
        
        // Create hidden input elements for each parameter
        function createHiddenInput(name, value) {
            var input = document.createElement("input");
            input.type = "hidden";
            input.name = name;
            input.value = value;
            form.appendChild(input);
        }
        
        createHiddenInput("numPassengers", numPassengers);
        createHiddenInput("pickUpDate", pickUpDate);
        createHiddenInput("hours", hours);
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
        createHiddenInput("hub", hub);
        createHiddenInput("operationFare", operationFare);
        createHiddenInput("rideDuration", rideDuration);
        createHiddenInput("tourDuration", tourDuration);
        createHiddenInput("return1", return1);
        createHiddenInput("return2", return2);
        createHiddenInput("pickup1", pickup1);
        createHiddenInput("pickup2", pickup2);
        createHiddenInput("toursuresi", toursuresi);
        
        // Append form to body and submit
        document.body.appendChild(form);
        form.submit();
    });
</script>
   </body>
</html>
