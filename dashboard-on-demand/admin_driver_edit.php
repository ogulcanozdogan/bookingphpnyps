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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }
    .card-title {
        font-weight: 700;
    }
    .input-group-text {
        font-weight: 600;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
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

$driverid = $_GET['id'];
$sorgu = $baglanti->prepare("SELECT * FROM users WHERE id=:driverid");
$sorgu->execute(['driverid' => $driverid]);
$sonuc = $sorgu->fetch();
$selectedPerm = $sonuc['perm'];

if ($_POST) {
    $user = $_POST['user'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];		
    $perm = $_POST['perm'];
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $pdf_id = $_POST['pdf_id'];   

    $satir = [
        'id' => $driverid,
        'user' => $user,
        'name' => $name,
        'surname' => $surname,
        'email' => $email,
        'perm' => $perm,
        'pdf_id' => $pdf_id,
    ];

    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
    $sorgu->execute(['user' => $user]);
    $sonuc2 = $sorgu->fetch();
    $is_valid = true;

    if ($sonuc2 && $sonuc2["id"] != $driverid) {
        echo '<script>swal("Error","This username is already in use!","error");</script>';
        $is_valid = false;
    }

    if ($is_valid) {
        if (!empty($pass)) {
            $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
            $satir['pass'] = $hashed_pass;
            $sql = "UPDATE users SET user=:user, name=:name, surname=:surname, email=:email, pass=:pass, perm=:perm, pdf_id=:pdf_id WHERE id=:id";
        } else {
            $sql = "UPDATE users SET user=:user, name=:name, surname=:surname, email=:email, perm=:perm, pdf_id=:pdf_id WHERE id=:id";
        }

        try {
            $stmt = $baglanti->prepare($sql);
            $durum = $stmt->execute($satir);
            if ($durum) {
                echo '<script>swal("Successful", "Driver Profile Updated.", "success").then((value) => { window.location.href = "admin_drivers.php" });</script>';
            } else {
                echo "SQL Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
            }
        } catch (PDOException $e) {
            echo "PDO Exception: " . $e->getMessage() . "<br>";
        }
    }
}
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div style="margin: auto;" class="col-lg-6">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
						
                            <a href="admin_drivers.php" class="btn btn-danger btn-sm" style="float: right;"><-</a>
                            <h4 class="card-title mb-0 flex-grow-1" style='text-align:center;'>Driver Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="" method="POST">
                                    <div>
                                        <h5 class="fs-15">Driver <?=$sonuc['name'] . ' ' . $sonuc['surname']?></h5>
                                        <div class="row g-3">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Username</span>
                                                    <input type="text" class="form-control" name="user" value="<?=$sonuc['user']?>" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Password</span>
                                                    <input type="password" class="form-control" name="pass" autocomplete="new-password" placeholder="Password (If you don't want to change password, please don't write anything in this area.)" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">First Name</span>
                                                    <input type="text" class="form-control" name="name" value="<?=$sonuc['name']?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">Last Name</span>
                                                    <input type="text" class="form-control" name="surname" value="<?=$sonuc['surname']?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Email</span>
                                                    <input type="text" class="form-control" name="email" value="<?=$sonuc['email']?>" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Pedicab Driver Registration ID</span>
                                                    <input type="text" class="form-control" name="pdf_id" value="<?=$sonuc['pdf_id']?>" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">Phone +1</span>
                                                    <input type="text" class="form-control" name="number" value="<?=$sonuc['number']?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <label class="input-group-text" for="inputGroupSelect01">Perm</label>
                                                    <select class="form-select" id="inputGroupSelect01" name="perm">
                                                        <option value="0" disabled>Choose...</option>
                                                        <option value="admin" <?php echo ($selectedPerm == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                        <option value="driver" <?php echo ($selectedPerm == 'driver') ? 'selected' : ''; ?>>Driver</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="submit" style="float:right;" class="btn rounded-pill btn-success waves-effect waves-light">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
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
