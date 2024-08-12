<?php
include('inc/init.php');
?>
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
    $hata = '';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once('vendor/autoload.php');
    require_once('inc/db.php');
    require_once('whatsapp.php');
	
	

    if (
        !isset(
            $_GET["unique_id"]
        )
    ) {
        header("Location: index.php");
        exit();
    }


	$unique_id = $_GET["unique_id"];
	

if ($unique_id === null) {
    die("Unique ID is required.");
}

    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Pull data from database
    $stmt = $pdo->prepare("SELECT * FROM temporaryBookings WHERE unique_id = :unique_id");
    $stmt->execute([':unique_id' => $unique_id]);
    $booking = $stmt->fetch();

    if (!$booking) {
        die("Booking not found.");
    }


  
    // Get date and time information from the form
    $firstName = $booking['first_name'];
    $lastName = $booking['last_name'];
    $emailAddress = $booking['email'];
    $phoneNumber = $booking['phone_number'];
    $numPassengers = $booking['num_passengers'];
    $pickUpDate = $booking['pick_up_date'];
    $hours = $booking['hours'];
    $minutes = $booking['minutes'];
    $ampm = $booking['ampm'];
    $pickUpAddress = $booking['pick_up_address'];
    $destinationAddress = $booking['destination_address'];
    $paymentMethod = $booking['payment_method'];
    $rideDuration = $booking['ride_duration'];
    $bookingFee = $booking['booking_fee'];
    $driverFare = $booking['driver_fare'];
    $totalFare = $booking['total_fare'];
    $returnDuration = $booking["return_duration"];
    $operationFare = $booking["operation_fare"];
    $tourDuration = $booking["tour_duration"];
    $pickup1 = $booking["pickup1"];
    $pickup2 = $booking["pickup2"];
    $return1 = $booking["return1"];
    $return2 = $booking["return2"];
    $toursuresi = $booking["toursuresi"];
	$baseFare = $booking["base_fare"];
	$countryCode = $booking["country_code"];
	
	$currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));
	$createdAt = $currentDateTime->format('Y-m-d H:i:s');
	
	    $phoneNumber = "+" . $countryCode . $phoneNumber;
	
	$timeOfPickUp = $hours . ":" . $minutes . " " . $ampm;
	
		if ($tourDuration == 1) {
    $tourDuration2 = $tourDuration * 60;
} else {
    $tourDuration2 = $tourDuration;
}
	
    $totalMinutes = $pickup1 + $pickup2 + $return1 + $return2 + $tourDuration2;
    $operationDuration = $totalMinutes / 60;
    $operationDurationFormatted = number_format($operationDuration, 2);

    $dateParts = explode('/', $pickUpDate);
    $month = $dateParts[0];
    $day = $dateParts[1];
    $year = $dateParts[2];

    $formattedHour = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $formattedMinute = str_pad($minutes, 2, '0', STR_PAD_LEFT);
    $pickUpDateTime = DateTime::createFromFormat('m/d/Y', $pickUpDate);
    $pickUpYear = $pickUpDateTime->format('Y');
    $pickUpMonth = $pickUpDateTime->format('m');
    $pickUpDay = $pickUpDateTime->format('d');

    $timeOfRide = DateTime::createFromFormat('h:i A', $hours . ':' . $minutes . ' ' . $ampm);
    $formattedTimeOfRide = $timeOfRide->format('H-i');

    $floridaTimeZone = new DateTimeZone('America/New_York');
    $orderDateTime = new DateTime('now', $floridaTimeZone);
    $orderYear = $orderDateTime->format('Y');
    $orderMonth = $orderDateTime->format('m');
    $orderDay = $orderDateTime->format('d');
    $formattedTimeOfOrder = $orderDateTime->format('H-i');
	
		
	function generateUUID() {
    return bin2hex(random_bytes(16));
}

$uuid = generateUUID();
$kisauuid = substr($uuid, 0, 16);

    $bookingNumber = $pickUpYear . '-' . $pickUpMonth . '-' . $pickUpDay . '-' .
                     $formattedTimeOfRide . '-' . $orderYear . '-' . $orderMonth . '-' .
                     $orderDay . '-' . $formattedTimeOfOrder . '-' . $kisauuid;


    $apiKey = 'AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo';
    function getCoordinates($address, $apiKey) {
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response, true);
        if ($response['status'] == 'OK') {
            $geometry = $response['results'][0]['geometry']['location'];
            return $geometry['lat'] . ',' . $geometry['lng'];
        } else {
            return null;
        }
    }

    $pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
    $destinationCoords = getCoordinates($destinationAddress, $apiKey);
$date = new DateTime();

// Get day value
$pickUpDay = $date->format('l');
$todayFormatted = $date->format('m/d/Y');
$todayDay = $date->format('l');

$namesurname = $firstName. ' '  .$lastName;

    if ($firstName != "" && $lastName != "") {
        $satir = [
            'bookingNumber' => $bookingNumber,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'emailAddress' => $emailAddress,
            'phoneNumber' => $phoneNumber,
            'numPassengers' => $numPassengers,
            'pickUpDate' => $pickUpDate,
            'hours' => $hours,
            'minutes' => $minutes,
            'ampm' => $ampm,
            'pickUpAddress' => $pickUpAddress,
            'destinationAddress' => $destinationAddress,
            'paymentMethod' => $paymentMethod,
            'rideDuration' => $rideDuration,
            'bookingFee' => $bookingFee,
            'driverFare' => $driverFare,
            'totalFare' => $totalFare,
            'returnDuration' => $returnDuration,
            'operationFare' => $operationFare,
            'pickUpCoords' => $pickUpCoords,
			"totalMinutes" => $totalMinutes,
            'destinationCoords' => $destinationCoords,
			"unique_id" => $unique_id,
			"createdAt" => $createdAt,			
        ];

        $sql = "INSERT INTO centralpark (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration,  operationFare, pickUpCoords, destinationCoords, unique_id, totalMinutes, createdAt)
                VALUES ('$uuid', '$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$pickUpDate', '$hours', '$minutes', '$ampm', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$returnDuration', '$operationFare', '$pickUpCoords', '$destinationCoords', '$unique_id', '$totalMinutes', '$createdAt')";
        $durum = $baglanti->prepare($sql)->execute();

		$operationFare = number_format($operationFare, 2);
		$rideDuration = number_format($rideDuration , 2);
		$date = DateTime::createFromFormat('m/d/Y', $pickUpDate);
		// Gün değerini al
		$pickUpDay = $date->format('l');

		$rideDuration = number_format($rideDuration, 2);
		
		if ($paymentMethod == "CARD" or $paymentMethod == "card"){
			$paymentMethod2 = "debit/credit card";
		}
				if ($paymentMethod == "CASH" or $paymentMethod == "cash"){
			$paymentMethod2 = "CASH";
		}
		
        if ($durum) {
            $email1 = new \SendGrid\Mail\Mail();
            $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
            $email1->setSubject("Scheduled Central Park Pedicab Tour - " . $bookingNumber);
            $email1->addTo("info@newyorkpedicabservices.com", "NYPS");
            $htmlContent1 = <<<EOD
<html>
<body>
    <h1>Booking Details</h1>
    <p><strong>Booking Number:</strong> $bookingNumber</p>
    <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-scheduled-central-pedicab-tour/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>
    <p><strong>Type:</strong> Scheduled Central Park Pedicab Tour</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>
    <p><strong>Date of Tour:</strong> $pickUpDate</p>
    <p><strong>Time of Tour:</strong> $timeOfPickUp</p>
    <p><strong>Pick Up 1 (Hub 1 to Start) Duration:</strong> {$pickup1} Minutes</p>
    <p><strong>Pick Up 2 (Start to Hub 2) Duration:</strong> {$pickup2} Minutes</p>
    <p><strong>Duration of Tour:</strong> {$tourDuration} Minutes</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Return 1 (Hub 1 to Finish) Duration:</strong> {$return1} Minutes</p>
    <p><strong>Return 2 (Finish to Hub 2) Duration:</strong> {$return2} Minutes</p>
    <p><strong>Operation Duration:</strong> {$operationDurationFormatted} hours</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>
    <p><strong>Hub 1:</strong> West Drive and West 59th Street New York, NY 10019</p>
    <p><strong>Hub 2:</strong> 6th Avenue and Central Park South New York, NY 10019</p>
    <p><strong>Base Fare:</strong> \${$baseFare}</p>
    <p><strong>Operation Fare:</strong> \${$operationFare} per hour</p>
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod2 due on $pickUpDate $pickUpDay</p>
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
    <h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Central Park Pedicab Tour<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Phone:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date: </strong>$pickUpDate $pickUpDay<br><strong>Time:</strong> $timeOfPickUp<br><strong>Tour Duration:</strong> {$tourDuration} Minutes<br><strong>Ride Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \${$driverFare} $paymentMethod2 by customer $firstName $lastName
</body>
</html>
EOD;

            $email1->addContent("text/html", $htmlContent1);

            $email2 = new \SendGrid\Mail\Mail();
            $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
            $email2->setSubject("CONFIRMATION: Scheduled Central Park Pedicab Tour - " . $bookingNumber);
            $email2->addTo($emailAddress, $namesurname);
            $htmlContent2 = <<<EOD
<html>
<body>
    <h1>Booking Details</h1>
    <p><strong>Thank you for choosing New York Pedicab Services</strong></p>
    <p><strong>Below are the confirmed details of your booking:</strong></p>
    <p><strong>Type:</strong> Scheduled Central Park Pedicab Tour</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>
    <p><strong>Date of Tour:</strong> $pickUpDate $pickUpDay</p>
    <p><strong>Time of Tour:</strong> $timeOfPickUp</p>
    <p><strong>Duration of Tour:</strong> {$tourDuration} Minutes</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod2 due on $pickUpDate $pickUpDay</p>
	<p><strong>Total Fare:</strong> \${$totalFare}</p>
    <p><strong>Thank you,</strong></p>
    <p><strong>New York Pedicab Services</strong></p>
    <p><strong>(212) 961-7435</strong></p>
    <p><strong>info@newyorkpedicabservices.com</strong></p>
</body>
</html>
EOD;
            $email2->addContent("text/html", $htmlContent2);

            $sendgrid = new \SendGrid('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');
            try {
                $response1 = $sendgrid->send($email1);
                $response2 = $sendgrid->send($email2);
            } catch (Exception $e) {
                echo 'Email sending error: ' . $e->getMessage();
            }

       $sorgu = $baglanti->prepare("SELECT * FROM users WHERE perm = 'driver'");
        $sorgu->execute();

        $phoneNumbers = [];
        while ($sonuc = $sorgu->fetch()) { 
            $formattedPhone = "whatsapp:+1" . $sonuc['number'];
            $phoneNumbers[] = $formattedPhone;
        }

       $message = "Central Park Pedicab Tour available!
{" . $bookingNumber . "}";
            foreach ($phoneNumbers as $phoneNumberwp) {
                $messageSid = sendWhatsAppMessage($twilio, $phoneNumberwp, $message);
            }

            // Redirect to completed.php with POST data
            $postData = [
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $emailAddress,
                'phoneNumber' => $phoneNumber,
                'numPassengers' => $numPassengers,
                'pickUpAddress' => $pickUpAddress,
                'destinationAddress' => $destinationAddress,
                'paymentMethod' => $paymentMethod,
                'rideDuration' => $rideDuration,
                'bookingFee' => $bookingFee,
                'driverFare' => $driverFare,
                'totalFare' => $totalFare,
                'orderMonth' => $orderMonth,
                'orderDay' => $orderDay,
                'orderYear' => $orderYear,
                'timeOfPickUp' => $timeOfPickUp,
                'tourDuration' => $tourDuration,
				'hours' => $hours,
                'minutes' => $minutes,
                'ampm' => $ampm,
				'bookingNumber' => $bookingNumber,
                'pickUpDate' => $pickUpDate
            ];

            $form = '<form id="completedForm" action="completed.php" method="post">';
            foreach ($postData as $key => $value) {
                $form .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
            }
            $form .= '</form>';
            $form .= '<script>document.getElementById("completedForm").submit();</script>';
            echo $form;
            exit;
        } else {
            echo 'Editing error occurred: ';
        }
    } else {
        echo 'An error occurred: ' . $hata;
    }
    if ($hata != "") {
        echo '<script>swal("Error","' . $hata . '","error");</script>';
    }
    ?>
</body>
</html>
