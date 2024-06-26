<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
  <script src="js/sweetalert.min.js"></script>
</head>
<body>
<?php
$hata = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";
require_once "inc/db.php";
require_once "whatsapp.php";

if (!$_GET) {
	header("location: index.php");
		exit;
}

// Get date and time information from the form
$firstName = $_GET["firstName"]; // default value 1
$lastName = $_GET["lastName"]; // default value 1
$emailAddress = $_GET["email"]; // default value 1
$phoneNumber = $_GET["phoneNumber"]; // default value 1
$numPassengers = $_GET["numPassengers"]; // default value 1
$pickUpDate = $_GET["pickUpDate"];
$hours = $_GET["hours"];
$minutes = $_GET["minutes"];
$ampm = $_GET["ampm"];
$pickUpAddress = $_GET["pickUpAddress"];
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

$timeOfPickUp = $hours . ":" . $minutes . " " . $ampm;

$totalMinutes = $rideDuration + $pickUpDuration + $returnDuration; // Calculate the total minutes
$operationDuration = $totalMinutes / 60; // Convert minutes to hours

// Formatting and displaying on screen
$operationDurationFormatted = number_format($operationDuration, 2);

// Split the date string into parts (Month, Day, Year)
$dateParts = explode("/", $pickUpDate);
$month = $dateParts[0];
$day = $dateParts[1];
$year = $dateParts[2];

// Format the hour and minute values to two digits
$formattedHour = str_pad($hours, 2, "0", STR_PAD_LEFT);
$formattedMinute = str_pad($minutes, 2, "0", STR_PAD_LEFT);

// Convert PickUpDate to a DateTime object
$pickUpDateTime = DateTime::createFromFormat("m/d/Y", $pickUpDate);
$pickUpYear = $pickUpDateTime->format("Y");
$pickUpMonth = $pickUpDateTime->format("m");
$pickUpDay = $pickUpDateTime->format("d");

$dayOfWeek = $pickUpDateTime->format("l");

// Convert the time to 24-hour format
$timeOfRide = DateTime::createFromFormat(
    "h:i A",
    $hours . ":" . $minutes . " " . $ampm
);
$formattedTimeOfRide = $timeOfRide->format("H-i");

// Create the current time in Florida time zone
$floridaTimeZone = new DateTimeZone("America/New_York");
$orderDateTime = new DateTime("now", $floridaTimeZone);
$orderYear = $orderDateTime->format("Y");
$orderMonth = $orderDateTime->format("m");
$orderDay = $orderDateTime->format("d");
$formattedTimeOfOrder = $orderDateTime->format("H-i");

$orderDate = $orderMonth . "/" . $orderDay . "/" . $orderYear;

$dateOrder = DateTime::createFromFormat("m/d/Y", $orderDate);

$dayOfOrder = $dateOrder->format("l");

function generateUUID()
{
    return bin2hex(random_bytes(16));
}

$uuid = generateUUID();
$kisauuid = substr($uuid, 0, 16);

// Create the booking number according to the new format
$bookingNumber =
    $pickUpYear .
    "-" .
    $pickUpMonth .
    "-" .
    $pickUpDay .
    "-" .
    $formattedTimeOfRide .
    "-" .
    $orderYear .
    "-" .
    $orderMonth .
    "-" .
    $orderDay .
    "-" .
    $formattedTimeOfOrder .
    "-" .
    $kisauuid;

$apiKey = "AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY";
// Function to convert addresses to coordinates
function getCoordinates($address, $apiKey)
{
    // Make the address URL-friendly
    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey";

    // Initialize HTTP request with cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    // Execute the request and get the result
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode the response as JSON
    $response = json_decode($response, true);

    // Get the coordinates
    if ($response["status"] == "OK") {
        $geometry = $response["results"][0]["geometry"]["location"];
        return $geometry["lat"] . "," . $geometry["lng"];
    } else {
        return null; // Coordinates not found
    }
}

// Get the coordinates for both addresses
$pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
$destinationCoords = getCoordinates($destinationAddress, $apiKey);
$hubCoords = getCoordinates($hub, $apiKey);

$paymentMethod = strtoupper($paymentMethod);

if ($firstName != "" && $lastName != "") {
    // Check if data fields are not empty.
    //Data to be updated

    $satir = [
        "bookingNumber" => $bookingNumber,
        "firstName" => $firstName,
        "lastName" => $lastName,
        "emailAddress" => $emailAddress,
        "phoneNumber" => $phoneNumber,
        "numPassengers" => $numPassengers,
        "pickUpDate" => $pickUpDate,
        "hours" => $hours,
        "minutes" => $minutes,
        "ampm" => $ampm,
        "pickUpAddress" => $pickUpAddress,
        "destinationAddress" => $destinationAddress,
        "paymentMethod" => $paymentMethod,
        "rideDuration" => $rideDuration,
        "bookingFee" => $bookingFee,
        "driverFare" => $driverFare,
        "totalFare" => $totalFare,
        "returnDuration" => $returnDuration,
        "pickUpDuration" => $pickUpDuration,
        "hub" => $hub,
        "baseFare" => $baseFare,
        "operationFare" => $operationFare,
        "pickUpCoords" => $pickUpCoords,
        "destinationCoords" => $destinationCoords,
    ];

    $sql = "INSERT INTO pointatob (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration, pickUpDuration, hub, baseFare, operationFare, pickUpCoords, destinationCoords, hubCoords)
VALUES ('$uuid', '$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$pickUpDate', '$hours', '$minutes', '$ampm', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$returnDuration', '$pickUpDuration', '$hub', '$baseFare', '$operationFare', '$pickUpCoords', '$destinationCoords', '$hubCoords')";
    $durum = $baglanti->prepare($sql)->execute();

    if ($durum) {
        // First email
        $email1 = new \SendGrid\Mail\Mail();
        $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email1->setSubject(
            "Scheduled Point A to B Pedicab Ride - " . $bookingNumber
        );
        $email1->addTo("info@newyorkpedicabservices.com", "NYPS");

        $htmlContent1 = <<<EOD
<html>
<body>
    <h1>Booking Details</h1>
    <p><strong>Booking Number:</strong> $bookingNumber</p>
    <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-scheduled-point-a-to-b-pedicab-ride/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>    
    <p><strong>Type:</strong> Scheduled Point A to B Pedicab Ride</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>
    <p><strong>Date of Pick Up:</strong> $pickUpDate $dayOfWeek</p>
    <p><strong>Time of Pick Up:</strong> $timeOfPickUp</p>
    <p><strong>Pick Up Duration:</strong> {$pickUpDuration} Minutes</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Return Duration:</strong> {$returnDuration} Minutes</p>    
    <p><strong>Operation Duration:</strong> {$operationDurationFormatted} hours</p>
    <p><strong>Hub:</strong> $hub</p>
    <p><strong>Base Fare:</strong> \${$baseFare}</p>
    <p><strong>Operation Fare:</strong> \${$operationFare}</p>
    <p><strong>Pick Up Address:</strong> $pickUpAddress</p>
    <p><strong>Destination Address:</strong> $destinationAddress</p>
EOD;

        if ($paymentMethod == "FULLCARD") {
            $htmlContent1 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee</p>
EOD;
            $htmlContent1 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare}</p>
	<p><strong>Total Fare:</strong> \${$totalFare}paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;
        } else {
            $htmlContent1 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;
            $htmlContent1 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
	<p><strong>Total Fare:</strong> \${$totalFare}</p>
EOD;
        }

        $dateDriver = DateTime::createFromFormat("m/d/Y", $pickUpDate);

        if ($dateDriver) {
            // İstenen formatta tarihi almak için formatla
            $driverDate = $dateDriver->format("M d l");
        }

        if ($paymentMethod != "FULLCARD") {
            $htmlContent1 .= <<<EOD
    <h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Point A to B Pedicab Ride<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong> $driverDate<br><strong>Time:</strong> $timeOfPickUp<br><strong>Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \${$driverFare} with $paymentMethod by customer $firstName $lastName
</body>
</html>
EOD;
        } else {
            $htmlContent1 .= <<<EOD
    <h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Point A to B Pedicab Ride<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong> $driverDate<br><strong>Time:</strong> $timeOfPickUp<br><strong>Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \${$driverFare} with Zelle by Ibrahim Donmez
</body>
</html>
EOD;
        }

        $email1->addContent("text/html", $htmlContent1);

        // Second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject(
            "CONFIRMATION: Scheduled Point A to B Pedicab Ride - " .
                $bookingNumber
        );
        $email2->addTo($emailAddress, $firstName . " " . $lastName);
        $htmlContent2 = <<<EOD
<html>
<body>
    <p><strong>CONFIRMATION: Scheduled Point A to B Pedicab Ride - </strong> $bookingNumber</p>
	<br>
	<p><strong>Below are the confirmed details of your booking:</strong></p>
    <p><strong>Type:</strong> Scheduled Point A to B Pedicab Ride</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>
    <p><strong>Date of Pick Up:</strong> $pickUpDate $dayOfWeek</p>
    <p><strong>Time of Pick Up:</strong> $timeOfPickUp</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Pick Up Address:</strong> $pickUpAddress</p>
    <p><strong>Destination Address:</strong> $destinationAddress</p>
EOD;

        if ($paymentMethod != "FULLCARD") {
            $htmlContent2 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;

            $htmlContent2 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
EOD;
        }

        if ($paymentMethod == "FULLCARD") {
            $htmlContent2 .= <<<EOD
    <p><strong>Total Fare:</strong> \${$totalFare} paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;
        } else {
            $htmlContent2 .= <<<EOD
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
EOD;
        }
        $htmlContent2 .= <<<EOD
    <p><strong>Thank you for choosing New York Pedicab Services.</strong></p>
    <strong>New York Pedicab Services</strong><br>
    <strong>(212) 961-7435</strong><br>
    <strong>info@newyorkpedicabservices.com</strong>
</body>
</html>
EOD;

        $email2->addContent("text/html", $htmlContent2);

        // SendGrid API key
        $sendgrid = new \SendGrid(
            "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"
        );

        try {
            // Send the first email
            $response1 = $sendgrid->send($email1);
            // print $response1->statusCode() . "\n";
            //print_r($response1->headers());
            // print $response1->body() . "\n";

            // Send the second email
            $response2 = $sendgrid->send($email2);
            // print $response2->statusCode() . "\n";
            // print_r($response2->headers());
            // print $response2->body() . "\n";
        } catch (Exception $e) {
            // echo 'Caught exception: '. $e->getMessage() ."\n";
        }

        $sorgu = $baglanti->prepare(
            "SELECT * FROM users WHERE perm = 'driver'"
        );
        $sorgu->execute();

        while ($sonuc = $sorgu->fetch()) {
            // Add WhatsApp format to the phone number
            $formattedPhone = "whatsapp:+1" . $sonuc["number"];
            $phoneNumbers[] = $formattedPhone;
        }

        $message =
            "Point A to B Pedicab Tour available!
{" .
            $bookingNumber .
            "}";

        // Send message to each phone number
        foreach ($phoneNumbers as $phoneNumberwp) {
            $messageSid = sendWhatsAppMessage($twilio, $phoneNumberwp, $message);
            // echo "Message sent, SID: $messageSid<br>";
        }

        // Redirect to completed.php with POST data
        $postData = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "emailAddress" => $emailAddress,
            "phoneNumber" => $phoneNumber,
            "numPassengers" => $numPassengers,
            "pickUpAddress" => $pickUpAddress,
            "destinationAddress" => $destinationAddress,
            "paymentMethod" => $paymentMethod,
            "rideDuration" => $rideDuration,
            "bookingFee" => $bookingFee,
            "driverFare" => $driverFare,
            "totalFare" => $totalFare,
            "orderMonth" => $orderMonth,
            "orderDay" => $orderDay,
            "orderYear" => $orderYear,
            "current_time" => $current_time,
            "tourDuration" => $tourDuration,
            "pickUpDate" => $pickUpDate,
            "bookingNumber" => $bookingNumber,
            "timeOfPickUp" => $timeOfPickUp,
            "dayOfPickup" => $dayOfPickup,
        ];

        $form =
            '<form id="completedForm" action="completed.php" method="post">';
        foreach ($postData as $key => $value) {
            $form .=
                '<input type="hidden" name="' .
                htmlspecialchars($key) .
                '" value="' .
                htmlspecialchars($value) .
                '">';
        }
        $form .= "</form>";
        $form .=
            '<script>document.getElementById("completedForm").submit();</script>';
        echo $form;
        exit();
    } else {
        echo "Edit error occurred: "; // Print an error if ID is not found or there is an error in the query.
    }
} else {
    echo "An error occurred: " . $hata; // Return an error for file errors and form elements being empty.
}
if ($hata != "") {
    echo '<script>swal("Error","' . $hata . '","error");</script>';
}
?>



</body>
</html>
