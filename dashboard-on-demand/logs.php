<?php ob_start(); error_reporting(E_ALL);
ini_set("display_errors", 1);?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Logs";
$descripton = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$descripton?>" name="description" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="assets/js/sweetalert.min.js"></script>
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card .card-header {
        background-color: #f8f9fa;
    }
    .card h4 {
        font-weight: 700;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-icon {
        background-color: transparent;
        border: none;
    }
    .btn-icon i {
        font-size: 1.2rem;
        color: #000;
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Logs</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
											    <th scope="col">Booking Number</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Perm</th>												
                                                <th scope="col">Timestamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sorgu = $baglanti->prepare("SELECT * FROM logs ORDER BY timestamp DESC");
                                        $sorgu->execute();

                                        while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
											    <td><b><a href="<?php 
												if ($sonuc['action'] == "Point A to B Accepted!"){
												echo "detailsatob.php?bookingNumber=" . $sonuc['bookingNumber'];
												}
												else if ($sonuc['action'] == "Hourly Accepted!"){
												echo "detailscentralpark.php?bookingNumber=" . $sonuc['bookingNumber'];
												}
												else if ($sonuc['action'] == "Central Accepted!"){
												echo "detailshourly.php?bookingNumber=" . $sonuc['bookingNumber'];
												}
												
												?>"><?=$sonuc['bookingNumber']; ?></a></b></td>
                                                <td><b><?=$sonuc['driverUsername']; ?></b></td>
                                                <td><b><?=$sonuc['driverName']; ?></b></td>
                                                <td><b><?=$sonuc['driverLastName']; ?></b></td>
												<td><b><?=$sonuc['action']; ?></b></td>
                                                <td><b><?=$sonuc['perm']; ?></b></td>
                                                <td><b><?=$sonuc['timestamp']; ?></b></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
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