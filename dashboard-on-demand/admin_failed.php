<?php ob_start();?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php');

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi']; ?>
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
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
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
                $sorgu = $baglanti->prepare("SELECT id, driver, bookingNumber, createdAt, 'Point A to B Pedicab Ride' AS Type FROM pointatob WHERE status = 'failed'
                    UNION ALL
                    SELECT id, driver, bookingNumber, createdAt, 'Hourly Pedicab Ride' AS Type FROM hourly WHERE status = 'failed'
                    UNION ALL
                    SELECT id, driver, bookingNumber, createdAt, 'Central Park Tour' AS Type FROM centralpark WHERE status = 'failed'
                    ORDER BY createdAt DESC");
                $sorgu->execute();

                while ($sonuc = $sorgu->fetch()) { 
                ?>           
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body position-relative">
                            <h5 class="mb-3"><?= $sonuc["bookingNumber"] ?></h5>
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
                                        <b class="pay-amount"><?= htmlspecialchars($sonuc['Type']) ?></b>
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
                                        <b class="pay-amount" style='color:red;'>FAILED</b>
                                    </div>
                                </div>
                                <form method="POST" action="<?php 
                                    if (htmlspecialchars($sonuc['Type']) == 'Point A to B Pedicab Ride'){
                                        echo "detailsatob.php";
                                    }
                                    elseif (htmlspecialchars($sonuc['Type']) == 'Hourly Pedicab Ride'){
                                        echo "detailshourly.php";
                                    }
                                    elseif (htmlspecialchars($sonuc['Type']) == 'Central Park Tour'){
                                        echo "detailscentralpark.php";
                                    }
                                ?>" role="form">
                                    <input type="hidden" name="id" value="<?=$sonuc["id"]?>" />
                                    <input type="hidden" name="bookingNumber" value="<?=$sonuc["bookingNumber"]?>" />
                                    <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn" value="Details"/>
                                </form>           
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
<?php 
include('inc/footer.php');
include('inc/scripts.php');?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>