<?php
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   
    if ($_POST){
   // Formdan alınan bilgiler
       // Formdan alınan bilgiler
   $firstName = $_POST["firstName"]; // varsayılan değer 1
   $lastName = $_POST["lastName"]; // varsayılan değer 1
   $email = $_POST["email"]; // varsayılan değer 1
   $phoneNumber = $_POST["phoneNumber"]; // varsayılan değer 1
   $numPassengers = $_POST["numPassengers"] ?? 1; // varsayılan değer 1
   $pickUpDate = $_POST["pickUpDate"];
   $hours = $_POST["hours"];
   $minutes = $_POST["minutes"];
   $ampm = $_POST["ampm"];
   $deneme2 = $_POST["pickUpAddress"];
   $destinationAddress = $_POST["destinationAddress"];
   $paymentMethod = $_POST["paymentMethod"];
   $tourDuration = $_POST["tourDuration"];
	$countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
   }
   
   
  else if ($_GET){
      // Formdan alınan bilgiler
   $firstName = $_GET["firstName"]; // varsayılan değer 1
   $lastName = $_GET["lastName"]; // varsayılan değer 1
   $email = $_GET["email"]; // varsayılan değer 1
   $phoneNumber = $_GET["phoneNumber"]; // varsayılan değer 1
   $numPassengers = $_GET["numPassengers"] ?? 1; // varsayılan değer 1
   $pickUpDate = $_GET["pickUpDate"];
   $hours = $_GET["hours"];
   $minutes = $_GET["minutes"];
   $ampm = $_GET["ampm"];
   $deneme2 = $_GET["pickUpAddress"];
   $destinationAddress = $_GET["destinationAddress"];
   $paymentMethod = $_GET["paymentMethod"];
   $tourDuration = $_GET["tourDuration"];
	$countryCode = $_GET["countryCode"];
    $countryName = $_GET["countryName"];
   }
   
 else {
    header("location: index.php");
	exit;
}
   
      $zipCodes = [
            '10017', '10018', '10019', '10020', '10022', '10036', '10055',
            '10101', '10102', '10103', '10104', '10105', '10106', '10107',
            '10108', '10109', '10110', '10111', '10112', '10124', '10126',
            '10129', '10151', '10152', '10153', '10154', '10155', '10163',
            '10164', '10166', '10167', '10169', '10170', '10171', '10172',
            '10173', '10174', '10175', '10176', '10177', '10179', '10185'
];

// Belirtilen zip kodlarının olup olmadığını kontrol et
$checkZipCodes = function($address) use ($zipCodes) {
    foreach ($zipCodes as $zipCode) {
        if (strpos($address, $zipCode) !== false) {
            return true;
        }
    }
    return false;
};

if (!$checkZipCodes($deneme2) || !$checkZipCodes($destinationAddress)) {
    $queryParams = http_build_query([
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'phoneNumber' => $phoneNumber,
		'countryCode' => $countryCode,
        "countryName" => $countryName,
        'numPassengers' => $numPassengers,
        'pickUpDate' => $pickUpDate,
        'hours' => $hours,
        'minutes' => $minutes,
        'ampm' => $ampm,
        'pickUpAddress' => $deneme2,
        'destinationAddress' => $destinationAddress,
        'paymentMethod' => $paymentMethod,
		'error' => 'yes',
    ]);
    header("location: index.php?$queryParams");
    exit;
}
   
   
   
       $hub1 = "6th Avenue and Central Park South New York, NY 10019";
       $hub2 = "West Drive and West 59th Street New York, NY 10019";
   
   
   // Tarihi 'm/d/Y' formatından 'Y-m-d' formatına çevirme
   $convertedDate = DateTime::createFromFormat('m/d/Y', $pickUpDate)->format('Y-m-d');
   
   // Yeni tarihi kullanarak gün adını bulma
   $dayName = date('l', strtotime($convertedDate));
   
   $hourlyOperationFare = 0;
   
   // Check day name and December
   if (strpos($dayName, 'Monday') !== false || 
    strpos($dayName, 'Tuesday') !== false || 
    strpos($dayName, 'Wednesday') !== false || 
    strpos($dayName, 'Thursday') !== false) {
    // Monday to Thursday
    $hourlyOperationFare = 60;
   } elseif (strpos($dayName, 'Friday') !== false || 
          strpos($dayName, 'Saturday') !== false || 
          strpos($dayName, 'Sunday') !== false) {
    // Friday to Sunday
    $hourlyOperationFare = 70;
   }
   
   // Check if it's December
   if (date('m', strtotime($convertedDate)) == 12) {
    if (strpos($dayName, 'Monday') !== false || 
        strpos($dayName, 'Tuesday') !== false || 
        strpos($dayName, 'Wednesday') !== false || 
        strpos($dayName, 'Thursday') !== false) {
        // Monday to Thursday in December
        $hourlyOperationFare = 80;
    } elseif (strpos($dayName, 'Friday') !== false || 
              strpos($dayName, 'Saturday') !== false || 
              strpos($dayName, 'Sunday') !== false) {
        // Friday to Sunday in December
        $hourlyOperationFare = 90;
    }
   }
   
   
   function getShortestBicycleRouteDuration($origin, $destination) {
    $apiKey = 'AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY'; // API anahtarınızı buraya girin
    $origin = urlencode($origin);
    $destination = urlencode($destination);
   
    // Bisiklet modu parametresi ekleniyor
    $url = "https://maps.googleapis.com/maps/api/directions/json?origin=$origin&destination=$destination&mode=bicycling&key=$apiKey";
   
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
   
    if ($response) {
        $data = json_decode($response, true);
        if (isset($data['routes']) && count($data['routes']) > 0) {
            // En kısa süreyi bul
            $shortestDuration = PHP_INT_MAX;
            foreach ($data['routes'] as $route) {
                $routeDuration = 0;
                foreach ($route['legs'] as $leg) {
                    $routeDuration += $leg['duration']['value'];
                }
                if ($routeDuration < $shortestDuration) {
                    $shortestDuration = $routeDuration;
                }
            }
            
            // En kısa sürenin dakika cinsinden hesaplanması
            if ($shortestDuration !== PHP_INT_MAX) {
                $minutes = floor($shortestDuration / 60);
                $seconds = $shortestDuration % 60;
                return sprintf("%.2f", $minutes + ($seconds / 60)); // Süreyi "24.11" gibi bir formatla döndür
            }
        }
    }
   
    return false; // Uygun rota bulunamazsa false döndür
   }
   
   
   
   // Pick Up 1 süresi
   $origin = $hub1;
   $destination = $deneme2;
   $pickup1suresi = getShortestBicycleRouteDuration($origin, $destination);
   
   // Pick Up 2 süresi
   $origin = $deneme2;
   $destination = $hub2;
   $pickup2suresi = getShortestBicycleRouteDuration($origin, $destination);
   
   // Tour süresi
   $origin = $deneme2;
   $destination = $destinationAddress;
   $toursuresi = getShortestBicycleRouteDuration($origin, $destination);
   
   // Return 1 süresi
   $origin = $hub1;
   $destination = $destinationAddress;
   $return1suresi = getShortestBicycleRouteDuration($origin, $destination);
   
   // Return 2 süresi
   $origin = $destinationAddress;
   $destination = $hub2;
   $return2suresi = getShortestBicycleRouteDuration($origin, $destination);
   
   
   // Örnek olarak sabit süreler kullanalım (dakika cinsinden)
   $pickup1 = $pickup1suresi; // Pick Up 1 süresi
   $pickup2 = $pickup2suresi; // Pick Up 2 süresi
   $toursuresi = $toursuresi;// Tour süresi
   $return1 = $return1suresi; // Return 1 süresi
   $return2 = $return2suresi; // Return 2 süresi
   
   
   
   
   
   $pickup1 *= 2.5;
   $pickup2 *= 2.5;
   $return1 *= 2.5;
   $return2 *= 2.5;
   $toursuresi  = $toursuresi;
   
   
   
   // Calculate Operatino Fare
   
   $operationFare = $pickup1 + $pickup2 + $return1 + $return2 + $tourDuration;
     
   // Calculate Booking Fee
   
   $bookingFee = 0.2 * $operationFare;
   
   // Calculate Driver Fare with CASH
   
   if ($paymentMethod == "cash"){
   $driverFare = 0.8 * $operationFare;
   }
   
   // Calculate Driver Fare with CARD
   if ($paymentMethod == "card"){
   $driverFare = 0.8 * $operationFare;
   $driverFare = 1.1 * $driverFare;
   }
   
   
   // Calculate Total Fare
   
   $totalFare = $bookingFee + $driverFare;
   
   
   
   
   
   
   // Toplam süre (dakika cinsinden)
   $rideDuration = $pickup2 + $tourDuration + $return1;
   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book Scheduled Central Park Pedicab Tour</title>
	  <meta name="description" content="Scheduled Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta etiketi eklendi -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
      <style>
         .top-controls {
         position: absolute;
         top: 10px; /* Sayfanın en üstünden 10px aşağıda */
         right: 50%; /* Yatayda ortalanacak */
         transform: translateX(-50%); /* Sol tarafından %50 geri gelerek tam ortalanmış olacak */
         z-index: 1000; /* Diğer içeriklerin üzerinde görünür */
         }
         .centered-title {
         text-align: center;
         margin-top: 70px; /* Butonlar ve başlık için üstten boşluk */
         }
      </style>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
   </head>
   <body>
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-6">
               <!-- Formu daha dar bir sütuna sığdırarak merkezle -->
               <div id="map" style="margin-top:30px;display:none;"></div>
               <form method="post" id="myform" action="">
                  <input type="hidden" name="firstName" value="<?=$firstName?>">
                  <input type="hidden" name="lastName" value="<?=$lastName?>">
                  <input type="hidden" name="email" value="<?=$email?>">
                  <input type="hidden" name="phoneNumber" value="<?=$phoneNumber?>">	
				  <input type="hidden" name="countryCode" value="<?=$countryCode?>">	
				  <input type="hidden" name="countryName" value="<?= $countryName ?>">
                  <input type="hidden" name="numPassengers" value="<?=$numPassengers?>">
                  <input type="hidden" name="pickUpDate" value="<?=$pickUpDate?>">
                  <input type="hidden" name="hours" value="<?=$hours?>">
                  <input type="hidden" name="minutes" value="<?=$minutes?>">
                  <input type="hidden" name="ampm" value="<?=$ampm?>">
                  <input type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
                  <input type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
                  <input type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
                  <input type="hidden" name="rideDuration" value="<?=$rideDuration?>">	
                  <input type="hidden" name="tourDuration" value="<?=$tourDuration?>">	
                  <input type="hidden" name="pickup1" value="<?=$pickup1?>">
                  <input type="hidden" name="pickup2" value="<?=$pickup2?>">
                  <input type="hidden" name="return1" value="<?=$return1?>">
                  <input type="hidden" name="return2" value="<?=$return2?>">	
                  <input type="hidden" name="toursuresi" value="<?=$toursuresi?>">		
                  <input type="hidden" id="jsData" name="min" value="">
                  <input type="submit" class="btn" style="background-color: #0909ff; color:white; display:none;" value="Review">
               </form>
            </div>
         </div>
      </div>
      </form>
      <script>
         document.getElementById("nextButton").addEventListener("click", function() {
             document.getElementById("myform").submit();
         });
         
      </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput-jquery.min.js"></script>
      <script>
         // Telefon numarası giriş alanını al
         var phoneNumberInput = document.getElementById("phoneNumber");
         
         // Ülke kodunu al
         var countryCode = "+1"; // Örnek ülke kodu (ABD)
         
         // Telefon numarasının başına ülke kodunu ekleyen işlev
         function addCountryCode() {
             var phoneNumber = phoneNumberInput.value.replace(/\D/g, ''); // Sadece rakamları al
         
             // Telefon numarasının başına ülke kodunu ekleyerek biçimlendir
             var formattedPhoneNumber = countryCode + phoneNumber;
         
             // Biçimli numarayı giriş alanına yerleştir
             phoneNumberInput.value = formattedPhoneNumber;
         }
         
         // Telefon numarası girişi değiştiğinde biçimlendirme işlemini gerçekleştir
         phoneNumberInput.addEventListener("input", function(event) {
             var input = event.target.value;
             
             // Sadece rakamları al
             var phoneNumber = input.replace(/\D/g, '');
         
             // 10 haneli telefon numarası biçimini kontrol et
             var phoneNumberRegex = /^(\d{3})(\d{3})(\d{4})$/;
             if (phoneNumberRegex.test(phoneNumber)) {
                 // Numarayı biçimlendir ve parantezler ekleyerek döndür
                 var formattedPhoneNumber = phoneNumber.replace(phoneNumberRegex, "($1) $2-$3");
         
                 // Biçimli numarayı giriş alanına yerleştir
                 event.target.value = formattedPhoneNumber;
             }
         });
         
         // Sayfa yüklendiğinde ve telefon numarası girişi bittiğinde ülke kodunu telefon numarasına ekle
         phoneNumberInput.addEventListener("blur", addCountryCode);
         
         // Sayfa yüklendiğinde ülke kodunu telefon numarasına ekle
         addCountryCode();
      </script>
      <script>
         function initMap() {
             var map = new google.maps.Map(document.getElementById('map'), {
                 zoom: 14,
                 center: {lat: 40.712776, lng: -74.005974},
                 styles: [
                     {
                         featureType: 'road',
                         elementType: 'geometry',
                         stylers: [{color: '#f5f1e6'}]
                     }
                 ]
             });
         
             var directionsService = new google.maps.DirectionsService();
             var directionsRenderer = new google.maps.DirectionsRenderer({
                 map: map,
                 suppressMarkers: true,  // Varsayılan işaretçileri kaldır
                 polylineOptions: {
                     strokeColor: '#FF0000',  // Çizgi rengini kırmızı yap
                     strokeOpacity: 0.8,      // Çizginin opaklığı
                     strokeWeight: 6          // Çizgi kalınlığı
                 }
             });
         
             var pickupAddress = <?php echo json_encode($deneme2); ?>;
             var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
         
             calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress);
         }
         
         function calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress) {
             directionsService.route({
                 origin: pickupAddress,
                 destination: destinationAddress,
                 travelMode: 'BICYCLING',
                 provideRouteAlternatives: true  // Alternatif rotaları sağla
             }, function(response, status) {
                 if (status === 'OK') {
                     var fastestRouteIndex = findFastestRouteIndex(response.routes);
                     directionsRenderer.setDirections(response);
                     directionsRenderer.setRouteIndex(fastestRouteIndex);
                     addCustomMarkers(response.routes[fastestRouteIndex], map);
         
                     // Rotanın süresini hesapla
         var durationMinutes = parseFloat(response.routes[fastestRouteIndex].legs.reduce((sum, leg) => sum + leg.duration.value, 0) / 60);
         
         
         
         			console.log("durationMinutes: " + durationMinutes);
         			
          document.getElementById('jsData').value = durationMinutes;
           var form = document.getElementById('myform');
                      form.action = 'step2.php'; // Formun action'ını ayarla
                     form.submit(); // Formu submit et
         
                 } else {
                     window.alert('Directions request failed due to ' + status);
                 }
             });
         }
         
         
         function findFastestRouteIndex(routes) {
             var index = 0;
             var minDuration = Number.MAX_VALUE;
         
             routes.forEach(function(route, i) {
                 var routeDuration = route.legs.reduce((sum, leg) => sum + leg.duration.value, 0);
                 if (routeDuration < minDuration) {
                     minDuration = routeDuration;
                     index = i;
                 }
             });
         
             return index;
         }
         
         function addCustomMarkers(route, map) {
             var startMarker = new google.maps.Marker({
                 position: route.legs[0].start_location,
                 map: map,
                 label: 'A',
                 title: 'Start: ' + route.legs[0].start_address
             });
         
             var endMarker = new google.maps.Marker({
                 position: route.legs[0].end_location,
                 map: map,
                 label: 'B',
                 title: 'End: ' + route.legs[0].end_address
             });
         }
      </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&callback=initMap"></script>  
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <script>
         // Bu fonksiyon, hesaplanan süreyi PHP dosyasına gönderir
         
      </script>
      <script>
         document.getElementById("prevButton").addEventListener("click", function() {
             // URL'den parametreleri al
             var urlParams = new URLSearchParams(window.location.search);
         
             // Eğer GET parametreleri varsa, onları kullan
             var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode($_GET["numPassengers"] ?? $_POST["numPassengers"] ?? 1); ?>;
             var pickUpDate = urlParams.has('pickUpDate') ? urlParams.get('pickUpDate') : <?php echo json_encode($_GET["pickUpDate"] ?? $_POST["pickUpDate"] ?? ''); ?>;
             var hours24 = urlParams.has('hours') ? urlParams.get('hours') : <?php echo json_encode($_GET["hours"] ?? $_POST["hours"] ?? ''); ?>; // 24 saatlik formatta saat
             var minutes = urlParams.has('minutes') ? urlParams.get('minutes') : <?php echo json_encode($_GET["minutes"] ?? $_POST["minutes"] ?? ''); ?>;
             var ampm = urlParams.has('ampm') ? urlParams.get('ampm') : <?php echo json_encode($_GET["ampm"] ?? $_POST["ampm"] ?? ''); ?>;
             var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode($_GET["pickUpAddress"] ?? $_POST["pickUpAddress"] ?? ''); ?>;
             var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode($_GET["destinationAddress"] ?? $_POST["destinationAddress"] ?? ''); ?>;
             var paymentMethod = urlParams.has('paymentMethod') ? urlParams.get('paymentMethod') : <?php echo json_encode($_GET["paymentMethod"] ?? $_POST["paymentMethod"] ?? ''); ?>;
             var firstName = urlParams.has('firstName') ? urlParams.get('firstName') : <?php echo json_encode($_GET["firstName"] ?? $_POST["firstName"] ?? ''); ?>;
             var lastName = urlParams.has('lastName') ? urlParams.get('lastName') : <?php echo json_encode($_GET["lastName"] ?? $_POST["lastName"] ?? ''); ?>;
             var email = urlParams.has('email') ? urlParams.get('email') : <?php echo json_encode($_GET["email"] ?? $_POST["email"] ?? ''); ?>;
             var phoneNumber = urlParams.has('phoneNumber') ? urlParams.get('phoneNumber') : <?php echo json_encode($_GET["phoneNumber"] ?? $_POST["phoneNumber"] ?? ''); ?>;
			var countryCode = urlParams.has('countryCode') ? urlParams.get('countryCode') : <?php echo json_encode($_GET["countryCode"] ?? $_POST["countryCode"] ?? ''); ?>;
			 var countryName = urlParams.has('countryName') ? urlParams.get('countryName') : <?php echo json_encode(
     $_GET["countryName"] ?? ($_POST["countryName"] ?? "")
 ); ?>;
             var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode($_GET["bookingFee"] ?? $_POST["bookingFee"] ?? ''); ?>;
             var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode($_GET["driverFare"] ?? $_POST["driverFare"] ?? ''); ?>;
             var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode($_GET["totalFare"] ?? $_POST["totalFare"] ?? ''); ?>;	
             var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode($_GET["rideDuration"] ?? $_POST["rideDuration"] ?? ''); ?>;	
             var tourDuration = urlParams.has('tourDuration') ? urlParams.get('tourDuration') : <?php echo json_encode($_GET["tourDuration"] ?? $_POST["tourDuration"] ?? ''); ?>;	
         	 var pickup1 = urlParams.has('pickup1') ? urlParams.get('pickup1') : <?php echo json_encode($_GET["pickup1"] ?? $_POST["pickup1"] ?? ''); ?>;
             var pickup2 = urlParams.has('pickup2') ? urlParams.get('pickup2') : <?php echo json_encode($_GET["pickup2"] ?? $_POST["pickup2"] ?? ''); ?>;	
             var return1 = urlParams.has('return1') ? urlParams.get('return1') : <?php echo json_encode($_GET["return1"] ?? $_POST["return1"] ?? ''); ?>;	
             var return2 = urlParams.has('return2') ? urlParams.get('return2') : <?php echo json_encode($_GET["return2"] ?? $_POST["return2"] ?? ''); ?>;	
         	var toursuresi = urlParams.has('toursuresi') ? urlParams.get('toursuresi') : <?php echo json_encode($_GET["toursuresi"] ?? $_POST["toursuresi"] ?? ''); ?>;	
         		
         		
         		
         		    <input type="hidden" name="pickup1" value="<?=$pickup1?>">
             <input type="hidden" name="pickup2" value="<?=$pickup2?>">
             <input type="hidden" name="return1" value="<?=$return1?>">
             <input type="hidden" name="return1" value="<?=$return1?>">	
             <input type="hidden" name="toursuresi" value="<?=$toursuresi?>">	
         
         
             // ...
         
             // Ardından, işlemleriniz tamamlandıktan sonra yönlendirme yapabilirsiniz
             var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
                               "&pickUpDate=" + encodeURIComponent(pickUpDate) +
                               "&hours=" + encodeURIComponent(hours) +
                               "&minutes=" + encodeURIComponent(minutes) +
                               "&ampm=" + encodeURIComponent(ampm) +
                               "&pickUpAddress=" + encodeURIComponent(pickUpAddress) +
                               "&destinationAddress=" + encodeURIComponent(destinationAddress) +
                               "&paymentMethod=" + encodeURIComponent(paymentMethod) +
                               "&firstName=" + encodeURIComponent(firstName) +
                               "&lastName=" + encodeURIComponent(lastName) +
                               "&email=" + encodeURIComponent(email) +
                               "&phoneNumber=" + encodeURIComponent(phoneNumber) +
								"&countryCode=" + encodeURIComponent(countryCode) +
								"&countryName=" + encodeURIComponent(countryName) +
                               "&bookingFee=" + encodeURIComponent(bookingFee) +
                               "&driverFare=" + encodeURIComponent(driverFare) +
                               "&totalFare=" + encodeURIComponent(totalFare) +
                               "&rideDuration=" + encodeURIComponent(rideDuration)+
         					  "&pickup1=" + encodeURIComponent(pickup1) +
                               "&pickup2=" + encodeURIComponent(pickup2) +
                               "&return1=" + encodeURIComponent(return1) +
                               "&return2=" + encodeURIComponent(return2)+
         					  "&toursuresi=" + encodeURIComponent(toursuresi)+
         					  "&tourDuration=" + encodeURIComponent(tourDuration)
         
             window.location.href = "index.php?" + queryString;
         });
         
      </script>
   </body>
</html>