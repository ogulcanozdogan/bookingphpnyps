<?php 
include('inc/vt.php');
include('text.php');

require_once '/home/zlds82bav5q4/public_html/dashboard-scheduled/vendor/autoload.php';
use Twilio\Rest\Client;


function updatePastBookings2($pdo) {
    $now = new DateTime("now", new DateTimeZone('America/New_York'));
    $currentDateTime  = $now->format('Y-m-d H:i:s'); 

    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT bookingNumber, updated_at, totalMinutes FROM $table WHERE status = 'pending'");
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking) {
            $bookingNumber = $booking['bookingNumber'];
            $updatedAt = $booking['updated_at'];
            $totalMinutes = $booking['totalMinutes'];

            $minutes = floor($totalMinutes);
            $seconds = ($totalMinutes - $minutes) * 60;

            $updatedAtDateTime = new DateTime($updatedAt, new DateTimeZone('America/New_York'));
            $updatedAtDateTime->modify("+$minutes minutes");
            $updatedAtDateTime->modify("+" . round($seconds) . " seconds");
            $modifiedUpdatedAt = $updatedAtDateTime->format('Y-m-d H:i:s');

            if ($currentDateTime >= $modifiedUpdatedAt) {
                $updateStmt = $pdo->prepare("UPDATE $table SET status = 'past', updated_at = :updated_at WHERE bookingNumber = :bookingNumber");
                $updateStmt->execute([':updated_at' => $currentDateTime, ':bookingNumber' => $bookingNumber]);
            }
        }
    }
}

updatePastBookings2($baglanti);




function updateFailedBookings($pdo) {
    global $twilio; 

    $now = new DateTime("now", new DateTimeZone('America/New_York'));
    $currentDateTime = $now->format('Y-m-d H:i:s'); 

    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        $stmt = $pdo->query("SELECT emailAddress, firstName, phoneNumber, bookingNumber, createdAt FROM $table WHERE status = 'available'");
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking) {
            $bookingNumber = $booking['bookingNumber'];
            $createdAt = $booking['createdAt'];
            $phoneNumber = $booking['phoneNumber'];
            $firstName = $booking['firstName'];
			$emailAddress = $booking['emailAddress'];
			
			if ($table == 'centralpark'){
				$subjecttitle = 'On Demand Central Park Pedicab Tour';
			}
			elseif ($table == 'pointatob'){
				$subjecttitle = 'On Demand Point A to B Pedicab Ride';
			}
			elseif ($table == 'hourly'){
				$subjecttitle = 'On Demand Hourly Pedicab Service';
			}
			
			
			
            $createdAtDateTime = new DateTime($createdAt, new DateTimeZone('America/New_York'));
            $expiryTime = clone $createdAtDateTime;
            $expiryTime->modify('+5 minutes');
            $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));

            if ($currentTime > $expiryTime) {
                $updateStmt = $pdo->prepare("UPDATE $table SET status = 'failed', updated_at = :updated_at WHERE bookingNumber = :bookingNumber");
                $updateStmt->execute([':updated_at' => $currentDateTime, ':bookingNumber' => $bookingNumber]);

                $to = $phoneNumber;
                $from = "+16468527935";
                $message = "Hello " . $firstName .". We could not assign a driver. We will issue a full refund. Thank you. -New York Pedicab Services";

                try {
                    $messageSid = sendTextMessage($twilio, $to, $from, $message);
                    if ($messageSid) {
                        error_log("Message sent successfully with SID: $messageSid");
                    } else {
                        error_log("Message sending failed for booking number: $bookingNumber");
                    }
                } catch (Exception $e) {
                    error_log("Error sending message: " . $e->getMessage());
                }
				
				            try {
                $email1 = new \SendGrid\Mail\Mail(); 
                $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
                $email1->setSubject("FAILED: ". $subjecttitle . " " . $bookingNumber);
                $email1->addTo($emailAddress, $firstName);
                $htmlContent1 = <<<EOD
<html>
<body>
    <p>Hello {$firstName},</p>
    <p>We could not assign a driver.</p>
    <p>We will issue a full refund.</p>
    <p>Thank you,</p>
    <p>New York Pedicab Services</p>
    <p>(212) 961-7435</p>
    <p>info@newyorkpedicabservices.com</p>
</body>
</html>
EOD;
                $email1->addContent("text/html", $htmlContent1);

                $sendgrid = new \SendGrid('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');
                try {
                    $response1 = $sendgrid->send($email1);
                    print $response1->statusCode() . "\n";
                    print_r($response1->headers());
                    print $response1->body() . "\n";
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }

                $updateStmt = $pdo->prepare("UPDATE $table SET sms_sent = 1 WHERE phoneNumber = :phoneNumber AND status = 'past'");
                $updateStmt->execute([':phoneNumber' => $phoneNumber]);

            } catch (Exception $e) {
                echo "Could not send SMS: " . $e->getMessage();
            }
				
            }
        }
    }
}


updateFailedBookings($baglanti);


function sendScheduledSMS($pdo) {
    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        $stmt = $pdo->prepare("SELECT firstName, phoneNumber, emailAddress, bookingNumber, createdAt FROM $table WHERE status = 'past' AND sms_sent = 0");
        $stmt->execute();
        $records = $stmt->fetchAll();

        foreach ($records as $record) {
            $phoneNumber = $record['phoneNumber'];
            $emailAddress = $record['emailAddress'];
            $bookingNumber = $record['bookingNumber'];
            $customerFirstName = $record['firstName']; // Assuming you have the customer's first name; adjust accordingly

            try {
                // İlk E-posta
                $email1 = new \SendGrid\Mail\Mail(); 
                $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
                $email1->setSubject("Pedicab Review Request");
                $email1->addTo($emailAddress, $customerFirstName);
                $htmlContent1 = <<<EOD
<html>
<body>
    <p>Hi {$customerFirstName},</p>
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
                $email1->addContent("text/html", $htmlContent1);

                $sendgrid = new \SendGrid('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');
                try {
                    $response1 = $sendgrid->send($email1);
                    print $response1->statusCode() . "\n";
                    print_r($response1->headers());
                    print $response1->body() . "\n";
                } catch (Exception $e) {
                    echo 'Caught exception: '. $e->getMessage() ."\n";
                }

                $updateStmt = $pdo->prepare("UPDATE $table SET sms_sent = 1 WHERE phoneNumber = :phoneNumber AND status = 'past'");
                $updateStmt->execute([':phoneNumber' => $phoneNumber]);

            } catch (Exception $e) {
                echo "Could not send SMS: " . $e->getMessage();
            }
        }
    }
}


sendScheduledSMS($baglanti);

?>