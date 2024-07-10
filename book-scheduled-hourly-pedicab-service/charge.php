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

if (
    !isset(
        $_GET["firstName"],
        $_GET["lastName"],
        $_GET["email"],
        $_GET["phoneNumber"],
        $_GET["numPassengers"],
        $_GET["pickUpDate"],
        $_GET["hours"],
        $_GET["minutes"],
        $_GET["ampm"],
        $_GET["pickUpAddress"],
        $_GET["destinationAddress"],
        $_GET["paymentMethod"],
        $_GET["rideDuration"],
        $_GET["bookingFee"],
        $_GET["driverFare"],
        $_GET["totalFare"],
        $_GET["serviceDetails"],
        $_GET["returnDuration"],
        $_GET["pickUpDuration"],
        $_GET["hub"],
        $_GET["baseFare"],
        $_GET["operationFare"],
        $_GET["serviceDuration"]
    )
) {
    header("Location: index.php");
    exit();
}

// Get the date and time information from the form
$firstName = $_GET["firstName"];
$lastName = $_GET["lastName"];
$emailAddress = $_GET["email"];
$phoneNumber = $_GET["phoneNumber"];
$numPassengers = $_GET["numPassengers"];
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
$serviceDetails = $_GET["serviceDetails"];
$returnDuration = $_GET["returnDuration"];
$pickUpDuration = $_GET["pickUpDuration"];
$hub = $_GET["hub"];
$baseFare = $_GET["baseFare"];
$operationFare = $_GET["operationFare"];
$serviceDuration = $_GET["serviceDuration"];


$timeOfPickUp = $hours . ":" . $minutes . " " . $ampm;


if ($serviceDuration == 30 || $serviceDuration == 90) {
	$serviceDuration2 = $serviceDuration;

} else {
    $serviceDuration2 = $serviceDuration*60;
}

$totalMinutes = $pickUpDuration + $returnDuration + $serviceDuration2; // Calculate the total minutes
$operationDuration = $totalMinutes / 60; // Convert minutes to hours

// Formatting and displaying on screen
$operationDurationFormatted = number_format($operationDuration, 2);


if ($serviceDuration == 30 || $serviceDuration == 90) {
    $serviceDuration = $serviceDuration . " Minutes";
} else {
    $serviceDuration = $serviceDuration . " Hour";
}

$dateParts = explode("/", $pickUpDate);
$month = $dateParts[0];
$day = $dateParts[1];
$year = $dateParts[2];

$formattedHour = str_pad($hours, 2, "0", STR_PAD_LEFT);
$formattedMinute = str_pad($minutes, 2, "0", STR_PAD_LEFT);

$pickUpDateTime = DateTime::createFromFormat("m/d/Y", $pickUpDate);
$pickUpYear = $pickUpDateTime->format("Y");
$pickUpMonth = $pickUpDateTime->format("m");
$pickUpDay = $pickUpDateTime->format("d");


$dayOfWeek = $pickUpDateTime->format("l");

$timeOfRide = DateTime::createFromFormat(
    "h:i A",
    $hours . ":" . $minutes . " " . $ampm
);
$formattedTimeOfRide = $timeOfRide->format("H-i");

$floridaTimeZone = new DateTimeZone("America/New_York");
$orderDateTime = new DateTime("now", $floridaTimeZone);
$orderYear = $orderDateTime->format("Y");
$orderMonth = $orderDateTime->format("m");
$orderDay = $orderDateTime->format("d");
$formattedTimeOfOrder = $orderDateTime->format("H-i");

$orderDate = $orderMonth . "/" . $orderDay . "/" . $orderYear;

$dateOrder = DateTime::createFromFormat("m/d/Y", $orderDate);

if ($dateOrder) {
    // Gün ismini almak için formatla
    $dayOfOrder = $dateOrder->format("l");
}

function generateUUID()
{
    return bin2hex(random_bytes(16));
}

$uuid = generateUUID();
$kisauuid = substr($uuid, 0, 16);

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

function getCoordinates($address, $apiKey)
{
    $address = urlencode($address);
    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);

    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);

    if ($response["status"] == "OK") {
        $geometry = $response["results"][0]["geometry"]["location"];
        return $geometry["lat"] . "," . $geometry["lng"];
    } else {
        return null;
    }
}

$pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
$destinationCoords = getCoordinates($destinationAddress, $apiKey);
$hubCoords = getCoordinates($hub, $apiKey);

$paymentMethod = strtoupper($paymentMethod);

if ($firstName != "" && $lastName != "") {
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
        "serviceDetails" => $serviceDetails,
        "serviceDuration" => $serviceDuration,
    ];

    $sql = "INSERT INTO hourly (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration, pickUpDuration, hub, baseFare, operationFare, pickUpCoords, destinationCoords, hubCoords, serviceDetails, serviceDuration)
    VALUES ('$uuid', '$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$pickUpDate', '$hours', '$minutes', '$ampm', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$returnDuration', '$pickUpDuration', '$hub', '$baseFare', '$operationFare', '$pickUpCoords', '$destinationCoords', '$hubCoords', '$serviceDetails', '$serviceDuration')";
    $durum = $baglanti->prepare($sql)->execute();

    if ($durum) {
		
		$rideDuration = number_format($rideDuration, 2);
		$paymentMethod = strtoupper($paymentMethod);
		
        // First email
        $email1 = new \SendGrid\Mail\Mail();
        $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email1->setSubject("Scheduled Hourly Pedicab Service - " . $bookingNumber);
        $email1->addTo("info@newyorkpedicabservices.com", "NYPS");

        $htmlContent1 = <<<EOD
        <html>
        <body>
            <h1>Booking Details</h1>
            <p><strong>Booking Number:</strong> $bookingNumber</p>
            <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-scheduled-hourly-pedicab-service/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>    
            <p><strong>Type:</strong> Hourly Pedicab Service</p>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Cell Phone Number:</strong> $phoneNumber</p>
            <p><strong>Number of Passengers:</strong> $numPassengers</p>
            <p><strong>Date of Service:</strong> $pickUpDate</p>
            <p><strong>Time of Service:</strong> $timeOfPickUp</p>
            <p><strong>Pick Up Duration:</strong> {$pickUpDuration} Minutes</p>
            <p><strong>Duration of Service:</strong> {$serviceDuration}</p>
            <p><strong>Return Duration:</strong> {$returnDuration} Minutes</p>
            <p><strong>Operation Duration:</strong> {$operationDurationFormatted} Hours</p>
            <p><strong>HUB:</strong> $hub</p>
            <p><strong>Base Fare:</strong> \${$baseFare} per hour</p>
            <p><strong>Operation Fare:</strong> \${$operationFare}</p>
            <p><strong>Start Address:</strong> $pickUpAddress</p>
            <p><strong>Finish Address:</strong> $destinationAddress</p>
            <p><strong>Service Details:</strong> $serviceDetails</p>
EOD;

        if ($paymentMethod != "FULLCARD") {
            $htmlContent1 .= <<<EOD
            <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear</p>
EOD;
        } else {
            $htmlContent1 .= <<<EOD
            <p><strong>Booking Fee:</strong> \$$bookingFee</p>
EOD;
        }

if ($paymentMethod == "card" OR $paymentMethod == "CARD"){
	$paymentMethod2 = "with debit/credit card";
}
if ($paymentMethod == "cash" OR $paymentMethod == "CASH"){
	$paymentMethod2 = "CASH";
}
        $htmlContent1 .= <<<EOD
            <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod2 due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
EOD;

        if ($paymentMethod == "FULLCARD") {
			if ($paymentMethod == "fullcard" OR $paymentMethod == "FULLCARD"){
	$paymentMethod2 = "with debit/credit card";
}
            $htmlContent1 .= <<<EOD
            <p><strong>Total Fare:</strong> \${$totalFare} paid on $orderMonth/$orderDay/$orderYear</p>
EOD;
        } else {
            $htmlContent1 .= <<<EOD
            <p><strong>Total Fare:</strong> \${$totalFare}</p>
EOD;
        }

        $htmlContent1 .= <<<EOD
            <h2>Driver Note</h2>
            <strong>Type:</strong> Hourly Pedicab Service<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong>$pickUpDate $dayOfWeek<br><strong>Time:</strong> $timeOfPickUp<br><strong>Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Details:</strong> $serviceDetails<br><strong>Pay:</strong> \${$driverFare} with $paymentMethod2 by customer $firstName $lastName
        </body>
        </html>
EOD;

        $email1->addContent("text/html", $htmlContent1);

        // Second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject(
            "CONFIRMATION: Scheduled Hourly Pedicab Service - " . $bookingNumber
        );
        $email2->addTo($emailAddress, "NYPS");

        $htmlContent2 = <<<EOD
        <html>
        <body>
            <h1>Booking Details</h1>
            <p><strong>CONFIRMATION: Hourly Pedicab Ride - </strong> $bookingNumber</p>
            <p><strong>Thank you for choosing New York Pedicab Services</strong></p>
            <p><strong>Below are the confirmed details of your booking:</strong></p>
            <p><strong>Type:</strong> Hourly Pedicab Ride</p>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Phone Number:</strong> $phoneNumber</p>
            <p><strong>Number of Passengers:</strong> $numPassengers</p>
            <p><strong>Date of Service:</strong> $pickUpDate $dayOfWeek</p>
            <p><strong>Time of Service:</strong> $timeOfPickUp</p>
            <p><strong>Duration of Service:</strong> {$serviceDuration}</p>
            <p><strong>Start Address:</strong> $pickUpAddress</p>
            <p><strong>Finish Address:</strong> $destinationAddress</p>
EOD;
if ($paymentMethod == "card" OR $paymentMethod == "CARD"){
	$paymentMethod2 = "with debit/credit card";
}
if ($paymentMethod == "cash" OR $paymentMethod == "CASH"){
	$paymentMethod2 = "CASH";
}
if ($paymentMethod == "fullcard" OR $paymentMethod == "FULLCARD"){
	$paymentMethod2 = "with debit/credit card";
}
        if ($paymentMethod != "FULLCARD") {
            $htmlContent2 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;

            $htmlContent2 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod2 due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
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
            //print $response1->statusCode() . "\n";
            // print_r($response1->headers());
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

        $phoneNumbers = [];
        while ($sonuc = $sorgu->fetch()) {
            $formattedPhone = "whatsapp:+1" . $sonuc["number"];
            $phoneNumbers[] = $formattedPhone;
        }

        $message =
            "Hourly Pedicab Tour available!
{" .
            $bookingNumber .
            "}";
        foreach ($phoneNumbers as $phoneNumberwp) {
            $messageSid = sendWhatsAppMessage($twilio, $phoneNumberwp, $message);
            // echo "Message sent, SID: $messageSid<br>";
        }

        // Redirect to completed.php with POST data
        $postData = [
            "bookingNumber" => $bookingNumber,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "emailAddress" => $emailAddress,
            "phoneNumber" => $phoneNumber,
            "numPassengers" => $numPassengers,
            "pickUpDate" => $pickUpDate,
            "timeOfPickUp" => $timeOfPickUp,
            "serviceDuration" => $serviceDuration,
            "pickUpAddress" => $pickUpAddress,
            "destinationAddress" => $destinationAddress,
            "serviceDetails" => $serviceDetails,
            "bookingFee" => $bookingFee,
            "orderMonth" => $orderMonth,
            "orderDay" => $orderDay,
            "orderYear" => $orderYear,
            "driverFare" => $driverFare,
            "paymentMethod" => $paymentMethod,
            "totalFare" => $totalFare,
        ];

        $form =
            '<form id="completedForm" action="completed.php" method="post">';
        foreach ($postData as $key => $value) {
            $form .=
                '<input type="hidden" name="' .
                $key .
                '" value="' .
                $value .
                '">';
        }
        $form .= "</form>";
        $form .=
            '<script>document.getElementById("completedForm").submit();</script>';
        echo $form;
        exit();
    } else {
        echo "An error occurred during editing: ";
    }
} else {
    echo "An error occurred: " . $hata;
}

if (isset($hata) && $hata != "") {
    echo '<script>swal("Error","' . $hata . '","error");</script>';
}
?>
</body>
</html>
