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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card h5 {
        font-weight: 700;
    }
    .booking-details {
        font-size: 1.1rem;
        font-weight: 600;
    }
</style>
</head>
<body>
<?php
include('inc/header.php');
include('inc/navbar.php');
if ($_POST){
$bookingNumber = $_POST["bookingNumber"];
$id = $_POST["id"];
}
if ($_GET){
	if ($perm != "admin"){
		    header('location: index.php');
			exit;
	}
$bookingNumber = $_GET["bookingNumber"];
$expodedid = explode("-", $bookingNumber);
$id = end($expodedid);
}
$sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();

$pickupAddress = $sonuc["pickupAddress"];
$destinationAddress = $sonuc["destinationAddress"];
$customerPhone = $sonuc["phoneNumber"];
$customerName = $sonuc["firstName"];
$updatedAt = $sonuc["updated_at"];
$createdAt = $sonuc["createdAt"];
$dateTime = new DateTime($createdAt, new DateTimeZone('America/New_York'));
$timeFormatted = $dateTime->format('h:i A');
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h5 style="color:red;">Booking Number: <?=$bookingNumber?></h5>
                            <div class="booking-details mt-3">
                                <p>Type: Central Park Pedicab Tour</p>
                                <p>Start Location: <?=$pickupAddress?></p>
                                <p>Finish Location: <?=$destinationAddress?></p>
                                <p>Date: <?=$sonuc["date"]?></p>
                                <p>Time: <?=$timeFormatted?></p>
                                <p>Duration: <?=number_format($sonuc["duration"], 2)?> Minutes</p>
                                <p>Passengers: <?=$sonuc["numberOfPassengers"]?></p>
                                <p>Name: <?=$customerName . ' ' . $sonuc["lastName"]?></p>
                                <p>Phone: <?=$customerPhone?></p>
                                <p>Pay: $<?=$sonuc["driverFee"]?> with <?=$sonuc["paymentMethod"]?> by customer <?=$sonuc["firstName"] . " " . $sonuc["lastName"]?></p>
                                <div id="map" class="mt-3"></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
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

<?php
if (isset($_POST['submit'])) {
    $driver = $_POST['driver'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    $bookingNumber = $_POST['bookingNumber'];
    $satir = [
        'id' => $id,
        'status' => $status,
        'driver' => $driver,
    ];

    $sql = "UPDATE centralpark SET status=:status, driver=:driver WHERE id=:id";             
    $durum = $baglanti->prepare($sql)->execute($satir);

    if ($durum) {
        echo '<script>swal("Successful", "Job accepted.", "success").then((value) => { window.location.href = "pending.php" });</script>';

        $sorgu = $baglanti->prepare("SELECT * FROM users WHERE perm = 'driver'");
        $sorgu->execute();
        while ($sonuc = $sorgu->fetch()) { 
            $formattedPhone = "whatsapp:+1" . $sonuc['number'];
            $phoneNumbers[] = $formattedPhone;
        }
        $message = "Central Park Pedicab Tour assigned.\n{" . $bookingNumber . "}";

        foreach ($phoneNumbers as $phoneNumber) {
            $messageSid = sendWhatsAppMessage($twilio, $phoneNumber, $message);
            echo "Mesaj gönderildi, SID: $messageSid<br>";
        }

        $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
        $sorgu->execute(['user' => $user]);
        $sonuc = $sorgu->fetch();

        $driverName = $sonuc["name"];
        $to = $customerPhone;
        $from = "+16468527935";
        $message = "Hello " . $customerName . ". " . $driverName . " is your assigned driver. Driver's phone number is +1" . $sonuc["number"] . ". Thank you. -New York Pedicab Services";
        $messageSid = sendTextMessage($twilio, $to, $from, $message);
    } else {
        echo 'Job error: '; 
    }
}
?>