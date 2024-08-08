<?php
include('inc/init.php');

if ($_POST) {
    // Form data received
    $firstName = $_POST["firstName"]; // default value 1
    $lastName = $_POST["lastName"]; // default value 1
    $email = $_POST["email"]; // default value 1
    $phoneNumber = $_POST["phoneNumber"]; // default value 1
    $phoneNumber = substr($phoneNumber, -10);
    $numPassengers = $_POST["numPassengers"]; // default value 1
    $deneme2 = $_POST["pickUpAddress"];
    $destinationAddress = $_POST["destinationAddress"];
    $paymentMethod = $_POST["paymentMethod"];
    $tourDuration = $_POST["tourDuration"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
}  else {
    header("location: index.php");
		exit;
}


$hub1 = "40.766941088678855, -73.97899952992152";
$hub2 = "6th Avenue and Central Park South New York, NY 10019";

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

// Example of using fixed durations (in minutes)
$pickup1 = $pickup1suresi; // Pick Up 1 duration
$pickup2 = $pickup2suresi; // Pick Up 2 duration
$toursuresi = $toursuresi; // Tour duration
$return1 = $return1suresi; // Return 1 duration
$return2 = $return2suresi; // Return 2 duration

$pickup1 *= 2.5;
$pickup2 *= 2.5;
$return1 *= 2.5;
$return2 *= 2.5;
$toursuresi = $toursuresi;

// Operation Fare hesaplama
$operationFare = $pickup1 + $pickup2 + $return1 + $return2 + $tourDuration;

// Tarihi 'm/d/Y' formatından 'Y-m-d' formatına çevirme
$convertedDate = date("Y-m-d");

// Yeni tarihi kullanarak gün adını bulma
$dayName = date("l", strtotime($convertedDate));

$todayDay = date("m/d/Y");
$todayDayName = date("l", strtotime($todayDay));

if (
    strpos($dayName, "Monday") !== false ||
    strpos($dayName, "Tuesday") !== false ||
    strpos($dayName, "Wednesday") !== false ||
    strpos($dayName, "Thursday") !== false
) {
    // Monday to Thursday
    $hourlyOperationFare = 37.5;
} elseif (
    strpos($dayName, "Friday") !== false ||
    strpos($dayName, "Saturday") !== false ||
    strpos($dayName, "Sunday") !== false
) {
    // Friday to Sunday
    $hourlyOperationFare = 45;
}

// Check if it's December
if (date("m", strtotime($convertedDate)) == 12) {
    if (
        strpos($dayName, "Monday") !== false ||
        strpos($dayName, "Tuesday") !== false ||
        strpos($dayName, "Wednesday") !== false ||
        strpos($dayName, "Thursday") !== false
    ) {
        // Monday to Thursday in December
        $hourlyOperationFare = 52.5;
    } elseif (
        strpos($dayName, "Friday") !== false ||
        strpos($dayName, "Saturday") !== false ||
        strpos($dayName, "Sunday") !== false
    ) {
        // Friday to Sunday in December
        $hourlyOperationFare = 60;
    }
}

// Toplam dakika cinsinden operasyon süresi
$totalMinutes = $operationFare;

// Dakikayı saate dönüştürme
$totalHours = $totalMinutes / 60;

// Günün saatlik operasyon ücreti ile çarpma
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
    $driverFare = 1.1 * $driverFare;
}

// Calculate Total Fare
$totalFare = $bookingFee + $driverFare;


$bookingFee = number_format($bookingFee, 2);
$totalFare = number_format($totalFare, 2);
$driverFare = number_format($driverFare, 2);

// Total duration (in minutes)
$rideDuration = $pickup2 + $tourDuration + $return1;



require "inc/countryselect.php";
// Oturum verilerini kontrol edin
	// Oturum verilerini kontrol edin
?>
<!DOCTYPE html>
<html lang="en">
   <head>
   <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
      <title>Book On Demand Central Park Pedicab Tour</title>
	  <meta name="description" content=" On Demand Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	     <link rel="shortcut icon" href="vendor/favicon.ico">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <style>
         .top-controls {
         position: absolute;
         top: 10px; /* 10px below the top of the page */
         right: 50%; /* Centered horizontally */
         transform: translateX(-50%); /* Move back 50% from the left */
         z-index: 1000; /* Visible above other content */
         }
         .centered-title {
         text-align: center;
         margin-top: 70px; /* Top margin for buttons and title */
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
            <input <?php if (!$_POST) {
                echo "disabled";
            } ?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
         </div>
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-6">
                  <!-- Center the form in a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
					 <b>On Demand<br>Central Park Pedicab Tour<br>Booking Application</b>
                  </div>
                  <div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text"></span>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
					  <tr>
					<!-- <th scope="row">hubs</th>
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
						</tr> -->
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
                           <td><?= $tourDuration ?> Minutes</td>
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
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Passenger Details</h2>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
        <?php if (isset($_POST["firstName"]) && !empty($_POST["firstName"])) { ?>
            value="<?php echo htmlspecialchars($_POST["firstName"]); ?>"
        <?php } ?> 
        maxlength="20" required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="lastName">Last Name</label>
    <input title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
        <?php if (isset($_POST["lastName"]) && !empty($_POST["lastName"])) { ?>
            value="<?php echo htmlspecialchars($_POST["lastName"]); ?>"
        <?php } ?> 
        maxlength="20" required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
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
    <div style="display: flex;" class="form-group">
        <?= countrySelector() ?>
        <input title="" style="flex: 2; margin-left: 10px;" type="tel" pattern=".{10,10}" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
               onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter a 10 digit phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" value="<?php echo htmlspecialchars($_POST['phoneNumber'] ?? ''); ?>" placeholder="Enter your phone number" required>
    </div>
</div>


                  <input title="" type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
                  <input title="" type="hidden" name="pickUpAddress" value="<?= $deneme2 ?>">
                  <input title="" type="hidden" name="destinationAddress" value="<?= $destinationAddress ?>">
                  <input title="" type="hidden" name="paymentMethod" value="<?= $paymentMethod ?>">
                  <input title="" type="hidden" name="rideDuration" value="<?= $rideDuration ?>">	
                  <input title="" type="hidden" name="bookingFee" value="<?= $bookingFee ?>">
                  <input title="" type="hidden" name="driverFare" value="<?= $driverFare ?>">
                  <input title="" type="hidden" name="totalFare" value="<?= $totalFare ?>">	
                  <input title="" type="hidden" name="returnDuration" value="<?= $returnDuration ?>">
                  <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">	
                  <input title="" type="hidden" name="tourDuration" value="<?= $tourDuration ?>">	
                  <input title="" type="hidden" name="pickup1" value="<?= $pickup1 ?>">	
                  <input title="" type="hidden" name="pickup2" value="<?= $pickup2 ?>">
                  <input title="" type="hidden" name="return1" value="<?= $return1 ?>">	
                  <input title="" type="hidden" name="return2" value="<?= $return2 ?>">		
                  <input title="" type="hidden" name="toursuresi" value="<?= $toursuresi ?>">		
                  <input title="" type="hidden" name="hourlyOperationFare" value="<?= $hourlyOperationFare ?>">						  
				  
				  
                 <center> <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
      </form>
      </div>
      </div>
      </div>
      </form>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	  


    <script>
        function showError(message) {
            var errorMessage = document.getElementById('error-message');
            var errorText = document.getElementById('error-text');
            errorText.innerHTML = message;
            errorMessage.style.display = 'block';
            errorMessage.classList.add('show');
            errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function checkTimeValidity() {
            var now = new Date();
            var utcHour = now.getUTCHours();
            var nyHour = utcHour - 4; // New York Time (EST) is UTC-4

            if (nyHour < 0) nyHour += 24;

            if (nyHour < 10 || nyHour > 18) {
                showError("<b>Please, do not use this application to book a tour between 6:01 pm and 9:59 am.</b>");
                return false;
            }
            return true;
        }

        document.getElementById("myform").addEventListener("submit", function(event) {
            if (!checkTimeValidity()) {
                event.preventDefault();
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
                     strokeOpacity: 0,      // Line opacity
                     strokeWeight: 6          // Line thickness
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
        pickup1: <?php echo json_encode($_POST["pickup1"] ?? ""); ?>,
        pickup2: <?php echo json_encode($_POST["pickup2"] ?? ""); ?>,
        return1: <?php echo json_encode($_POST["return1"] ?? ""); ?>,
        return2: <?php echo json_encode($_POST["return2"] ?? ""); ?>,
        toursuresi: <?php echo json_encode($_POST["toursuresi"] ?? ""); ?>,
        rideDuration: <?php echo json_encode($_POST["rideDuration"] ?? ""); ?>,
        tourDuration: <?php echo json_encode($_POST["tourDuration"] ?? ""); ?>,
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
