<?php ob_start(); ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$descripton?>" name="description" />
</head>
<body>
<?php
include('inc/header.php');
if ($perm != "admin") { 
header('location: index.php');
}
include('inc/navbar.php');
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <?php
                $tables = ["centralpark", "hourly", "pointatob"];
                foreach ($tables as $table) {
                    $sorgu = $baglanti->prepare("SELECT * FROM $table WHERE status = 'pending'");
                    $sorgu->execute();
                    while ($sonuc = $sorgu->fetch()) {
                        $paymentMethod = $sonuc['paymentMethod'];
                        if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                            $paymentMethod = "debit/credit card";
                        } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                            $paymentMethod = "CASH";
                        }
						
														$drivername = $sonuc["driver"];
								$sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = '$drivername'");
								$sorgu2->execute();
								$sonuc2 = $sorgu2->fetch();
								$drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];

                        // updated_at ve totalMinutes değerlerini al
                        $createdAt = new DateTime($sonuc['updated_at'], new DateTimeZone('America/New_York'));
                        $totalMinutes = floatval($sonuc['totalMinutes']);

                        // toplam dakikayı saniyeye çevir
                        $totalSeconds = intval($totalMinutes * 60);

                        // bitiş zamanını hesapla
                        $expiryTime = clone $createdAt;
                        $expiryTime->modify('+' . $totalSeconds . ' seconds');

                        // şu anki zamanı al
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
                                            <b class="pay-amount"><?=$table == 'centralpark' ? 'Central Park Ride' : ($table == 'hourly' ? 'Hourly Pedicab Ride' : 'Point A to B Pedicab Ride')?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="vstack gap-2">
                                <div class="form-check card-radio">
                                    <input id="listGroupRadioGrid1" name="listGroupRadioGrid" type="radio" class="form-check-input">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                    <i class="ri-file-user-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Driver</h6>
                                            <b class="pay-amount"><?=$drivernamesurname;?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="booking-details">
                                <br><br>
                                Type = <?=$table == 'centralpark' ? 'Central Park Ride' : ($table == 'hourly' ? 'Hourly Pedicab Ride' : 'Point A to B Pedicab Ride')?><br>
                                Start Location = <?=$sonuc["pickupAddress"]?><br>
                                Finish Location = <?=$sonuc["destinationAddress"]?><br>
                                Date = <?=$sonuc["date"]?><br>
                                Time = Now!<br>
                                Duration = <?=$sonuc["duration"]?><br>
                                Passengers = <?=$sonuc["numberOfPassengers"]?><br>
                                Name = <?=$sonuc["firstName"] . ' ' . $sonuc["lastName"]?><br>
                                Phone = <?=$sonuc["phoneNumber"];?><br>
                                Pay = $<?=$sonuc["driverFee"]?> with <?=$paymentMethod?> by customer <?=$sonuc["firstName"] . " " . $sonuc["lastName"]?><br>
                                Please, confirm by typing the start time.&nbsp;<br>
                                <div id="map" style="margin-top:30px;"></div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Remaining Time</h6>
                                <b class="pay-amount">
                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown"></span> minutes
                                </b>
                            </div>     
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
                    card.style.display = 'none'; // Zaman dolduğunda kartı gizle
                }
            }
        }, 1000);
    }
</script>

</body>
</html>