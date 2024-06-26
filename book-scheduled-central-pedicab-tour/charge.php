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

	
	   if (!isset($_GET['firstName'], $_GET['lastName'], $_GET['email'], $_GET['phoneNumber'], $_GET['numPassengers'], $_GET['pickUpAddress'], $_GET['destinationAddress'], $_GET['paymentMethod'], $_GET['rideDuration'], $_GET['bookingFee'], $_GET['driverFare'], $_GET['totalFare'], $_GET['operationFare'], $_GET['tourDuration'], $_GET['pickup1'], $_GET['pickup2'], $_GET['return1'], $_GET['return2'], $_GET['toursuresi'])) {
        header('Location: index.php');
        exit;
    }

  
    // Get date and time information from the form
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $emailAddress = $_GET['email'];
    $phoneNumber = $_GET['phoneNumber']; // Remove 'whatsapp:' prefix
    $numPassengers = $_GET['numPassengers'];
    $pickUpDate = $_GET['pickUpDate'];
    $hours = $_GET['hours'];
    $minutes = $_GET['minutes'];
    $ampm = $_GET['ampm'];
    $pickUpAddress = $_GET['pickUpAddress'];
    $destinationAddress = $_GET['destinationAddress'];
    $paymentMethod = $_GET['paymentMethod'];
    $rideDuration = $_GET['rideDuration'];
    $bookingFee = $_GET['bookingFee'];
    $driverFare = $_GET['driverFare'];
    $totalFare = $_GET['totalFare'];
    $returnDuration = $_GET["returnDuration"];
    $operationFare = $_GET["operationFare"];
    $tourDuration = $_GET["tourDuration"];
    $pickup1 = $_GET["pickup1"];
    $pickup2 = $_GET["pickup2"];
    $return1 = $_GET["return1"];
    $return2 = $_GET["return2"];
    $toursuresi = $_GET["toursuresi"];
	
	$timeOfPickUp = $hours . ":" . $minutes . " " . $ampm;
	
    $totalMinutes = $pickup1 + $pickup2 + $return1 + $return2 + $toursuresi;
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


    $apiKey = 'AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY';
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

// Gün değerini al
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
            'destinationCoords' => $destinationCoords
        ];

        $sql = "INSERT INTO centralpark (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration,  operationFare, pickUpCoords, destinationCoords)
                VALUES ('$uuid', '$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$pickUpDate', '$hours', '$minutes', '$ampm', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$returnDuration', '$operationFare', '$pickUpCoords', '$destinationCoords')";
        $durum = $baglanti->prepare($sql)->execute();

		$operationFare = number_format($operationFare, 2);
		
		$rideDuration = number_format($rideDuration , 2);
		   $date = DateTime::createFromFormat('m/d/Y', $pickUpDate);

// Gün değerini al
$pickUpDay = $date->format('l');


			
$rideDuration = number_format($rideDuration, 2);
		
		
        if ($durum) {
            $email1 = new \SendGrid\Mail\Mail();
            $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
            $email1->setSubject("Scheduled Central Park Pedicab Tour - " . $bookingNumber);
            $email1->addTo("info@newyorkpedicabservices.com", "NYPS");
            $htmlContent1 = <<<EOD
<html>
<body>
    <h1>Booking Details</h1>
    <p><strong>“Booking Number:</strong> $bookingNumber</p>
    <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-scheduled-central-pedicab-tour/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>
    <p><strong>Type:</strong> Scheduled Central Park Pedicab Tour</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>
    <p><strong>Date of Tour:</strong> $pickUpDate</p>
    <p><strong>Time of Tour:</strong> $timeOfPickUp</p>
    <p><strong>Pick Up 1:</strong> {$pickup1} Minutes</p>
    <p><strong>Pick Up 2:</strong> {$pickup2} Minutes</p>
    <p><strong>Duration of Tour:</strong> {$tourDuration} Minutes</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Return 1 Duration:</strong> {$return1} Minutes</p>
    <p><strong>Return 2 Duration:</strong> {$return2} Minutes</p>
    <p><strong>Operation Duration:</strong> {$operationDurationFormatted} hours</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>
    <p><strong>Hub 1:</strong> West Drive and West 59th Street New York, NY 10019</p>
    <p><strong>Hub 2:</strong> 6th Avenue and Central Park South New York, NY 10019</p>
    <p><strong>Operation Fare:</strong> \${$operationFare} per hour</p>
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $pickUpDate $pickUpDay</p>
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
    <h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Central Park Pedicab Tour<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Phone:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date: </strong>$pickUpDate $pickUpDay<br><strong>Time:</strong> $timeOfPickUp<br><strong>Tour Duration:</strong> {$tourDuration} Minutes<br><strong>Ride Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \${$driverFare} strtoupper($paymentMethod) by customer $firstName $lastName
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
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $pickUpDate $pickUpDay</p>
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
