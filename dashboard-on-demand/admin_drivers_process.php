<?php

include('inc/vt.php'); 
include('inc/head.php'); 
include('inc/header.php');
if ($perm != "admin") { 
    header('location: index.php');
}
require_once "vendor/autoload.php";
include('whatsapp.php');
if ($_GET) {
    if ($_GET['process'] && $_GET['id']) {
        $table = "users";
        $process = $_GET['process'];
        $driverid = $_GET['id'];


            $sorgu = $baglanti->prepare("SELECT * FROM $table WHERE id=:driverid");
            $sorgu->execute(['driverid' => $driverid]);
            $sonuc = $sorgu->fetch();

            if ($process == 'verify') {

$sql = "UPDATE $table SET verify=1 WHERE id=:driverid";
$durum = $baglanti->prepare($sql)->execute(['driverid' => $driverid]);

$driverEmail = $sonuc['email'];
$driverName = $sonuc['name'] . " " .  $sonuc['surname'];

 if ($sonuc) {
    $formattedPhone = "whatsapp:+1" . $sonuc['number'];

    $message = "Your driver account is verified now! -New York Pedicab Services";

    $messageSid = sendWhatsAppMessage($twilio, $formattedPhone, $message);

    echo "Mesaj gönderildi, SID: $messageSid<br>";
}

    $email1 = new \SendGrid\Mail\Mail(); 
    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
    $email1->setSubject("Your Account is verified! - NYPS");
    $email1->addTo($driverEmail, $driverName);
    $htmlContent1 = <<<EOD
<html>
<body>
    <p><strong>Hello $driverName.</strong></p>
    <p>Your driver account is verified now!</p>
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
        header("location:pending.php");
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() . "\n";
    }
			

                if ($durum) {
                    header('location: admin_verify_drivers.php');
                } else {
                    echo "SQL Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
                }
            } elseif ($process == 'delete') {
				$durum = $baglanti->prepare("DELETE FROM $table WHERE id=:driverid")->execute(['driverid' => $driverid]);
			if ($durum) {
			header("location:admin_drivers.php");
			}
            } else {
                header('location:admin_drivers.php');
            }
 
    } else {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}
?>
