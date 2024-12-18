<?php
ob_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "vendor/autoload.php";
include('whatsapp.php');
?>
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

if ($_POST) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $perm = $_POST['perm'];
    $pdf_id = $_POST['pdf_id']; 

    $is_valid = true;

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
            'pdf_id' => $pdf_id,
        ];
        $sql = "INSERT INTO users (user, pass, name, surname, email, number, perm, pdf_id) VALUES (:user, :pass, :name, :surname, :email, :number, :perm, :pdf_id)";
        $stmt = $baglanti->prepare($sql);
        try {
            $durum = $stmt->execute($satir);
            if ($durum) {
                echo '<script>swal("Successful","Driver add successful. Please go the verify menu to activate this driver account.","success").then((value)=>{ window.location.href = "admin_verify_drivers.php"});</script>';
            
			 $formattedPhone = "whatsapp:+1" . $number;

    $message = "Your driver account registration is successful! -New York Pedicab Services";

    $messageSid = sendWhatsAppMessage($twilio, $formattedPhone, $message);



    $email1 = new \SendGrid\Mail\Mail(); 
    $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
    $email1->setSubject("Your registration is successful! - NYPS");
    $email1->addTo($email, $name);
    $htmlContent1 = <<<EOD
<html>
<body>
    <p><strong>Hello $name.</strong></p>
    <p>Your driver account registration is successful!</p>
    <p>Thank you,</p>    
    <p>New York Pedicab Services</p>   
    <p>(212) 961-7435</p>   
    <p>info@newyorkpedicabservices.com</p>       
</body>
</html>
EOD;
    $email1->addContent("text/html", $htmlContent1);
    $sendgrid = new \SendGrid('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');
    try {
        $response1 = $sendgrid->send($email1);
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() . "\n";
    }
			
			
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
                                                    <span class="input-group-text">First Name</span>
                                                    <input type="text" class="form-control" name="name" autocomplete="new-password" required placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group">
                                                    <span class="input-group-text">Last Name</span>
                                                    <input type="text" class="form-control" name="surname" autocomplete="new-password" required placeholder="Last Name">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Email</span>
                                                    <input type="email" class="form-control" name="email" autocomplete="new-password" required placeholder="E-Mail" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">Pedicab Driver Registration ID</span>
                                                    <input type="text" class="form-control" name="pdf_id" required placeholder="Pedicab Driver Registration ID" aria-describedby="basic-addon1">
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
                                                        <option value="driver" selected>Driver</option>
                                                        <option value="admin">Admin</option>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.querySelector('input[name="number"]');

    phoneInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
});
</script>
</body>
</html>
