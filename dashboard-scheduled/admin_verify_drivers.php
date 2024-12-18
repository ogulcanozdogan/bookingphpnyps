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
<script src="assets/js/sweetalert.min.js"></script>
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
                                    <h4 class="card-title mb-0 flex-grow-1">Verify Drivers</h4>

                                    <div class="flex-shrink-0">
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                      <div class="live-preview">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Driver Username</th>
                                                        <th scope="col">Driver Name</th>
														<th scope="col">Driver Email</th>
														<th scope="col">Driver Phone</th>
														<th scope="col">Perm</th>
														<th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php 
$sorgu = $baglanti->prepare("SELECT * FROM users_temporary");
$sorgu->execute();

while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
												?>

<tr>
    <td><b><?=$sonuc['user']; ?></b></td>
	<td><b><?=$sonuc['name'] . ' ' . $sonuc['surname']; ?></b></td>
	<td><b><?=$sonuc['email']; ?></b></td>
	<td><b>+1<?=$sonuc['number']; ?></b></td>
	<td><b><?=$sonuc['perm']; ?></b></td>
	<td>
<a onclick="event.preventDefault(); 
            swal({
                title: 'Are you sure?',
                text: 'Do you want to verify this membership?',
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
                        style: 'background-color: blue; color: white;'
                    }
                },
                dangerMode: true,
            }).then((willVerify) => { 
                if (willVerify) {
                    window.location.href = 'admin_drivers_process.php?id=<?=$sonuc['id']?>&process=verify&table=users_temporary';
                } else {
                    swal('Action cancelled', 'The membership was not verified.', 'info');
                }
            });">
    <b><i class="bx-border bx-xs bx bx-check"></i></b>
</a>

<a onclick="event.preventDefault(); 
            swal({
                title: 'Are you sure?',
                text: 'Do you want to delete this item?',
                icon: 'warning',
                buttons: ['No', 'Yes'],
                dangerMode: true,
            }).then((willDelete) => { 
                if (willDelete) {
                    window.location.href = 'admin_drivers_process.php?id=<?=$sonuc['id']?>&process=delete&table=users_temporary';
                } else {
                    swal('Action cancelled', 'The item was not deleted.', 'info');
                }
            });">
    <b style='margin-left:5%;'><i class="bx-border bx-xs bx bx-trash"></i></b>
</a>

	</td>
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

</body>

</html>