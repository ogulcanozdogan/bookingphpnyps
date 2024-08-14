<?php
include('inc/init.php');
include('inc/db.php');
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
    $operationFare = $_POST["operationFare"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
} else {
    header("location: index.php");
		exit;
}


$hub = "West Drive and West 59th Street New York, NY 10019";
$hubCoords = '40.766941088678855, -73.97899952992152';

function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo"; // Enter your API key here
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
$origin = $hubCoords;
$destination = $deneme2;
$pickupsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Ride duration
$origin = $deneme2;
$destination = $destinationAddress;
$ridesuresi = getShortestBicycleRouteDuration($origin, $destination);

// Return duration
$origin = $destinationAddress;
$destination = $hubCoords;
$returnsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Example of using fixed durations (in minutes)
$pickUpDuration = $pickupsuresi; // Pick Up duration
$returnDuration = $returnsuresi; // Return duration
$rideDuration = $ridesuresi;

$pickUpDuration *= 2.5;
$returnDuration *= 2.5;
$rideDuration *= 2.5;

$rideDuration = substr($rideDuration, 0, 5);

$sorgu2 = $baglanti->prepare("SELECT * FROM rates WHERE ratename = 'Point A to B'");
$sorgu2->execute();
$rate = $sorgu2->fetch(PDO::FETCH_ASSOC);

function calculateOperationFarePerHour($dayOfWeek, $month, $rate)
{
    $isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
    if ($month == "December") {
        return $isWeekend ? $rate['hourlyOperationFareWeekendsDecember'] : $rate['hourlyOperationFareDecember']; // Different fare for weekends and weekdays in December
    } else {
        return $isWeekend ? $rate['hourlyOperationFareWeekends'] : $rate['hourlyOperationFare']; // Different fare for normal weekends and weekdays
    }
}

// Total duration (in minutes)
$totalDurationMinutes = $pickUpDuration + $rideDuration + $returnDuration;

// Hourly fare calculation
$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month, $rate);

// Total Operation Fare calculation (by converting minutes to hours and multiplying by hourly fare)
$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;

// Booking Fee and Driver Fare calculation
$minFares = [
    "CASH" => [
        "week" => $rate['minFareCashWeek'],
        "weekend" => $rate['minFareCashWeekend'],
        "weekDecember" => $rate['minFareCashWeekDecember'],
        "weekendDecember" => $rate['minFareCashWeekendDecember'],
    ],
    "CARD" => [
        "week" => $rate['minFareCardWeek'],
        "weekend" => $rate['minFareCardWeekend'],
        "weekDecember" => $rate['minFareCardWeekDecember'],
        "weekendDecember" => $rate['minFareCardWeekendDecember'],
    ],
];

function calculateBookingAndDriverFares($paymentMethod, $totalFare) {
    if ($paymentMethod === "CASH") {
        $bookingFee = $totalFare * 0.20;
        $driverFare = $totalFare * 0.80;
    } elseif ($paymentMethod === "CARD") {
        $bookingFee = $totalFare * 0.1852;
        $driverFare = $totalFare * 0.8148;
    } else {
        $bookingFee = 0;
        $driverFare = 0;
    }

    return [
        "Booking Fee" => round($bookingFee, 2),
        "Driver Fare" => round($driverFare, 2),
        "Total Fare" => $totalFare
    ];
}


$key = ($isWeekend ? "weekend" : "week") . ($month == "December" ? "December" : "");
$minTotalFare = $minFares[$paymentMethod][$key];

if ($paymentMethod === "CARD" || $paymentMethod === "CASH") {
    $bookingFee = 0.2 * $operationFare;
    $driverFare = 0.8 * $operationFare;

    if ($paymentMethod === "CARD") {
        $driverFare *= 1.1;
    }

    // Total fare calculation
    $totalFare = $bookingFee + $driverFare;

    // Check if total fare is below minimum fare
    if ($totalFare < $minTotalFare) {
        // If so, calculate fares based on the minimum fare
        $fares = calculateBookingAndDriverFares($paymentMethod, $minTotalFare);
        $bookingFee = $fares["Booking Fee"];
        $driverFare = $fares["Driver Fare"];
        $totalFare = $fares["Total Fare"];
    }

} else {
    // Other payment methods
    $totalFare = $operationFare * 1.2;
    $totalFare = max($totalFare, $minTotalFare);
}

require "inc/countryselect.php";
$rideDuration = number_format($rideDuration, 2);
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
				  <div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text"></span>
                  </div>
                    <div id="map" style="margin-top:30px;"></div>
                    <table class="table">
                        <tbody>
						<!-- <tr>
						<th scope="row">Debug Area</th>
						<td>Pickup Duration: <?=$pickUpDuration?></td>
						<td>Ride Duration: <?=$rideDuration?></td>
						<td>Return Duration: <?=$returnDuration?></td>
						<td>Hub: <?=$hub?></td>
						</tr> -->
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
                                 <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'CARD' ? 'debit/credit card' : $paymentMethod ?></td>
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
    <input maxlength="50" title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
        <?php if (isset($_POST["firstName"]) && !empty($_POST["firstName"])) { ?>
            value="<?php echo htmlspecialchars($_POST["firstName"]); ?>"
        <?php } ?> 
       maxlength="20" required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>

<div class="form-group">
    <label for="lastName">Last Name</label>
    <input maxlength="50" title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
        <?php if (isset($_POST["lastName"]) && !empty($_POST["lastName"])) { ?>
            value="<?php echo htmlspecialchars($_POST["lastName"]); ?>"
        <?php } ?> 
       maxlength="20" required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" 
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

<label for="countrySelect">Phone</label>
<div style="display: flex;" class="form-group">
    <?= countrySelector() ?>
    <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
           onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter phone number.'); this.classList.add('invalid');" 
           oninput="this.value = this.value.replace(/\D+/g, ''); setCustomValidity(''); this.classList.remove('invalid');" 
           value="<?php echo htmlspecialchars($_POST['phoneNumber'] ?? ''); ?>" placeholder="Enter your phone number" required>
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
                    <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">	
					<input title="" type="hidden" name="dayOfWeek" value="<?= $dayOfWeek ?>">
					<input title="" type="hidden" name="hourlyOperationFare" value="<?= $operationFarePerHour ?>">						
					
                    <center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
                </div>
            </div>
        </div>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput-jquery.min.js"></script>
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
        suppressMarkers: true,  // Remove default pointers
        polylineOptions: {
            strokeColor: '#FF0000',  // Make the line color red
            strokeOpacity: 0.8,      // Opacity of the line
            strokeWeight: 6          // Line thickness
        }
    });

    var pickupAddress = <?php echo json_encode($deneme2); ?>;
    var destinationAddress = <?php echo json_encode($destinationAddress); ?>;

    var geocoder = new google.maps.Geocoder();
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&callback=initMap"></script>  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        // This function sends the calculated duration to the PHP file
    </script>
<script>
document.getElementById("prevButton").addEventListener("click", function() {
    // Use POST data
    var numPassengers = <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>;
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


    var form = document.createElement("form");
    form.method = "POST";
    form.action = "index.php";

    // Append form fields
    form.appendChild(createHiddenInput("numPassengers", numPassengers));
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
