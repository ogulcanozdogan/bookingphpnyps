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
         ini_set('display_errors', 1);
         error_reporting(E_ALL);
         use PHPMailer\PHPMailer\PHPMailer;
         use PHPMailer\PHPMailer\Exception;
         require_once('vendor/autoload.php');
         require_once('inc/db.php');
         require_once('whatsapp.php');  
		$stripe = new \Stripe\StripeClient('sk_test_51MhFmmGdhoanQCDNADx1H93FzMcqZLmrnInZxyCBxeacfx7aX25DvSHJic5df5vx8Q36j5D6R3kk5Nim4PRMRewj00DLrQnp9L');
         $token = $_POST['stripeToken'];
         $amount = $_POST['bookingFee']; // Bu değeri formdan alabilir veya sabit bir değer belirleyebilirsiniz.
         $amountCents = round($amount * 100);
         // Formdan gelen tarih ve saat bilgilerini al
         $firstName = $_POST['firstName'];
         $lastName = $_POST['lastName'];
         $emailAddress = $_POST['aq'];
         $phoneNumber = $_POST['phoneNumber'];
         $numPassengers = $_POST['numPassengers'];
         $pickUpAddress = $_POST['pickUpAddress'];
         $destinationAddress = $_POST['destinationAddress'];
         $paymentMethod = $_POST['paymentMethod'];
         $rideDuration = $_POST['rideDuration'];
         $bookingFee = $_POST['bookingFee'];
         $driverFare = $_POST['driverFare'];
         $totalFare = $_POST['totalFare'];
         $operationFare = $_POST["operationFare"];  
         $tourDuration = $_POST["tourDuration"];   
         $pickup1 = $_POST["pickup1"];
         $pickup2 = $_POST["pickup2"];
         $return1 = $_POST["return1"];  
         $return2 = $_POST["return2"];   
         $toursuresi = $_POST["toursuresi"];  
         // Toplam dakikayı hesaplama
         $totalMinutes = $pickup1 + $pickup2 + $return1 + $return2 + $toursuresi;
     
         // Toplam dakikayı saat cinsine çevirme
         $operationDuration = $totalMinutes / 60;
         
         // Formatlanmış çıktıyı hazırlama
         $operationDurationFormatted = number_format($operationDuration, 2);
		 
		 $pickup11 = intval($pickup1); // pickup1 değişkenini integer olarak alın
		 
		 
 // Florida zaman dilimi ile şu anki zamanı oluştur
$floridaTimeZone = new DateTimeZone('America/New_York');
$currentDateTime = new DateTime('now', $floridaTimeZone);

// Tour Time hesapla: geçerli zaman + 5 dakika + pickup1
$tourTime = clone $currentDateTime;
$tourTime->add(new DateInterval('PT5M'));
$tourTime->add(new DateInterval('PT' . $pickup11 . 'M'));

// Geçerli zaman formatlarını al
$tourYear = $currentDateTime->format('Y');
$tourMonth = $currentDateTime->format('m');
$tourDay = $currentDateTime->format('d');
$tourHour = $tourTime->format('H');
$tourMinute = $tourTime->format('i');
$formattedTimeOfTour = $tourHour . '-' . $tourMinute;

$orderYear = $currentDateTime->format('Y');
$orderMonth = $currentDateTime->format('m');
$orderDay = $currentDateTime->format('d');
$orderHour = $currentDateTime->format('H');
$orderMinute = $currentDateTime->format('i');
$formattedTimeOfOrder = $orderHour . '-' . $orderMinute;

// Rezervasyon numarasını yeni formata göre oluştur
$bookingNumber = $tourYear . '-' . $tourMonth . '-' . $tourDay . '-' . $formattedTimeOfTour . '-' .
                 $orderYear . '-' . $orderMonth . '-' . $orderDay . '-' . $formattedTimeOfOrder;


         try {
             $charge = $stripe->charges->create([
                 'amount' => $amountCents,
                 'currency' => 'usd',
                 'description' => 'Örnek ödeme',
                 'source' => $token,
             ]);
         
           //  echo 'Payment successful!';
         	
         	
         } catch (\Stripe\Exception\ApiErrorException $e) {
            // echo 'An error occurred during the checkout process: ' . $e->getMessage();
         }
         
          $apiKey = 'AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY';
          // Adresleri koordinatlara çevirme işlevi
         function getCoordinates($address, $apiKey) {
             // Adresi URL'e uygun hale getir
             $address = urlencode($address);
             $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey";
         
             // cURL ile HTTP isteği başlat
             $ch = curl_init();
             curl_setopt($ch, CURLOPT_URL, $url);
             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
             curl_setopt($ch, CURLOPT_HEADER, 0);
             
             // İsteği yürüt ve sonucu al
             $response = curl_exec($ch);
             curl_close($ch);
             
             // Yanıtı JSON olarak çöz
             $response = json_decode($response, true);
         
             // Koordinatları elde et
             if ($response['status'] == 'OK') {
                 $geometry = $response['results'][0]['geometry']['location'];
                 return $geometry['lat'] . ',' . $geometry['lng'];
             } else {
                 return null; // Koordinat bulunamadı
             }
         }
         
         // Her iki adres için koordinatları al
         $pickUpCoords = getCoordinates($pickUpAddress, $apiKey);
         $destinationCoords = getCoordinates($destinationAddress, $apiKey);
        
         $formattedDate = $currentDateTime->format('m/d/Y');
         
		 
		       if ($firstName <> "" && $lastName <> "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                         //Değişecek veriler
         				
         $satir = [
             'bookingNumber' => $bookingNumber,
             'firstName' => $firstName,
             'lastName' => $lastName,
             'emailAddress' => $emailAddress,
             'phoneNumber' => $phoneNumber,
             'numPassengers' => $numPassengers,
             'pickUpDate' => $formattedDate,
             'pickUpAddress' => $pickUpAddress,
             'destinationAddress' => $destinationAddress,
             'paymentMethod' => $paymentMethod,
             'rideDuration' => $rideDuration,
             'bookingFee' => $bookingFee,
             'driverFare' => $driverFare,
             'totalFare' => $totalFare,
             'operationFare' => $operationFare,
         	'pickUpCoords' => $pickUpCoords,
             'destinationCoords' => $destinationCoords
         ];
         
         			 
         			 
         			   $sql = "INSERT INTO centralpark (bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare,operationFare, pickUpCoords, destinationCoords)
         VALUES ('$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$formattedDate', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$operationFare', '$pickUpCoords', '$destinationCoords')";
         			$durum = $baglanti->prepare($sql)->execute();
                        
						
						// Son eklenen kaydın ID'sini al
$lastInsertId = $baglanti->lastInsertId();

// Booking number'ı güncelle
$bookingNumber .= '-' . $lastInsertId;

// Booking number'ı veritabanında güncelle
$sqlUpdate = "UPDATE centralpark SET bookingNumber = '$bookingNumber' WHERE id = $lastInsertId";
$baglanti->prepare($sqlUpdate)->execute();
         
                      if ($durum)
                      {
                         echo '<script>swal("Successful","Succesfully payment.","success").then((value)=>{ window.location.href = "index.php"});
         
                         </script>';  
						 
						

// İlk E-posta
$email1 = new \SendGrid\Mail\Mail(); 
$email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
$email1->setSubject("On Demand Central Park Pedicab Tour - " . $bookingNumber);
$email1->addTo("info@newyorkpedicabservices.com", "NYPS");
$htmlContent1 = <<<EOD
         <html>
         <body>
             <h1>Booking Details</h1>
             <p><strong>CONFIRMATION: Central Park Pedicab Tour - </strong> $bookingNumber</p>
             <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/centralparkogulcan/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>	
             <p><strong>Type:</strong> Central Park Pedicab Tour</p>
             <p><strong>First Name:</strong> $firstName</p>
             <p><strong>Last Name:</strong> $lastName</p>
             <p><strong>Email Address:</strong> $emailAddress</p>
             <p><strong>Phone Number:</strong> $phoneNumber</p>
             <p><strong>Number of Passengers:</strong> $numPassengers</p>
         	<p><strong>Pick Up 1:</strong> {$pickup1} minutes</p>
         	<p><strong>Pick Up 2:</strong> {$pickup2} minutes</p>
         	<p><strong>Duration of Tour:</strong> {$tourDuration} minutes</p>
             <p><strong>Duration of Ride:</strong> {$rideDuration} minutes</p>
         	<p><strong>Return 1:</strong> {$return1} minutes</p>
         	<p><strong>Return 2:</strong> {$return2} minutes</p>	
             <p><strong>Operation Duration:</strong> {$operationDurationFormatted} hours</p>
             <p><strong>Start Address:</strong> $pickUpAddress</p>
             <p><strong>Finish Address:</strong> $destinationAddress</p>
             <p><strong>Hub 1:</strong> West Drive and West 59th Street New York, NY 10019</p>
             <p><strong>Hub 2:</strong> = 6th Avenue and Central Park South New York, NY 10019</p>			 
             <p><strong>Operation Fare:</strong> \${$operationFare}</p>
             <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear</p>
             <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod</p>
             <p><strong>Total Fare:</strong> \${$totalFare}</p>
             <h2>Driver Note</h2>
            <strong>Type:</strong> On Demand Central Park Pedicab Tour<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Phone:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong><strong>Ride Duration:</strong> {$rideDuration} minutes</strong><br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \${$driverFare} with $paymentMethod by customer $firstName $lastName
         </body>
         </html>
         EOD;
$email1->addContent("text/html", $htmlContent1);

// İkinci E-posta
$email2 = new \SendGrid\Mail\Mail(); 
$email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
$email2->setSubject("CONFIRMATION: On Demand Central Park Pedicab Ride - " . $bookingNumber);
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
    <p><strong>Duration of Tour:</strong> {$tourDuration} minutes</p>	
    <p><strong>Duration of Ride:</strong> {$rideDuration} minutes</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>	
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear</p>
    <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod</p>
    <p><strong>Thank you,</strong></p>
    <strong>New York Pedicab Services</strong>
    <strong>(212) 961-7435</strong>
    <strong>info@newyorkpedicabservices.com</strong>
</body>
</html>
EOD;
$email2->addContent("text/html", $htmlContent2);













         $sendgrid = new \SendGrid('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');
         try {
    // İlk e-posta gönderimi
    $response1 = $sendgrid->send($email1);
    print $response1->statusCode() . "\n";
    print_r($response1->headers());
    print $response1->body() . "\n";
    
    // İkinci e-posta gönderimi
    $response2 = $sendgrid->send($email2);
    print $response2->statusCode() . "\n";
    print_r($response2->headers());
    print $response2->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
         
           
         				
$sorgu = $baglanti->prepare("SELECT * FROM users WHERE perm = 'driver'");
$sorgu->execute();

while ($sonuc = $sorgu->fetch()) { 

  // Telefon numarasına uygun WhatsApp formatını ekleyin
    $formattedPhone = "whatsapp:+1" . $sonuc['number'];
    $phoneNumbers[] = $formattedPhone;

}

$message = "Central Park Pedicab Tour available!
{". $bookingNumber ."}";

// Her bir telefon numarasına mesaj gönder
foreach ($phoneNumbers as $phoneNumber) {
    $messageSid = sendWhatsAppMessage($twilio, $phoneNumber, $message);
   // echo "Mesaj gönderildi, SID: $messageSid<br>";
}

    
           




                     } else {
                             echo 'Düzenleme hatası oluştu: '; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
                         }
                     } else {
                         echo 'Hata oluştu: ' . $hata; // dosya hatası ve form elemanlarının boş olma durumunua göre hata döndürüyoruz.
                     }
                     if ($hata != "") {
                 echo '<script>swal("Hata","' . $hata . '","error");</script>';
             }
          
         
         
         
         
         
         
         
         
         
         
         ?>
   </body>
</html>