<?php 
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
    $serviceDetails = $_POST["serviceDetails"];  
    $serviceDuration = $_POST["serviceDuration"];  	
	
   }
  
   
   if ($_GET){
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
    $serviceDetails = $_GET["serviceDetails"];  
    $serviceDuration = $_GET["serviceDuration"];  	
   }
   
   $hours12 = $hours;
   
   // AM/PM formatını dikkate alarak saat bilgisini 24 saatlik formata çevirme
   $hours = $ampm === 'PM' && $hours != 12 ? $hours + 12 : ($ampm === 'AM' && $hours == 12 ? 0 : $hours);
   
   // Tarih ve saat bilgisini işle
   $pickupDateTime = DateTime::createFromFormat('m/d/Y H:i', $pickUpDate . " " . $hours . ":" . $minutes);
   if (!$pickupDateTime) {
       die("Geçersiz tarih formatı. Lütfen tarih ve saat bilgilerini kontrol edin.");
   }
   $dayOfWeek = $pickupDateTime->format('l');
   $month = $pickupDateTime->format('F');
   $hour24 = (int) $pickupDateTime->format('G'); // 24 saatlik format
   
   // HUB seçimi
   if ($hour24 >= 9 && $hour24 < 16) {
       $hub = "West Drive and West 59th Street New York, NY 10019";
   } elseif ($hour24 >= 16 && $hour24 < 19) {
       $hub = "6th Avenue and West 48th Street New York, NY 10020";
   } else {
       $hub = "7th Avenue and West 48th Street New York, NY 10036";
   }
   
   
   // Base Fare hesaplama
   $isWeekend = in_array($dayOfWeek, ['Friday', 'Saturday', 'Sunday']);
   $baseFare = $isWeekend ? 35 : 30;
   if ($month == "December") {
       $baseFare += 10;
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



// Pick Up süresi
$origin = $hub;
$destination = $deneme2;
$pickupsuresi = getShortestBicycleRouteDuration($origin, $destination);

// Ride süresi
$origin = $deneme2;
$destination = $destinationAddress;
$ridesuresi = getShortestBicycleRouteDuration($origin, $destination);

// Return süresi
$origin = $destinationAddress;
$destination = $hub;
$returnsuresi = getShortestBicycleRouteDuration($origin, $destination);




	

// Örnek olarak sabit süreler kullanalım (dakika cinsinden)
$pickUpDuration = $pickupsuresi; // Pick Up süresi
$rideDuration = $ridesuresi; // Ride süresi
$returnDuration = $returnsuresi; // Return süresi


$pickUpDuration *= 2.5;
$returnDuration *= 2.5;
   
   function calculateOperationFarePerHour($dayOfWeek, $month) {
    $isWeekend = in_array($dayOfWeek, ['Friday', 'Saturday', 'Sunday']);
    if ($month == "December") {
        return $isWeekend ? 45 : 40; // Aralık hafta sonu ve hafta içi farklı ücret
    } else {
        return $isWeekend ? 35 : 30; // Normal hafta sonu ve hafta içi farklı ücret
    }
}
   
   // Toplam süre (dakika cinsinden)
$totalDurationMinutes = $pickUpDuration + $serviceDuration + $returnDuration;

// Saatlik ücret hesaplama
$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month);

// Toplam Operation Fare hesaplama (dakikayı saate çevirip saatlik ücretle çarparak)
$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;

   // Kodun geri kalanını bu doğrultuda güncelleyin...
   
// Booking Fee ve Driver Fare hesaplama
$baseFareOperationRate = $baseFare + $operationFare;

if ($totalDurationMinutes <= 120) { // 0.5, 1, 1.5 veya 2 saat
    $bookingFee = 0.2 * $baseFareOperationRate;
    $driverFare = 0.8 * $baseFareOperationRate;
} elseif ($totalDurationMinutes <= 300) { // 3, 4 veya 5 saat
    $bookingFee = 0.3 * $baseFareOperationRate;
    $driverFare = 0.7 * $baseFareOperationRate;
} else { // 6, 7 veya 8 saat
    $bookingFee = 0.4 * $baseFareOperationRate;
    $driverFare = 0.6 * $baseFareOperationRate;
}

if ($paymentMethod === "card") {
    $driverFare *= 1.1;
}


   $minFares = [
       'cash' => [
           'week' => ['Booking Fee' => 9, 'Driver Fare' => 36, 'Total Fare' => 45],
           'weekend' => ['Booking Fee' => 10.5, 'Driver Fare' => 42, 'Total Fare' => 52.5],
           'weekDecember' => ['Booking Fee' => 12, 'Driver Fare' => 48, 'Total Fare' => 60],
           'weekendDecember' => ['Booking Fee' => 13.5, 'Driver Fare' => 54, 'Total Fare' => 67.5]
       ],
       'card' => [
           'week' => ['Booking Fee' => 9, 'Driver Fare' => 39.6, 'Total Fare' => 48.6],
           'weekend' => ['Booking Fee' => 10.5, 'Driver Fare' => 46.2, 'Total Fare' => 56.7],
           'weekDecember' => ['Booking Fee' => 12, 'Driver Fare' => 52.8, 'Total Fare' => 64.8],
           'weekendDecember' => ['Booking Fee' => 13.5, 'Driver Fare' => 59.4, 'Total Fare' => 72.9]
       ]
   ];
   

   $key = ($isWeekend ? 'weekend' : 'week') . ($month == "December" ? 'December' : '');
   $minBookingFee = $minFares[$paymentMethod][$key]['Booking Fee'];
   $minDriverFare = $minFares[$paymentMethod][$key]['Driver Fare'];
   $minTotalFare = $minFares[$paymentMethod][$key]['Total Fare'];
   
// Minimum ücretler ile karşılaştır
$bookingFee = max($bookingFee, $minBookingFee);
$driverFare = max($driverFare, $minDriverFare);
   if ($paymentMethod === "fullcard") {
       $bookingFee *= 1.2;
	   $driverFare *= 1.2;
   }
$totalFare = max($bookingFee + $driverFare, $minTotalFare);

   
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book Your Pedicab Ride</title>
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
    <input type="hidden" name="numPassengers" value="<?=$numPassengers?>">
    <input type="hidden" name="pickUpDate" value="<?=$pickUpDate?>">
    <input type="hidden" name="hours" value="<?=$hours12?>">
    <input type="hidden" name="minutes" value="<?=$minutes?>">
    <input type="hidden" name="ampm" value="<?=$ampm?>">
    <input type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
    <input type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
    <input type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
	<input type="hidden" name="serviceDuration" value="<?=$serviceDuration?>">
	<input type="hidden" name="serviceDetails" value="<?=$serviceDetails?>">
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
    $("#phoneNumber").intlTelInput({
        initialCountry: "us", // Kullanıcının bulunduğu ülkeyi otomatik olarak seçer
        separateDialCode: true, // Telefon kodunu ayrı bir alan olarak gösterir
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Kodu formatlamak için gerekli yardımcı script
    });
</script>
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
    var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode($_GET["bookingFee"] ?? $_POST["bookingFee"] ?? ''); ?>;
    var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode($_GET["driverFare"] ?? $_POST["driverFare"] ?? ''); ?>;
    var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode($_GET["totalFare"] ?? $_POST["totalFare"] ?? ''); ?>;	
    var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode($_GET["rideDuration"] ?? $_POST["rideDuration"] ?? ''); ?>;	
    var serviceDetails = urlParams.has('serviceDetails') ? urlParams.get('serviceDetails') : <?php echo json_encode($_GET["serviceDetails"] ?? $_POST["serviceDetails"] ?? ''); ?>;		
    var serviceDuration = urlParams.has('serviceDuration') ? urlParams.get('serviceDuration') : <?php echo json_encode($_GET["serviceDuration"] ?? $_POST["serviceDuration"] ?? ''); ?>;			

    // 12 saatlik formata çevir
    var hours12 = hours24 % 12 || 12; // 12 saatlik formatta saat

    // Şimdi gerekli işlemleri yapabilirsiniz
    // ...

    // Ardından, işlemleriniz tamamlandıktan sonra yönlendirme yapabilirsiniz
    var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
                      "&pickUpDate=" + encodeURIComponent(pickUpDate) +
                      "&hours=" + encodeURIComponent(hours12) +
                      "&minutes=" + encodeURIComponent(minutes) +
                      "&ampm=" + encodeURIComponent(ampm) +
                      "&pickUpAddress=" + encodeURIComponent(pickUpAddress) +
                      "&destinationAddress=" + encodeURIComponent(destinationAddress) +
                      "&paymentMethod=" + encodeURIComponent(paymentMethod) +
                      "&firstName=" + encodeURIComponent(firstName) +
                      "&lastName=" + encodeURIComponent(lastName) +
                      "&email=" + encodeURIComponent(email) +
                      "&phoneNumber=" + encodeURIComponent(phoneNumber) +
                      "&bookingFee=" + encodeURIComponent(bookingFee) +
                      "&driverFare=" + encodeURIComponent(driverFare) +
                      "&totalFare=" + encodeURIComponent(totalFare) +
                      "&serviceDetails=" + encodeURIComponent(serviceDetails) +
                      "&serviceDuration=" + encodeURIComponent(serviceDuration) +
                      "&rideDuration=" + encodeURIComponent(rideDuration);

    window.location.href = "index.php?" + queryString;
});

</script>

   </body>
</html>