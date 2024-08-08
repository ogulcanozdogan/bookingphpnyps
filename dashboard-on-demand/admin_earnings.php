<?php ob_start(); error_reporting(E_ALL);
ini_set("display_errors", 1);?>
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
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .year-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 2px;
        justify-content: flex-end;  /* Sağa yaslamak için */
        margin-bottom: 50px;  /* Alt kısmından 50px boşluk */
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
                    <div class="d-flex flex-wrap gap-2 year-buttons">
                        <a href="admin_earnings.php?year=2024" class="btn btn-outline-secondary waves-effect waves-light">2024</a>
                        <a href="admin_earnings.php?year=2025" class="btn btn-outline-secondary waves-effect waves-light">2025</a>
                        <a href="admin_earnings.php?year=2026" class="btn btn-outline-secondary waves-effect waves-light">2026</a>
                        <a href="admin_earnings.php?year=2027" class="btn btn-outline-secondary waves-effect waves-light">2027</a>
                        <a href="admin_earnings.php?year=2028" class="btn btn-outline-secondary waves-effect waves-light">2028</a>
                    </div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Admin Earnings</h4>
                            <div class="flex-shrink-0"></div>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Driver Name</th>
                                                <th scope="col">Total Earnings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalKazanc = 0; // Toplam kazancı saklamak için bir değişken tanımlayın
                                            $date = isset($_GET['year']) ? $_GET['year'] : '';

                                            // Kullanıcıları seçme sorgusu
                                            $sorgu = $baglanti->prepare("SELECT * FROM users");
                                            $sorgu->execute();

                                            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                                                $driver2 = $sonuc["user"];

                                                // Point A to B Pedicab Ride toplam kazancı hesaplama
                                                $sql_pointatob = "SELECT SUM(bookingFee) AS toplamkazandigi FROM pointatob WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
                                                $stmt_pointatob = $baglanti->prepare($sql_pointatob);
                                                $stmt_pointatob->bindParam(':driver2', $driver2, PDO::PARAM_STR);
                                                if ($date) {
                                                    $likeDate = '%' . $date . '%';
                                                    $stmt_pointatob->bindParam(':date', $likeDate, PDO::PARAM_STR);
                                                }
                                                $stmt_pointatob->execute();
                                                $result_pointatob = $stmt_pointatob->fetch(PDO::FETCH_ASSOC);
                                                $kazanc_pointatob = $result_pointatob['toplamkazandigi'] ?? 0;

                                                // Hourly Pedicab Ride toplam kazancı hesaplama
                                                $sql_hourly = "SELECT SUM(bookingFee) AS toplamkazandigi FROM hourly WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
                                                $stmt_hourly = $baglanti->prepare($sql_hourly);
                                                $stmt_hourly->bindParam(':driver2', $driver2, PDO::PARAM_STR);
                                                if ($date) {
                                                    $stmt_hourly->bindParam(':date', $likeDate, PDO::PARAM_STR);
                                                }
                                                $stmt_hourly->execute();
                                                $result_hourly = $stmt_hourly->fetch(PDO::FETCH_ASSOC);
                                                $kazanc_hourly = $result_hourly['toplamkazandigi'] ?? 0;

                                                // Central Park Tour toplam kazancı hesaplama
                                                $sql_centralpark = "SELECT SUM(bookingFee) AS toplamkazandigi FROM centralpark WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
                                                $stmt_centralpark = $baglanti->prepare($sql_centralpark);
                                                $stmt_centralpark->bindParam(':driver2', $driver2, PDO::PARAM_STR);
                                                if ($date) {
                                                    $stmt_centralpark->bindParam(':date', $likeDate, PDO::PARAM_STR);
                                                }
                                                $stmt_centralpark->execute();
                                                $result_centralpark = $stmt_centralpark->fetch(PDO::FETCH_ASSOC);
                                                $kazanc_centralpark = $result_centralpark['toplamkazandigi'] ?? 0;

                                                // Toplam kazancı hesaplama
                                                $kazanc = $kazanc_pointatob + $kazanc_hourly + $kazanc_centralpark;
                                                $totalKazanc += $kazanc;
                                                ?>
                                                
                                                <tr>
                                                    <th scope="row"><?php echo htmlspecialchars($sonuc["name"] . ' ' . $sonuc["surname"]); ?></th>
                                                    <td><b style='color:green;'>$<?= number_format($kazanc, 2); ?></b></td>
                                                </tr>
                                                
                                            <?php } ?>
                                            <tr>
                                                <th scope="row"><b style='color:green;background-color:yellow;'>Total Earnings for <?= htmlspecialchars($date); ?></b></th>
                                                <td><b style='color:green;'>$<?= number_format($totalKazanc, 2); ?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
						
				<div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Driver Earnings</h4>
                            <div class="flex-shrink-0"></div>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Driver Name</th>
                                                <th scope="col">Total Earnings</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $totalKazanc = 0; // Toplam kazancı saklamak için bir değişken tanımlayın
                                            $date = isset($_GET['year']) ? $_GET['year'] : '';

                                            // Kullanıcıları seçme sorgusu
                                            $sorgu = $baglanti->prepare("SELECT * FROM users");
                                            $sorgu->execute();

                                            while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                                                $driver2 = $sonuc["user"];

                                                // Point A to B Pedicab Ride toplam kazancı hesaplama
                                                $sql_pointatob = "SELECT SUM(driverFee) AS toplamkazandigi FROM pointatob WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
                                                $stmt_pointatob = $baglanti->prepare($sql_pointatob);
                                                $stmt_pointatob->bindParam(':driver2', $driver2, PDO::PARAM_STR);
                                                if ($date) {
                                                    $likeDate = '%' . $date . '%';
                                                    $stmt_pointatob->bindParam(':date', $likeDate, PDO::PARAM_STR);
                                                }
                                                $stmt_pointatob->execute();
                                                $result_pointatob = $stmt_pointatob->fetch(PDO::FETCH_ASSOC);
                                                $kazanc_pointatob = $result_pointatob['toplamkazandigi'] ?? 0;

                                                // Hourly Pedicab Ride toplam kazancı hesaplama
                                                $sql_hourly = "SELECT SUM(driverFee) AS toplamkazandigi FROM hourly WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
                                                $stmt_hourly = $baglanti->prepare($sql_hourly);
                                                $stmt_hourly->bindParam(':driver2', $driver2, PDO::PARAM_STR);
                                                if ($date) {
                                                    $stmt_hourly->bindParam(':date', $likeDate, PDO::PARAM_STR);
                                                }
                                                $stmt_hourly->execute();
                                                $result_hourly = $stmt_hourly->fetch(PDO::FETCH_ASSOC);
                                                $kazanc_hourly = $result_hourly['toplamkazandigi'] ?? 0;

                                                // Central Park Tour toplam kazancı hesaplama
                                                $sql_centralpark = "SELECT SUM(driverFee) AS toplamkazandigi FROM centralpark WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
                                                $stmt_centralpark = $baglanti->prepare($sql_centralpark);
                                                $stmt_centralpark->bindParam(':driver2', $driver2, PDO::PARAM_STR);
                                                if ($date) {
                                                    $stmt_centralpark->bindParam(':date', $likeDate, PDO::PARAM_STR);
                                                }
                                                $stmt_centralpark->execute();
                                                $result_centralpark = $stmt_centralpark->fetch(PDO::FETCH_ASSOC);
                                                $kazanc_centralpark = $result_centralpark['toplamkazandigi'] ?? 0;

                                                // Toplam kazancı hesaplama
                                                $kazanc = $kazanc_pointatob + $kazanc_hourly + $kazanc_centralpark;
                                                $totalKazanc += $kazanc;
                                                ?>
                                                
                                                <tr>
                                                    <th scope="row"><?php echo htmlspecialchars($sonuc["name"] . ' ' . $sonuc["surname"]); ?></th>
                                                    <td><b style='color:green;'>$<?= number_format($kazanc, 2); ?></b></td>
                                                </tr>
                                                
                                            <?php } ?>
                                            <tr>
                                                <th scope="row"><b style='color:green;background-color:yellow;'>Total Earnings for <?= htmlspecialchars($date); ?></b></th>
                                                <td><b style='color:green;'>$<?= number_format($totalKazanc, 2); ?></b></td>
                                            </tr>
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