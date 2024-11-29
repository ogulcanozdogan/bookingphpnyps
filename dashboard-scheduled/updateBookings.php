<?php 
include('inc/vt.php');
include_once('text.php');


function updatePastBookings($pdo) {
    $now = new DateTime("now", new DateTimeZone('America/New_York'));
    $currentDateTime = $now->format('Y-m-d H:i');

    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT bookingNumber, updated_at, totalMinutes FROM $table WHERE status = 'pending'");
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking) {
            $bookingNumber = $booking['bookingNumber'];
            $updatedAt = new DateTime($booking['updated_at']);
            $totalMinutes = (float)$booking['totalMinutes'];

            $interval = new DateInterval('PT' . (int)($totalMinutes * 60) . 'S');
            $updatedAt->add($interval);
            $bookingDateTime = $updatedAt->format('Y-m-d H:i');

            if ($bookingDateTime <= $currentDateTime) {
                $updateStmt = $pdo->prepare("UPDATE $table SET status = 'past', updated_at = :updated_at WHERE bookingNumber = :bookingNumber");
                $updateStmt->execute([':updated_at' => $currentDateTime, ':bookingNumber' => $bookingNumber]);
            }
        }
    }
}

updatePastBookings($baglanti);


function sendReminder($pdo) {
    global $twilio;
    // New York saat dilimi
    $now = new DateTime("now", new DateTimeZone('America/New_York'));
    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        // Tablo verilerini çekiyoruz
        $stmt = $pdo->query("SELECT * FROM $table WHERE reminder_sent = 0");
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking) {
            // Veritabanından gelen saat, dakika ve AM/PM'yi birleştirip datetime oluşturuyoruz
            $bookingDate = $booking['date']; // Format: MM/DD/YYYY
            $bookingHour = (int)$booking['hour']; // Saat
            $bookingMinutes = $booking['minutes']; // Dakika
            $bookingAmPm = $booking['ampm']; // AM/PM formatı

            // AM/PM formatını 24 saat formatına çevirme
            if ($bookingAmPm === 'PM' && $bookingHour != 12) {
                $bookingHour += 12;
            } elseif ($bookingAmPm === 'AM' && $bookingHour == 12) {
                $bookingHour = 0; // 12 AM durumu
            }

            // Rezervasyon tarihini ve saatini New York saatine göre oluşturma
            $bookingDateTimeStr = $bookingDate . ' ' . str_pad($bookingHour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($bookingMinutes, 2, '0', STR_PAD_LEFT);
            $bookingDateTime = DateTime::createFromFormat('m/d/Y H:i', $bookingDateTimeStr, new DateTimeZone('America/New_York'));

            // Tarih kontrolü: Sadece bugünkü rezervasyonlar için hatırlatma gönder
            if ($bookingDateTime->format('Y-m-d') !== $now->format('Y-m-d')) {
                continue; // Eğer bugünkü değilse, bu döngüyü atla
            }

            // Şu anki zamanla rezervasyon zamanı arasında fark hesaplama
            $interval = $now->diff($bookingDateTime);
            $hoursDifference = (int)$interval->format('%r%h'); // Saat farkı
            $minutesDifference = (int)$interval->format('%r%i'); // Dakika farkı

            // Eğer rezervasyon saatine 2 saat veya daha az kala ise, e-posta gönderme
            if ($hoursDifference < 2 || ($hoursDifference == 2 && $minutesDifference <= 0)) {
				
				if ($table == 'centralpark'){
                try {
                    // İlk E-posta oluşturma
                    $email1 = new \SendGrid\Mail\Mail();
                    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");

                    // E-posta içeriğini hazırlama
                    $firstName = $booking['firstName'];
                    $lastName = $booking['lastName'];
                    $emailAddress = $booking['emailAddress'];
                    $phoneNumber = $booking['phoneNumber'];
                    $numPassengers = $booking['numberOfPassengers'];
                    $pedicabCount = ceil($numPassengers / 3);
                    $driverFare = $booking['driverFee'];
                    $driverFarePerDriver = number_format($driverFare/$pedicabCount, 2);
                    $driverFarePerDriverText = ($pedicabCount != 1) ? '($' . $driverFarePerDriver . ' per driver)' : '';
                    $dateOfTour = $booking['date']; // Rezervasyon tarihi
                    $dayOfWeek = DateTime::createFromFormat('m/d/Y', $dateOfTour)->format('l');
                    $tourDuration = $booking['tourDuration'];
                    $tourDurationText = ($tourDuration == 1) ? "1 Hour" : $tourDuration . " Minutes";
                    $pickUpAddress = $booking['pickupAddress'];
                    $destinationAddress = $booking['destinationAddress'];
                    $totalFare = $booking['totalFare'];
                    $bookingFee = $booking['bookingFee'];
                    $bookingNumber = $booking['bookingNumber'];
                    $paymentMethod = $booking['paymentMethod'];
                    $paymentMethodText = ($paymentMethod == "card") ? "debit/credit card" : "CASH";
					$formattedHour = date("g", strtotime($bookingHour . ":00"));
					
					date_default_timezone_set('America/New_York');
					$todayMonth = date('m'); 
					$todayDay = date('d'); 
					$todayYear = date('Y'); 
					$todayDayName = date('l');

                    // E-posta başlığı ve içeriği
                    $email1->setSubject("REMINDER: Scheduled Central Park Pedicab Tour - " . $bookingNumber);
                    $htmlContent1 = <<<EOD
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
    <p><strong>Date of Tour:</strong> $dateOfTour $dayOfWeek</p>
    <p><strong>Time of Tour:</strong> $formattedHour:$bookingMinutes $bookingAmPm</p>
    <p><strong>Duration of Tour:</strong> $tourDurationText</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayMonth/$todayDay/$todayYear $todayDay</p>
    <p><strong>Driver Fare:</strong> \$$driverFare $driverFarePerDriverText with $paymentMethodText due on $dateOfTour $dayOfWeek</p>
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
    <p><strong>Thank you,</strong></p>
    <p><strong>New York Pedicab Services</strong></p>
    <p><strong>(212) 961-7435</strong></p>
    <p><strong>info@newyorkpedicabservices.com</strong></p>
</body>
</html>
EOD;

                    $email1->addTo($emailAddress, $firstName);
                    $email1->addContent("text/html", $htmlContent1);

                    // SendGrid ile e-posta gönderimi
                    $sendgrid = new \SendGrid('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');
                    $response1 = $sendgrid->send($email1);

                    // Gönderim sonucu
                    print $response1->statusCode() . "\n";
                    print_r($response1->headers());
                    print $response1->body() . "\n";
					


				try {
 $to = $phoneNumber;
$from = "+16468527935";
$message = "Hello " . $firstName .". You have a Central Park Tour with at ". $formattedHour .":" . $bookingMinutes . " " . $bookingAmPm .". See you soon. Thank you. -New York Pedicab Services";
$messageSid = sendTextMessage($twilio, $to, $from, $message);

                    // Veritabanında durumu güncelle
				$updateReminder = $pdo->prepare("UPDATE $table SET reminder_sent = 1 WHERE bookingNumber = :bookingNumber");
                $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
				$updateReminder = $pdo->prepare("UPDATE $table SET reminder_sent = 2 WHERE bookingNumber = :bookingNumber");
                $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                    continue; // Devam et ve sıradaki numaraya geç
                }

                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }
				}
				
				if ($table == 'pointatob'){
                try {
                    // İlk E-posta oluşturma
                    $email1 = new \SendGrid\Mail\Mail();
                    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");

                    // E-posta içeriğini hazırlama
                    $firstName = $booking['firstName'];
                    $lastName = $booking['lastName'];
                    $emailAddress = $booking['emailAddress'];
                    $phoneNumber = $booking['phoneNumber'];
                    $numPassengers = $booking['numberOfPassengers'];
                    $pedicabCount = ceil($numPassengers / 3);
                    $driverFare = $booking['driverFee'];
                    $driverFarePerDriver = number_format($driverFare/$pedicabCount, 2);
                    $driverFarePerDriverText = ($pedicabCount != 1) ? '($' . $driverFarePerDriver . ' per driver)' : '';
                    $dateOfTour = $booking['date']; // Rezervasyon tarihi
                    $dayOfWeek = DateTime::createFromFormat('m/d/Y', $dateOfTour)->format('l');
                    $tourDuration = $booking['duration'];
                    $pickUpAddress = $booking['pickupAddress'];
                    $destinationAddress = $booking['destinationAddress'];
                    $totalFare = $booking['totalFare'];
                    $bookingFee = $booking['bookingFee'];
                    $bookingNumber = $booking['bookingNumber'];
                    $paymentMethod = $booking['paymentMethod'];
					$formattedHour = date("g", strtotime($bookingHour . ":00"));
					date_default_timezone_set('America/New_York');
					$todayMonth = date('m'); 
					$todayDay = date('d'); 
					$todayYear = date('Y'); 
					$todayDayName = date('l');
                    // E-posta başlığı ve içeriği
                    $email1->setSubject("REMINDER: Scheduled Point A to B Pedicab Ride - " . $bookingNumber);
        $htmlContent1 = <<<EOD
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
    <p><strong>Date of Pick Up:</strong> $dateOfTour $dayOfWeek</p>
    <p><strong>Time of Pick Up:</strong> $formattedHour:$bookingMinutes $bookingAmPm</p>
    <p><strong>Duration of Ride:</strong> $tourDuration Minutes</p>
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
            $htmlContent1 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayMonth/$todayDay/$todayYear $todayDayName</p>
EOD;

            $htmlContent1 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText with $paymentMethod2 due on $dateOfTour $dayOfWeek</p>
EOD;
        }

        if ($paymentMethod == "FULLCARD") {
			$paymentMethod2 = "debit/credit card";
            $htmlContent1 .= <<<EOD
    <p><strong>Total Fare:</strong> \${$totalFare} paid on $todayMonth/$todayDay/$todayYear $todayDayName</p>
EOD;
        } else {
            $htmlContent1 .= <<<EOD
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
EOD;
        }
        $htmlContent1 .= <<<EOD
    <p><strong>Thank you for choosing New York Pedicab Services.</strong></p>
    <strong>New York Pedicab Services</strong><br>
    <strong>(212) 961-7435</strong><br>
    <strong>info@newyorkpedicabservices.com</strong>
</body>
</html>
EOD;

                    $email1->addTo($emailAddress, $firstName);
                    $email1->addContent("text/html", $htmlContent1);

                    // SendGrid ile e-posta gönderimi
                    $sendgrid = new \SendGrid('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');
                    $response1 = $sendgrid->send($email1);

                    // Gönderim sonucu
                    print $response1->statusCode() . "\n";
                    print_r($response1->headers());
                    print $response1->body() . "\n";
					

				try {
 $to = $phoneNumber;
$from = "+16468527935";
$message = "Hello " . $firstName .". You have a Point A to B Ride with us at ". $formattedHour .":" . $bookingMinutes . " " . $bookingAmPm .". See you soon. Thank you. -New York Pedicab Services";
$messageSid = sendTextMessage($twilio, $to, $from, $message);

                    // Veritabanında durumu güncelle
				$updateReminder = $pdo->prepare("UPDATE $table SET reminder_sent = 1 WHERE bookingNumber = :bookingNumber");
                $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
				$updateReminder = $pdo->prepare("UPDATE $table SET reminder_sent = 2 WHERE bookingNumber = :bookingNumber");
                $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
				
				
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }
				}
				
				
				if ($table == 'hourly'){
                try {
                    // İlk E-posta oluşturma
                    $email1 = new \SendGrid\Mail\Mail();
                    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");

                    // E-posta içeriğini hazırlama
                    $firstName = $booking['firstName'];
                    $lastName = $booking['lastName'];
                    $emailAddress = $booking['emailAddress'];
                    $phoneNumber = $booking['phoneNumber'];
                    $numPassengers = $booking['numberOfPassengers'];
                    $pedicabCount = ceil($numPassengers / 3);
                    $driverFare = $booking['driverFee'];
                    $driverFarePerDriver = number_format($driverFare/$pedicabCount, 2);
                    $driverFarePerDriverText = ($pedicabCount != 1) ? '($' . $driverFarePerDriver . ' per driver)' : '';
                    $dateOfTour = $booking['date']; // Rezervasyon tarihi
                    $dayOfWeek = DateTime::createFromFormat('m/d/Y', $dateOfTour)->format('l');
                    $tourDuration = $booking['serviceDuration'];
                    $pickUpAddress = $booking['pickupAddress'];
                    $destinationAddress = $booking['destinationAddress'];
                    $totalFare = $booking['totalFare'];
                    $bookingFee = $booking['bookingFee'];
                    $bookingNumber = $booking['bookingNumber'];
                    $paymentMethod = $booking['paymentMethod'];
					$serviceDetails = $booking['serviceDetails'];
					$formattedHour = date("g", strtotime($bookingHour . ":00"));
					date_default_timezone_set('America/New_York');
					$todayMonth = date('m'); 
					$todayDay = date('d'); 
					$todayYear = date('Y'); 
					$todayDayName = date('l');
                    // E-posta başlığı ve içeriği
                    $email1->setSubject("REMINDER: Scheduled Hourly Pedicab Service - " . $bookingNumber);
        $htmlContent1 = <<<EOD
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
            <p><strong>Date of Service:</strong> $dateOfTour $dayOfWeek</p>
            <p><strong>Time of Service:</strong> $formattedHour:$bookingMinutes $bookingAmPm</p>
            <p><strong>Duration of Service:</strong> $tourDuration</p>
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
            $htmlContent1 .= <<<EOD
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $todayMonth/$todayDay/$todayYear $todayDayName</p>
EOD;

            $htmlContent1 .= <<<EOD
    <p><strong>Driver Fare:</strong> \${$driverFare} $driverFarePerDriverText with $paymentMethod2 due on $dateOfTour $dayOfWeek</p>
EOD;
        }

        if ($paymentMethod == "FULLCARD") {
            $htmlContent1 .= <<<EOD
    <p><strong>Total Fare:</strong> \${$totalFare} paid on $todayMonth/$todayDay/$todayYear $todayDayName</p>
EOD;
        } else {
            $htmlContent1 .= <<<EOD
    <p><strong>Total Fare:</strong> \${$totalFare}</p>
EOD;
        }
        $htmlContent1 .= <<<EOD
    <p><strong>Thank you for choosing New York Pedicab Services.</strong></p>
    <strong>New York Pedicab Services</strong><br>
    <strong>(212) 961-7435</strong><br>
    <strong>info@newyorkpedicabservices.com</strong>
</body>
</html>
EOD;

                    $email1->addTo($emailAddress, $firstName);
                    $email1->addContent("text/html", $htmlContent1);

                    // SendGrid ile e-posta gönderimi
                    $sendgrid = new \SendGrid('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');
                    $response1 = $sendgrid->send($email1);

                    // Gönderim sonucu
                    print $response1->statusCode() . "\n";
                    print_r($response1->headers());
                    print $response1->body() . "\n";

				try {
 $to = $phoneNumber;
$from = "+16468527935";
$message = "Hello " . $firstName .". You have a Hourly Service with us at ". $formattedHour .":" . $bookingMinutes . " " . $bookingAmPm .". See you soon. Thank you. -New York Pedicab Services";
$messageSid = sendTextMessage($twilio, $to, $from, $message);

                    // Veritabanında durumu güncelle
				$updateReminder = $pdo->prepare("UPDATE $table SET reminder_sent = 1 WHERE bookingNumber = :bookingNumber");
                $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
				$updateReminder = $pdo->prepare("UPDATE $table SET reminder_sent = 2 WHERE bookingNumber = :bookingNumber");
                $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                    continue; // Devam et ve sıradaki numaraya geç
                }				
				
				
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }
				}
				
            }
        }
    }
}

sendReminder($baglanti);


function sendReviewEmailWithTotalMinutes($pdo) {
	global $twilio;
    // New York saat dilimi
    $now = new DateTime("now", new DateTimeZone('America/New_York'));
    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        // Tablo verilerini çekiyoruz
        $stmt = $pdo->query("SELECT * FROM $table WHERE sms_sent = 0");
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking) {
            // Veritabanından gelen saat, dakika ve AM/PM'yi birleştirip datetime oluşturuyoruz
            $bookingDate = $booking['date']; // Format: MM/DD/YYYY
            $bookingHour = (int)$booking['hour']; // Saat
            $bookingMinutes = $booking['minutes']; // Dakika
            $bookingAmPm = strtolower($booking['ampm']); // AM/PM formatı
            $totalMinutes = $booking['totalMinutes']; // Veritabanından gelen süre (dakika)
			$phoneNumber = $booking['phoneNumber'];

            // AM/PM formatını 24 saat formatına çevirme
            if ($bookingAmPm === 'pm' && $bookingHour != 12) {
                $bookingHour += 12;
            } elseif ($bookingAmPm === 'am' && $bookingHour == 12) {
                $bookingHour = 0; // 12 AM durumu
            }

            // Rezervasyon tarihini ve saatini New York saatine göre oluşturma
            $bookingDateTimeStr = $bookingDate . ' ' . str_pad($bookingHour, 2, '0', STR_PAD_LEFT) . ':' . str_pad($bookingMinutes, 2, '0', STR_PAD_LEFT);
            $bookingDateTime = DateTime::createFromFormat('m/d/Y H:i', $bookingDateTimeStr, new DateTimeZone('America/New_York'));

            // $totalMinutes'i saat ve dakikaya bölme
            $totalHours = floor($totalMinutes / 60); // Saat kısmı
            $remainingMinutes = round(($totalMinutes % 60)); // Dakika kısmı

            // Rezervasyon saatine önce toplam saati, sonra kalan dakikayı ekleme
            $bookingDateTime->modify("+{$totalHours} hours");
            $bookingDateTime->modify("+{$remainingMinutes} minutes");

            // Total dakikaya 30 dakika daha ekleme (yarım saat sonra gönderim için)
            $bookingDateTime->modify("+30 minutes");

            // Şu anki zamanla karşılaştırma
            if ($now > $bookingDateTime) {
                try {
                    // E-posta oluşturma
                    $email = new \SendGrid\Mail\Mail();
                    $email->setFrom("info@newyorkpedicabservices.com", "NYPS");

                    // E-posta içeriğini hazırlama
                    $firstName = $booking['firstName'];
                    $lastName = $booking['lastName'];
                    $emailAddress = $booking['emailAddress'];
                    $bookingNumber = $booking['bookingNumber'];
                    $dateOfTour = $booking['date'];

                    // E-posta başlığı ve içeriği
                    $email->setSubject("Pedicab Review Request - " . $bookingNumber);
                $htmlContent = <<<EOD
<html>
<body>
    <p>Hi {$firstName},</p>
    <p>We hope we were able to provide an awesome pedicab experience.</p>
    <p>If you have any concern or negative feedback or question in regards to your experience with us, please,
    contact us immediately. We will do our best to address your concern or negative feedback or question as
    we deeply care about customer service.</p>
    <p>If you enjoyed your tour, please, consider dropping some stars for us on our pages. It only takes a few
    seconds. Below are the links:</p>
    <p><strong>Our Google Business Review Page:</strong> <a href='https://search.google.com/local/writereview?placeid=ChIJXXguyPdYwokR_P1uG9_UTZ0' target='_blank'>Google Review</a></p>
    <p><strong>Our TripAdvisor Review Page:</strong> <a href='https://www.tripadvisor.com/UserReviewEdit-g60763-d2091094-New_York_Pedicab_ServicesNew_York_City_New_York.html' target='_blank'>TripAdvisor Review</a></p>
    <p><strong>Our Yelp Review Page:</strong> <a href='https://www.yelp.com/writeareview/biz/ZoHf4pNhXz9bTB3dBSKi9Q?return_url=%2Fbiz%2FZoHf4pNhXz9bTB3dBSKi9Q&review_origin=biz-details-war-button' target='_blank'>Yelp Review</a></p>
    <p><strong>Our Facebook Review Page:</strong> <a href='https://www.facebook.com/newyorkpedicab/reviews' target='_blank'>Facebook Review</a></p>
    <p>We hope to see you again.</p>
    <p>Thank you,</p>
    <p>New York Pedicab Services</p>
    <p>(212) 961-7435</p>
    <p>info@newyorkpedicabservices.com</p>
</body>
</html>
EOD;

                    $email->addTo($emailAddress, $firstName);
                    $email->addContent("text/html", $htmlContent);

                    // SendGrid ile e-posta gönderimi
                    $sendgrid = new \SendGrid('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');
                    $response = $sendgrid->send($email);

                    // Gönderim sonucu
                    print $response->statusCode() . "\n";
                    print_r($response->headers());
                    print $response->body() . "\n";
				
					
				try {
 $to = $phoneNumber;
$from = "+16468527935";
$message = "We hope you enjoyed your tour. Please, consider dropping stars for us on Google. Thank you.
https://g.page/r/Cfz9bhvf1E2dEBM/review";
$messageSid = sendTextMessage($twilio, $to, $from, $message);

                    // Veritabanında durumu güncelle
  $updateReminder = $pdo->prepare("UPDATE $table SET sms_sent = 1, status = 'past', driver = 'ibrahim' WHERE bookingNumber = :bookingNumber");
                    $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
  $updateReminder = $pdo->prepare("UPDATE $table SET sms_sent = 2, status = 'past', driver = 'ibrahim' WHERE bookingNumber = :bookingNumber");
                    $updateReminder->execute([':bookingNumber' => $bookingNumber]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
					
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }
            }
        }
    }
}

sendReviewEmailWithTotalMinutes($baglanti);



?>
