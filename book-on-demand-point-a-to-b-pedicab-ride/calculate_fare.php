<?php
header('Content-Type: application/json');

// Functions
function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo"; // Replace with your API key
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
                return floatval(sprintf("%.2f", $minutes + $seconds / 60)); // Return the duration in float
            }
        }
    }

    return false; // Return false if no suitable route is found
}

// Function to calculate operation fare per hour
function calculateOperationFarePerHour($dayOfWeek, $month)
{
    $isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
    if ($month == "December") {
        return $isWeekend ? 60 : 52.5; // Different fare for weekends and weekdays in December
    } else {
        return $isWeekend ? 45 : 37.5; // Different fare for normal weekends and weekdays
    }
}

// Get input data
$input = json_decode(file_get_contents('php://input'), true);
$originLocation = $input['origin'];
$destinationLocation = $input['destination'];
$paymentMethod = $input['paymentMethod'];

// Set the timezone to New York
date_default_timezone_set('America/New_York');

// Get the current day of the week and month in New York
$dayOfWeek = date('l'); // Full textual representation of the day of the week (e.g., "Monday")
$month = date('F'); // Full textual representation of the month (e.g., "January")

// Hub location
$hubLocation = "40.766941088678855, -73.97899952992152";

// Calculate durations
$pickupDuration = getShortestBicycleRouteDuration($hubLocation, $originLocation);
$rideDuration = getShortestBicycleRouteDuration($originLocation, $destinationLocation);
$returnDuration = getShortestBicycleRouteDuration($destinationLocation, $hubLocation);

if ($pickupDuration === false || $rideDuration === false || $returnDuration === false) {
    // Return error if any duration is not found
    echo json_encode([
        'error' => 'Could not calculate one or more of the route durations.',
        'pickupDuration' => $pickupDuration,
        'rideDuration' => $rideDuration,
        'returnDuration' => $returnDuration,
    ]);
    exit;
}

// Calculate operation fare
$pickupDurationFare = $pickupDuration * 2.5;
$returnDurationFare = $returnDuration * 2.5;
$rideDurationFare = floatval(substr($rideDuration * 2.5, 0, 5));
$totalDurationMinutes = $pickupDurationFare + $rideDurationFare + $returnDurationFare;
$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month);
$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;

// Calculate booking fee and driver fare
if ($paymentMethod == "CARD" || $paymentMethod == "CASH") {
    $bookingFee = 0.2 * $operationFare;
    $driverFare = 0.8 * $operationFare;
    if ($paymentMethod === "CARD") {
        $driverFare *= 1.1;
    }
} else {
    $bookingFee = 0.3 * $operationFare;
    $driverFare = 0.7 * $operationFare;
}

$minFares = [
    "CASH" => [
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
    "CARD" => [
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

$isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
$key = ($isWeekend ? "weekend" : "week") . ($month == "December" ? "December" : "");
$minBookingFee = $minFares[$paymentMethod][$key]["Booking Fee"];
$minDriverFare = $minFares[$paymentMethod][$key]["Driver Fare"];
$minTotalFare = $minFares[$paymentMethod][$key]["Total Fare"];

$bookingFee = max($bookingFee, $minBookingFee);
$driverFare = max($driverFare, $minDriverFare);
if ($paymentMethod == "CARD" or $paymentMethod == "CASH") {
    $totalFare = max($bookingFee + $driverFare, $minTotalFare);
} else {
    $totalFare = ($operationFare) * 1.2;
    $totalFare = max($totalFare, $minTotalFare);
}

$pickupDuration = $pickupDuration * 2.5;
$rideDuration = $rideDuration * 2.5;
$returnDuration = $returnDuration  * 2.5;
$returnDuration = getShortestBicycleRouteDuration($destinationLocation, $hubLocation);

// Output the results as JSON
echo json_encode([
    'bookingFee' => round($bookingFee, 2),
    'driverFare' => round($driverFare, 2),
    'totalFare' => round($bookingFee + $driverFare, 2),
    'pickupDuration' => round($pickupDuration, 2),
    'rideDuration' => round($rideDuration, 2),
    'returnDuration' => round($returnDuration, 2),
    'dayOfWeek' => $dayOfWeek,
    'month' => $month
]);
?>
