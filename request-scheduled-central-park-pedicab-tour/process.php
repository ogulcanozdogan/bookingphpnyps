<?php
include('inc/init.php');
require_once "vendor/autoload.php";
require_once "inc/db.php";

if (!$_POST) {
    header("location: index.php");
    exit;
}

$firstName = htmlspecialchars($_POST["firstName"]);
$lastName = htmlspecialchars($_POST["lastName"]);
$emailAddress = htmlspecialchars($_POST["email"]);
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
$numPassengers = htmlspecialchars($_POST["numPassengers"]);
$pickUpDate = htmlspecialchars($_POST["pickUpDate"]);
$timeOfPickUp = htmlspecialchars($_POST["hours"] . ":" . $_POST["minutes"] . " " . $_POST["ampm"]);
$pickUpAddress = htmlspecialchars($_POST["pickUpAddress"]);
$destinationAddress = htmlspecialchars($_POST["destinationAddress"]);
$downPayment = htmlspecialchars($_POST["downPayment"]);
$paymentMethod = htmlspecialchars($_POST["paymentMethod"]);
$serviceDuration = htmlspecialchars($_POST["serviceDuration"]);
$serviceDetails = htmlspecialchars($_POST["serviceDetails"]);

    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
	
		    $phoneNumber = "+" . $countryCode . $phoneNumber;
  $pickUpDate = date("m/d/Y", strtotime($pickUpDate));
  $pickUpDay = date("l", strtotime($pickUpDate));


if ($downPayment == "zelle") {
    $downPaymentDescription = "I will pay the booking fee with Zelle (No fee)";
} elseif ($downPayment == "venmo") {
    $downPaymentDescription = "I will pay the booking fee with Venmo (No Fee)";
} elseif ($downPayment == "card") {
    $downPaymentDescription = "I will pay the booking fee with debit/credit card (10% fee applies to the booking fee)";
}

// Ödeme yöntemi açıklamasını belirle
if ($paymentMethod == "CASH") {
    $paymentDescription = "I will pay the driver cash";
} elseif ($paymentMethod == "card") {
    $paymentDescription = "I will pay the driver with debit/credit card (10% fee applies to the driver fare)";
} elseif ($paymentMethod == "fullcard") {
    $paymentDescription = "I will pay all upfront to New York Pedicab Services and New York Pedicab Services will pay the driver (20% fee applies to the full fare)";
}

function generateUUID()
{
    return bin2hex(random_bytes(16));
}

$uuid = generateUUID();
$kisauuid = substr($uuid, 0, 16);

date_default_timezone_set('America/New_York');

// Geçerli zamanı al
$currentDateTime = new DateTime();

$requestYear = $currentDateTime->format('Y');
$requestMonth = $currentDateTime->format('m');
$requestDay = $currentDateTime->format('d');

$requestHour = $currentDateTime->format('H');
$requestMinute = $currentDateTime->format('i');


$requestTimeOfOrder = $requestHour . '-' . $requestMinute;

// POST verilerini al
$pickUpHour = isset($_POST["hours"]) ? intval($_POST["hours"]) : 0;
$pickUpMinute = isset($_POST["minutes"]) ? str_pad($_POST["minutes"], 2, "0", STR_PAD_LEFT) : '00';
$ampm = isset($_POST["ampm"]) ? strtolower($_POST["ampm"]) : 'am';

// 12 saat formatından 24 saat formatına dönüştürme
if ($ampm === 'pm' && $pickUpHour < 12) {
    $pickUpHour += 12;
} elseif ($ampm === 'am' && $pickUpHour == 12) {
    $pickUpHour = 0; // 12 AM, 24 saat formatında 00:00'a karşılık gelir
}

// Saat ve dakikayı 2 basamaklı olarak formatla
$pickUpHour = str_pad($pickUpHour, 2, "0", STR_PAD_LEFT); // Saat değişkeni
$pickUpMinute = str_pad($pickUpMinute, 2, "0", STR_PAD_LEFT); // Dakika değişkeni

// Tarihi DateTime nesnesi olarak oluştur
$dateObject = DateTime::createFromFormat('m/d/Y', $pickUpDate);

// Yeni formatta tarihi al (Y-m-d formatı)
$formattedPickUpDate = $dateObject ? $dateObject->format('Y-m-d') : '';

// Create the booking number according to the new format
$requestNumber =
    $formattedPickUpDate .
    "-" .
    $pickUpHour .
	"-".
	$pickUpMinute .
    "-" .
    $requestYear .
    "-" .
    $requestMonth .
    "-" .
    $requestDay .
    "-" .
    $requestTimeOfOrder .
    "-" .
    $kisauuid;
	
	

// NYPS için e-posta içeriğini hazırla
$nypsContent = <<<EOD
<html>
<body>
    <h2>Scheduled Central Park Pedicab Tour Request</h2>
	<p><strong>Request Number = </strong> $requestNumber</p>
    <p><strong>First Name = </strong> $firstName</p>
    <p><strong>Last Name = </strong> $lastName</p>
    <p><strong>Email Address = </strong> $emailAddress</p>
    <p><strong>Phone Number = </strong> $phoneNumber</p>
    <p><strong>Number of Passengers = </strong> $numPassengers</p>
    <p><strong>Date of Tour = </strong> $pickUpDate ($pickUpDay)</p>
    <p><strong>Time of Tour = </strong> $timeOfPickUp</p>
	<p><strong>Duration of Tour = </strong> $serviceDuration</p>
    <p><strong>Start Address = </strong> $pickUpAddress</p>
    <p><strong>Finish Address = </strong> $destinationAddress</p>
	<p><strong>Tour Details = </strong> $serviceDetails</p>
	<p><strong>Down Payment = </strong> $downPaymentDescription</p>
    <p><strong>Driver Payment = </strong> $paymentDescription</p>
</body>
</html>
EOD;

// Müşteri için e-posta içeriğini hazırla
$customerContent = <<<EOD
<html>
<body>
    <h2>Scheduled Central Park Pedicab Tour Request</h2>
	<p><strong>Request Number = </strong> $requestNumber</p>
    <p><strong>First Name = </strong> $firstName</p>
    <p><strong>Last Name = </strong> $lastName</p>
    <p><strong>Email Address = </strong> $emailAddress</p>
    <p><strong>Phone Number = </strong> $phoneNumber</p>
    <p><strong>Number of Passengers = </strong> $numPassengers</p>
    <p><strong>Date of Tour = </strong> $pickUpDate ($pickUpDay)</p>
    <p><strong>Time of Tour = </strong> $timeOfPickUp</p>
	<p><strong>Duration of Tour = </strong> $serviceDuration</p>
    <p><strong>Start Address = </strong> $pickUpAddress</p>
    <p><strong>Finish Address = </strong> $destinationAddress</p>
	<p><strong>Tour Details = </strong> $serviceDetails</p>
	<p><strong>Down Payment = </strong> $downPaymentDescription</p>
    <p><strong>Driver Payment = </strong> $paymentDescription</p>
    <br>
    <p>We confirm that we received your request.</p>
    <p>We will get back to you as soon as we can.</p>
    <br>
    <p>Thank you,</p>
    <p><strong>New York Pedicab Services</strong></p>
    <p><strong>Phone: (212) 961-7435</strong></p>
</body>
</html>
EOD;

// SendGrid API anahtarı
$sendgrid = new \SendGrid('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');

// NYPS için e-postayı gönder
$email1 = new \SendGrid\Mail\Mail();
$email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
$email1->setSubject("Scheduled Central Park Pedicab Tour Request - " . $requestNumber);
$email1->addTo("info@newyorkpedicabservices.com", "NYPS");
$email1->addContent("text/html", $nypsContent);

try {
    $response1 = $sendgrid->send($email1);
} catch (Exception $e) {
    // NYPS e-posta gönderim hatası işleme
}

// Müşteri için e-postayı gönder
$email2 = new \SendGrid\Mail\Mail();
$email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
$email2->setSubject("Scheduled Central Park Pedicab Tour Request - " . $requestNumber);
$email2->addTo($emailAddress, "$firstName $lastName");
$email2->addContent("text/html", $customerContent);

try {
    $response2 = $sendgrid->send($email2);
} catch (Exception $e) {
    // Müşteri e-posta gönderim hatası işleme
}

try {
    // New York zaman dilimini ayarlayın
    $dateTimeNY = new DateTime('now', new DateTimeZone('America/New_York'));
    $nyDateTimeFormatted = $dateTimeNY->format('Y-m-d H:i:s');

    $sql = "INSERT INTO scheduled_central_requests (
                requestNumber, first_name, last_name, email, phone_number, 
                num_passengers, pick_up_date, hours, minutes, am_pm, service_duration,
                pick_up_address, destination_address, service_details, down_payment, payment_method, created_at
            ) VALUES (
                :requestNumber, :first_name, :last_name, :email, :phone_number, 
                :num_passengers, :pick_up_date, :hours, :minutes, :am_pm, :service_duration, 
                :pick_up_address, :destination_address, :service_details, :down_payment, :payment_method, :ny_datetime
            )";

    $stmt = $baglanti->prepare($sql);
    
    $stmt->bindParam(':requestNumber', $requestNumber);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':email', $emailAddress);
    $stmt->bindParam(':phone_number', $phoneNumber);
    $stmt->bindParam(':num_passengers', $numPassengers, PDO::PARAM_INT);
    $stmt->bindParam(':pick_up_date', $formattedPickUpDate);
    $stmt->bindParam(':hours', $_POST["hours"], PDO::PARAM_INT);
    $stmt->bindParam(':minutes', $_POST["minutes"]);
    $stmt->bindParam(':am_pm', $ampm);
	$stmt->bindParam(':service_duration', $serviceDuration);
    $stmt->bindParam(':pick_up_address', $pickUpAddress);
    $stmt->bindParam(':destination_address', $destinationAddress);
	$stmt->bindParam(':service_details', $serviceDetails);
	$stmt->bindParam(':down_payment', $downPayment);
    $stmt->bindParam(':payment_method', $paymentMethod);
    $stmt->bindParam(':ny_datetime', $nyDateTimeFormatted);

    $stmt->execute();
    
    
} catch (PDOException $e) {
    echo $e->getMessage();
}



// POST ile completed.php'ye yönlendirme
echo "<form id='redirectForm' action='completed.php' method='POST'>";
echo "<input type='hidden' name='requestNumber' value='".htmlspecialchars($requestNumber)."'>";
echo "<input type='hidden' name='firstName' value='".htmlspecialchars($firstName)."'>";
echo "<input type='hidden' name='lastName' value='".htmlspecialchars($lastName)."'>";
echo "<input type='hidden' name='emailAddress' value='".htmlspecialchars($emailAddress)."'>";
echo "<input type='hidden' name='phoneNumber' value='".htmlspecialchars($phoneNumber)."'>";
echo "<input type='hidden' name='numPassengers' value='".htmlspecialchars($numPassengers)."'>";
echo "<input type='hidden' name='pickUpDate' value='".htmlspecialchars($pickUpDate)."'>";
echo "<input type='hidden' name='pickUpDay' value='".htmlspecialchars($pickUpDay)."'>";
echo "<input type='hidden' name='timeOfPickUp' value='".htmlspecialchars($timeOfPickUp)."'>";
echo "<input type='hidden' name='pickUpAddress' value='".htmlspecialchars($pickUpAddress)."'>";
echo "<input type='hidden' name='destinationAddress' value='".htmlspecialchars($destinationAddress)."'>";
echo "<input type='hidden' name='downPaymentDescription' value='".htmlspecialchars($downPaymentDescription)."'>";
echo "<input type='hidden' name='paymentDescription' value='".htmlspecialchars($paymentDescription)."'>";
echo "<input type='hidden' name='serviceDuration' value='".htmlspecialchars($serviceDuration)."'>";
echo "<input type='hidden' name='serviceDetails' value='".htmlspecialchars($serviceDetails)."'>";
echo "</form>";
echo "<script>document.getElementById('redirectForm').submit();</script>";
exit;

exit;
?>
