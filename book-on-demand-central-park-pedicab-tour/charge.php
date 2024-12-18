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

    // Assign the data retrieved from the database to variables
    $firstName = $booking["first_name"];
    $lastName = $booking["last_name"];
    $emailAddress = $booking["email"];
    $phoneNumber = $booking["phone_number"];
    $numPassengers = $booking["num_passengers"];
    $pickUpAddress = $booking["pick_up_address"];
    $destinationAddress = $booking["destination_address"];
    $paymentMethod = $booking["payment_method"];
    $rideDuration = $booking["ride_duration"];
    $bookingFee = $booking["booking_fee"];
    $driverFare = $booking["driver_fare"];
    $totalFare = $booking["total_fare"];
    $operationFare = $booking["operation_fare"];
    $hourlyOperationFare = $booking["hourly_operation_fare"];
    $tourDuration = $booking["tour_duration"];
    $pickup1 = $booking["pickup1"];
    $pickup2 = $booking["pickup2"];
    $return1 = $booking["return1"];
    $return2 = $booking["return2"];
    $toursuresi = $booking["toursuresi"];
    $countryCode = $booking["country_code"];	
	
    $phoneNumber = "+" . $countryCode . $phoneNumber;
	
	if ($tourDuration == 1) {
    $tourDuration2 = $tourDuration * 60;
} else {
    $tourDuration2 = $tourDuration;
}


    // Calculate total minutes
    $totalMinutes = $pickup1 + $pickup2 + $tourDuration2 + $return1 + $return2;

    // Convert total minutes to hours
    $operationDuration = $totalMinutes / 60;

    // Prepare formatted output
    $operationDurationFormatted = number_format($operationDuration, 2);

    $pickup11 = intval($pickup1); // Get pickup1 variable as integer

    // Create the current time in New York time zone
    $nyTimeZone = new DateTimeZone("America/New_York");
    $currentDateTime = new DateTime("now", $nyTimeZone);

    // current time
    $customerPaidTime = new DateTime("now", $nyTimeZone); // Current Time

    $pickup1Minutes = floor($pickup1);
    $pickup1Seconds = floor(($pickup1 - $pickup1Minutes) * 60);

    $tourTime = clone $customerPaidTime;
    $tourTime->add(new DateInterval("PT5M")); // + 5 minutes
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

    $apiKey = "AIzaSyB19a74p3hcn6_-JttF128c-xDZu18xewo";
    // Function to convert addresses to coordinates
    function getCoordinates($address, $apiKey)
    {
        // URL encode the address
        $address = urlencode($address);
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey";

        // Initiate HTTP request with cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        // Execute request and get the result
        $response = curl_exec($ch);
        curl_close($ch);

        // Decode the response as JSON
        $response = json_decode($response, true);

        // Get coordinates
        if ($response["status"] == "OK") {
            $geometry = $response["results"][0]["geometry"]["location"];
            return $geometry["lat"] . "," . $geometry["lng"];
        } else {
            return null; // Coordinates not found
        }
    }

    $date = new DateTime();

    // Get day value
    $pickUpDay = $date->format("l");
    $todayFormatted = $date->format("m/d/Y");
    $todayDay = $date->format("l");

    // Get coordinates for both addresses
    $pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
    $destinationCoords = getCoordinates($destinationAddress, $apiKey);

$currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));
$createdAt = $currentDateTime->format('Y-m-d H:i:s');
$formattedDate = $currentDateTime->format('m/d/Y');


$totalMinutes = number_format($totalMinutes, 2);

$rideDuration = number_format($rideDuration, 2);

if ($paymentMethod == "card"){
	$paymentMethod = "CARD";
	
}

    if ($firstName != "" && $lastName != "") {
        // Check that data fields are not empty
        // Data to be changed
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
            "operationFare" => $operationFare,
            "pickUpCoords" => $pickUpCoords,
			"tourDuration" => $tourDuration,
            "destinationCoords" => $destinationCoords,
			"createdAt" => $createdAt,
			"totalMinutes" => $totalMinutes,	
			"pickUpTime" => $tourTimeFormatted,
			"unique_id" => $unique_id,
        ];

$sql = "INSERT INTO centralpark (id, pickUpTime, totalMinutes, createdAt, bookingNumber, tourDuration, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, operationFare, pickUpCoords, destinationCoords, unique_id)
VALUES (:id, :pickUpTime, :totalMinutes, :createdAt, :bookingNumber, :tourDuration, :firstName, :lastName, :emailAddress, :phoneNumber, :numPassengers, :date, :pickupAddress, :destinationAddress, :paymentMethod, :duration, :bookingFee, :driverFee, :totalFare, :operationFare, :pickUpCoords, :destinationCoords, :unique_id)";

$statement = $baglanti->prepare($sql);

// Değişkenleri parametrelere bağlama
$statement->bindParam(':id', $uuid);
$statement->bindParam(':pickUpTime', $tourTimeFormatted);
$statement->bindParam(':totalMinutes', $totalMinutes);
$statement->bindParam(':createdAt', $createdAt);
$statement->bindParam(':bookingNumber', $bookingNumber);
$statement->bindParam(':tourDuration', $tourDuration);
$statement->bindParam(':firstName', $firstName);
$statement->bindParam(':lastName', $lastName);
$statement->bindParam(':emailAddress', $emailAddress);
$statement->bindParam(':phoneNumber', $phoneNumber);
$statement->bindParam(':numPassengers', $numPassengers);
$statement->bindParam(':date', $formattedDate);
$statement->bindParam(':pickupAddress', $pickUpAddress);
$statement->bindParam(':destinationAddress', $destinationAddress);
$statement->bindParam(':paymentMethod', $paymentMethod);
$statement->bindParam(':duration', $rideDuration);
$statement->bindParam(':bookingFee', $bookingFee);
$statement->bindParam(':driverFee', $driverFare);
$statement->bindParam(':totalFare', $totalFare);
$statement->bindParam(':operationFare', $operationFare);
$statement->bindParam(':pickUpCoords', $pickUpCoords);
$statement->bindParam(':destinationCoords', $destinationCoords);
$statement->bindParam(':unique_id', $unique_id);

    $durum = $statement->execute();
		
if ($paymentMethod == "CARD" or $paymentMethod == "card"){
				$paymentMethod2 = "debit/credit card";
			}
			if ($paymentMethod == "CASH" or $paymentMethod == "cash"){
				$paymentMethod2 = "CASH";
			}
			
			
if ($tourDuration == 60){
	$tourDuration = "1 Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)";
}
else {
	if ($tourDuration == 50){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill + Strawberry Fields)";
	}
	else if ($tourDuration == 45){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill)";
	}
	else if ($tourDuration == 40){
		$tourDuration = $tourDuration . " Minutes (Non Stop)";
	}
}
        $dateDriver = DateTime::createFromFormat("m/d/Y", $formattedDate);

        if ($dateDriver) {
            // Format to get the date in the desired format
            $driverDate = $dateDriver->format("F d l");
        }

        if ($durum) {
			
			
			
			
            $email1 = new \SendGrid\Mail\Mail();
            $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
            $email1->setSubject(
                "On Demand Central Park Pedicab Tour - " . $bookingNumber
            );
            $email1->addTo("info@newyorkpedicabservices.com", "NYPS");
			
			
$rideDuration = number_format($rideDuration, 2);

            $htmlContent1 = <<<EOD
<html>
<body>
    <h1>Booking Details</h1>
    <p><strong>Booking Number:</strong> $bookingNumber</p>
    <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-on-demand-central-park-pedicab-tour/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>    
    <p><strong>Type:</strong> On Demand Central Park Pedicab Tour</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>
    <p><strong>Date of Tour:</strong> $orderMonth/$orderDay/$orderYear $dayOfOrder (Today)</p>
    <p><strong>Time of Tour:</strong> $tourTimeFormatted</p>     
    <p><strong>Pick Up 1 (Hub 1 to Start) Duration:</strong> {$pickup1} Minutes</p>
    <p><strong>Pick Up 2 (Start to Hub 2) Duration:</strong> {$pickup2} Minutes</p>
    <p><strong>Duration of Tour:</strong> $tourDuration</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Return 1 (Hub 1 to Finish) Duration:</strong> {$return1} Minutes</p>
    <p><strong>Return 2 (Finish to Hub 2) Duration:</strong> {$return2} Minutes</p>   
    <p><strong>Operation Duration:</strong> {$operationDurationFormatted} Hour</p>
    <p><strong>Hub 1:</strong> West Drive and West 59th Street New York, NY 10019</p>
    <p><strong>Hub 2:</strong> 6th Avenue and Central Park South New York, NY 10019</p> 
	<p><strong>Operation Rate:</strong> \${$hourlyOperationFare}</p>
    <p><strong>Operation Fare:</strong> \${$operationFare}</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>    
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod2 due on $todayFormatted $todayDay</p>
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
    <h2>Driver Note</h2>
<strong>Type:</strong> On Demand Central Park Pedicab Tour<br>
<strong>Name:</strong> $firstName $lastName<br>
<strong>Cell:</strong> $phoneNumber<br>
<strong>Passengers:</strong> $numPassengers<br>
<strong>Date:</strong> $driverDate (Today)<br>
<strong>Time:</strong> $tourTimeFormatted<br>
<strong>Tour Duration:</strong> $tourDuration<br>
<strong>Ride Duration:</strong> {$rideDuration} Minutes<br>
<strong>Start:</strong> $pickUpAddress<br>
<strong>Finish:</strong> $destinationAddress<br>
<strong>Pay:</strong> \${$driverFare} with $paymentMethod2 by customer $firstName $lastName

</body>
</html>
EOD;




            $email1->addContent("text/html", $htmlContent1);

            // Second E-Mail
            $email2 = new \SendGrid\Mail\Mail();
            $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
            $email2->setSubject(
                "CONFIRMATION: On Demand Central Park Pedicab Tour - " .
                    $bookingNumber
            );
            $email2->addTo($emailAddress, "NYPS");

            $htmlContent2 = <<<EOD
<html>
<body>
    <h1>Booking Details</h1>
    <p><strong>Thank you for choosing New York Pedicab Services</strong></p>
    <p><strong>Below are the confirmed details of your booking:</strong></p>
    <p><strong>Type:</strong> On Demand Central Park Pedicab Tour</p>
    <p><strong>First Name:</strong> $firstName</p>
    <p><strong>Last Name:</strong> $lastName</p>
    <p><strong>Email Address:</strong> $emailAddress</p>
    <p><strong>Phone Number:</strong> $phoneNumber</p>
    <p><strong>Number of Passengers:</strong> $numPassengers</p>  
    <p><strong>Date of Tour:</strong> $orderMonth/$orderDay/$orderYear $dayOfOrder (Today)</p>
    <p><strong>Time of Tour:</strong> $tourTimeFormatted</p>        
    <p><strong>Duration of Tour:</strong> $tourDuration</p>   
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>   
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod2 due on $todayFormatted $todayDay</p>
	<p><strong>Total Fare:</strong> \${$totalFare}</p>
    <p><strong>Thank you,</strong></p>
    <p><strong>New York Pedicab Services</strong></p>
    <p><strong>(212) 961-7435</strong></p>
    <p><strong>info@newyorkpedicabservices.com</strong></p>
</body>
</html>
EOD;

            $email2->addContent("text/html", $htmlContent2);

            $sendgrid = new \SendGrid(
                "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"
            );
            try {
                // Send the first email
                $response1 = $sendgrid->send($email1);
                // print $response1->statusCode() . "\n";
                //print_r($response1->headers());
                //print $response1->body() . "\n";

                // Send the second email
                $response2 = $sendgrid->send($email2);
                //print $response2->statusCode() . "\n";
                //print_r($response2->headers());
                //print $response2->body() . "\n";
            } catch (Exception $e) {
                //echo 'Caught exception: '. $e->getMessage() ."\n";
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
                "On Demand Central Park Pedicab Tour available!
{" .  $bookingNumber .  "}";

            // Send message to each phone number
            foreach ($phoneNumbers as $phoneNumberwp) {
                $messageSid = sendWhatsAppMessage(
                    $twilio,
                    $phoneNumberwp,
                    $message
                );
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
                "current_time" => $tourTimeFormatted,
                "tourDuration" => $tourDuration,
                "pickUpDate" => $formattedDate,
				"bookingNumber" => $bookingNumber,
            ];
            $form =
                '<form id="completedForm" action="completed.php" method="post">';
            foreach ($postData as $key => $value) {
                $form .=
                    '<input type="hidden" name="' .
                    htmlspecialchars($key ?? "") .
                    '" value="' .
                    htmlspecialchars($value ?? "") .
                    '">';
            }
            $form .= "</form>";
            $form .=
                '<script>document.getElementById("completedForm").submit();</script>';
            echo $form;
            exit();
        } else {
            echo "Edit error occurred: "; // If ID is not found or there is an error in the query, print the error.
        }
    } else {
        echo "An error occurred: " . $hata; // Return error according to file error and form fields being empty.
    }
    if ($hata != "") {
        echo '<script>swal("Error","' . $hata . '","error");</script>';
    }
    ?>
</body>
</html>
