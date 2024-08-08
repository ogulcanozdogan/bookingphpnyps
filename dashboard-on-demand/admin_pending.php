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
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-info-circle"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Type</h6>
                                        <b class="pay-amount"><?=$table == 'centralpark' ? 'Central Park Ride' : ($table == 'hourly' ? 'Hourly Pedicab Ride' : 'Point A to B Pedicab Ride')?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Driver</h6>
                                        <b class="pay-amount"><?=$drivernamesurname;?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Start Location</h6>
                                        <b class="pay-amount"><?=$sonuc["pickupAddress"]?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-map-marker-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Finish Location</h6>
                                        <b class="pay-amount"><?=$sonuc["destinationAddress"]?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Date</h6>
                                        <b class="pay-amount"><?=$sonuc["date"]?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Time</h6>
                                        <b class="pay-amount">Now!</b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Passengers</h6>
                                        <b class="pay-amount"><?=$sonuc["numberOfPassengers"]?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Name</h6>
                                        <b class="pay-amount"><?=$sonuc["firstName"] . ' ' . $sonuc["lastName"]?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-phone"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Phone</h6>
                                        <b class="pay-amount"><?=$sonuc["phoneNumber"]?></b>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Pay</h6>
                                        <b class="pay-amount">$<?=$sonuc["driverFee"]?> with <?=$paymentMethod?> by customer <?=$sonuc["firstName"] . " " . $sonuc["lastName"]?></b>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Remaining Time</h6>
                                    <b class="pay-amount">
                                        <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown"></span> minutes
                                    </b>
                                </div>     
                            </div>
                        </div>
                    </div>
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