<?php ob_start();
include('inc/vt.php'); 
include('inc/head.php');
$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi']; 
include('whatsapp.php');
include('text.php');
include('inc/header.php');
include('inc/navbar.php');
$id = $_POST["id"];
$bookingNumber = $_POST["bookingNumber"];
$sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();

$currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));
$updated_at = $currentDateTime->format('Y-m-d H:i:s');


$pickupAddress = $sonuc["pickupAddress"];
$destinationAddress = $sonuc["destinationAddress"];


$customerName = $sonuc["firstName"];
$customerLastName = $sonuc["lastName"];
$customerPhone = $sonuc["phoneNumber"];
$numberOfPassengers = $sonuc["numberOfPassengers"];
$todayDay = $currentDateTime->format('m/d/Y');
$pickUpTime = $sonuc["pickUpTime"];
$tourDuration = $sonuc["tourDuration"];
$rideDuration = $sonuc["duration"];
$driverFare = $sonuc["driverFee"];
$paymentMethod = $sonuc["paymentMethod"];


$customerEmail = $sonuc["emailAddress"];
    $driver = $user;
    $status = "pending";
    $id = $_POST['id'];
	$bookingNumber = $_POST['bookingNumber'];
    $hata = '';


$satir = [
    'id' => $id,
    'status' => $status,
    'driver' => $driver,
	'updated_at' => $updated_at,
];

    $sql = "UPDATE centralpark SET status=:status, driver=:driver, updated_at=:updated_at WHERE id=:id";             
    $durum = $baglanti->prepare($sql)->execute($satir);

    if ($durum) {
        echo '<script>swal("Successful", "Job accepted.", "success").then((value) => { window.location.href = "pending.php" });</script>';     

				
					$action = "Central Accepted!";


    $log_satir = [
	    'bookingNumber' => $bookingNumber,
        'driverUsername' => $user,
        'driverName' => $name,
        'driverLastName' => $surname,
        'action' => $action,
		'perm' => $perm,
        'timestamp' => $updated_at,
    ];
    
    $sql = "INSERT INTO logs (bookingNumber, driverUsername, driverName, driverLastName, action, perm, timestamp) VALUES (:bookingNumber, :driverUsername, :driverName, :driverLastName, :action, :perm, :timestamp)";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute($log_satir);
				
				
				
								$sorgu = $baglanti->prepare("SELECT * FROM users WHERE perm = 'driver'");
				$sorgu->execute();

while ($sonuc = $sorgu->fetch()) { 

    $formattedPhone = "whatsapp:+1" . $sonuc['number'];
    $phoneNumbers[] = $formattedPhone;

}
$message = "Central Park Pedicab Tour assigned.
{". $bookingNumber ."}";

foreach ($phoneNumbers as $phoneNumber) {
    $messageSid = sendWhatsAppMessage($twilio, $phoneNumber, $message);
    echo "Mesaj gönderildi, SID: $messageSid<br>";
}

				
$sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
$sorgu->execute(['user' => $user]);
$sonuc = $sorgu->fetch();

$driverName = $sonuc["name"];
$driverPhone = $sonuc["number"];
$driverEmail = $sonuc["email"];
$to = $customerPhone;
$from = "+16468527935";
$message = "Hello " . $customerName .". " . $driverName . " is your assigned driver. Driver's phone number is +1" . $driverPhone . ". Thank you. -New York Pedicab Services";
$messageSid = sendTextMessage($twilio, $to, $from, $message);
				





	
	

                    $email1 = new \SendGrid\Mail\Mail(); 
                    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
                    $email1->setSubject("DRIVER INFORMATION - On Demand Central Park Pedicab Tour -" . $bookingNumber);
                    $email1->addTo($customerEmail, $customerName);
                    $htmlContent1 = <<<EOD
<html>
<body>
    <p><strong>Hello $customerName.</strong></p>
    <p>$driverName is your assigned driver.</p>    
    <p>Driver's phone number is +1$driverPhone.</p>    
    <p>Thank you,</p>    
    <p>New York Pedicab Services</p>   
    <p>(212) 961-7435</p>   
    <p>info@newyorkpedicabservices.com</p>       
    </body>
</html>
EOD;
                    $email1->addContent("text/html", $htmlContent1);
					
					
					if ($tourDuration == 1){
	$tourDuration = $tourDuration . " Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)";
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
					
					        // Second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject(
            "RIDE INFORMATION: Central Park Tour - " . $bookingNumber
        );
        $email2->addTo($driverEmail, $driverName);

        $htmlContent2 = <<<EOD
        <html>
        <body>
<h2>Driver Note</h2>
<strong>Type:</strong> On Demand Central Park Pedicab Tour<br>
<strong>First:</strong> $customerName<br>
<strong>Last:</strong> $customerLastName<br>
<strong>Cell:</strong> $customerPhone<br>
<strong>Passengers:</strong> $numberOfPassengers<br>
<strong>Date:</strong> $todayDay (Today)<br>
<strong>Time:</strong> $pickUpTime<br>
<strong>Tour Duration:</strong> $tourDuration<br>
<strong>Ride Duration:</strong> {$rideDuration} Minutes<br>
<strong>Start:</strong> $pickupAddress<br>
<strong>Finish:</strong> $destinationAddress<br>
<strong>Pay:</strong> \${$driverFare} with $paymentMethod by customer $customerName $customerLastName
</body>
</html>
EOD;

        $email2->addContent("text/html", $htmlContent2);


                    $sendgrid = new \SendGrid('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');
                 
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
		        header("Location: pending.php");
		    } else {
        echo 'Job error: ';
    }
?>
