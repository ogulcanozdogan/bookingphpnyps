<?php if ($_POST) {
    // Formdan alınan bilgiler
    // Formdan alınan bilgiler
    $firstName = $_POST["firstName"]; // varsayılan değer 1
    $lastName = $_POST["lastName"]; // varsayılan değer 1
    $email = $_POST["email"]; // varsayılan değer 1
    $phoneNumber = $_POST["phoneNumber"]; // varsayılan değer 1
    $numPassengers = $_POST["numPassengers"] ?? 1; // varsayılan değer 1
    $deneme2 = $_POST["pickUpAddress"];
    $destinationAddress = $_POST["destinationAddress"];
    $paymentMethod = $_POST["paymentMethod"];
    $countryCode = $_POST["countryCode"];
    $countryName = $_POST["countryName"];
} elseif ($_GET) {
    // Formdan alınan bilgiler
    $firstName = $_GET["firstName"]; // varsayılan değer 1
    $lastName = $_GET["lastName"]; // varsayılan değer 1
    $email = $_GET["email"]; // varsayılan değer 1
    $phoneNumber = $_GET["phoneNumber"]; // varsayılan değer 1
    $numPassengers = $_GET["numPassengers"] ?? 1; // varsayılan değer 1
    $deneme2 = $_GET["pickUpAddress"];
    $destinationAddress = $_GET["destinationAddress"];
    $paymentMethod = $_GET["paymentMethod"];
    $countryCode = $_GET["countryCode"];
    $countryName = $_GET["countryName"];
}  else {
    header("location: index.php");
	exit;
}

$zipCodes = [
    "10000",
    "10001",
    "10002",
    "10003",
    "10004",
    "10005",
    "10006",
    "10007",
    "10008",
    "10009",
    "10010",
    "10011",
    "10012",
    "10013",
    "10014",
    "10015",
    "10016",
    "10017",
    "10018",
    "10019",
    "10020",
    "10021",
    "10022",
    "10023",
    "10024",
    "10025",
    "10026",
    "10028",
    "10029",
    "10036",
    "10038",
    "10041",
    "10043",
    "10045",
    "10055",
    "10060",
    "10065",
    "10069",
    "10075",
    "10080",
    "10081",
    "10087",
    "10090",
    "10101",
    "10102",
    "10103",
    "10104",
    "10105",
    "10106",
    "10107",
    "10108",
    "10109",
    "10110",
    "10111",
    "10112",
    "10113",
    "10114",
    "10116",
    "10117",
    "10118",
    "10119",
    "10120",
    "10121",
    "10122",
    "10123",
    "10124",
    "10126",
    "10128",
    "10129",
    "10130",
    "10131",
    "10132",
    "10133",
    "10138",
    "10151",
    "10152",
    "10153",
    "10154",
    "10155",
    "10156",
    "10157",
    "10158",
    "10159",
    "10160",
    "10162",
    "10163",
    "10164",
    "10165",
    "10166",
    "10167",
    "10168",
    "10169",
    "10170",
    "10171",
    "10172",
    "10173",
    "10174",
    "10175",
    "10176",
    "10177",
    "10178",
    "10179",
    "10185",
    "10199",
    "10203",
    "10211",
    "10212",
    "10242",
    "10249",
    "10256",
    "10258",
    "10259",
    "10260",
    "10261",
    "10265",
    "10268",
    "10269",
    "10270",
    "10271",
    "10272",
    "10273",
    "10274",
    "10275",
    "10276",
    "10277",
    "10278",
    "10279",
    "10280",
    "10281",
    "10282",
    "10285",
    "10286",
];

// Belirtilen zip kodlarının olup olmadığını kontrol et
$checkZipCodes = function ($address) use ($zipCodes) {
    foreach ($zipCodes as $zipCode) {
        if (strpos($address, $zipCode) !== false) {
            return true;
        }
    }
    return false;
};

if (!$checkZipCodes($deneme2) || !$checkZipCodes($destinationAddress)) {
    $queryParams = http_build_query([
        "firstName" => $firstName,
        "lastName" => $lastName,
        "email" => $email,
        "phoneNumber" => $phoneNumber,
        "countryCode" => $countryCode,
        "countryName" => $countryName,
        "numPassengers" => $numPassengers,
        "pickUpAddress" => $deneme2,
        "destinationAddress" => $destinationAddress,
        "paymentMethod" => $paymentMethod,
        "error" => "yes",
    ]);
    header("location: index.php?$queryParams");
    exit();
}

$hub = "West Drive and West 59th Street New York, NY 10019";

function getShortestBicycleRouteDuration($origin, $destination)
{
    $apiKey = "AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY"; // API anahtarınızı buraya girin
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
        if (isset($data["routes"]) && count($data["routes"]) > 0) {
            // En kısa süreyi bul
            $shortestDuration = PHP_INT_MAX;
            foreach ($data["routes"] as $route) {
                $routeDuration = 0;
                foreach ($route["legs"] as $leg) {
                    $routeDuration += $leg["duration"]["value"];
                }
                if ($routeDuration < $shortestDuration) {
                    $shortestDuration = $routeDuration;
                }
            }

            // En kısa sürenin dakika cinsinden hesaplanması
            if ($shortestDuration !== PHP_INT_MAX) {
                $minutes = floor($shortestDuration / 60);
                $seconds = $shortestDuration % 60;
                return sprintf("%.2f", $minutes + $seconds / 60); // Süreyi "24.11" gibi bir formatla döndür
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
$rideDuration *= 2.5;
$returnDuration *= 2.5;

function calculateOperationFarePerHour($dayOfWeek, $month)
{
    $isWeekend = in_array($dayOfWeek, ["Friday", "Saturday", "Sunday"]);
    if ($month == "December") {
        return $isWeekend ? 45 : 40; // Aralık hafta sonu ve hafta içi farklı ücret
    } else {
        return $isWeekend ? 35 : 30; // Normal hafta sonu ve hafta içi farklı ücret
    }
}

// Toplam süre (dakika cinsinden)
$totalDurationMinutes = $pickUpDuration + $rideDuration + $returnDuration;

// Saatlik ücret hesaplama
$operationFarePerHour = calculateOperationFarePerHour($dayOfWeek, $month);

// Toplam Operation Fare hesaplama (dakikayı saate çevirip saatlik ücretle çarparak)
$operationFare = ($totalDurationMinutes / 60) * $operationFarePerHour;

// Kodun geri kalanını bu doğrultuda güncelleyin...

// Booking Fee ve Driver Fare hesaplama
$bookingFee = 0.2 * ($baseFare + $operationFare);
$driverFare = 0.8 * ($baseFare + $operationFare);
if ($paymentMethod === "card") {
    $driverFare *= 1.1;
}

$minFares = [
    "cash" => [
        "week" => ["Booking Fee" => 9, "Driver Fare" => 36, "Total Fare" => 45],
        "weekend" => [
            "Booking Fee" => 10.5,
            "Driver Fare" => 42,
            "Total Fare" => 52.5,
        ],
        "weekDecember" => [
            "Booking Fee" => 12,
            "Driver Fare" => 48,
            "Total Fare" => 60,
        ],
        "weekendDecember" => [
            "Booking Fee" => 13.5,
            "Driver Fare" => 54,
            "Total Fare" => 67.5,
        ],
    ],
    "card" => [
        "week" => [
            "Booking Fee" => 9,
            "Driver Fare" => 39.6,
            "Total Fare" => 48.6,
        ],
        "weekend" => [
            "Booking Fee" => 10.5,
            "Driver Fare" => 46.2,
            "Total Fare" => 56.7,
        ],
        "weekDecember" => [
            "Booking Fee" => 12,
            "Driver Fare" => 52.8,
            "Total Fare" => 64.8,
        ],
        "weekendDecember" => [
            "Booking Fee" => 13.5,
            "Driver Fare" => 59.4,
            "Total Fare" => 72.9,
        ],
    ],
];

$key =
    ($isWeekend ? "weekend" : "week") .
    ($month == "December" ? "December" : "");
$minBookingFee = $minFares[$paymentMethod][$key]["Booking Fee"];
$minDriverFare = $minFares[$paymentMethod][$key]["Driver Fare"];
$minTotalFare = $minFares[$paymentMethod][$key]["Total Fare"];

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
	  <title>Book On Demand Point A to B Pedicab Ride</title>
	  <meta name="description" content="On Demand Point A to B Pedicab Ride Booking Application">
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

	<input type="hidden" name="firstName" value="<?= $firstName ?>">
    <input type="hidden" name="lastName" value="<?= $lastName ?>">
    <input type="hidden" name="email" value="<?= $email ?>">
    <input type="hidden" name="phoneNumber" value="<?= $phoneNumber ?>">	
	    <input type="hidden" name="countryCode" value="<?= $countryCode ?>">	
				  <input type="hidden" name="countryName" value="<?= $countryName ?>">
    <input type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
    <input type="hidden" name="pickUpDate" value="<?= $pickUpDate ?>">
    <input type="hidden" name="hours" value="<?= $hours12 ?>">
    <input type="hidden" name="minutes" value="<?= $minutes ?>">
    <input type="hidden" name="ampm" value="<?= $ampm ?>">
    <input type="hidden" name="pickUpAddress" value="<?= $deneme2 ?>">
    <input type="hidden" name="destinationAddress" value="<?= $destinationAddress ?>">
    <input type="hidden" name="paymentMethod" value="<?= $paymentMethod ?>">
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

    var geocoder = new google.maps.Geocoder();
    geocodeAddress(geocoder, pickupAddress, function(pickupLocation) {
        geocodeAddress(geocoder, destinationAddress, function(destinationLocation) {
            calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupLocation, destinationLocation);
        });
    });
}

function geocodeAddress(geocoder, address, callback) {
    geocoder.geocode({ 'address': address }, function(results, status) {
        if (status === 'OK') {
            callback(results[0].geometry.location);
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupLocation, destinationLocation) {
    directionsService.route({
        origin: pickupLocation,
        destination: destinationLocation,
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
    var numPassengers = urlParams.has('numPassengers') ? urlParams.get('numPassengers') : <?php echo json_encode(
        $_GET["numPassengers"] ?? ($_POST["numPassengers"] ?? 1)
    ); ?>;
    var pickUpDate = urlParams.has('pickUpDate') ? urlParams.get('pickUpDate') : <?php echo json_encode(
        $_GET["pickUpDate"] ?? ($_POST["pickUpDate"] ?? "")
    ); ?>;
    var hours24 = urlParams.has('hours') ? urlParams.get('hours') : <?php echo json_encode(
        $_GET["hours"] ?? ($_POST["hours"] ?? "")
    ); ?>; // 24 saatlik formatta saat
    var minutes = urlParams.has('minutes') ? urlParams.get('minutes') : <?php echo json_encode(
        $_GET["minutes"] ?? ($_POST["minutes"] ?? "")
    ); ?>;
    var ampm = urlParams.has('ampm') ? urlParams.get('ampm') : <?php echo json_encode(
        $_GET["ampm"] ?? ($_POST["ampm"] ?? "")
    ); ?>;
    var pickUpAddress = urlParams.has('pickUpAddress') ? urlParams.get('pickUpAddress') : <?php echo json_encode(
        $_GET["pickUpAddress"] ?? ($_POST["pickUpAddress"] ?? "")
    ); ?>;
    var destinationAddress = urlParams.has('destinationAddress') ? urlParams.get('destinationAddress') : <?php echo json_encode(
        $_GET["destinationAddress"] ?? ($_POST["destinationAddress"] ?? "")
    ); ?>;
    var paymentMethod = urlParams.has('paymentMethod') ? urlParams.get('paymentMethod') : <?php echo json_encode(
        $_GET["paymentMethod"] ?? ($_POST["paymentMethod"] ?? "")
    ); ?>;
    var firstName = urlParams.has('firstName') ? urlParams.get('firstName') : <?php echo json_encode(
        $_GET["firstName"] ?? ($_POST["firstName"] ?? "")
    ); ?>;
    var lastName = urlParams.has('lastName') ? urlParams.get('lastName') : <?php echo json_encode(
        $_GET["lastName"] ?? ($_POST["lastName"] ?? "")
    ); ?>;
    var email = urlParams.has('email') ? urlParams.get('email') : <?php echo json_encode(
        $_GET["email"] ?? ($_POST["email"] ?? "")
    ); ?>;
    var phoneNumber = urlParams.has('phoneNumber') ? urlParams.get('phoneNumber') : <?php echo json_encode(
        $_GET["phoneNumber"] ?? ($_POST["phoneNumber"] ?? "")
    ); ?>;
	var countryCode = urlParams.has('countryCode') ? urlParams.get('countryCode') : <?php echo json_encode(
     $_GET["countryCode"] ?? ($_POST["countryCode"] ?? "")
 ); ?>;
 	var countryName = urlParams.has('countryName') ? urlParams.get('countryName') : <?php echo json_encode(
     $_GET["countryName"] ?? ($_POST["countryName"] ?? "")
 ); ?>;
    var bookingFee = urlParams.has('bookingFee') ? urlParams.get('bookingFee') : <?php echo json_encode(
        $_GET["bookingFee"] ?? ($_POST["bookingFee"] ?? "")
    ); ?>;
    var driverFare = urlParams.has('driverFare') ? urlParams.get('driverFare') : <?php echo json_encode(
        $_GET["driverFare"] ?? ($_POST["driverFare"] ?? "")
    ); ?>;
    var totalFare = urlParams.has('totalFare') ? urlParams.get('totalFare') : <?php echo json_encode(
        $_GET["totalFare"] ?? ($_POST["totalFare"] ?? "")
    ); ?>;	
    var rideDuration = urlParams.has('rideDuration') ? urlParams.get('rideDuration') : <?php echo json_encode(
        $_GET["rideDuration"] ?? ($_POST["rideDuration"] ?? "")
    ); ?>;		

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
                      "&countryCode=" + encodeURIComponent(countryCode) +
					"&countryName=" + encodeURIComponent(countryName) +
                      "&bookingFee=" + encodeURIComponent(bookingFee) +
                      "&driverFare=" + encodeURIComponent(driverFare) +
                      "&totalFare=" + encodeURIComponent(totalFare) +
                      "&rideDuration=" + encodeURIComponent(rideDuration);

    window.location.href = "index.php?" + queryString;
});

</script>

   </body>
</html>