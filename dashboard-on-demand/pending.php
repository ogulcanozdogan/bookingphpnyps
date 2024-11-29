<?php ob_start();?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$descripton?>" name="description" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card .card-body {
        background-color: #f8f9fa;
    }
    .card h5 {
        font-weight: 700;
    }
    .pay-amount {
        font-size: 1.1rem;
        font-weight: 600;
    }
    .navbar, .footer {
        background-color: #343a40;
        color: white;
    }
    .navbar a, .footer a {
        color: white;
    }
</style>
</head>
<body>
<?php
include('inc/header.php');
include('inc/navbar.php');

if ($_POST){
    $bookingNumber = $_POST['bookingNumber'];
    $table = $_POST['table'];    
    
    $satir = [
        'bookingNumber' => $bookingNumber
    ];

    $sql = "UPDATE $table SET status='past' WHERE bookingNumber=:bookingNumber";             
    $durum = $baglanti->prepare($sql)->execute($satir);

    if ($durum) {
        header("location:available.php");
    }
}

?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <?php
                $tables = ["centralpark", "hourly", "pointatob"];
                foreach ($tables as $table) {
                    $sorgu = $baglanti->prepare("SELECT * FROM $table WHERE driver=:user AND status = 'pending'");
                    $sorgu->execute(['user' => $user]);
                    while ($sonuc = $sorgu->fetch()) {
                        $paymentMethod = $sonuc['paymentMethod'];
                        if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                            $paymentMethod = "debit/credit card";
                        } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                            $paymentMethod = "CASH";
                        }

                        $createdAt = new DateTime($sonuc['updated_at'], new DateTimeZone('America/New_York'));
                        $totalMinutes = floatval($sonuc['totalMinutes']);
                        $totalSeconds = intval($totalMinutes * 60);
                        $expiryTime = clone $createdAt;
                        $expiryTime->modify('+' . $totalSeconds . ' seconds');
                        $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
                        $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

                        if ($remainingTime > 0) {
                ?>           
                <div class="col-xl-3 col-md-6">
                    <div class="card" id="card-<?= $sonuc['id'] ?>">
                        <div class="card-body position-relative">
                            <h5 class="mb-3"><?=$sonuc["bookingNumber"]?></h5>
                            <div class="vstack gap-2">
                                <div class="form-check card-radio">
                                    <input id="listGroupRadioGrid1" name="listGroupRadioGrid" type="radio" class="form-check-input">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                    <i class="ri-message-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Type</h6>
                                            <b class="pay-amount"><?=$table == 'centralpark' ? 'Central Park Tour' : ($table == 'hourly' ? 'Hourly  Service' : 'Point A to B Ride')?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-details">
                                <br><br>
                                <b>Type:</b> <?=$table == 'centralpark' ? 'Central Park Tour' : ($table == 'hourly' ? 'Hourly Service' : 'Point A to B Ride')?><br>
                                <b>Start Address:</b> <?=$sonuc["pickupAddress"]?><br>
                                <b>Finish Address:</b> <?=$sonuc["destinationAddress"]?><br>
<?php
$date = DateTime::createFromFormat('m/d/Y', $sonuc["date"]);
$dayOfWeek = $date->format('l'); // Günü yazdırır (Monday, Tuesday, vb.)

echo "<b>Date:</b> " . $sonuc["date"] . " " . $dayOfWeek . " (Today)";
?>

                            </br>    <b>Time:</b> <?php
echo $sonuc["pickUpTime"];
?><br>
<?php 
if ($table == 'centralpark'){
	$tourDuration = $sonuc["tourDuration"];
if ($tourDuration == 1){
	$tourDuration = $tourDuration . " Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)";
}
else {
	if ($tourDuration == 50){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill + Strawberry Fields)";
	}
	else if ($tourDuration == 45){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill)";
	}
	else if ($tourDuration == 40){
		$tourDuration = $tourDuration . " Minutes (Non Stop)";
	}
}
?>

                                <b>Tour Duration:</b> <?=$tourDuration?><br>
						<?php } ?>
						
<?php 
if ($table == 'hourly'){
	$serviceDuration = $sonuc["serviceDuration"];
	if ($serviceDuration == 30 || $serviceDuration == 90) {
    $serviceDuration = $serviceDuration . " Minutes";
} 
else if ($serviceDuration == 1){
    $serviceDuration = $serviceDuration . " Hour";
}
else if ($serviceDuration == 2 or $serviceDuration == 3){
    $serviceDuration = $serviceDuration . " Hours";
}
?>

                                <b>Service Duration:</b> <?=$serviceDuration?><br>
						<?php } ?>
                                <b>Ride Duration:</b> <?=$sonuc["duration"]?> Minutes<br>
                                <b>Passengers:</b> <?=$sonuc["numberOfPassengers"]?><br>
                                <b>Name:</b> <?=$sonuc["firstName"] . ' ' . $sonuc["lastName"]?><br>
                                <b>Phone:</b> <?=$sonuc["phoneNumber"];?><br>
                                <b>Pay:</b> $<?=$sonuc["driverFee"]?> with <?=$paymentMethod?> by customer <?=$sonuc["firstName"] . " " . $sonuc["lastName"]?><br>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Remaining Time</h6>
                                <b class="pay-amount">
                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown"></span> minutes
                                </b>
                            </div>  <br>
                            <form method='POST'>
                                <input type="hidden" name="bookingNumber" value="<?=$sonuc["bookingNumber"]?>">
                                <input type="hidden" name="table" value="<?=$table?>">
                               <!-- <input type="submit" class="btn btn-danger" value="Bitir">     -->
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var remainingTime = <?= $remainingTime ?>;
                        var display = document.querySelector('#countdown-<?= $sonuc['id'] ?>');
                        var card = document.querySelector('#card-<?= $sonuc['id'] ?>');
                        if (remainingTime > 0) {
                            startCountdown(remainingTime, display, card);
                        }
                    });
                </script>

                <?php 
                        }
                    }
                } 
                ?>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<?php 
include('inc/footer.php');
include('inc/scripts.php');
?>

<script>
    function startCountdown(duration, display, card) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            if (timer >= 0) {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    timer = 0;
                    card.style.display = 'none';
                }
            }
        }, 1000);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>