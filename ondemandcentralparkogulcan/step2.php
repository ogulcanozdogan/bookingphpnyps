<?php  
   
    if ($_POST){
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
   $deneme2 = $_POST["pickUpAddress"];
   $destinationAddress = $_POST["destinationAddress"];
   $paymentMethod = $_POST["paymentMethod"];
   $tourDuration = $_POST["tourDuration"];
   }
   
   
   if ($_GET){
      // Formdan alınan bilgiler
   $firstName = $_GET["firstName"]; // varsayılan değer 1
   $lastName = $_GET["lastName"]; // varsayılan değer 1
   $email = $_GET["email"]; // varsayılan değer 1
   $phoneNumber = $_GET["phoneNumber"]; // varsayılan değer 1
   // Başta kalan rakamları almak
	$lastTenDigits = substr($phoneNumber, -10);

// Başta kalan rakamları almak
$countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);

	$phoneNumber = substr($phoneNumber, -10);
   $numPassengers = $_GET["numPassengers"] ?? 1; // varsayılan değer 1
   $deneme2 = $_GET["pickUpAddress"];
   $destinationAddress = $_GET["destinationAddress"];
   $paymentMethod = $_GET["paymentMethod"];
   $tourDuration = $_GET["tourDuration"];
   }
   
   
       $hub1 = "6th Avenue and Central Park South New York, NY 10019";
       $hub2 = "West Drive and West 59th Street New York, NY 10019";
   
   
   // Tarihi 'm/d/Y' formatından 'Y-m-d' formatına çevirme
   $convertedDate = date('m/d/Y');
   
   // Yeni tarihi kullanarak gün adını bulma
   $dayName = date('l', strtotime($convertedDate));
 if (strpos($dayName, 'Monday') !== false || 
    strpos($dayName, 'Tuesday') !== false || 
    strpos($dayName, 'Wednesday') !== false || 
    strpos($dayName, 'Thursday') !== false) {
    // Monday to Thursday
    $hourlyOperationFare = 37;
} elseif (strpos($dayName, 'Friday') !== false || 
          strpos($dayName, 'Saturday') !== false || 
          strpos($dayName, 'Sunday') !== false) {
    // Friday to Sunday
    $hourlyOperationFare = 45;
}

// Check if it's December
if (date('m', strtotime($convertedDate)) == 12) {
    if (strpos($dayName, 'Monday') !== false || 
        strpos($dayName, 'Tuesday') !== false || 
        strpos($dayName, 'Wednesday') !== false || 
        strpos($dayName, 'Thursday') !== false) {
        // Monday to Thursday in December
        $hourlyOperationFare = 52;
    } elseif (strpos($dayName, 'Friday') !== false || 
              strpos($dayName, 'Saturday') !== false || 
              strpos($dayName, 'Sunday') !== false) {
        // Friday to Sunday in December
        $hourlyOperationFare = 60;
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
      <title>Book Your Pedicab Ride - <?=$return1?></title>
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
      <form method="post" id="myform" autocomplete="off" action="step3.php">
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
                     <b>Book Scheduled Central Park Pedicab Tour</b>
                  </div>
                  <div id="map" style="margin-top:30px;"></div>
                  <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?=$numPassengers?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Ride</th>
                           <td><?=$rideDuration?> mins</td>
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
                  </div><label for="countrySelect">Phone</label>
        <div style="  display: flex;
            align-items: center;" class="form-group">
           
           <div class="country-list">
                <input title="" type="text" id="countrySelect" class="form-control country-select" required readonly onclick="toggleCountryOptions()" value="<?=$countryCode?>" placeholder="Select a country code" >
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
                  <input title="" type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
                  <input title="" type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
                  <input title="" type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
                  <input title="" type="hidden" name="rideDuration" value="<?=$rideDuration?>">	
                  <input title="" type="hidden" name="bookingFee" value="<?=$bookingFee?>">
                  <input title="" type="hidden" name="driverFare" value="<?=$driverFare?>">
                  <input title="" type="hidden" name="totalFare" value="<?=$totalFare?>">	
                  <input title="" type="hidden" name="returnDuration" value="<?=$returnDuration?>">
                  <input title="" type="hidden" name="operationFare" value="<?=$operationFare?>">	
                  <input title="" type="hidden" name="tourDuration" value="<?=$tourDuration?>">	
                  <input title="" type="hidden" name="pickup1" value="<?=$pickup1?>">	
                  <input title="" type="hidden" name="pickup2" value="<?=$pickup2?>">
                  <input title="" type="hidden" name="return1" value="<?=$return1?>">	
                  <input title="" type="hidden" name="return2" value="<?=$return2?>">		
                  <input title="" type="hidden" name="toursuresi" value="<?=$toursuresi?>">		
                 <center> <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Review"></center>
      </form>
      </div>
      </div>
      </div>
      </form>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
             var hub = urlParams.has('hub') ? urlParams.get('hub') : <?php echo json_encode($_GET["hub"] ?? $_POST["hub"] ?? ''); ?>;
             var operationFare = urlParams.has('operationFare') ? urlParams.get('operationFare') : <?php echo json_encode($_GET["operationFare"] ?? $_POST["operationFare"] ?? ''); ?>;		
             var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode($_GET["rideDuration"] ?? $_POST["rideDuration"] ?? ''); ?>;		
             var tourDuration = urlParams.has('tourDuration') ? urlParams.get('tourDuration') : <?php echo json_encode($_GET["tourDuration"] ?? $_POST["tourDuration"] ?? ''); ?>;
             var return1 = urlParams.has('return1') ? urlParams.get('return1') : <?php echo json_encode($_GET["return1"] ?? $_POST["return1"] ?? ''); ?>;
             var return2 = urlParams.has('return2') ? urlParams.get('return2') : <?php echo json_encode($_GET["return2"] ?? $_POST["return2"] ?? ''); ?>;
             var pickup1 = urlParams.has('pickup1') ? urlParams.get('pickup1') : <?php echo json_encode($_GET["pickup1"] ?? $_POST["pickup1"] ?? ''); ?>;		
             var pickup2 = urlParams.has('pickup2') ? urlParams.get('pickup2') : <?php echo json_encode($_GET["pickup2"] ?? $_POST["pickup2"] ?? ''); ?>;		
             var toursuresi = urlParams.has('toursuresi') ? urlParams.get('toursuresi') : <?php echo json_encode($_GET["toursuresi"] ?? $_POST["toursuresi"] ?? ''); ?>;
         
             // Şimdi gerekli işlemleri yapabilirsiniz
             // ...
         
             // Ardından, işlemleriniz tamamlandıktan sonra yönlendirme yapabilirsiniz
             var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
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
         					  "&pickup1=" + encodeURIComponent(pickup1) +
                               "&pickup2=" + encodeURIComponent(pickup2) +
                               "&return1=" + encodeURIComponent(return1) +
                               "&return2=" + encodeURIComponent(return2)+
         					  "&toursuresi=" + encodeURIComponent(toursuresi)+
                               "&rideDuration=" + encodeURIComponent(rideDuration) +
         					  "&tourDuration=" + encodeURIComponent(tourDuration)
         
             window.location.href = "index.php?" + queryString;
         });
         
      </script>
   </body>
</html>