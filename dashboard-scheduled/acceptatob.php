<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php');
$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi']; 
include('whatsapp.php');
include('text.php'); ?>
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
        width: 50%;
    }
}

@media (min-width: 900px) {
    #map {
        width: 30%;
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
$sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();

$pickupAddress = $sonuc["pickupAddress"];
$destinationAddress = $sonuc["destinationAddress"];

$customerPhone = $sonuc["phoneNumber"];
$customerName = $sonuc["firstName"];
?>
       <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">
			
			
	<h5 style="color:red;">Booking Number: <?=$bookingNumber?></h5>
	<div class="booking-details">
	<br><br>
Type = Point A to B Pedicab Ride<br>
Start Location = <?=$pickupAddress?><br>
Finish Location = <?=$destinationAddress?><br>
Date = <?=$sonuc["date"]?><br>
Time = <?php 
echo ($sonuc["hour"] < 10 ? "0" . $sonuc["hour"] : $sonuc["hour"]) . ":"
     . ($sonuc["minutes"] == 0 ? "0" . $sonuc["minutes"] : $sonuc["minutes"])
     . " " . $sonuc["ampm"];
?><br>
Duration = <?=$sonuc["duration"]?><br>
Passengers = <?=$sonuc["numberOfPassengers"]?><br>
Name = <?=$customerName . ' ' . $sonuc["lastName"]?><br>
Phone = <?=$customerPhone;?><br>
Pay = $<?=$sonuc["driverFee"]?> with <?=$sonuc["paymentMethod"]?> by customer <?php echo $sonuc["firstName"] . " " . $sonuc["lastName"]?><br>
Please, confirm by typing the start time.&nbsp;<br>
    <div id="map" style="margin-top:30px;"></div>
       </div>
		
     
      <div class="col-lg-12">
    <div class="text-end">
        <form method="post" role="form">
            <input type="hidden" name="driver" value="<?=$user?>">
            <input type="hidden" name="status" value="pending">
            <input type="hidden" name="id" value="<?=$id?>">
			<input type="hidden" name="bookingNumber" value="<?=$bookingNumber?>">
            <input type="submit" class="btn btn-primary" name="submit" value="Accept">
        </form>
    </div>
</div><!--end col-->

<?php
// Post işlemi gerçekleştiğinde çalışacak kodlar
if (isset($_POST['submit'])) {
    $driver = $_POST['driver'];
    $status = $_POST['status'];
    $id = $_POST['id'];
	$bookingNumber = $_POST['bookingNumber'];
    $hata = '';

    $satir = [
        'id' => $id,
        'status' => $status,
        'driver' => $driver,
    ];


$currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));
$updated_at = $currentDateTime->format('Y-m-d H:i:s');


$satir = [
    'id' => $id,
    'status' => $status,
    'driver' => $driver,
	'updated_at' => $updated_at,
];

$sql = "UPDATE pointatob SET status=:status, driver=:driver, updated_at=:updated_at WHERE id=:id";
$durum = $baglanti->prepare($sql)->execute($satir);

    if ($durum) {
        echo '<script>swal("Successful", "Job accepted.", "success").then((value) => { window.location.href = "pending.php" });</script>';     

				
				
$sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
$sorgu->execute(['user' => $user]);
$sonuc = $sorgu->fetch();

$driverName = $sonuc["name"];

$to = $customerPhone;
$from = "+16468527935";
$message = "Hello " . $customerName .". " . $driverName . " is your assigned driver. Driver's phone number is +1" . $sonuc["number"] . ". Thank you. -New York Pedicab Services";
$messageSid = sendTextMessage($twilio, $to, $from, $message);
				
				$sorgu = $baglanti->prepare("SELECT * FROM users WHERE perm = 'driver'");
				$sorgu->execute();

while ($sonuc = $sorgu->fetch()) { 

    $formattedPhone = "whatsapp:+1" . $sonuc['number'];
    $phoneNumbers[] = $formattedPhone;

}
$message = "Point A to B Pedicab Ride assigned.
{". $bookingNumber ."}";

foreach ($phoneNumbers as $phoneNumber) {
    $messageSid = sendWhatsAppMessage($twilio, $phoneNumber, $message);
    echo "Mesaj gönderildi, SID: $messageSid<br>";
}



    } else {
        echo 'Job error: '; 
    }
} 
?>

			
			

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
        suppressMarkers: true, 
        polylineOptions: {
            strokeColor: '#FF0000', 
            strokeOpacity: 0.8, 
            strokeWeight: 6  
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
        provideRouteAlternatives: true 
    }, function(response, status) {
        if (status === 'OK') {
            var fastestRouteIndex = findFastestRouteIndex(response.routes);
            directionsRenderer.setDirections(response);
            directionsRenderer.setRouteIndex(fastestRouteIndex);
            addCustomMarkers(response.routes[fastestRouteIndex], map);

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
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&callback=initMap">
    </script>
</body>
</html>