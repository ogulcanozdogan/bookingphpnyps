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

    // Pull data from database
    $stmt = $pdo->prepare("SELECT * FROM temporaryBookings WHERE unique_id = :unique_id");
    $stmt->execute([':unique_id' => $unique_id]);
    $booking = $stmt->fetch();

    if (!$booking) {
        die("Booking not found.");
    }


// Get date and time information from the form
$firstName = $booking["first_name"]; // default value 1
$lastName = $booking["last_name"]; // default value 1
$emailAddress = $booking["email"]; // default value 1
$phoneNumber = $booking["phone_number"]; // default value 1
$numPassengers = $booking["num_passengers"]; // default value 1
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
$returnDuration = $booking["return_duration"];
$pickUpDuration = $booking["pick_up_duration"];
$hub = $booking["hub"];
$baseFare = $booking["base_fare"];
$operationFare = $booking["operation_fare"];
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

$totalMinutes = $rideDuration + $pickUpDuration + $returnDuration; // Calculate the total minutes
$operationDuration = $totalMinutes / 60; // Convert minutes to hours

// Biçimlendirme ve ekranda görüntüleme
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

$apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo";
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
if ($hub == "West Drive and West 59th Street New York, NY 10019"){
	$hubCoords = '40.766941088678855, -73.97899952992152';
}
else {
	$hubCoords = getCoordinates($hub, $apiKey);
}

$paymentMethod = strtoupper($paymentMethod);


$rideDuration = number_format($rideDuration, 2);

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
		"unique_id" => $unique_id,
		"totalMinutes" => $totalMinutes,
		"createdAt" => $createdAt,		
    ];

$sql = "INSERT INTO pointatob (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration, pickUpDuration, hub, baseFare, operationFare, pickUpCoords, destinationCoords, hubCoords, unique_id, totalMinutes, createdAt)
VALUES (:id, :bookingNumber, :firstName, :lastName, :emailAddress, :phoneNumber, :numPassengers, :pickUpDate, :hours, :minutes, :ampm, :pickUpAddress, :destinationAddress, :paymentMethod, :rideDuration, :bookingFee, :driverFare, :totalFare, :returnDuration, :pickUpDuration, :hub, :baseFare, :operationFare, :pickUpCoords, :destinationCoords, :hubCoords, :unique_id, :totalMinutes, :createdAt)";

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
$statement->bindParam(':baseFare', $baseFare);
$statement->bindParam(':operationFare', $operationFare);
$statement->bindParam(':pickUpCoords', $pickUpCoords);
$statement->bindParam(':destinationCoords', $destinationCoords);
$statement->bindParam(':hubCoords', $hubCoords);
$statement->bindParam(':unique_id', $unique_id);
$statement->bindParam(':totalMinutes', $totalMinutes);
$statement->bindParam(':createdAt', $createdAt);

// Sorguyu çalıştırma
$durum = $statement->execute();

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
    <h1>BOOKING DETAILS</h1>
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
    <p><strong>Operation Duration:</strong> {$operationDurationFormatted} Hour</p>
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
    <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText</p>
	<p><strong>Total Fare:</strong> \${$totalFare} paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;
        } else {
			if ($paymentMethod == "CARD"){
				$paymentMethod2 = "debit/credit card";
			}
			else if ($paymentMethod == "CASH"){
				$paymentMethod2 = "CASH";
			}
            $htmlContent1 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;
            $htmlContent1 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText with $paymentMethod2 due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
	<p><strong>Total Fare:</strong> \${$totalFare}</p>
EOD;
        }

        $dateDriver = DateTime::createFromFormat("m/d/Y", $pickUpDate);

        if ($dateDriver) {
            // Format to get the date in the desired format
            $driverDate = $dateDriver->format("F d l");
        }

        if ($paymentMethod != "FULLCARD") {
			$paymentMethod2 = "debit/credit card";
			if ($paymentMethod == "CASH"){
			$paymentMethod2 = "CASH";
			}
            $htmlContent1 .= <<<EOD
    <h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Point A to B Pedicab Ride<br><strong>Name:</strong> $firstName $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong> $driverDate<br><strong>Time:</strong> $timeOfPickUp<br><strong>Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \$$driverFarePerDriver per driver with $paymentMethod2 by customer $firstName $lastName
</body>
</html>
EOD;
        } else {
			if ($paymentMethod == "CARD"){
				$paymentMethod2 = "debit/credit card";
			}
            $htmlContent1 .= <<<EOD
    <h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Point A to B Pedicab Ride<br><strong>Name:</strong> $firstName $lastName<br><strong>Cell:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong> $driverDate<br><strong>Time:</strong> $timeOfPickUp<br><strong>Duration:</strong> {$rideDuration} Minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \$$driverFarePerDriver per driver with Zelle by Ibrahim Donmez
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
    <p><strong>Thank you for choosing New York Pedicab Services</strong></p>
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
			if ($paymentMethod == "CASH"){
			$paymentMethod2 = "CASH";
			}
			if ($paymentMethod == "card" or $paymentMethod == "CARD"){
			$paymentMethod2 = "debit/credit card";
			}
            $htmlContent2 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
EOD;

            $htmlContent2 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText with $paymentMethod2 due on $pickUpMonth/$pickUpDay/$pickUpYear $dayOfWeek</p>
EOD;
        }

        if ($paymentMethod == "FULLCARD") {
			$paymentMethod2 = "debit/credit card";
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

// $dateTimeEnd nesnesine tam dakika ve saniyeleri ekliyoruz.
$dateTimeEnd->modify("+$minutes minutes"); // Tam dakika ekleme


$source = "Scheduled Point A to B Pedicab Ride";

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
$icsContent .= "SUMMARY:" . $source . " " . $firstName . " " . $lastName . "\r\n";
$icsContent .= "DESCRIPTION:" . $source . " " . $firstName . " " . $lastName . "\r\n";
$icsContent .= "LOCATION:6th Avenue & 57th Street, New York, NY\r\n";

// Hatırlatma bildirimleri
$icsContent .= "BEGIN:VALARM\r\n";
$icsContent .= "TRIGGER:-PT20H\r\n";
$icsContent .= "ACTION:DISPLAY\r\n";
$icsContent .= "DESCRIPTION:" . $source . " " . $firstName . " " . $lastName . " reminder\r\n";
$icsContent .= "END:VALARM\r\n";
$icsContent .= "END:VEVENT\r\n";
$icsContent .= "END:VCALENDAR\r\n";

$icsFile = tempnam(sys_get_temp_dir(), 'calendar') . '.ics';
file_put_contents($icsFile, $icsContent);

// SendGrid ile e-posta gönderme
$email3 = new \SendGrid\Mail\Mail();
$email3->setFrom("info@newyorkpedicabservices.com", "New York Pedicab Services");
$email3->setSubject("REMINDER: " . $source . " - " . $firstName . " " . $lastName);
$email3->addTo('info@newyorkpedicabservices.com', 'NYPS');

        if ($paymentMethod != "FULLCARD") {
			$paymentMethod2 = "debit/credit card";
			if ($paymentMethod == "CASH"){
			$paymentMethod2 = "CASH";
			}
            $htmlContent3 = "<h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Point A to B Pedicab Ride<br>
	<strong>Name:</strong> $firstName $lastName<br>
	<strong>Cell:</strong> $phoneNumber<br>
	<strong>Passengers:</strong> $numPassengers<br>
	<strong>Date:</strong> $driverDate<br>
	<strong>Time:</strong> $timeOfPickUp<br>
	<strong>Duration:</strong> {$rideDuration} Minutes<br>
	<strong>Start:</strong> $pickUpAddress<br>
	<strong>Finish:</strong> $destinationAddress<br>
	<strong>Pay:</strong> \$$driverFarePerDriver per driver with $paymentMethod2 by customer $firstName $lastName";
        } else {
			if ($paymentMethod == "CARD"){
				$paymentMethod2 = "debit/credit card";
			}
            $htmlContent3 = "<h2>Driver Note</h2>
    <strong>Type:</strong> Scheduled Point A to B Pedicab Ride<br>
	<strong>Name:</strong> $firstName $lastName<br>
	<strong>Cell:</strong> $phoneNumber<br>
	<strong>Passengers:</strong> $numPassengers<br>
	<strong>Date:</strong> $driverDate<br>
	<strong>Time:</strong> $timeOfPickUp<br>
	<strong>Duration:</strong> {$rideDuration} Minutes<br>
	<strong>Start:</strong> $pickUpAddress<br>
	<strong>Finish:</strong> $destinationAddress<br>
	<strong>Pay:</strong> \$$driverFarePerDriver per driver with Zelle by Ibrahim Donmez";
	}

$email3->addContent("text/html", $htmlContent3);


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

        while ($sonuc = $sorgu->fetch()) {
            // Add WhatsApp format to the phone number
            $formattedPhone = "whatsapp:+1" . $sonuc["number"];
            $phoneNumbers[] = $formattedPhone;
        }

        $message =
            "Scheduled Point A to B Pedicab Ride available!
{" . $bookingNumber . "}";

        // Send message to each phone number
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
            "pickUpDate" => $pickUpDate,
            "bookingNumber" => $bookingNumber,
            "timeOfPickUp" => $timeOfPickUp,
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
