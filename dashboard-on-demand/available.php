<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$descripton?>" name="description" />
<script src="assets/js/sweetalert.min.js"></script>
</head>
<body>
<?php
include('inc/header.php');
include('inc/navbar.php');
if ($sayac > 0){
    header('location: pending.php');
    exit;
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Point A to B Pedicab Rides -->
                <div class="col-12">
                    <h2 class="mb-3">Point A to B Pedicab Rides</h2>
                    <hr>
                    <div class="row">
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE status = 'available' ORDER BY createdAt DESC");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            $paymentMethod = $sonuc['paymentMethod'];
                            if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                                $paymentMethod = "debit/credit card";
                            } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                                $paymentMethod = "CASH";
                            }

                            $createdAt = new DateTime($sonuc['createdAt'], new DateTimeZone('America/New_York'));
                            $expiryTime = clone $createdAt;
                            $expiryTime->modify('+5 minutes');
                            $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
                            $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

                            if ($remainingTime > 0) {
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card" id="card-<?= $sonuc['id'] ?>">
                                <div class="card-body position-relative">
                                    <h5 class="mb-3"><?= htmlspecialchars($sonuc["bookingNumber"]) ?></h5>
                                    <div class="vstack gap-2">
                                        <div class="form-check card-radio">
                                            <input id="listGroupRadioGrid3" name="listGroupRadioGrid" type="radio" class="form-check-input">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                            <i class="ri-apps-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Type</h6>
                                                    <b class="pay-amount">Point A to B Pedicab Ride</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-parent-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Passengers</h6>
                                                <b class="pay-amount"><?= htmlspecialchars($sonuc['numberOfPassengers']) ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-calendar-2-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Date Of Tour</h6>
                                                <b class="pay-amount">
                                                    <?php
                                                    $date = new DateTime($sonuc['date']);
                                                    echo htmlspecialchars($date->format('m/d/Y'));
                                                    ?>
                                                    (<?= htmlspecialchars($date->format('l')) ?>) (Today)
                                                </b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-time-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Time of Tour</h6>
                                                <b class="pay-amount">
                                                    <?php
                                                    $time = new DateTime($sonuc['createdAt'], new DateTimeZone('America/Los_Angeles')); // Pacific Time
                                                    $time->setTimezone(new DateTimeZone('America/New_York')); // New York Time
                                                    echo htmlspecialchars($time->format('h:i A'));
                                                    ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-map-pin-time-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Duration of Ride</h6>
                                                <b class="pay-amount"><?= htmlspecialchars(number_format($sonuc['duration'], 2)) ?> Minutes</b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-coin-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Driver Fare</h6>
                                                <b class="pay-amount">$<?= htmlspecialchars($sonuc["driverFee"]) ?> with <?= $paymentMethod ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-time-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Remaining Time</h6>
                                                <b class="pay-amount">
                                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown"><?= gmdate('i:s', $remainingTime) ?></span> minutes
                                                </b>
                                            </div>
                                        </div>
                                        <form method="POST" action="acceptatob.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                            <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                            <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                            <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Accept" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var remainingTime = <?= $remainingTime ?>;
                                var display = document.querySelector('#countdown-<?= $sonuc['id'] ?>');
                                var button = document.querySelector('#confirm-btn-<?= $sonuc['id'] ?>');
                                var card = document.querySelector('#card-<?= $sonuc['id'] ?>');
                                startCountdown(remainingTime, display, button, card);
                            });
                        </script>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- Hourly Pedicab Rides -->
                <div class="col-12">
                    <h2 class="mb-3">Hourly Pedicab Services</h2>
                    <hr>
                    <div class="row">
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE status = 'available' ORDER BY createdAt DESC");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            $paymentMethod = $sonuc['paymentMethod'];
                            if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                                $paymentMethod = "debit/credit card";
                            } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                                $paymentMethod = "CASH";
                            }

                            $createdAt = new DateTime($sonuc['createdAt'], new DateTimeZone('America/New_York'));
                            $expiryTime = clone $createdAt;
                            $expiryTime->modify('+5 minutes');
                            $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
                            $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

                            if ($remainingTime > 0) {
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card" id="card-<?= $sonuc['id'] ?>">
                                <div class="card-body position-relative">
                                    <h5 class="mb-3"><?= htmlspecialchars($sonuc["bookingNumber"]) ?></h5>
                                    <div class="vstack gap-2">
                                        <div class="form-check card-radio">
                                            <input id="listGroupRadioGrid3" name="listGroupRadioGrid" type="radio" class="form-check-input">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                            <i class="ri-apps-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Type</h6>
                                                    <b class="pay-amount">Hourly Pedicab Service</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-parent-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Passengers</h6>
                                                <b class="pay-amount"><?= htmlspecialchars($sonuc['numberOfPassengers']) ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-calendar-2-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Date Of Tour</h6>
                                                <b class="pay-amount">
                                                    <?php
                                                    $date = new DateTime($sonuc['date']);
                                                    echo htmlspecialchars($date->format('m/d/Y'));
                                                    ?>
                                                    (<?= htmlspecialchars($date->format('l')) ?>) (Today)
                                                </b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-time-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Time of Tour</h6>
                                                <b class="pay-amount">
                                                    <?php
                                                    $time = new DateTime($sonuc['createdAt'], new DateTimeZone('America/Los_Angeles')); // Pacific Time
                                                    $time->setTimezone(new DateTimeZone('America/New_York')); // New York Time
                                                    echo htmlspecialchars($time->format('h:i A'));
                                                    ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-map-pin-time-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Duration of Ride</h6>
                                                <b class="pay-amount"><?= htmlspecialchars(number_format($sonuc['duration'], 2)) ?> Minutes</b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-coin-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Driver Fare</h6>
                                                <b class="pay-amount">$<?= htmlspecialchars($sonuc["driverFee"]) ?> with <?= $paymentMethod ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-time-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Remaining Time</h6>
                                                <b class="pay-amount">
                                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown"><?= gmdate('i:s', $remainingTime) ?></span> minutes
                                                </b>
                                            </div>
                                        </div>
                                        <form method="POST" action="accepthourly.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                            <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                            <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                            <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Accept"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var remainingTime = <?= $remainingTime ?>;
                                var display = document.querySelector('#countdown-<?= $sonuc['id'] ?>');
                                var button = document.querySelector('#confirm-btn-<?= $sonuc['id'] ?>');
                                var card = document.querySelector('#card-<?= $sonuc['id'] ?>');
                                startCountdown(remainingTime, display, button, card);
                            });
                        </script>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <!-- Central Park Tours -->
                <div class="col-12">
                    <h2 class="mb-3">Central Park Pedicab Tours</h2>
                    <hr>
                    <div class="row">
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE status = 'available' ORDER BY createdAt DESC");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            $paymentMethod = $sonuc['paymentMethod'];
                            if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                                $paymentMethod = "debit/credit card";
                            } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                                $paymentMethod = "CASH";
                            }

                            $tourDuration = $sonuc["tourDuration"];
                            if ($tourDuration == 60) {
                                $tourDuration = "1 Hour";
                            } else {
                                $tourDuration = $tourDuration . " Minutes";
                            }

                            $createdAt = new DateTime($sonuc['createdAt'], new DateTimeZone('America/New_York'));
                            $expiryTime = clone $createdAt;
                            $expiryTime->modify('+5 minutes');
                            $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
                            $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

                            if ($remainingTime > 0) {
                        ?>
                        <div class="col-xl-3 col-md-6">
                            <div class="card" id="card-<?= $sonuc['id'] ?>">
                                <div class="card-body position-relative">
                                    <h5 class="mb-3"><?= htmlspecialchars($sonuc["bookingNumber"]) ?></h5>
                                    <div class="vstack gap-2">
                                        <div class="form-check card-radio">
                                            <input id="listGroupRadioGrid3" name="listGroupRadioGrid" type="radio" class="form-check-input">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                            <i class="ri-apps-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">Type</h6>
                                                    <b class="pay-amount">Central Park Pedicab Tour</b>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-parent-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Passengers</h6>
                                                <b class="pay-amount"><?= htmlspecialchars($sonuc['numberOfPassengers']) ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-calendar-2-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Date Of Tour</h6>
                                                <b class="pay-amount">
                                                    <?php
                                                    $date = new DateTime($sonuc['date']);
                                                    echo htmlspecialchars($date->format('m/d/Y'));
                                                    ?>
                                                    (<?= htmlspecialchars($date->format('l')) ?>) (Today)
                                                </b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-time-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Time of Tour</h6>
                                                <b class="pay-amount">
                                                    <?php
                                                    $time = new DateTime($sonuc['createdAt'], new DateTimeZone('America/Los_Angeles')); // Pacific Time
                                                    $time->setTimezone(new DateTimeZone('America/New_York')); // New York Time
                                                    echo htmlspecialchars($time->format('h:i A'));
                                                    ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-map-pin-time-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Duration of Tour</h6>
                                                <b class="pay-amount"><?= htmlspecialchars($tourDuration) ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-map-pin-time-fill"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Duration of Ride</h6>
                                                <b class="pay-amount"><?= htmlspecialchars(number_format($sonuc['duration'], 2)) ?> Minutes</b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-coin-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Driver Fare</h6>
                                                <b class="pay-amount">$<?= htmlspecialchars($sonuc["driverFee"]) ?> with <?= $paymentMethod ?></b>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                        <i class="ri-time-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">Remaining Time</h6>
                                                <b class="pay-amount">
                                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown"><?= gmdate('i:s', $remainingTime) ?></span> minutes
                                                </b>
                                            </div>
                                        </div>
                                        <form method="POST" action="acceptcentralpark.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                            <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                            <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                            <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Accept"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                var remainingTime = <?= $remainingTime ?>;
                                var display = document.querySelector('#countdown-<?= $sonuc['id'] ?>');
                                var button = document.querySelector('#confirm-btn-<?= $sonuc['id'] ?>');
                                var card = document.querySelector('#card-<?= $sonuc['id'] ?>');
                                startCountdown(remainingTime, display, button, card);
                            });
                        </script>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
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
    document.querySelectorAll("form[id^='accept-form-']").forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            swal({
                title: 'Are you sure?',
                text: 'Do you want to accept this booking?',
                icon: 'info',
                buttons: {
                    cancel: {
                        text: 'No',
                        value: null,
                        visible: true,
                        className: '',
                        closeModal: true,
                    },
                    confirm: {
                        text: 'Yes',
                        value: true,
                        visible: true,
                        className: '',
                        closeModal: true,
                        style: 'background-color: blue; color: white;' // Stil özelliklerini buraya ekledik
                    }
                },
                dangerMode: true,
            }).then((willAccept) => {
                if (willAccept) {
                    form.submit();
                } else {
                    swal('Action cancelled', 'The booking was not accepted.', 'info');
                }
            });
        });
    });

    function startCountdown(duration, display, button, card) {
        var timer = duration, minutes, seconds;
        var countdownInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (timer <= 60) {
                display.style.color = "red";
            }

            if (--timer < 0) {
                clearInterval(countdownInterval);
                display.textContent = "Expired";
                display.style.color = "red";
                button.disabled = true;
                card.style.display = "none"; // Zaman dolduğunda kartı gizle
            }
        }, 1000);
    }
</script>

</body>
</html>