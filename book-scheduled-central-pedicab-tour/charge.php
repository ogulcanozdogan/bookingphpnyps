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
	  $hata = '';
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
         $pickUpDate = $_POST['pickUpDate'];
         $hours = $_POST['hours'];
         $minutes = $_POST['minutes'];
         $ampm = $_POST['ampm'];
         $pickUpAddress = $_POST['pickUpAddress'];
         $destinationAddress = $_POST['destinationAddress'];
         $paymentMethod = $_POST['paymentMethod'];
         $rideDuration = $_POST['rideDuration'];
         $bookingFee = $_POST['bookingFee'];
         $driverFare = $_POST['driverFare'];
         $totalFare = $_POST['totalFare'];
         $returnDuration = $_POST["returnDuration"];
         $operationFare = $_POST["operationFare"];
         $tourDuration = $_POST["tourDuration"];
         $pickup1 = $_POST["pickup1"];
         $pickup2 = $_POST["pickup2"];
         $return1 = $_POST["return1"];
         $return2 = $_POST["return2"];
         $toursuresi = $_POST["toursuresi"];  
         $timeOfPickUp = $hours . ":" . $minutes . " " . $ampm;
         // Toplam dakikayı hesaplama
         $totalMinutes = $pickup1 + $pickup2 + $return1 + $return2 + $toursuresi;
     
         // Toplam dakikayı saat cinsine çevirme
         $operationDuration = $totalMinutes / 60;
         
         // Formatlanmış çıktıyı hazırlama
         $operationDurationFormatted = number_format($operationDuration, 2);
         
         // Tarih string'ini parçalara ayır (Ay, Gün, Yıl)
         $dateParts = explode('/', $pickUpDate);
         $month = $dateParts[0];
         $day = $dateParts[1];
         $year = $dateParts[2];
         
         // Saat ve dakika değerlerini iki basamaklı formatla düzenle
         $formattedHour = str_pad($hours, 2, '0', STR_PAD_LEFT);
         $formattedMinute = str_pad($minutes, 2, '0', STR_PAD_LEFT);
         
         // PickUpDate'i DateTime objesine dönüştür
         $pickUpDateTime = DateTime::createFromFormat('m/d/Y', $pickUpDate);
         $pickUpYear = $pickUpDateTime->format('Y');
         $pickUpMonth = $pickUpDateTime->format('m');
         $pickUpDay = $pickUpDateTime->format('d');
         
         // Saati 24 saat formatına çevir
         $timeOfRide = DateTime::createFromFormat('h:i A', $hours . ':' . $minutes . ' ' . $ampm);
         $formattedTimeOfRide = $timeOfRide->format('H-i');
         
         // Florida zaman dilimi ile şu anki zamanı oluştur
         $floridaTimeZone = new DateTimeZone('America/New_York');
         $orderDateTime = new DateTime('now', $floridaTimeZone);
         $orderYear = $orderDateTime->format('Y');
         $orderMonth = $orderDateTime->format('m');
         $orderDay = $orderDateTime->format('d');
         $formattedTimeOfOrder = $orderDateTime->format('H-i');
         
         // Rezervasyon numarasını yeni formata göre oluştur
         $bookingNumber = $pickUpYear . '-' . $pickUpMonth . '-' . $pickUpDay . '-' .
                          $formattedTimeOfRide . '-' . $orderYear . '-' . $orderMonth . '-' .
                          $orderDay . '-' . $formattedTimeOfOrder;
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
        
         
         
     
                     if ($firstName <> "" && $lastName <> "") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
                         //Değişecek veriler
         				
         $satir = [
             'bookingNumber' => $bookingNumber,
             'firstName' => $firstName,
             'lastName' => $lastName,
             'emailAddress' => $emailAddress,
             'phoneNumber' => $phoneNumber,
             'numPassengers' => $numPassengers,
             'pickUpDate' => $pickUpDate,
             'hours' => $hours,
             'minutes' => $minutes,
             'ampm' => $ampm,
             'pickUpAddress' => $pickUpAddress,
             'destinationAddress' => $destinationAddress,
             'paymentMethod' => $paymentMethod,
             'rideDuration' => $rideDuration,
             'bookingFee' => $bookingFee,
             'driverFare' => $driverFare,
             'totalFare' => $totalFare,
             'returnDuration' => $returnDuration,
             'operationFare' => $operationFare,
         	'pickUpCoords' => $pickUpCoords,
             'destinationCoords' => $destinationCoords
         ];
         
         			 
         			 
         			   $sql = "INSERT INTO centralpark (bookingNumber, firstName, lastName, emailAddress, phoneNumber, numberOfPassengers, date, hour, minutes, ampm, pickupAddress, destinationAddress, paymentMethod, duration, bookingFee, driverFee, totalFare, returnDuration,  operationFare, pickUpCoords, destinationCoords)
         VALUES ('$bookingNumber', '$firstName', '$lastName', '$emailAddress', '$phoneNumber', '$numPassengers', '$pickUpDate', '$hours', '$minutes', '$ampm', '$pickUpAddress', '$destinationAddress', '$paymentMethod', '$rideDuration', '$bookingFee', '$driverFare', '$totalFare', '$returnDuration', '$operationFare', '$pickUpCoords', '$destinationCoords')";
         			$durum = $baglanti->prepare($sql)->execute();
                        
									$lastInsertId = $baglanti->lastInsertId();

// Booking number'ı güncelle
$bookingNumber .= '-' . $lastInsertId;

// Booking number'ı veritabanında güncelle
$sqlUpdate = "UPDATE centralpark SET bookingNumber = '$bookingNumber' WHERE id = $lastInsertId";
$baglanti->prepare($sqlUpdate)->execute();

               
         
                      if ($durum)
                      {
                        echo '
<h1>Booking Details</h1>
<p><strong>Thank you for choosing New York Pedicab Services</strong></p>
<p><strong>Below are the confirmed details of your booking:</strong></p>
<p><strong>Type:</strong> Scheduled Central Park Pedicab Tour</p>
<p><strong>First Name:</strong> ' . htmlspecialchars($firstName) . '</p>
<p><strong>Last Name:</strong> ' . htmlspecialchars($lastName) . '</p>
<p><strong>Email Address:</strong> ' . htmlspecialchars($emailAddress) . '</p>
<p><strong>Phone Number:</strong> ' . htmlspecialchars($phoneNumber) . '</p>
<p><strong>Number of Passengers:</strong> ' . htmlspecialchars($numPassengers) . '</p>
<p><strong>Date of Tour:</strong> ' . htmlspecialchars($pickUpDate) . '</p>
<p><strong>Time of Tour:</strong> ' . htmlspecialchars($timeOfPickUp) . '</p>
<p><strong>Duration of Tour:</strong> ' . htmlspecialchars($tourDuration) . ' minutes</p>
<p><strong>Duration of Ride:</strong> ' . htmlspecialchars($rideDuration) . ' minutes</p>
<p><strong>Start Address:</strong> ' . htmlspecialchars($pickUpAddress) . '</p>
<p><strong>Finish Address:</strong> ' . htmlspecialchars($destinationAddress) . '</p>
<p><strong>Booking Fee:</strong> $' . htmlspecialchars($bookingFee) . ' paid on ' . htmlspecialchars($pickUpDate) . '</p>
<p><strong>Driver Fare:</strong> $' . htmlspecialchars($driverFare) . ' with ' . htmlspecialchars($paymentMethod) . '</p>
<p><strong>Thank you,</strong></p>
<strong>New York Pedicab Services</strong>
<strong>(212) 961-7435</strong>
<strong>info@newyorkpedicabservices.com</strong>
';
  
						 
						 
						      
         
         

// İlk E-posta
$email1 = new \SendGrid\Mail\Mail(); 
$email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
$email1->setSubject("“Scheduled Central Park Pedicab Tour - " . $bookingNumber);
$email1->addTo("info@newyorkpedicabservices.com", "NYPS");
$htmlContent1 = <<<EOD
         <html>
         <body>
             <h1>Booking Details</h1>
             <p><strong>CONFIRMATION: Central Park Pedicab Tour - </strong> $bookingNumber</p>
             <p><strong>Route:</strong> <a href='https://newyorkpedicabservices.com/book-scheduled-central-pedicab-tour/route/index.php?bookingNumber=$bookingNumber' target='_blank'> View Route</a></p>	
             <p><strong>Type:</strong> Central Park Pedicab Tour</p>
             <p><strong>First Name:</strong> $firstName</p>
             <p><strong>Last Name:</strong> $lastName</p>
             <p><strong>Email Address:</strong> $emailAddress</p>
             <p><strong>Phone Number:</strong> $phoneNumber</p>
             <p><strong>Number of Passengers:</strong> $numPassengers</p>
             <p><strong>Date of Tour:</strong> $pickUpDate</p>
             <p><strong>Time of Tour:</strong> $timeOfPickUp</p>
         	<p><strong>Pick Up 1:</strong> {$pickup1} minutes</p>
         	<p><strong>Pick Up 2:</strong> {$pickup2} minutes</p>
         	<p><strong>Duration of Tour:</strong> {$tourDuration} minutes</p>
             <p><strong>Duration of Ride:</strong> {$rideDuration} minutes</p>
         	<p><strong>Return 1 Duration:</strong> {$return1} minutes</p>
         	<p><strong>Return 2 Duration:</strong> {$return2} minutes</p>	
             <p><strong>Operation Duration:</strong> {$operationDurationFormatted} hours</p>
             <p><strong>Start Address:</strong> $pickUpAddress</p>
             <p><strong>Finish Address:</strong> $destinationAddress</p>
             <p><strong>Hub 1:</strong> West Drive and West 59th Street New York, NY 10019</p>
             <p><strong>Hub 2:</strong> 6th Avenue and Central Park South New York, NY 10019</p>			 
             <p><strong>Operation Fare:</strong> \${$operationFare} per hour</p>
             <p><strong>Booking Fee:</strong> \$$bookingFee paid on $orderMonth/$orderDay/$orderYear</p>
             <p><strong>Driver Fare:</strong> \${$driverFare} with $paymentMethod</p>
             <p><strong>Total Fare:</strong> \${$totalFare}</p>
             <h2>Driver Note</h2>
            <strong>Type:</strong> Scheduled Central Park Pedicab Tour<br><strong>First:</strong> $firstName<br><strong>Last:</strong> $lastName<br><strong>Phone:</strong> $phoneNumber<br><strong>Passengers:</strong> $numPassengers<br><strong>Date:</strong>$pickUpDate<br><strong>Time:</strong> $timeOfPickUp<br><strong>Tour Duration:</strong> {$tourDuration} minutes<br><strong>Ride Duration:</strong> {$rideDuration} minutes<br><strong>Start:</strong> $pickUpAddress<br><strong>Finish:</strong> $destinationAddress<br><strong>Pay:</strong> \${$driverFare} with $paymentMethod by customer $firstName $lastName
         </body>
         </html>
         EOD;
$email1->addContent("text/html", $htmlContent1);


// İkinci E-posta
$email2 = new \SendGrid\Mail\Mail(); 
$email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
$email2->setSubject("CONFIRMATION: Central Park Pedicab Ride - " . $bookingNumber);
$email2->addTo($emailAddress, "NYPS");
$htmlContent2 = <<<EOD
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
    <p><strong>Date of Tour:</strong> $pickUpDate</p>
    <p><strong>Time of Tour:</strong> $timeOfPickUp</p>
    <p><strong>Duration of Tour:</strong> {$tourDuration} minutes</p>	
    <p><strong>Duration of Ride:</strong> {$rideDuration} minutes</p>
    <p><strong>Start Address:</strong> $pickUpAddress</p>
    <p><strong>Finish Address:</strong> $destinationAddress</p>	
    <p><strong>Booking Fee:</strong> \$$bookingFee paid on $pickUpDate</p>
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
    //print $response1->statusCode() . "\n";
    //print_r($response1->headers());
   //print $response1->body() . "\n";
    
    // İkinci e-posta gönderimi
    $response2 = $sendgrid->send($email2);
    //print $response2->statusCode() . "\n";
    //print_r($response2->headers());
   // print $response2->body() . "\n";
} catch (Exception $e) {
    
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