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
$hata = "";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";
require_once "inc/db.php";
require_once "whatsapp.php";
require_once('text.php');	
	
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


    $stmt = $pdo->prepare("SELECT * FROM temporaryBookings WHERE unique_id = :unique_id");
    $stmt->execute([':unique_id' => $unique_id]);
    $booking = $stmt->fetch();

    if (!$booking) {
        die("Booking not found.");
    }

// Get the date and time information from the form
$firstName = $booking["first_name"];
$lastName = $booking["last_name"];
$emailAddress = $booking["email"];
$phoneNumber = $booking["phone_number"];
$numPassengers = $booking["num_passengers"];
$pickUpDate = $booking["pick_up_date"];
$hours = $booking["hours"];
$minutes = $booking["minutes"];
$ampm = $booking["ampm"];
$pickUpAddress = $booking["pick_up_address"];
$destinationAddress = $booking["destination_address"];
$paymentMethod = $booking["payment_method"];
$rideDuration = $booking["ride_duration"];
$bookingFee = $booking["booking_fee"];
$driverFare = $booking["driver_fare"];
$totalFare = $booking["total_fare"];
$serviceDetails = $booking["service_details"];
$returnDuration = $booking["return_duration"];
$pickUpDuration = $booking["pick_up_duration"];
$hub = $booking["hub"];
$baseFare = $booking["base_fare"];
$operationFare = $booking["operation_fare"];
$serviceDuration = $booking["service_duration"];
$countryCode = $booking["country_code"];

	$currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));
	$createdAt = $currentDateTime->format('Y-m-d H:i:s');
	
		        $pedicabCount = ceil($numPassengers / 3);
		
		$driverFarePerDriver = number_format($driverFare/$pedicabCount, 2);
		
		if ($pedicabCount != 1) {
		$driverFarePerDriverText = '($' . $driverFarePerDriver . ' per driver)';
		}
		else{
		$driverFarePerDriverText = '';
		}

$phoneNumber = "+" . $countryCode . $phoneNumber;

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
    // Format to get the day name
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

$apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo";

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
if ($hub == "West Drive and West 59th Street New York, NY 10019"){
	$hubCoords = '40.766941088678855, -73.97899952992152';
}
else {
	$hubCoords = getCoordinates($hub, $apiKey);
}


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
		"hubCoords" => $hubCoords,
        "baseFare" => $baseFare,
        "operationFare" => $operationFare,
        "pickUpCoords" => $pickUpCoords,
        "destinationCoords" => $destinationCoords,
        "serviceDetails" => $serviceDetails,
        "serviceDuration" => $serviceDuration,
		"unique_id" => $unique_id,
		"totalMinutes" => $totalMinutes,
		"createdAt" => $createdAt,	
    ];

$sql = "INSERT INTO hourly (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration, pickUpDuration, hub, hubCoords, baseFare, operationFare, pickUpCoords, destinationCoords, serviceDetails, serviceDuration, unique_id, totalMinutes, createdAt)
VALUES (:id, :bookingNumber, :firstName, :lastName, :emailAddress, :phoneNumber, :numPassengers, :pickUpDate, :hours, :minutes, :ampm, :pickUpAddress, :destinationAddress, :paymentMethod, :rideDuration, :bookingFee, :driverFare, :totalFare, :returnDuration, :pickUpDuration, :hub, :hubCoords, :baseFare, :operationFare, :pickUpCoords, :destinationCoords, :serviceDetails, :serviceDuration, :unique_id, :totalMinutes, :createdAt)";

$statement = $baglanti->prepare($sql);

// Değişkenleri parametrelere bağlama
$statement->bindParam(':id', $uuid);
$statement->bindParam(':bookingNumber', $bookingNumber);
$statement->bindParam(':firstName', $firstName);
$statement->bindParam(':lastName', $lastName);
$statement->bindParam(':emailAddress', $emailAddress);
$statement->bindParam(':phoneNumber', $phoneNumber);
$statement->bindParam(':numPassengers', $numPassengers);
$statement->bindParam(':pickUpDate', $pickUpDate);
$statement->bindParam(':hours', $hours);
$statement->bindParam(':minutes', $minutes);
$statement->bindParam(':ampm', $ampm);
$statement->bindParam(':pickUpAddress', $pickUpAddress);
$statement->bindParam(':destinationAddress', $destinationAddress);
$statement->bindParam(':paymentMethod', $paymentMethod);
$statement->bindParam(':rideDuration', $rideDuration);
$statement->bindParam(':bookingFee', $bookingFee);
$statement->bindParam(':driverFare', $driverFare);
$statement->bindParam(':totalFare', $totalFare);
$statement->bindParam(':returnDuration', $returnDuration);
$statement->bindParam(':pickUpDuration', $pickUpDuration);
$statement->bindParam(':hub', $hub);
$statement->bindParam(':hubCoords', $hubCoords);
$statement->bindParam(':baseFare', $baseFare);
$statement->bindParam(':operationFare', $operationFare);
$statement->bindParam(':pickUpCoords', $pickUpCoords);
$statement->bindParam(':destinationCoords', $destinationCoords);
$statement->bindParam(':serviceDetails', $serviceDetails);
$statement->bindParam(':serviceDuration', $serviceDuration);
$statement->bindParam(':unique_id', $unique_id);
$statement->bindParam(':totalMinutes', $totalMinutes);
$statement->bindParam(':createdAt', $createdAt);

    $durum = $statement->execute();
	
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
            <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText with $paymentMethod2 due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
EOD;

       $dateDriver = DateTime::createFromFormat("m/d/Y", $pickUpDate);

        if ($dateDriver) {
            // Format to get the date in the desired format
            $driverDate = $dateDriver->format("F d l");
        }

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
            <strong>Type:</strong> Hourly Pedicab Service<br><strong>Name:</strong> $firstName $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong> $driverDate<br><strong>Time:</strong> $timeOfPickUp<br><strong>Duration:</strong> {$serviceDuration}<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Details:</strong> $serviceDetails<br><strong>Pay:</strong> \$$driverFarePerDriver per driver with $paymentMethod2 by customer $firstName $lastName
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
            <p><strong>Service Details:</strong> $serviceDetails</p>			
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
    <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText with $paymentMethod2 due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
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

// Saat AM ya da PM durumunu kontrol edip 24 saat formatına çeviriyoruz
if ($ampm == 'PM' && $hours != 12) {
    $hours += 12;
} elseif ($ampm == 'AM' && $hours == 12) {
    $hours = 0;
}

date_default_timezone_set('America/New_York');
$timeString = $pickUpDate . ' ' . $hours . ':' . $minutes . ':00';
$dateTime = new DateTime($timeString, new DateTimeZone('America/New_York'));

$dateTimeEnd = clone $dateTime;
// $totalMinutes değişkenini tam dakika ve saniye olarak ayrıştırıyoruz.
$minutes = floor($totalMinutes); // Tam dakika kısmı (örn. 95)
$seconds = ($totalMinutes - $minutes) * 60; // Saniye kısmı (örn. 0.8 * 60)

// $dateTimeEnd nesnesine tam dakika ve saniyeleri ekliyoruz.
$dateTimeEnd->modify("+$minutes minutes"); // Tam dakika ekleme


$source = "Scheduled Hourly Pedicab Service";

// .ics dosyası oluşturma
$icsContent = "BEGIN:VCALENDAR\r\n";
$icsContent .= "VERSION:2.0\r\n";
$icsContent .= "PRODID:-//New York Pedicab Services//EN\r\n";
$icsContent .= "METHOD:REQUEST\r\n";
$icsContent .= "BEGIN:VEVENT\r\n";
$icsContent .= "UID:" . uniqid() . "\r\n";
$icsContent .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
$icsContent .= "DTSTART;TZID=America/New_York:" . $dateTime->format('Ymd\THis') . "\r\n";
$icsContent .= "DTEND;TZID=America/New_York:" . $dateTimeEnd->format('Ymd\THis') . "\r\n";
$icsContent .= "SUMMARY:" . $source . " " . $serviceDuration . " " . $firstName . " " . $lastName . "\r\n";
$icsContent .= "DESCRIPTION:" . $source . " " . $serviceDuration . " " . $firstName . " " . $lastName . "\r\n";
$icsContent .= "LOCATION:6th Avenue & 57th Street, New York, NY\r\n";

// Hatırlatma bildirimleri
$icsContent .= "BEGIN:VALARM\r\n";
$icsContent .= "TRIGGER:-PT20H\r\n";
$icsContent .= "ACTION:DISPLAY\r\n";
$icsContent .= "DESCRIPTION:" . $source . " " . $serviceDuration . " " . $firstName . " " . $lastName . " reminder\r\n";
$icsContent .= "END:VALARM\r\n";
$icsContent .= "END:VEVENT\r\n";
$icsContent .= "END:VCALENDAR\r\n";

$icsFile = tempnam(sys_get_temp_dir(), 'calendar') . '.ics';
file_put_contents($icsFile, $icsContent);

// SendGrid ile e-posta gönderme
$email3 = new \SendGrid\Mail\Mail();
$email3->setFrom("info@newyorkpedicabservices.com", "New York Pedicab Services");
$email3->setSubject("REMINDER: " . $source . " " . $serviceDuration . " - " . $firstName . " " . $lastName);
$email3->addTo('info@newyorkpedicabservices.com', 'NYPS');
$email3->addContent("text/html", "
			<h2>Driver Note</h2>
            <strong>Type:</strong> Hourly Pedicab Service<br>
			<strong>Name:</strong> $firstName $lastName<br>
			<strong>Cell:</strong> $phoneNumber<br><strong>
			Passengers:</strong> $numPassengers<br><strong>
			Date:</strong> $driverDate<br>
			<strong>Time:</strong> $timeOfPickUp<br>
			<strong>Duration:</strong> {$serviceDuration}<br>
			<strong>Start:</strong> $pickUpAddress<br>
			<strong>Finish:</strong> $destinationAddress<br>
			<strong>Details:</strong> $serviceDetails<br>
			<strong>Pay:</strong> \$$driverFarePerDriver per driver with $paymentMethod2 by customer $firstName $lastName
");


    $email3->addAttachment(
        base64_encode(file_get_contents($icsFile)),
        "text/calendar; method=REQUEST",
        "tour_reminder.ics",
        "attachment"
    );



            $sendgrid = new \SendGrid('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');
            try {
                $response1 = $sendgrid->send($email1);
                $response2 = $sendgrid->send($email2);
				$response3 = $sendgrid->send($email3);
            } catch (Exception $e) {
                echo 'Email sending error: ' . $e->getMessage();
            }

        $sorgu = $baglanti->prepare(
            "SELECT * FROM users"
        );
        $sorgu->execute();

        $phoneNumbers = [];
        while ($sonuc = $sorgu->fetch()) {
            $formattedPhone = "whatsapp:+1" . $sonuc["number"];
            $phoneNumbers[] = $formattedPhone;
        }

        $message =
            "Scheduled Hourly Pedicab Service available!
{" . $bookingNumber . "}";
        foreach ($phoneNumbers as $phoneNumberwp) {
            $messageSid = sendWhatsAppMessage($twilio, $phoneNumberwp, $message);
            // echo "Message sent, SID: $messageSid<br>";
        }
		
		       $sorgu = $baglanti->prepare("SELECT * FROM users");
        $sorgu->execute();

        $phoneNumbers = [];
        while ($sonuc = $sorgu->fetch()) { 
            $formattedPhone = "+1" . $sonuc['number'];
            $phoneNumbers[] = $formattedPhone;
        }
	foreach ($phoneNumbers as $phoneNumberwp) {
                $messageSid = sendTextMessage($twilio, $phoneNumberwp, $message);
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
