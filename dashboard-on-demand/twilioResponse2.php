<?php
$number = $_POST['From'];
$body = $_POST['Body'];
require_once "vendor/autoload.php";
include('text.php');
date_default_timezone_set('America/New_York');
$currentDateTime = date('Y-m-d H:i:s');
$username = 'dashboard';
$password = 'Ogulcan07!?!';

if (strpos($number, 'whatsapp:') === 0) {
    // Önce gereksiz boşlukları kaldır
    $number = trim($number); 
    // 'whatsapp:' ifadesini kaldır
    $numberQuery = str_replace('whatsapp:', '', $number);
    // Sonuçtan kalan gereksiz boşlukları da temizle
    $numberQuery = trim($numberQuery); 
} else {
    $numberQuery = $number;
}
	
$name = 'Unknown';

	
	if ($name == "Unknown"){
	require 'inc/scheduleddb.php';
	$tables = ['centralpark', 'hourly', 'pointatob'];
	    // Her tabloyu kontrol et
    foreach ($tables as $table) {
        $sql = "SELECT firstName, lastName FROM $table WHERE phoneNumber = :phoneNumber";
        $stmt = $baglanti3->prepare($sql);
        $stmt->execute(['phoneNumber' => $numberQuery]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kayıt bulunduysa isimleri birleştir ve döngüyü kır
        if ($row) {
            $name = $row['firstName'] . ' ' . $row['lastName'];
            break;
        }
    }
	}
	
if ($name == "Unknown") {
    require 'inc/outlookdb.php'; // İlgili veritabanı bağlantısını ekliyoruz.

    // schedule_requests tablosunu kontrol et
    $sql = "SELECT name, CONCAT('+', countryCode, phone_number) as fullNumber FROM schedule_requests";
    $stmt = $baglanti4->prepare($sql);
    $stmt->execute();

    // Tüm kayıtları döngü ile kontrol ediyoruz
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dbNumber = $row['fullNumber']; // Veritabanındaki tam numara + ülke kodu ve numara birleşimi
        
        // Gelen $numberQuery ile veritabanındaki numarayı karşılaştır
        if ($dbNumber === $numberQuery) {
            $name = $row['name']; // Eşleşen kaydın ismini atayın
            break; // Eşleşme bulunduğunda döngüyü kır
        }
    }
}

require 'inc/vt.php';
if ($name == "Unknown") {
	    // Tablo isimleri
    $tables = ['centralpark', 'hourly', 'pointatob'];

    // Her tabloyu kontrol et
    foreach ($tables as $table) {
        $sql = "SELECT firstName, lastName FROM $table WHERE phoneNumber = :phoneNumber";
        $stmt = $baglanti->prepare($sql);
        $stmt->execute(['phoneNumber' => $numberQuery]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kayıt bulunduysa isimleri birleştir ve döngüyü kır
        if ($row) {
            $name = $row['firstName'] . ' ' . $row['lastName'];
            break;
        }
    }
}
	
	$sql = "INSERT INTO messages (name, phone_number, body, sent_at) VALUES (:name, :phone_number, :body, :sent_at)";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute(['name' => $name, 'phone_number' => $number, 'body' => $body, 'sent_at' => $currentDateTime]);
	

	
	
	
	$email1 = new \SendGrid\Mail\Mail(); 
    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
    $email1->setSubject("Twilio Message!");
    $email1->addTo("info@newyorkpedicabservices.com", "NYPS");
    $htmlContent1 = <<<EOD
<html>
<body>
    <p><strong>Customer Name: $name</strong></p>
    <p><strong>Number: $number</strong></p>
    <p><strong>Body: $body</strong></p>     
</body>
</html>
EOD;
    $email1->addContent("text/html", $htmlContent1);
    $sendgrid = new \SendGrid('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');
    try {
    $response1 = $sendgrid->send($email1);
	$to = "+16562002544";
    $from = "+16468527935"; 
    $message = "Customer Name: " . $name . " 
Number: " . $number ." 
Body:" . $body . ".";
    $messageSid = sendTextMessage($twilio, $to, $from, $message);
	$to = "+12129617435";
    $from = "+16468527935"; 
    $message = "Customer Name: " . $name . " 
Number: " . $number ." 
Body:" . $body . ".";
    $messageSid = sendTextMessage($twilio, $to, $from, $message);
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() . "\n";
    }
	
	
header('Content-Type: text/xml');
?>

<Response>
    <Message>
	<?php 
	if ($name != "Unknown"){
		echo "Hello " . $name . ",";
	}
	?>
	
We do not read text messages at this phone number.
Please, text us at +1 212-961-7435 instead.
Thank you,
-New York Pedicab Services
    </Message>
</Response>