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
            $_GET["operationFare"],
            $_GET["tourDuration"],
            $_GET["pickup1"],
            $_GET["pickup2"],
            $_GET["return1"],
            $_GET["return2"],
            $_GET["toursuresi"]
        )
    ) {
        header("Location: index.php");
        exit();
    }

    // Get date and time information from the form
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
    $operationFare = $_GET["operationFare"];
    $tourDuration = $_GET["tourDuration"];
    $pickup1 = $_GET["pickup1"];
    $pickup2 = $_GET["pickup2"];
    $return1 = $_GET["return1"];
    $return2 = $_GET["return2"];
    $toursuresi = $_GET["toursuresi"];
	
	if ($serviceDuration == 1) {
    $serviceDuration2 = $serviceDuration * 60;
} else {
    $serviceDuration2 = $serviceDuration;
}


    // Calculate total minutes
    $totalMinutes = $pickup1 + $pickup2 + $return1 + $return2 + $rideDuration + $tourDuration + $serviceDuration2;

    // Convert total minutes to hours
    $operationDuration = $totalMinutes / 60;

    // Prepare formatted output
    $operationDurationFormatted = number_format($operationDuration, 2);

    $pickup11 = intval($pickup1); // Get pickup1 variable as integer

    // Create the current time in New York time zone
    $nyTimeZone = new DateTimeZone("America/New_York");
    $currentDateTime = new DateTime("now", $nyTimeZone);

    // Mevcut zaman
    $customerPaidTime = new DateTime("now", $nyTimeZone); // Şu anki zaman

    $pickup1Minutes = floor($pickup1);
    $pickup1Seconds = floor(($pickup1 - $pickup1Minutes) * 60);

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

    // Gün değerini al
    $pickUpDay = $date->format("l");
    $todayFormatted = $date->format("m/d/Y");
    $todayDay = $date->format("l");

    // Get coordinates for both addresses
    $pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
    $destinationCoords = getCoordinates($destinationAddress, $apiKey);

    $formattedDate = $currentDateTime->format("m/d/Y");

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
            "destinationCoords" => $destinationCoords,
        ];

        $sql = "INSERT INTO centralpark (id, bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, operationFare, pickUpCoords, destinationCoords)
                VALUES ('$uuid','$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$formattedDate', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$operationFare', '$pickUpCoords', '$destinationCoords')";
        $durum = $baglanti->prepare($sql)->execute();

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
    <p><strong>Date of Tour:</strong> $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
    <p><strong>Time of Tour:</strong> As Soon As Possible</p>     
    <p><strong>Pick Up 1 (Hub 1 to Start) Duration:</strong> {$pickup1} Minutes</p>
    <p><strong>Pick Up 2 (Start to Hub 2) Duration:</strong> {$pickup2} Minutes</p>
    <p><strong>Duration of Tour:</strong> {$tourDuration} Minutes</p>
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Return 1 Duration:</strong> {$return1} Minutes</p>
    <p><strong>Return 2 Duration:</strong> {$return2} Minutes</p>   
    <p><strong>Operation Duration:</strong> {$operationDurationFormatted} Hour</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>
    <p><strong>Hub 1:</strong> West Drive and West 59th Street New York, NY 10019</p>
    <p><strong>Hub 2:</strong> 6th Avenue and Central Park South New York, NY 10019</p>             
    <p><strong>Operation Fare:</strong> \${$operationFare}</p>
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $todayFormatted $todayDay</p>
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
    <h2>Driver Note</h2>
    <p><strong>Type:</strong> On Demand Central Park Pedicab Tour</p>
    <p><strong>First:</strong> $firstName</p>
    <p><strong>Last:</strong> $lastName</p>
    <p><strong>Phone:</strong> $phoneNumber</p>
    <p><strong>Passengers:</strong> $numPassengers</p>
    <p><strong>Date:</strong> $todayFormatted $todayDay</p>
    <p><strong>Time:</strong> $tourTimeFormatted</p>
    <p><strong>Tour Duration:</strong> $tourDuration Minutes</p>
    <p><strong>Ride Duration:</strong> {$rideDuration} Minutes</p>
    <p><strong>Start:</strong> $pickUpAddress</p>
    <p><strong>Finish:</strong> $destinationAddress</p>
    <p><strong>Pay:</strong> \${$driverFare} with strtoupper($paymentMethod) by customer $firstName $lastName</p>
</body>
</html>
EOD;




            $email1->addContent("text/html", $htmlContent1);

            // İkinci E-posta
            $email2 = new \SendGrid\Mail\Mail();
            $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
            $email2->setSubject(
                "CONFIRMATION: On Demand Central Park Pedicab Ride - " .
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
    <p><strong>Date of Tour:</strong> $orderMonth/$orderDay/$orderYear $dayOfOrder</p>
    <p><strong>Time of Tour:</strong> As Soon As Possible</p>        
    <p><strong>Duration of Tour:</strong> {$tourDuration} Minutes</p>   
    <p><strong>Duration of Ride:</strong> {$rideDuration} Minutes</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>   
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayFormatted $todayDay</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod due on $todayFormatted $todayDay</p>
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
                "SELECT * FROM users WHERE perm = 'driver'"
            );
            $sorgu->execute();

            $phoneNumbers = [];
            while ($sonuc = $sorgu->fetch()) {
                $formattedPhone = "whatsapp:+1" . $sonuc["number"];
                $phoneNumbers[] = $formattedPhone;
            }

            $message =
                "On Demand Central Park Pedicab Tour available!
{" .
                $bookingNumber .
                "}";

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
