<?php
if ($_POST) {
    // Information received from the form
    $firstName = $_POST["firstName"]; // default value 1
    $lastName = $_POST["lastName"]; // default value 1
    $email = $_POST["email"]; // default value 1
    $phoneNumber = $_POST["phoneNumber"]; // default value 1
    $phoneNumber = substr($phoneNumber, -10);
    $numPassengers = $_POST["numPassengers"] ?? 1; // default value 1
    $deneme2 = $_POST["pickUpAddress"];
    $destinationAddress = $_POST["destinationAddress"];
    $paymentMethod = $_POST["paymentMethod"];
    $rideDuration = $_POST["min"];
    $rideDuration *= 2.5;
    $bookingFee = $_POST["bookingFee"];
    $driverFare = $_POST["driverFare"];
    $totalFare = $_POST["totalFare"];
    $returnDuration = $_POST["returnDuration"];
    $pickUpDuration = $_POST["pickUpDuration"];
    $hub = $_POST["hub"];
    $baseFare = $_POST["baseFare"];
    $operationFare = $_POST["operationFare"];
    $countryCode = $_POST["countryCode"];
} elseif ($_GET) {
    // Information received from the form
    $firstName = $_GET["firstName"]; // default value 1
    $lastName = $_GET["lastName"]; // default value 1
    $email = $_GET["email"]; // default value 1
    $phoneNumber = $_GET["phoneNumber"]; // default value 1
    $phoneNumber = substr($phoneNumber, -10);
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
    $baseFare = $_GET["baseFare"];
    $operationFare = $_GET["operationFare"];
    $countryCode = $_GET["countryCode"];
} else {
    header("location: index.php");
		exit;
}


    $hub = "West Drive and West 59th Street New York, NY 10019";


// Base Fare calculation
$isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
$baseFare = $isWeekend ? 35 : 30;
if ($month == "December") {
    $baseFare += 10;
}

function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY"; // Enter your API key here
    $origin = urlencode($origin);
    $destination = urlencode($destination);

    // Adding bicycle mode parameter
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
                return sprintf("%.2f", $minutes + $seconds / 60); // Return the duration in "24.11" format
            }
        }
    }

    return false; // Return false if no suitable route is found
}

// Pick Up duration
$origin = $hub;
$destination = $deneme2;
$pickupsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Ride duration
$origin = $deneme2;
$destination = $destinationAddress;
$ridesuresi = getShortestBicycleRouteDuration($origin, $destination);

// Return duration
$origin = $destinationAddress;
$destination = $hub;
$returnsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Example of using fixed durations (in minutes)
$pickUpDuration = $pickupsuresi; // Pick Up duration
$returnDuration = $returnsuresi; // Return duration

$pickUpDuration *= 2.5;
$returnDuration *= 2.5;

$rideDuration = substr($rideDuration, 0, 5);

function calculateOperationFarePerHour($dayOfWeek, $month)
{
    $isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
    if ($month == "December") {
        return $isWeekend ? 45 : 40; // Different fare for weekends and weekdays in December
    } else {
        return $isWeekend ? 35 : 30; // Different fare for normal weekends and weekdays
    }
}

// Total duration (in minutes)
$totalDurationMinutes = $pickUpDuration + $rideDuration + $returnDuration;

// Hourly fare calculation
$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month);

// Total Operation Fare calculation (by converting minutes to hours and multiplying by hourly fare)
$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;

// Update the rest of the code accordingly...

// Booking Fee and Driver Fare calculation
if ($paymentMethod == "card" or $paymentMethod == "cash") {
    $bookingFee = 0.2 * ($baseFare + $operationFare);
    $driverFare = 0.8 * ($baseFare + $operationFare);
    if ($paymentMethod === "card") {
        $driverFare *= 1.1;
    }
} else {
    $bookingFee = 0.3 * $totalFare;
    $driverFare = 0.7 * $totalFare;
}

$minFares = [
    "cash" => [
        "week" => ["Booking Fee" => 3.75, "Driver Fare" => 15, "Total Fare" => 18.75],
        "weekend" => [
            "Booking Fee" => 4.5,
            "Driver Fare" => 18,
            "Total Fare" => 22.5,
        ],
        "weekDecember" => [
            "Booking Fee" => 5,
            "Driver Fare" => 20,
            "Total Fare" => 25,
        ],
        "weekendDecember" => [
            "Booking Fee" => 6,
            "Driver Fare" => 24,
            "Total Fare" => 30,
        ],
    ],
    "card" => [
        "week" => [
            "Booking Fee" => 3.75,
            "Driver Fare" => 16.5,
            "Total Fare" => 20.25,
        ],
        "weekend" => [
            "Booking Fee" => 4.5,
            "Driver Fare" => 19.8,
            "Total Fare" => 24.3,
        ],
        "weekDecember" => [
            "Booking Fee" => 5,
            "Driver Fare" => 22,
            "Total Fare" => 27,
        ],
        "weekendDecember" => [
            "Booking Fee" => 6,
            "Driver Fare" => 26.4,
            "Total Fare" => 32.4,
        ],
    ],
    "fullcard" => [
        "week" => [
            "Booking Fee" => 3.75,
            "Driver Fare" => 16.5,
            "Total Fare" => 20.25,
        ],
        "weekend" => [
            "Booking Fee" => 4.5,
            "Driver Fare" => 19.8,
            "Total Fare" => 24.3,
        ],
        "weekDecember" => [
            "Booking Fee" => 5,
            "Driver Fare" => 22,
            "Total Fare" => 27,
        ],
        "weekendDecember" => [
            "Booking Fee" => 6,
            "Driver Fare" => 26.4,
            "Total Fare" => 32.4,
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
if ($paymentMethod == "card" or $paymentMethod == "cash") {
    $totalFare = max($bookingFee + $driverFare, $minTotalFare);
} else {
    $totalFare = ($baseFare + $operationFare) * 1.2;
    $totalFare = max($totalFare, $minTotalFare);
}
require "inc/countryselect.php";
$rideDuration = number_format($rideDuration, 2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
                     <b>On Demand<br>Point A to B Pedicab Ride<br>Booking Application</b>
                  </div>
                    <div id="map" style="margin-top:30px;"></div>
                    <table class="table">
                        <tbody>
                            <tr>
                            <th scope="row">Number of Passengers</th>
                                <td><?= $numPassengers ?></td>
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
                        <input title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
                        <?php if (
                            isset($_GET["firstName"]) &&
                            !empty($_GET["firstName"])
                        ) { ?>
                            value="<?php echo htmlspecialchars(
                                $_GET["firstName"]
                            ); ?>"
                        <?php } elseif (
                            isset($_POST["firstName"]) &&
                            !empty($_POST["firstName"])
                        ) { ?>
                            value="<?php echo htmlspecialchars(
                                $_POST["firstName"]
                            ); ?>"
                        <?php } ?> 
                        required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
                        <?php if (
                            isset($_GET["lastName"]) &&
                            !empty($_GET["lastName"])
                        ) { ?>
                            value="<?php echo htmlspecialchars(
                                $_GET["lastName"]
                            ); ?>"
                        <?php } elseif (
                            isset($_POST["lastName"]) &&
                            !empty($_POST["lastName"])
                        ) { ?>
                            value="<?php echo htmlspecialchars(
                                $_POST["lastName"]
                            ); ?>"
                        <?php } ?> 
                        required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
                        <?php if (
                            isset($_GET["email"]) &&
                            !empty($_GET["email"])
                        ) { ?>
                            value="<?php echo htmlspecialchars(
                                $_GET["email"]
                            ); ?>"
                        <?php } elseif (
                            isset($_POST["email"]) &&
                            !empty($_POST["email"])
                        ) { ?>
                            value="<?php echo htmlspecialchars(
                                $_POST["email"]
                            ); ?>"
                        <?php } ?> 
                        required oninvalid="this.setCustomValidity('Please, enter email adress.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                    </div>
                    <label for="countrySelect">Phone</label>
        <div style="  display: flex;
            " class="form-group">
           
<?= countrySelector() ?>

            <input title="" style="flex: 2; margin-left: 10px;" type="tel"  pattern=".{10,10}" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
                   onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter a 10 digit phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" value="<?= $phoneNumber ?>" placeholder="Enter your phone number" required >
        </div>
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
					<input title="" type="hidden" name="dayOfWeek" value="<?= $dayOfWeek ?>">	
					
                    <center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
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

            // Use GET parameters if available
            var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode(
                $_GET["numPassengers"] ?? ($_POST["numPassengers"] ?? 1)
            ); ?>;
            var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode(
                $_GET["pickUpAddress"] ?? ($_POST["pickUpAddress"] ?? "")
            ); ?>;
            var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode(
                $_GET["destinationAddress"] ??
                    ($_POST["destinationAddress"] ?? "")
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
            var baseFare = urlParams.has('baseFare') ? urlParams.get('baseFare') : <?php echo json_encode(
                $_GET["baseFare"] ?? ($_POST["baseFare"] ?? "")
            ); ?>;
            var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode(
                $_GET["operationFare"] ?? ($_POST["operationFare"] ?? "")
            ); ?>;		
            var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode(
                $_GET["rideDuration"] ?? ($_POST["rideDuration"] ?? "")
            ); ?>;		
            var dayOfWeek = urlParams.has('dayOfWeek') ? urlParams.get('dayOfWeek') : <?php echo json_encode(
                $_GET["dayOfWeek"] ?? ($_POST["dayOfWeek"] ?? "")
            ); ?>;		
			
            // Now you can perform the necessary operations
            // ...

            // Then, after completing your operations, you can redirect
            var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
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
                              "&rideDuration=" + encodeURIComponent(rideDuration) +
							  "&dayOfWeek=" + encodeURIComponent(dayOfWeek);

            window.location.href = "index.php?" + queryString;
        });
    </script>
</body>
</html>
