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

if ($_POST) {
    $user = $_POST['user'];
	$pass = $_POST['pass'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
	$number = $_POST['number'];
    $perm = $_POST['perm'];


		
		 // Variable to check if the registration should proceed
                                    $is_valid = true;

                                    // Username check
                                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user=:user");
                                    $sorgu->execute(['user' => $user]);
                                    if ($sorgu->rowCount() > 0) {
										echo '<script>swal("Error","This username is already in use!","error");</script>';
                                        $is_valid = false; // Stop registration if there's an error
                                    }

                                    // Email check
                                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE email=:email");
                                    $sorgu->execute(['email' => $email]);
                                    if ($sorgu->rowCount() > 0) {
										echo '<script>swal("Error","This email address is already in use!","error");</script>';
                                        $is_valid = false; // Stop registration if there's an error
                                    }

                                    // Phone number check
                                    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE number=:number");
                                    $sorgu->execute(['number' => $number]);
                                    if ($sorgu->rowCount() > 0) {
										echo '<script>swal("Error","This phone number is already in use!","error");</script>';
                                        $is_valid = false; // Stop registration if there's an error
                                    }
									
									
									  if ($is_valid){
                                        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
        $satir = [
            'user' => $user,
			'pass' => $hashed_pass,
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
			'number' => $number,
            'perm' => $perm,
        ];
		
                                        $sql = "INSERT INTO users_temporary (user, pass, name, surname, email, number, perm) VALUES (:user, :pass, :name, :surname, :email, :number, :perm)";
                                        $stmt = $baglanti->prepare($sql);
                                        try {
                                            $durum = $stmt->execute($satir);
                                            if ($durum) {
                                                echo '<script>swal("Successful","Driver add successful. Please go the verify menu to activate this driver account.","success").then((value)=>{ window.location.href = "admin_verify_drivers.php"});</script>';
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
            <div style="margin: auto;" class="col-lg-6">
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
                      <h5 class="fs-15">Add Driver</h5>
                      <div class="row g-3">
                        <div class="col-lg-12">
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Username</span>
                            <input type="text" class="form-control" name="user" autocomplete="new-password" required placeholder="Username" aria-describedby="basic-addon1">
                          </div>
                        </div>
						<div class="col-lg-12">
                          <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Password</span>
                            <input type="password" class="form-control" name="pass" autocomplete="new-password" required placeholder="Password" aria-describedby="basic-addon1">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-text">Name</span>
                            <input type="text" class="form-control" name="name" autocomplete="new-password" required placeholder="Name">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group">
                            <span class="input-group-text">Surname</span>
                            <input type="text" class="form-control" name="surname" autocomplete="new-password" required placeholder="Surname">
                          </div>
                        </div>
<div class="col-lg-12">
    <div class="input-group">
        <span class="input-group-text" id="basic-addon1">Email</span>
        <input type="email" class="form-control" name="email" autocomplete="new-password" required placeholder="E-Mail" aria-describedby="basic-addon1">
    </div>
</div>
<div class="col-lg-6">
    <div class="input-group">
        <span class="input-group-text">Phone +1</span>
        <input type="text" class="form-control" name="number" autocomplete="new-password" required placeholder="Phone Number (only U.S. numbers)" pattern="\d{10}" title="Please enter a valid 10-digit phone number">
    </div>
</div>

                        <div class="col-lg-6">
                          <div class="input-group">
                            <label class="input-group-text" for="inputGroupSelect01">Perm</label>
                            <select class="form-select" required id="inputGroupSelect01" name="perm">
                              <option value="driver" selected>Driver </option>
                              <option value="admin">Admin </option>
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
include('inc/scripts.php');?> 
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.querySelector('input[name="number"]');

    phoneInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // Sadece rakamları kabul et
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10); // Maksimum 10 karakter
        }
    });
});
</script>
</body>
</html>