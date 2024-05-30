<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php');
$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi']; ?>
<meta content="<?=$descripton?>" name="description" />
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
                        <div class="col">

                            <div class="h-100">
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1">Hello, <?php
												$sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = '$user'");
								$sorgu2->execute();
								$sonuc2 = $sorgu2->fetch();
								echo $sonuc2["name"] . ' ' . $sonuc2["surname"];
												
											
										
$sorgu = $baglanti->prepare("SELECT SUM(driverFee) AS totalDriverFee FROM pointatob WHERE status = 'past' AND driver = :user");
$sorgu->bindParam(':user', $user, PDO::PARAM_STR);
$sorgu->execute();
$sonuc = $sorgu->fetch();
$toplamDriverFee = $sonuc['totalDriverFee'];


$sorgu = $baglanti->prepare("SELECT SUM(driverFee) AS totalDriverFee FROM hourly WHERE status = 'past' AND driver = :user");
$sorgu->bindParam(':user', $user, PDO::PARAM_STR);
$sorgu->execute();
$sonuc = $sorgu->fetch();


$toplamDriverFee = $toplamDriverFee + $sonuc['totalDriverFee'];


$sorgu = $baglanti->prepare("SELECT SUM(driverFee) AS totalDriverFee FROM centralpark WHERE status = 'past' AND driver = :user");
$sorgu->bindParam(':user', $user, PDO::PARAM_STR);
$sorgu->execute();
$sonuc = $sorgu->fetch();


$toplamDriverFee = $toplamDriverFee + $sonuc['totalDriverFee'];

												?></h4>
                                                <p class="text-muted mb-0">From the menu on the left, you can perform any operation you want and view active jobs.</p>
<br>
<br>Your Total Earnings: $<b style='color:green;'><?= number_format($toplamDriverFee, 2)?></b>                                 </div>
												
										
                                            
                                        </div><!-- end card header -->	
                                    <!--end col-->
                                </div>
                                <!--end row-->




                            </div> <!-- end .h-100-->

                        </div> <!-- end col -->


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