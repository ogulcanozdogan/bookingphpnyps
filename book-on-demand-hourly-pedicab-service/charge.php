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
$operationFare = $_GET["operationFare"];
$serviceDuration = $_GET["serviceDuration"];


if ($serviceDuration == 30 || $serviceDuration == 90) {
    $serviceDuration2 = $serviceDuration;
} else {
    $serviceDuration2 = $serviceDuration * 60;
}


$totalMinutes = $serviceDuration2 + $pickUpDuration + $returnDuration;
$operationDuration = $totalMinutes / 60;
$operationDurationFormatted = number_format($operationDuration, 2);


if ($serviceDuration == 30 || $serviceDuration == 90) {
    $serviceDuration = $serviceDuration . " Minutes";
} else {
    $serviceDuration = $serviceDuration . " Hour";
}

   // Create the current time in New York time zone
    $nyTimeZone = new DateTimeZone("America/New_York");
    $currentDateTime = new DateTime("now", $nyTimeZone);

    // Mevcut zaman
    $customerPaidTime = new DateTime("now", $nyTimeZone); // Şu anki zaman

    $pickup1Minutes = floor($pickUpDuration);
    $pickup1Seconds = floor(($pickUpDuration - $pickup1Minutes) * 60);

    $tourTime = clone $customerPaidTime;
    $tourTime->add(new DateInterval("PT5M")); // + 5 dakika
    $tourTime->add(
        new DateInterval("PT" . $pickup1Minutes . "M" . $pickup1Seconds . "S")
    ); // + Pick Up 1

    $tourTimeFormatted = $tourTime->format("h:i A");

    // Get current time formats
    $tourYear = $currentDateTime->format("Y");
    $tourMonth = $currentDateTime->format("m");
    $tourDay = $currentDateTime->format("d");
    $tourHour = $tourTime->format("H");
    $tourMinute = $tourTime->format("i");
    $formattedTimeOfTour = $tourHour . "-" . $tourMinute;

    $orderYear = $currentDateTime->format("Y");
    $orderMonth = $currentDateTime->format("m");
    $orderDay = $currentDateTime->format("d");
    $orderHour = $currentDateTime->format("H");
    $orderMinute = $currentDateTime->format("i");
    $formattedTimeOfOrder = $orderHour . "-" . $orderMinute;
	
$orderDate = $orderMonth . "/" . $orderDay . "/" . $orderYear;

$dateOrder = DateTime::createFromFormat("m/d/Y", $orderDate);

$dayOfOrder = $dateOrder->format("l");



    function generateUUID()
    {
        return bin2hex(random_bytes(16));
    }

    $uuid = generateUUID();
    $kisauuid = substr($uuid, 0, 16);

    // Create booking number in the new format
    $bookingNumber =
        $tourYear .
        "-" .
        $tourMonth .
        "-" .
        $tourDay .
        "-" .
        $formattedTimeOfTour .
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

   $date = new DateTime();

    // Gün değerini al
    $pickUpDay = $date->format("l");
    $todayFormatted = $date->format("m/d/Y");
    $todayDay = $date->format("l");

$pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
$destinationCoords = getCoordinates($destinationAddress, $apiKey);
$hubCoords = getCoordinates($hub, $apiKey);


    $formattedDate = $currentDateTime->format("m/d/Y");

if ($firstName != "" && $lastName != "") {
    $satir = [
        "bookingNumber" => $bookingNumber,
        "firstName" => $firstName,
        "lastName" => $lastName,
        "emailAddress" => $emailAddress,
        "phoneNumber" => $phoneNumber,
        "numPassengers" => $numPassengers,
        "pickUpDate" => $formattedDate,
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
        "operationFare" => $operationFare,
        "pickUpCoords" => $pickUpCoords,
        "destinationCoords" => $destinationCoords,
        "serviceDetails" => $serviceDetails,
        "serviceDuration" => $serviceDuration,
    ];

    $sql = "INSERT INTO hourly (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration, pickUpDuration, hub, operationFare, pickUpCoords, destinationCoords, hubCoords, serviceDetails, serviceDuration)
    VALUES ('$uuid', '$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$formattedDate', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$returnDuration', '$pickUpDuration', '$hub', '$operationFare', '$pickUpCoords', '$destinationCoords', '$hubCoords', '$serviceDetails', '$serviceDuration')";
    $durum = $baglanti->prepare($sql)->execute();

    if ($durum) {
        // First email
        $email1 = new \SendGrid\Mail\Mail();
        $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email1->setSubject("On Demand Hourly Pedicab Service - " . $bookingNumber);
        $email1->addTo("info@newyorkpedicabservices.com", "NYPS");

        $htmlContent1 = <<<EOD
        <html>
        <body>
            <h1>Booking Details</h1>
            <p><strong>Booking Number:</strong> $bookingNumber</p>
            <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-on-demand-hourly-pedicab-service/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>    
            <p><strong>Type:</strong> Hourly Pedicab Service</p>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Cell Phone Number:</strong> $phoneNumber</p>
            <p><strong>Number of Passengers:</strong> $numPassengers</p>
            <p><strong>Date of Service:</strong> $formattedDate $dayOfOrder</p>
            <p><strong>Pick Up Duration:</strong> {$pickUpDuration} Minutes</p>
            <p><strong>Duration of Service:</strong> {$serviceDuration}</p>
            <p><strong>Return Duration:</strong> {$returnDuration} Minutes</p>
            <p><strong>Operation Duration:</strong> {$operationDurationFormatted} Hour</p>
            <p><strong>HUB:</strong> $hub</p>
            <p><strong>Operation Fare:</strong> \${$operationFare}</p>
            <p><strong>Start Address:</strong> $pickUpAddress</p>
            <p><strong>Finish Address:</strong> $destinationAddress</p>
            <p><strong>Service Details:</strong> $serviceDetails</p>
            <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear $todayDay</p>
            <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $todayFormatted $todayDay</p>
            <p><strong>Total Fare:</strong> \${$totalFare}</p>
            <h2>Driver Note</h2>
            <strong>Type:</strong> On Demand Hourly Pedicab Service<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong>$formattedDate<br><strong>Time:</strong> $tourTimeFormatted<br><strong>Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Details:</strong> $serviceDetails<br><strong>Pay:</strong> \${$driverFare} with $paymentMethod by customer $firstName $lastName
        </body>
        </html>
EOD;

        $email1->addContent("text/html", $htmlContent1);

        // Second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject(
            "CONFIRMATION: On Demand Hourly Pedicab Service - " . $bookingNumber
        );
        $email2->addTo($emailAddress, "NYPS");

        $htmlContent2 = <<<EOD
        <html>
        <body>
            <h1>Booking Details</h1>
            <p><strong>CONFIRMATION: On Demand Hourly Pedicab Ride - </strong> $bookingNumber</p>
            <p><strong>Thank you for choosing New York Pedicab Services</strong></p>
            <p><strong>Below are the confirmed details of your booking:</strong></p>
            <p><strong>Type:</strong> On Demand Hourly Pedicab Ride</p>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Phone Number:</strong> $phoneNumber</p>
            <p><strong>Number of Passengers:</strong> $numPassengers</p>
            <p><strong>Date of Service:</strong> $formattedDate $dayOfOrder</p>
            <p><strong>Time of Service:</strong> $tourTimeFormatted</p>
            <p><strong>Duration of Service:</strong> {$serviceDuration}</p>
            <p><strong>Start Address:</strong> $pickUpAddress</p>
            <p><strong>Finish Address:</strong> $destinationAddress</p>
			<p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
			<p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $todayFormatted $todayDay</p>
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
            "pickUpDate" => $formattedDate,
            "serviceDuration" => $serviceDuration,
            "pickUpAddress" => $pickUpAddress,
            "destinationAddress" => $destinationAddress,
            "serviceDetails" => $serviceDetails,
            "bookingFee" => $bookingFee,
			"rideDuration" => $rideDuration,
            "orderMonth" => $orderMonth,
            "orderDay" => $orderDay,
            "orderYear" => $orderYear,
            "current_time" => $tourTimeFormatted,
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