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
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Point A to B Pedicab Rides -->
<div class="col-12">
    <h2 class="mb-3">Point A to B Pedicab Rides [PAST]</h2>
    <hr>
    <div class="row">
        <?php
        $sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE status = 'past' ORDER BY createdAt DESC");
        $sorgu->execute();
        while ($sonuc = $sorgu->fetch()) {
            $paymentMethod = $sonuc['paymentMethod'];
            if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                $paymentMethod = "debit/credit card";
            }
            if ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                $paymentMethod = "CASH";
            }
			
								$drivername = $sonuc["driver"];
								$sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = '$drivername'");
								$sorgu2->execute();
								$sonuc2 = $sorgu2->fetch();
								$drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];
			

        ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body position-relative">
                            <h5 class="mb-3"></h5>
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
                                        <h6 class="mb-1">Booking Number</h6>
                                        <b class="pay-amount"><?= htmlspecialchars($sonuc['bookingNumber']) ?></b>
                                    </div>
                                </div>
								 <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="ri-file-user-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Driver Name</h6>
                                        <b class="pay-amount" style='color:red;'><?= $drivernamesurname ?></b>
                                    </div>
                                </div>
                                <form method="POST" action="detailsatob.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                    <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                    <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                    <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Details" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Hourly Pedicab Rides -->
<div class="col-12">
    <h2 class="mb-3">Hourly Pedicab Services [PAST]</h2>
    <hr>
    <div class="row">
        <?php
        $sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE status = 'past' ORDER BY createdAt DESC");
        $sorgu->execute();
        while ($sonuc = $sorgu->fetch()) {
            $paymentMethod = $sonuc['paymentMethod'];
            if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                $paymentMethod = "debit/credit card";
            }
            if ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                $paymentMethod = "CASH";
            }
			
											$drivername = $sonuc["driver"];
								$sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = '$drivername'");
								$sorgu2->execute();
								$sonuc2 = $sorgu2->fetch();
								$drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];

        ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body position-relative">
                            <h5 class="mb-3"></h5>
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
                                        <h6 class="mb-1">Booking Number</h6>
                                        <b class="pay-amount"><?= htmlspecialchars($sonuc['bookingNumber']) ?></b>
                                    </div>
                                </div>
								<div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="ri-file-user-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Driver Name</h6>
                                        <b class="pay-amount" style='color:red;'><?= $drivernamesurname ?></b>
                                    </div>
                                </div>
                                <form method="POST" action="detailshourly.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                    <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                    <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                    <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Details"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- Central Park Tours -->
<div class="col-12">
    <h2 class="mb-3">Central Park Pedicab Tours [PAST]</h2>
    <hr>
    <div class="row">
        <?php
        $sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE status = 'past' ORDER BY createdAt DESC");
        $sorgu->execute();
        while ($sonuc = $sorgu->fetch()) {
            $paymentMethod = $sonuc['paymentMethod'];
            if ($paymentMethod == "CARD" or $paymentMethod == "card") {
                $paymentMethod = "debit/credit card";
            }
            if ($paymentMethod == "CASH" or $paymentMethod == "cash") {
                $paymentMethod = "CASH";
            }

            $tourDuration = $sonuc["tourDuration"];
            if ($tourDuration == 60) {
                $tourDuration = "1 Hour";
            } else {
                $tourDuration = $tourDuration . " Minutes";
            }
			
											$drivername = $sonuc["driver"];
								$sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = '$drivername'");
								$sorgu2->execute();
								$sonuc2 = $sorgu2->fetch();
								$drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];
        ?>
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body position-relative">
                            <h5 class="mb-3"></h5>
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
                                        <h6 class="mb-1">Booking Number</h6>
                                        <b class="pay-amount"><?= htmlspecialchars($sonuc['bookingNumber']) ?></b>
                                    </div>
                                </div>
								<div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="avatar-xs">
                                            <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                <i class="ri-file-user-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">Driver Name</h6>
                                        <b class="pay-amount" style='color:red;'><?= $drivernamesurname ?></b>
                                    </div>
                                </div>
                                <form method="POST" action="detailscentralpark.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                    <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                    <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                    <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Details"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
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
</body>
</html>
