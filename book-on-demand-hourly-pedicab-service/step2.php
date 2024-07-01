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
} elseif ($_GET) {
    // Information received from the form
    $firstName = $_GET["firstName"]; // default value 1
    $lastName = $_GET["lastName"]; // default value 1
    $email = $_GET["email"]; // default value 1
    $phoneNumber = $_GET["phoneNumber"]; // default value 1
    $phoneNumber = substr($phoneNumber, -10);
    $numPassengers = $_GET["numPassengers"] ?? 1; // default value 1
    $deneme2 = $_GET["pickUpAddress"]; // This was previously using POST instead of GET
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
    $serviceDetails = $_GET["serviceDetails"];
    $serviceDuration = $_GET["serviceDuration"];
    $countryCode = $_GET["countryCode"];
    $countryName = $_GET["countryName"];
} else {
    header("location: index.php");
		exit;
}


$hub = "West Drive and West 59th Street New York, NY 10019";

function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY"; // Enter your API key here
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

// Pick Up süresi
$origin = $hub;
$destination = $deneme2;
$pickupsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Ride süresi
$origin = $deneme2;
$destination = $destinationAddress;
$ridesuresi = getShortestBicycleRouteDuration($origin, $destination);

// Return süresi
$origin = $destinationAddress;
$destination = $hub;
$returnsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Örnek olarak sabit süreler kullanalım (dakika cinsinden)
$pickUpDuration = $pickupsuresi; // Pick Up süresi
$rideDuration = $ridesuresi; // Ride süresi
$returnDuration = $returnsuresi; // Return süresi

$pickUpDuration *= 2.5;
$returnDuration *= 2.5;

// Tarihi 'm/d/Y' formatından 'Y-m-d' formatına çevirme
$convertedDate = date("Y-m-d");

// Yeni tarihi kullanarak gün adını bulma
$dayName = date("l", strtotime($convertedDate));

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

// Service duration conversion
if ($serviceDuration == 30 || $serviceDuration == 90) {
    $timeCheck = $serviceDuration; // minutes
} else {
    $timeCheck = $serviceDuration * 60; // hours to minutes
}

// Toplam dakika cinsinden operasyon süresi
$totalMinutes = $pickUpDuration + $rideDuration + $returnDuration + $timeCheck;

// Dakikayı saate dönüştürme
$totalHours = $totalMinutes / 60;

// Günün saatlik operasyon ücreti ile çarpma
$operationFare = $totalHours * $hourlyOperationFare;

// Calculate Booking Fee
$bookingFee = 0.2 * $operationFare;

// Calculate Driver Fare with CASH
if ($paymentMethod == "cash") {
    $driverFare = 0.8 * $operationFare;
}

// Calculate Driver Fare with CARD
if ($paymentMethod == "card") {
    $driverFare = 0.8 * $operationFare;
    $driverFare = 1.1 * $driverFare;
}

// Calculate Total Fare
$totalFare = $bookingFee + $driverFare;

require "inc/countryselect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <title>Book On Demand Hourly Pedicab Service</title>
    <meta name="description" content="On Demand Central Park Pedicab Tour Booking Application">
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
            <input <?php if (!$_GET) { echo "disabled"; } ?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>On Demand<br>Hourly Pedicab Service<br>Booking Application</b>
                  </div>
                    <div id="map" style="margin-top:30px;"></div>
                    <table class="table">
                        <tbody>
						<tr>
						<th scope="row">Debug Area</th>
						<td>Pickup Duration: <?=$pickUpDuration?></td>
						<td>Return Duration: <?=$returnDuration?></td>
						<td>Service Duration: <?=$timeCheck?></td>
						<td>Hub: <?=$hub?></td>
						</tr>
                            <tr>
                                <th scope="row">Number of Passengers</th>
                                <td><?= $numPassengers ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Duration of Service</th>
                                <td><?php if ($serviceDuration == 30 || $serviceDuration == 90) {
                                    echo $serviceDuration . " Minutes";
                                } else {
                                    echo $serviceDuration . " Hour";
                                } ?></td>
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
                                <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                            </tr>
                            <tr style="background-color:green;">
                                <th scope="row" style="color:white;">Total Fare</th>
                                <td><b style="color:white;">$<?= number_format($totalFare, 2); ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                    <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Passenger Details</h2>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <input title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
                        <?php if (isset($_GET["firstName"]) && !empty($_GET["firstName"])) { ?>
                            value="<?php echo htmlspecialchars($_GET["firstName"]); ?>"
                        <?php } elseif (isset($_POST["firstName"]) && !empty($_POST["firstName"])) { ?>
                            value="<?php echo htmlspecialchars($_POST["firstName"]); ?>"
                        <?php } ?> 
                        required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <input title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
                        <?php if (isset($_GET["lastName"]) && !empty($_GET["lastName"])) { ?>
                            value="<?php echo htmlspecialchars($_GET["lastName"]); ?>"
                        <?php } elseif (isset($_POST["lastName"]) && !empty($_POST["lastName"])) { ?>
                            value="<?php echo htmlspecialchars($_POST["lastName"]); ?>"
                        <?php } ?> 
                        required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
<input title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
    <?php if (isset($_GET['email']) && !empty($_GET['email'])) { ?>
        value="<?php echo htmlspecialchars($_GET['email']); ?>"
    <?php } elseif (isset($_POST['email']) && !empty($_POST['email'])) { ?>
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
                        <input title="" style="flex: 2; margin-left: 10px;" type="tel" pattern=".{10,10}" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
                               onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter a 10 digit phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" value="<?= $phoneNumber ?>" placeholder="Enter your phone number" required>
                    </div>
                    <input title="" type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
                    <input title="" type="hidden" name="pickUpAddress" value="<?= $deneme2 ?>">
                    <input title="" type="hidden" name="destinationAddress" value="<?= $destinationAddress ?>">
                    <input title="" type="hidden" name="paymentMethod" value="<?= $paymentMethod ?>">
                    <input title="" type="hidden" name="rideDuration" value="<?= $rideDuration ?>">
                    <input title="" type="hidden" name="bookingFee" value="<?= number_format($bookingFee, 2) ?>">
                    <input title="" type="hidden" name="driverFare" value="<?= number_format($driverFare, 2) ?>">
                    <input title="" type="hidden" name="totalFare" value="<?= number_format($totalFare, 2) ?>">
                    <input title="" type="hidden" name="returnDuration" value="<?= $returnDuration ?>">
                    <input title="" type="hidden" name="pickUpDuration" value="<?= $pickUpDuration ?>">
                    <input title="" type="hidden" name="hub" value="<?= $hub ?>">
                    <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">
                    <input title="" type="hidden" name="serviceDetails" value="<?= $serviceDetails ?>">
                    <input title="" type="hidden" name="serviceDuration" value="<?= $serviceDuration ?>">
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
                    strokeColor: '#FF0000',  // Set line color to red
                    strokeOpacity: 1,      // Line opacity
                    strokeWeight: 6          // Line thickness
                }
            });

            var geocoder = new google.maps.Geocoder();
            var pickupAddress = <?php echo json_encode($deneme2); ?>;
            var destinationAddress = <?php echo json_encode($destinationAddress); ?>;

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
        document.getElementById("prevButton").addEventListener("click", function() {
            // Get the parameters from the URL
            var urlParams = new URLSearchParams(window.location.search);

            // If there are GET parameters, use them
            var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode($_GET["numPassengers"] ?? ($_POST["numPassengers"] ?? 1)); ?>;
            var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode($_GET["pickUpAddress"] ?? ($_POST["pickUpAddress"] ?? "")); ?>;
            var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode($_GET["destinationAddress"] ?? ($_POST["destinationAddress"] ?? "")); ?>;
            var paymentMethod = urlParams.has('paymentMethod') ? urlParams.get('paymentMethod') : <?php echo json_encode($_GET["paymentMethod"] ?? ($_POST["paymentMethod"] ?? "")); ?>;
            var firstName = urlParams.has('firstName') ? urlParams.get('firstName') : <?php echo json_encode($_GET["firstName"] ?? ($_POST["firstName"] ?? "")); ?>;
            var lastName = urlParams.has('lastName') ? urlParams.get('lastName') : <?php echo json_encode($_GET["lastName"] ?? ($_POST["lastName"] ?? "")); ?>;
            var email = urlParams.has('email') ? urlParams.get('email') : <?php echo json_encode($_GET["email"] ?? ($_POST["email"] ?? "")); ?>;
            var phoneNumber = urlParams.has('phoneNumber') ? urlParams.get('phoneNumber') : <?php echo json_encode($_GET["phoneNumber"] ?? ($_POST["phoneNumber"] ?? "")); ?>;
            var countryCode = urlParams.has('countryCode') ? urlParams.get('countryCode') : <?php echo json_encode($_GET["countryCode"] ?? ($_POST["countryCode"] ?? "")); ?>;
			 var countryName = urlParams.has('countryName') ? urlParams.get('countryName') : <?php echo json_encode(
			$_GET["countryName"] ?? ($_POST["countryName"] ?? "")
			); ?>;
            var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode($_GET["bookingFee"] ?? ($_POST["bookingFee"] ?? "")); ?>;
            var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode($_GET["driverFare"] ?? ($_POST["driverFare"] ?? "")); ?>;
            var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode($_GET["totalFare"] ?? ($_POST["totalFare"] ?? "")); ?>;    
            var returnDuration = urlParams.has('returnDuration') ? urlParams.get('returnDuration') : <?php echo json_encode($_GET["returnDuration"] ?? ($_POST["returnDuration"] ?? "")); ?>;
            var pickUpDuration = urlParams.has('pickUpDuration') ? urlParams.get('pickUpDuration') : <?php echo json_encode($_GET["pickUpDuration"] ?? ($_POST["pickUpDuration"] ?? "")); ?>;
            var hub = urlParams.has('hub') ? urlParams.get('hub') : <?php echo json_encode($_GET["hub"] ?? ($_POST["hub"] ?? "")); ?>;
            var baseFare = urlParams.has('baseFare') ? urlParams.get('baseFare') : <?php echo json_encode($_GET["baseFare"] ?? ($_POST["baseFare"] ?? "")); ?>;
            var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode($_GET["operationFare"] ?? ($_POST["operationFare"] ?? "")); ?>;        
            var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode($_GET["rideDuration"] ?? ($_POST["rideDuration"] ?? "")); ?>;        
            var serviceDetails = urlParams.has('serviceDetails') ? urlParams.get('serviceDetails') : <?php echo json_encode($_GET["serviceDetails"] ?? ($_POST["serviceDetails"] ?? "")); ?>;    
            var serviceDuration = urlParams.has('serviceDuration') ? urlParams.get('serviceDuration') : <?php echo json_encode($_GET["serviceDuration"] ?? ($_POST["serviceDuration"] ?? "")); ?>;        

            // Now you can perform the necessary operations
            // ...

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
                              "&serviceDetails=" + encodeURIComponent(serviceDetails) +
                              "&serviceDuration=" + encodeURIComponent(serviceDuration) +
                              "&rideDuration=" + encodeURIComponent(rideDuration);

            window.location.href = "index.php?" + queryString;
        });
    </script>
</body>
</html>