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
<style>
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
 <div class="col-xl-12"><div class="d-flex flex-wrap gap-2 year-buttons">
     <a href="admin_earnings.php" class="btn btn-outline-secondary waves-effect waves-light">All Years</a>
    <a href="admin_earnings.php?year=2024" class="btn btn-outline-secondary waves-effect waves-light">2024</a>
    <a href="admin_earnings.php?year=2025" class="btn btn-outline-secondary waves-effect waves-light">2025</a>
    <a href="admin_earnings.php?year=2026" class="btn btn-outline-secondary waves-effect waves-light">2026</a>
    <a href="admin_earnings.php?year=2027" class="btn btn-outline-secondary waves-effect waves-light">2027</a>
    <a href="admin_earnings.php?year=2028" class="btn btn-outline-secondary waves-effect waves-light">2028</a>
</div>
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Admin Earnings</h4>


                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->

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
$totalKazanc = 0;
$date = isset($_GET['year']) ? $_GET['year'] : '';

$sorgu = $baglanti->prepare("SELECT * FROM users");
$sorgu->execute();

while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    $driver2 = $sonuc["user"];

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

    $sql_hourly = "SELECT SUM(bookingFee) AS toplamkazandigi FROM hourly WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
    $stmt_hourly = $baglanti->prepare($sql_hourly);
    $stmt_hourly->bindParam(':driver2', $driver2, PDO::PARAM_STR);
    if ($date) {
        $stmt_hourly->bindParam(':date', $likeDate, PDO::PARAM_STR);
    }
    $stmt_hourly->execute();
    $result_hourly = $stmt_hourly->fetch(PDO::FETCH_ASSOC);
    $kazanc_hourly = $result_hourly['toplamkazandigi'] ?? 0;

    $sql_centralpark = "SELECT SUM(bookingFee) AS toplamkazandigi FROM centralpark WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
    $stmt_centralpark = $baglanti->prepare($sql_centralpark);
    $stmt_centralpark->bindParam(':driver2', $driver2, PDO::PARAM_STR);
    if ($date) {
        $stmt_centralpark->bindParam(':date', $likeDate, PDO::PARAM_STR);
    }
    $stmt_centralpark->execute();
    $result_centralpark = $stmt_centralpark->fetch(PDO::FETCH_ASSOC);
    $kazanc_centralpark = $result_centralpark['toplamkazandigi'] ?? 0;

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
                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->

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
$totalKazanc = 0;
$date = isset($_GET['year']) ? $_GET['year'] : '';

$sorgu = $baglanti->prepare("SELECT * FROM users");
$sorgu->execute();

while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
    $driver2 = $sonuc["user"];

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

    $sql_hourly = "SELECT SUM(driverFee) AS toplamkazandigi FROM hourly WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
    $stmt_hourly = $baglanti->prepare($sql_hourly);
    $stmt_hourly->bindParam(':driver2', $driver2, PDO::PARAM_STR);
    if ($date) {
        $stmt_hourly->bindParam(':date', $likeDate, PDO::PARAM_STR);
    }
    $stmt_hourly->execute();
    $result_hourly = $stmt_hourly->fetch(PDO::FETCH_ASSOC);
    $kazanc_hourly = $result_hourly['toplamkazandigi'] ?? 0;

    $sql_centralpark = "SELECT SUM(driverFee) AS toplamkazandigi FROM centralpark WHERE status = 'past' AND driver = :driver2" . ($date ? " AND date LIKE :date" : "");
    $stmt_centralpark = $baglanti->prepare($sql_centralpark);
    $stmt_centralpark->bindParam(':driver2', $driver2, PDO::PARAM_STR);
    if ($date) {
        $stmt_centralpark->bindParam(':date', $likeDate, PDO::PARAM_STR);
    }
    $stmt_centralpark->execute();
    $result_centralpark = $stmt_centralpark->fetch(PDO::FETCH_ASSOC);
    $kazanc_centralpark = $result_centralpark['toplamkazandigi'] ?? 0;

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

</body>

</html>