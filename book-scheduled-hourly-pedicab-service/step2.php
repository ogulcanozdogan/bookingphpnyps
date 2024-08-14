<?php
include('inc/init.php');
if ($_POST) {
    // Information received from the form
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

  $pickUpDate = date("m/d/Y", strtotime($pickUpDate)); // we use it to change the calendar

$hours12 = $hours;

// Convert the hour information to 24-hour format considering the AM/PM format
$hours =
    $ampm === "PM" && $hours != 12
        ? $hours + 12
        : ($ampm === "AM" && $hours == 12
            ? 0
            : $hours);

// Process the date and time information
$pickupDateTime = DateTime::createFromFormat(
    "m/d/Y H:i",
    $pickUpDate . " " . $hours . ":" . $minutes
);
if (!$pickupDateTime) {
    die("Invalid date format. Please check the date and time information.");
}
$dayOfWeek = $pickupDateTime->format("l");
$month = $pickupDateTime->format("F");
$hour24 = (int) $pickupDateTime->format("G"); // 24-hour format

// HUB selection
if ($hour24 >= 9 && $hour24 < 16) {
    $hub = "West Drive and West 59th Street New York, NY 10019";
	$hubCoords = '40.766941088678855, -73.97899952992152';
} elseif ($hour24 >= 16 && $hour24 < 19) {
    $hub = "6th Avenue and West 48th Street New York, NY 10020";
	$hubCoords = '6th Avenue and West 48th Street New York, NY 10020';	
} else {
    $hub = "7th Avenue and West 48th Street New York, NY 10036";
	$hubCoords = '7th Avenue and West 48th Street New York, NY 10036';		
}

// Base Fare calculation
$isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
$baseFare = $isWeekend ? 35 : 30;
if ($month == "December") {
    $baseFare += 10;
}

function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo"; // Enter your API key here
    $origin = urlencode($origin);
    $destination = urlencode($destination);

    // Adding the bicycle mode parameter
    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origin&destination=$destination&mode=bicycling&key=$apiKey";

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
            foreach ($data["routes"] as $route) {
                $routeDuration = 0;
                foreach ($route["legs"] as $leg) {
                    $routeDuration += $leg["duration"]["value"];
                }
                if ($routeDuration < $shortestDuration) {
                    $shortestDuration = $routeDuration;
                }
            }

            // Calculate the shortest duration in minutes
            if ($shortestDuration !== PHP_INT_MAX) {
                $minutes = floor($shortestDuration / 60);
                $seconds = $shortestDuration % 60;
                return sprintf("%.2f", $minutes + $seconds / 60); // Return the duration in a format like "24.11"
            }
        }
    }

    return false; // Return false if no suitable route is found
}

$origin = $hubCoords;
$destination = $deneme2;
$pickupsuresi = getShortestBicycleRouteDuration($origin, $destination);

$origin = $deneme2;
$destination = $destinationAddress;
$ridesuresi = getShortestBicycleRouteDuration($origin, $destination);

$origin = $destinationAddress;
$destination = $hubCoords;
$returnsuresi = getShortestBicycleRouteDuration($origin, $destination);

$pickUpDuration = $pickupsuresi * 2.5;
$rideDuration = $ridesuresi;
$returnDuration = $returnsuresi * 2.5;

function calculateOperationFarePerHour($dayOfWeek, $month)
{
    $isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
    if ($month == "December") {
        return $isWeekend ? 45 : 40;
    } else {
        return $isWeekend ? 35 : 30;
    }
}

if ($serviceDuration != 30 && $serviceDuration != 90) {
    $timeCheck = $serviceDuration * 60;
} else {
    $timeCheck = $serviceDuration;
}

$totalDurationMinutes = $pickUpDuration + $returnDuration + $timeCheck;

$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month);

$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;

// Update the rest of the code accordingly...
$baseFareOperationRate = $baseFare + $operationFare;

if ($totalDurationMinutes <= 120) {
    $bookingFee = 0.2 * $baseFareOperationRate;
    $driverFare = 0.8 * $baseFareOperationRate;
} elseif ($totalDurationMinutes <= 300) {
    $bookingFee = 0.3 * $baseFareOperationRate;
    $driverFare = 0.7 * $baseFareOperationRate;
} else {
    $bookingFee = 0.4 * $baseFareOperationRate;
    $driverFare = 0.6 * $baseFareOperationRate;
}

if ($paymentMethod === "card") {
    $driverFare *= 1.1;
}

$minFares = [
    "CASH" => [
        "week" => ["Booking Fee" => 9, "Driver Fare" => 36, "Total Fare" => 45],
        "weekend" => [
            "Booking Fee" => 10.5,
            "Driver Fare" => 42,
            "Total Fare" => 52.5,
        ],
        "weekDecember" => [
            "Booking Fee" => 12,
            "Driver Fare" => 48,
            "Total Fare" => 60,
        ],
        "weekendDecember" => [
            "Booking Fee" => 13.5,
            "Driver Fare" => 54,
            "Total Fare" => 67.5,
        ],
    ],
    "card" => [
        "week" => [
            "Booking Fee" => 9,
            "Driver Fare" => 39.6,
            "Total Fare" => 48.6,
        ],
        "weekend" => [
            "Booking Fee" => 10.5,
            "Driver Fare" => 46.2,
            "Total Fare" => 56.7,
        ],
        "weekDecember" => [
            "Booking Fee" => 12,
            "Driver Fare" => 52.8,
            "Total Fare" => 64.8,
        ],
        "weekendDecember" => [
            "Booking Fee" => 13.5,
            "Driver Fare" => 59.4,
            "Total Fare" => 72.9,
        ],
    ],
];

$key =
    ($isWeekend ? "weekend" : "week") .
    ($month == "December" ? "December" : "");
$minBookingFee = $minFares[$paymentMethod][$key]["Booking Fee"];
$minDriverFare = $minFares[$paymentMethod][$key]["Driver Fare"];
$minTotalFare = $minFares[$paymentMethod][$key]["Total Fare"];

$bookingFee = max($bookingFee, $minBookingFee);
$driverFare = max($driverFare, $minDriverFare);

if ($paymentMethod === "fullcard") {
    $bookingFee *= 1.2;
    $driverFare *= 1.2;
}
$totalFare = max($bookingFee + $driverFare, $minTotalFare);

require "inc/countryselect.php";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
 </head>
   <body>
      <form method="post" id="myform" action="step3.php">
	    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
        <input <?php if (!$_GET) {
            echo "disabled";
        } ?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
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
					<!--	<tr>
						<th scope="row">Debug Area</th>
						<td>Pickup Duration: <?=$pickUpDuration?></td>
						<td>Return Duration: <?=$returnDuration?></td>
						<td>Service Duration: <?=$timeCheck?></td>
						<td>Hub: <?=$hub?></td>
						</tr> -->
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?= $numPassengers ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Date of Service</th>
                           <td><?= $pickUpDate ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Service</th>
                           <td><?php echo $hours12 .
                               ":" .
                               $minutes .
                               " " .
                               $ampm; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Service</th>
                           <td><?php if (
                               $serviceDuration == 30 or
                               $serviceDuration == 90
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
							<?php if ($paymentMethod != "fullcard") { ?>
                             <tr>
                                <th scope="row">Booking Fee</th>
                                <td>$<?= number_format($bookingFee, 2) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Driver Fare</th>
                                 <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                            </tr>
							<?php } ?>
                            <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format(
                               $totalFare,
                               2
                           ); if ($paymentMethod == 'fullcard') { echo ' with debit/credit card'; }?></b></td>
                        </tr>
                     </tbody>
                  </table>
				  
				  	  
    <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Passenger Details</h2>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input maxlength="50" title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
        <?php if (isset($_POST["firstName"]) && !empty($_POST["firstName"])) { ?>
            value="<?php echo htmlspecialchars($_POST["firstName"]); ?>"
        <?php } ?> 
        required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="lastName">Last Name</label>
    <input maxlength="50" title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
        <?php if (isset($_POST["lastName"]) && !empty($_POST["lastName"])) { ?>
            value="<?php echo htmlspecialchars($_POST["lastName"]); ?>"
        <?php } ?> 
        required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="email">Email Address</label>
    <input maxlength="50" title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
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
        <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
               onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" value="<?= htmlspecialchars($_POST['phoneNumber'] ?? '') ?>" placeholder="Enter your phone number" required>
    </div>
</div>

    <input title="" type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
    <input title="" type="hidden" name="pickUpDate" value="<?= $pickUpDate ?>">
    <input title="" type="hidden" name="hours" value="<?= $hours12 ?>">
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
	
	<center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
</form>
               </div>
            </div>
         </div>
      </form>

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
                strokeOpacity: 0,      // Line opacity
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
    // Get POST data
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

    // convert to 12 hour format
    var hours12 = hours24 % 12 || 12; // Clock in 12 hour format

    // Create a form and send it with POST
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "index.php";

    // Add form fields
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
