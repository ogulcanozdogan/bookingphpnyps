<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php');

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi'];
include('whatsapp.php'); ?>
<meta content="<?=$descripton?>" name="description" />
  <script src="assets/js/sweetalert.min.js"></script>
<style>
p {
    margin: 0; 
}
        #map {
            height: 400px;
            width: 100%;
        }
		
@media (min-width: 600px) {
    #map {
        width: 50%; /* Orta boyutlu cihazlar için genişliği %50 yap */
    }
}

@media (min-width: 900px) {
    #map {
        width: 30%; /* Büyük cihazlar için genişliği %30 yap */
    }
}
</style>
</head>
<body>
<?php
include('inc/header.php');
include('inc/navbar.php');
$id = $_POST["id"];
$bookingNumber = $_POST["bookingNumber"];
$sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();

$pickupAddress = $sonuc["pickupAddress"];
$destinationAddress = $sonuc["destinationAddress"];
// $updatedAt değişkenini veritabanından alıyoruz
$updatedAt = $sonuc["updated_at"];

// DateTime nesnesi oluşturup tarihi ayarlıyoruz
$dateTime = new DateTime($updatedAt, new DateTimeZone('America/New_York'));

// Saati 12 saat biçiminde formatlıyoruz
$timeFormatted = $dateTime->format('h:i A');
?>
       <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
			
			
	<h5 style="color:red;">Booking Number: <?=$bookingNumber?></h5>
	<div class="booking-details">
	<br><br>
Type = Hourly Pedicab Ride<br>
Start Location = <?=$pickupAddress?><br>
Finish Location = <?=$destinationAddress?><br>
Date = <?=$sonuc["date"]?><br>
Time = <?=$timeFormatted?><br>
Duration = <?=number_format($sonuc["duration"], 2)?> Minutes<br>
Passengers = <?=$sonuc["numberOfPassengers"]?><br>
Name = <?=$sonuc["firstName"] . ' ' . $sonuc["lastName"]?><br>
Phone = <?=$sonuc["phoneNumber"]?><br>
Pay = $<?=$sonuc["driverFee"]?> with CASH by customer <?php echo $sonuc["firstName"] . " " . $sonuc["lastName"]?><br>
    <div id="map" style="margin-top:30px;"></div>
       </div>



			
			

                        </div> <!-- end col -->


                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

		


<?php 
include('inc/footer.php');
include('inc/scripts.php');?>
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

    var pickupAddress = <?php echo json_encode($pickupAddress); ?>;
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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&callback=initMap">
    </script>
</body>
</html>