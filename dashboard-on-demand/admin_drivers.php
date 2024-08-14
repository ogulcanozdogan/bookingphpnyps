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
                            <h4 class="card-title mb-0 flex-grow-1">Drivers</h4>
                            <a href='admin_driver_add.php' class="btn-icon"><i class="fas fa-user-plus"></i></a>
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
                                                <th scope="col">Pedicab Registration File</th>
                                                <th scope="col">Perm</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $sorgu = $baglanti->prepare("SELECT * FROM users WHERE verify=1");
                                        $sorgu->execute();

                                        while ($sonuc = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <td><b><?=$sonuc['user']; ?></b></td>
                                                <td><b><?=$sonuc['name'] . ' ' . $sonuc['surname']; ?></b></td>
                                                <td><b><?=$sonuc['email']; ?></b></td>
                                                <td><b>+1<?=$sonuc['number']; ?></b></td>
                                                <td><b><a target='_blank' href='https://newyorkpedicabservices.com/dashboard-on-demand/registration_pdf.php?pdf_id=<?=$sonuc['pdf_id']; ?>'><?=$sonuc['pdf_id']; ?></a></b></td>
                                                <td><b><?=$sonuc['perm']; ?></b></td>
                                                <td>
                                                    <a href='admin_driver_edit.php?id=<?=$sonuc['id']?>' class="btn-icon"><i class="fas fa-pencil-alt"></i></a>
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
                                                                window.location.href = 'admin_drivers_process.php?id=<?=$sonuc['id']?>&process=delete';
                                                            } else {
                                                                swal('Action cancelled', 'The membership was not verified.', 'info');
                                                            }
                                                        });" class="btn-icon">
                                                        <i class="fas fa-trash-alt"></i>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>