<?php
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
  <head> <?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi'];?>
    <meta content="<?=$descripton?>" name="description" />
  <script src="assets/js/sweetalert.min.js"></script>
  </head>
  <body> <?php
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
        $number = $_POST['number'];  // Bu satır eklenmeli
        $pass = $_POST['pass'];      // Bu satır eklenmeli
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

        // Kullanıcı adı kontrolü
        $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
        $sorgu->execute(['user' => $user]);
        $sonuc2 = $sorgu->fetch();
        $is_valid = true;
        
        if ($sonuc2 && $sonuc2["id"] != $driverid) {
            echo '<script>swal("Error","This username is already in use!","error");</script>';
            $is_valid = false;
        }

        // Email kontrolü
        $sorgu = $baglanti->prepare("SELECT * FROM users WHERE email=:email");
        $sorgu->execute(['email' => $email]);
        $sonuc3 = $sorgu->fetch();
        
        if ($sonuc3 && $sonuc3["id"] != $driverid) {
            echo '<script>swal("Error","This email address is already in use!","error");</script>';
            $is_valid = false;
        }

        // Telefon numarası kontrolü
        $sorgu = $baglanti->prepare("SELECT * FROM users WHERE number=:number");
        $sorgu->execute(['number' => $number]);
        $sonuc4 = $sorgu->fetch();
        
        if ($sonuc4 && $sonuc4["id"] != $driverid) {
            echo '<script>swal("Error","This phone number is already in use!","error");</script>';
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

?><div class="main-content">
      <div class="page-content">
        <div class="container-fluid">
          <div class="row">
            <div style="margin: auto;"			class="col-lg-6">
              <div class="card">
                <div class="card-header align-items-center d-flex">
                  <h4 class="card-title mb-0 flex-grow-1">Driver Details</h4>
                  <div class="flex-shrink-0"></div>
                </div>
                <!-- end card header -->
                <div class="card-body">
                  <div class="live-preview">
				  <form action="" method="POST">
                    <div>
                      <h5 class="fs-15">Driver <?=$sonuc['name'] . ' ' . $sonuc['surname']?> </h5>
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
                            <input type="password" class="form-control" name="pass" autocomplete="new-password" value="" placeholder="Password (If you don't want to change password, please don't write anything in this area.)" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" value="<?=$sonuc['name']?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-text">Surname</span>
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
                              <option value="admin" <?php echo ($selectedPerm == 'admin') ? 'selected' : ''; ?>>Admin </option>
                              <option value="driver" <?php echo ($selectedPerm == 'driver') ? 'selected' : ''; ?>>Driver </option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="mt-4"> <button type="submit" style="float:right;" class="btn rounded-pill btn-success waves-effect waves-light">Submit</button> </div>
					</form>
                  </div>
                </div>
              </div>
            </div>
            <!--end col-->
          </div>
          <!-- container-fluid -->
        </div>
        <!-- End Page-content --> <?php 
include('inc/footer.php');
include('inc/scripts.php');?> </body>
</html>