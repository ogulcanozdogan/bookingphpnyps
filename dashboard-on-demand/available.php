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
                       
					   
			<?php
$sorgu = $baglanti->prepare("SELECT id, bookingNumber, createdAt, 'Point A to B Pedicab Ride' AS Type FROM pointatob WHERE status = 'available'
    UNION ALL
    SELECT id, bookingNumber, createdAt, 'Hourly Pedicab Ride' AS Type FROM hourly WHERE status = 'available'
	UNION ALL
	SELECT id, bookingNumber, createdAt, 'Central Park Tour' AS Type FROM centralpark WHERE status = 'available'
    ORDER BY createdAt DESC");
$sorgu->execute();

while ($sonuc = $sorgu->fetch()) { 

 ?>		   
			
			
			
			<div class="col-xl-3 col-md-6">
                            <div class="card">
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
                                                        <b class="pay-amount"><?php echo htmlspecialchars($sonuc['Type']) ?></b>
                                                    </div>
                                                </div>
                                          
                                        </div>

                                    </div>
                        <form method="POST" action="<?php 
						
						if (htmlspecialchars($sonuc['Type']) == 'Point A to B Pedicab Ride'){
							
							echo "acceptatob.php";
						}
						elseif (htmlspecialchars($sonuc['Type']) == 'Hourly Pedicab Ride'){
						echo "accepthourly.php";
						}
							elseif (htmlspecialchars($sonuc['Type']) == 'Central Park Tour'){
						echo "acceptcentralpark.php";
						}
						
						?>" role="form">
						<input type="hidden" name="id" value="<?=$sonuc["id"]?>" />
						<input type="hidden" name="bookingNumber" value="<?=$sonuc["bookingNumber"]?>" />
                                    <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn" value="Details"/>
                        
                        </form>           
								   
                                </div>
                                <!-- end card body -->
                            </div>
							
							
                            <!-- end card -->
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

</body>

</html>