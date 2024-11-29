<?php ob_start(); error_reporting(E_ALL);
ini_set("display_errors", 1);?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Rates Management";
$description = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$description?>" name="description" />
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
	    .actions-column {
        text-align: right;
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
                            <h4 class="card-title mb-0 flex-grow-1">ZIP Codes</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="live-preview">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">ZIP Code</th>
                                                <th scope="col" class="actions-column">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><b>1</b></td>
                                                <td><b>Central Park</b></td>
                                                <td class="actions-column">
                                                    <a href='admin_zip_edit.php?id=1' class="btn-icon"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
                                            </tr>
											  <tr>
                                                <td><b>2</b></td>
                                                <td><b>Hourly</b></td>
                                                <td class="actions-column">
                                                    <a href='admin_zip_edit.php?id=2' class="btn-icon"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
                                            </tr>
											<tr>
                                                <td><b>3</b></td>
                                                <td><b>Point A to B</b></td>
                                                <td class="actions-column">
                                                    <a href='admin_zip_edit.php?id=3' class="btn-icon"><i class="fas fa-pencil-alt"></i></a>
                                                </td>
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
