<?php  
    if ($_POST){
 // Formdan alınan bilgiler
 // Formdan alınan bilgiler
 	     // Formdan alınan bilgiler
	$firstName = $_POST["firstName"]; // varsayılan değer 1
	$lastName = $_POST["lastName"]; // varsayılan değer 1
	$email = $_POST["email"]; // varsayılan değer 1
	$phoneNumber = $_POST["phoneNumber"]; // varsayılan değer 1
		$lastTenDigits = substr($phoneNumber, -10);

// Başta kalan rakamları almak
$countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);

	$phoneNumber = substr($phoneNumber, -10);
   $numPassengers = $_POST["numPassengers"] ?? 1; // varsayılan değer 1
   $pickUpDate = $_POST["pickUpDate"];
   $hours = $_POST["hours"];
   $minutes = $_POST["minutes"];
   $ampm = $_POST["ampm"];
   $deneme2 = $_POST["pickUpAddress"];
   $destinationAddress = $_POST["destinationAddress"];
   $paymentMethod = $_POST["paymentMethod"];
   $rideDuration = $_POST["min"];
      $bookingFee = $_POST["bookingFee"];
   $driverFare = $_POST["driverFare"];
   $totalFare = $_POST["totalFare"];
       $returnDuration = $_POST["returnDuration"];
   $pickUpDuration = $_POST["pickUpDuration"];
      $hub = $_POST["hub"];
   $baseFare = $_POST["baseFare"];
   $operationFare = $_POST["operationFare"];  
       $serviceDetails = $_POST["serviceDetails"];  
	$serviceDuration = $_POST["serviceDuration"];  	
   }
  
   
   if ($_GET){
	     // Formdan alınan bilgiler
	$firstName = $_GET["firstName"]; // varsayılan değer 1
	$lastName = $_GET["lastName"]; // varsayılan değer 1
	$email = $_GET["email"]; // varsayılan değer 1
	$phoneNumber = $_GET["phoneNumber"]; // varsayılan değer 1
		// Son 10 rakamı çıkartmak
$lastTenDigits = substr($phoneNumber, -10);

// Başta kalan rakamları almak
$countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);

	$phoneNumber = substr($phoneNumber, -10);
   $numPassengers = $_GET["numPassengers"] ?? 1; // varsayılan değer 1
   $pickUpDate = $_GET["pickUpDate"];
   $hours = $_GET["hours"];
   $minutes = $_GET["minutes"];
   $ampm = $_GET["ampm"];
   $deneme2 = $_GET["pickUpAddress"];
   $destinationAddress = $_GET["destinationAddress"];
   $paymentMethod = $_GET["paymentMethod"];
    $rideDuration = $_GET["rideDuration"];
      $bookingFee = $_GET["bookingFee"];
   $driverFare = $_GET["driverFare"];
   $totalFare = $_GET["totalFare"];
         $returnDuration = $_GET["returnDuration"];
    $pickUpDuration = $_GET["pickUpDuration"];
      $hub = $_GET["hub"];
   $baseFare = $_GET["baseFare"];
   $operationFare = $_GET["operationFare"];
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



$origin = $hub;
$destination = $deneme2;
$pickupsuresi = getShortestBicycleRouteDuration($origin, $destination);

$origin = $deneme2;
$destination = $destinationAddress;
$ridesuresi = getShortestBicycleRouteDuration($origin, $destination);

$origin = $destinationAddress;
$destination = $hub;
$returnsuresi = getShortestBicycleRouteDuration($origin, $destination);

$pickUpDuration = $pickupsuresi * 2.5; 
$rideDuration = $ridesuresi; 
$returnDuration = $returnsuresi * 2.5;



   
 function calculateOperationFarePerHour($dayOfWeek, $month) {
    $isWeekend = in_array($dayOfWeek, ['Friday', 'Saturday', 'Sunday']);
    if ($month == "December") {
        return $isWeekend ? 45 : 40;
    } else {
        return $isWeekend ? 35 : 30;
    }
}


if ($serviceDuration != 30 OR $serviceDuration != 90){
	$timeCheck = $serviceDuration * 60;
}
else {
	$timeCheck = $serviceDuration;
}
   
$totalDurationMinutes = $pickUpDuration + $returnDuration + $timeCheck;

$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month);

$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;


   // Kodun geri kalanını bu doğrultuda güncelleyin...
$baseFareOperationRate = $baseFare + $operationFare;

if ($totalDurationMinutes <= 120) {
    $bookingFee = 0.2 * $baseFareOperationRate;
    $driverFare = 0.8 * $baseFareOperationRate;
} elseif ($totalDurationMinutes <= 300) {
    $bookingFee = 0.3 * $baseFareOperationRate;
    $driverFare = 0.7 * $baseFareOperationRate;
} else {
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

if (!array_key_exists($paymentMethod, $minFares)) {
    die("Geçersiz ödeme metodu: $paymentMethod");
}

$key = ($isWeekend ? 'weekend' : 'week') . ($month == "December" ? 'December' : '');
$minBookingFee = $minFares[$paymentMethod][$key]['Booking Fee'];
$minDriverFare = $minFares[$paymentMethod][$key]['Driver Fare'];
$minTotalFare = $minFares[$paymentMethod][$key]['Total Fare'];

$bookingFee = max($bookingFee, $minBookingFee);
$driverFare = max($driverFare, $minDriverFare);
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
		
        .country-list {
            position: relative;
            flex: 1;
        }

        .country-select {
            display: block;
            width: 100%;
            padding: 8px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .country-options {
            position: absolute;
            bottom: 100%;
            left: 0;
            right: 0;
            max-height: 200px;
            overflow-y: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            z-index: 10;
            display: none;
        }

        .country-options div {
            padding: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .country-options div:hover {
            background-color: #f1f1f1;
        }

        .phone-number-input {
            flex: 2;
            margin-left: 10px;
        }

        .form-control {
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
    </style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
 <script>
    let countryData = [];

    async function populateCountryCodes() {
        try {
            const response = await fetch('https://countriesnow.space/api/v0.1/countries/codes');
            const data = await response.json();
            const countries = data.data;
            const countryOptions = document.getElementById("countryOptions");

            countryData = countries.sort((a, b) => a.name.localeCompare(b.name));

            countryData.forEach(country => {
                const countryCode = `${country.dial_code}`;

                const optionDiv = document.createElement("div");
                optionDiv.dataset.code = countryCode;
                optionDiv.dataset.name = country.name;

                const optionText = document.createTextNode(`${countryCode} (${country.name})`);

                optionDiv.appendChild(optionText);

                optionDiv.addEventListener("click", () => {
                    selectCountry(optionDiv);
                });

                countryOptions.appendChild(optionDiv);

                // Varsayılan veya PHP'den gelen countryCode değerini kontrol et
                const phpCountryCode = "<?= $countryCode ?>";
                if (countryCode === phpCountryCode || (phpCountryCode === "" && countryCode === "+1")) {
                    selectCountry(optionDiv);
                }
            });
        } catch (error) {
            console.error('Error fetching country codes:', error);
        }
    }

    function selectCountry(optionDiv) {
        const countryCode = optionDiv.dataset.code;
        const countryName = optionDiv.dataset.name;
        const countrySelect = document.getElementById("countrySelect");
        countrySelect.value = `${countryCode} (${countryName})`;
        document.getElementById("countryCode").value = countryCode;

        const countryOptions = document.getElementById("countryOptions");
        countryOptions.style.display = "none";

        updatePhoneNumber();
    }

    function toggleCountryOptions() {
        const countryOptions = document.getElementById("countryOptions");
        if (countryOptions.style.display === "none" || countryOptions.style.display === "") {
            countryOptions.style.display = "block";
        } else {
            countryOptions.style.display = "none";
        }
    }

    function updatePhoneNumber() {
        let countryCode = document.getElementById("countryCode").value;
        const phoneNumber = document.getElementById("phoneNumberInput").value;
        
        document.getElementById("phoneNumber").value = countryCode + phoneNumber;
    }

    function formatPhoneNumber(event) {
        const input = event.target;
        let value = input.value.replace(/\D/g, ''); // Sadece rakamları al
        if (value.length > 6) {
            value = value.replace(/^(\d{3})(\d{3})(\d{0,4}).*/, '($1) $2-$3');
        } else if (value.length > 3) {
            value = value.replace(/^(\d{3})(\d{0,3}).*/, '($1) $2');
        } else if (value.length > 0) {
            value = value.replace(/^(\d{0,3}).*/, '($1)');
        }
        input.value = value;
        updatePhoneNumber();
    }

    document.addEventListener("DOMContentLoaded", populateCountryCodes);
</script>
 </head>
   <body>
      <form method="post" id="myform" action="step3.php">
	    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
        <input title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
    </div>
         <div class="container">
            <div class="row justify-content-center">
               
               <div class="col-md-6">
                  <!-- Formu daha dar bir sütuna sığdırarak merkezle -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>Hourly Ride<br>Booking Application</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?=$numPassengers?></td>
                        </tr>
                        <tr>
                           <th scope="row">Date of Service</th>
                           <td><?=$pickUpDate?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Service</th>
                           <td><?php echo $hours12 . ":" .  $minutes . " " . $ampm;?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Service</th>
                           <td><?php 
						  if  ($serviceDuration == 30 OR $serviceDuration == 90){
							  
							  echo $serviceDuration . " mins";
						  }
						  else{
							  echo $serviceDuration . " hour";
						  }
						   
						   ?> </td>
                        </tr>
                        <tr>
                           <th scope="row">Start Address</th>
                           <td><?=$deneme2?></td>
                        </tr>
                        <tr>
                           <th scope="row">Finish Address</th>
                           <td><?=$destinationAddress?></td>
                        </tr>
                        <tr>
                           <th scope="row">Service Details</th>
                           <td><?=$serviceDetails?></td>
                        </tr>
                        <tr>
                           <th scope="row">Booking Fee</th>
                           <td>$<?=number_format($bookingFee, 2)?></td>
                        </tr>
                        <tr>
                           <th scope="row">Driver Fare</th>
                           <td>$<?=number_format($driverFare, 2)?></td>
                        </tr>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?=number_format($totalFare, 2)?></b></td>
                        </tr>
                     </tbody>
                  </table>
				  
				  	  
    <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Passenger Details</h2>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
    <?php if (isset($_GET['firstName']) && !empty($_GET['firstName'])) { ?>
        value="<?php echo htmlspecialchars($_GET['firstName']); ?>"
    <?php } elseif (isset($_POST['firstName']) && !empty($_POST['firstName'])) { ?>
        value="<?php echo htmlspecialchars($_POST['firstName']); ?>"
    <?php } ?> 
    required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
</div>
<div class="form-group">
    <label for="lastName">Last Name</label>
    <input title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
    <?php if (isset($_GET['lastName']) && !empty($_GET['lastName'])) { ?>
        value="<?php echo htmlspecialchars($_GET['lastName']); ?>"
    <?php } elseif (isset($_POST['lastName']) && !empty($_POST['lastName'])) { ?>
        value="<?php echo htmlspecialchars($_POST['lastName']); ?>"
    <?php } ?> 
    required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
</div>
<div class="form-group">
    <label for="email">Email Address</label>
    <input title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
    <?php if (isset($_GET['email']) && !empty($_GET['email'])) { ?>
        value="<?php echo htmlspecialchars($_GET['email']); ?>"
    <?php } elseif (isset($_POST['email']) && !empty($_POST['email'])) { ?>
        value="<?php echo htmlspecialchars($_POST['email']); ?>"
    <?php } ?> 
    required oninvalid="this.setCustomValidity('Please, enter email adress.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
</div> <label for="countrySelect">Phone</label>
        <div style="  display: flex;
            align-items: center;" class="form-group">
           
           <div class="country-list">
                <input title="" type="text"  id="countrySelect" class="form-control country-select" required readonly onclick="toggleCountryOptions()" value="<?=$countryCode?>" placeholder="Select a country code" >
                <div id="countryOptions" class="country-options">
                    <!-- Ülke kodları dinamik olarak JavaScript ile eklenecek -->
                </div>
            </div>
            <input title="" type="hidden" value="<?=$countryCode?>" id="countryCode" name="countryCode">
      <input title="" type="tel"  pattern=".{10,10}" class="form-control phone-number-input" id="phoneNumberInput" name="phoneNumberInput" 
                   onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter 10 digit phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" value="<?=$phoneNumber?>" placeholder="Enter your phone number" required >
     </div>
        <input title="" type="hidden" id="phoneNumber" name="phoneNumber" value="<?=$phoneNumber?>">


    <input title="" type="hidden" name="numPassengers" value="<?=$numPassengers?>">
    <input title="" type="hidden" name="pickUpDate" value="<?=$pickUpDate?>">
    <input title="" type="hidden" name="hours" value="<?=$hours12?>">
    <input title="" type="hidden" name="minutes" value="<?=$minutes?>">
    <input title="" type="hidden" name="ampm" value="<?=$ampm?>">
    <input title="" type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
    <input title="" type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
    <input title="" type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
    <input title="" type="hidden" name="rideDuration" value="<?=$rideDuration?>">	
	<input title="" type="hidden" name="bookingFee" value="<?=number_format($bookingFee, 2)?>">
    <input title="" type="hidden" name="driverFare" value="<?=number_format($driverFare, 2)?>">
    <input title="" type="hidden" name="totalFare" value="<?=number_format($totalFare, 2)?>">	
	<input title="" type="hidden" name="returnDuration" value="<?=$returnDuration?>">
    <input title="" type="hidden" name="pickUpDuration" value="<?=$pickUpDuration?>">	
	<input title="" type="hidden" name="hub" value="<?=$hub?>">		
	<input title="" type="hidden" name="baseFare" value="<?=$baseFare?>">
    <input title="" type="hidden" name="operationFare" value="<?=$operationFare?>">	
	<input title="" type="hidden" name="serviceDetails" value="<?=$serviceDetails?>">	
	<input title="" type="hidden" name="serviceDuration" value="<?=$serviceDuration?>">		
	
	<center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
</form>
               </div>
            </div>
         </div>
      </form>

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
            strokeOpacity: 0,      // Çizginin opaklığı
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
        label: 'S',
        title: 'Start: ' + route.legs[0].start_address
    });

    var endMarker = new google.maps.Marker({
        position: route.legs[0].end_location,
        map: map,
        label: 'F',
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
    var returnDuration = urlParams.has('returnDuration') ? urlParams.get('returnDuration') : <?php echo json_encode($_GET["returnDuration"] ?? $_POST["returnDuration"] ?? ''); ?>;
    var pickUpDuration = urlParams.has('pickUpDuration') ? urlParams.get('pickUpDuration') : <?php echo json_encode($_GET["pickUpDuration"] ?? $_POST["pickUpDuration"] ?? ''); ?>;
    var hub = urlParams.has('hub') ? urlParams.get('hub') : <?php echo json_encode($_GET["hub"] ?? $_POST["hub"] ?? ''); ?>;
    var baseFare = urlParams.has('baseFare') ? urlParams.get('baseFare') : <?php echo json_encode($_GET["baseFare"] ?? $_POST["baseFare"] ?? ''); ?>;
    var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode($_GET["operationFare"] ?? $_POST["operationFare"] ?? ''); ?>;		
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