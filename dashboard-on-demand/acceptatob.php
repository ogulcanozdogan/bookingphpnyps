<?php
ob_start();
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
$sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();

$pickupAddress = $sonuc["pickupAddress"];
$destinationAddress = $sonuc["destinationAddress"];
$customerPhone = $sonuc["phoneNumber"];
$customerName = $sonuc["firstName"];
$customerEmail = $sonuc["emailAddress"];

$driver = $user;
$status = "pending";
$hata = '';

$currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));
$updated_at = $currentDateTime->format('Y-m-d H:i:s');

$satir = [
    'id' => $id,
    'status' => $status,
    'driver' => $driver,
	'updated_at' => $updated_at,
];

// Veri güncelleme sorgusu
$sql = "UPDATE pointatob SET status=:status, driver=:driver, updated_at=:updated_at WHERE id=:id";
$durum = $baglanti->prepare($sql)->execute($satir);

if ($durum) {
    echo '<script>swal("Successful", "Job accepted.", "success").then((value) => { window.location.href = "pending.php" });</script>';     

    // Mesaj gönderilecek telefon numaraları listesi
    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
    $sorgu->execute(['user' => $user]);
    $sonuc = $sorgu->fetch();

    $driverName = $sonuc["name"];
    $driverPhone = $sonuc["number"];

    // Text mesajı göndermek için fonksiyonu çağır
    $to = $customerPhone;
    $from = "+16468527935"; // Twilio telefon numarası
    $message = "Hello " . $customerName . ". " . $driverName . " is your assigned driver. Driver's phone number is +1" . $driverPhone . ". Thank you. -New York Pedicab Services";
    $messageSid = sendTextMessage($twilio, $to, $from, $message);

    // Sürücüler için WhatsApp mesajı
    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE perm = 'driver'");
    $sorgu->execute();
    $phoneNumbers = [];
    while ($sonuc = $sorgu->fetch()) { 
        $formattedPhone = "whatsapp:+1" . $sonuc['number'];
        $phoneNumbers[] = $formattedPhone;
    }
	$message = "Point A to B Pedicab Ride assigned.
{"	. $bookingNumber . "}";
    foreach ($phoneNumbers as $phoneNumber) {
        $messageSid = sendWhatsAppMessage($twilio, $phoneNumber, $message);
        echo "Mesaj gönderildi, SID: $messageSid<br>";
    }

    // Müşteriye E-posta gönderimi
    $email1 = new \SendGrid\Mail\Mail(); 
    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
    $email1->setSubject("DRIVER INFORMATION - On Demand Point A to B Pedicab Ride -" . $bookingNumber);
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
    $sendgrid = new \SendGrid('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');
    try {
        $response1 = $sendgrid->send($email1);
        header("location:pending.php");
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() . "\n";
    }
} else {
    echo 'Job error: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
}
?>