<?php ob_start(); error_reporting(E_ALL);
ini_set("display_errors", 1);?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

if (!isset($_GET['id'])) {
    header('location: admin_rate_management.php');
    exit;
}

$id = intval($_GET['id']);
$sorgu = $baglanti->prepare("SELECT * FROM rates WHERE id = :id");
$sorgu->execute(['id' => $id]);
$rate = $sorgu->fetch(PDO::FETCH_ASSOC);

if (!$rate) {
    header('location: admin_rate_management.php');
    exit;
}
$title = "Rates Management";
$description = $sonucayar['siteaciklamasi'];
?>
<meta content="<?=$description?>" name="description" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        max-width: 800px;
        margin: auto;
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
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .form-control {
        border-radius: 0.25rem;
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
    .form-group {
        margin-bottom: 0.75rem;
    }
    input[type="number"] {
        -moz-appearance: textfield; /* Firefox */
        appearance: auto; /* Diğer tarayıcılar */
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: auto;
        margin: 0;
    }
    .fee-calculation {
        font-size: 0.85rem;
        color: #555;
        margin-top: 5px;
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
                <div style="margin: auto;" class="col-lg-8">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
						    <a href="admin_rate_management.php" class="btn btn-danger btn-sm" style="float: right;"><-</a>
                            <h4 class="card-title mb-0 flex-grow-1" style="text-align: center;">Edit Rate</h4>
                        </div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group">
                                    <label for="name">Rate Name</label>
                                    <input disabled type="text" class="form-control" id="ratename" name="ratename" value="<?= htmlspecialchars($rate['ratename']) ?>" required>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($rate['hourlyOperationFare'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="hourlyOperationFare">Week Rate</label>
                                            <input type="number" step="0.05" class="form-control" id="hourlyOperationFare" name="hourlyOperationFare" value="<?= htmlspecialchars($rate['hourlyOperationFare']) ?>">
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($rate['hourlyOperationFareWeekends'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="hourlyOperationFareWeekends">Weekends Rate</label>
                                            <input type="number" step="0.05" class="form-control" id="hourlyOperationFareWeekends" name="hourlyOperationFareWeekends" value="<?= htmlspecialchars($rate['hourlyOperationFareWeekends']) ?>">
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($rate['hourlyOperationFareDecember'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="hourlyOperationFareDecember">Week Rate December</label>
                                            <input type="number" step="0.05" class="form-control" id="hourlyOperationFareDecember" name="hourlyOperationFareDecember" value="<?= htmlspecialchars($rate['hourlyOperationFareDecember']) ?>">
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($rate['hourlyOperationFareWeekendsDecember'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="hourlyOperationFareWeekendsDecember">Weekends Rate December</label>
                                            <input type="number" step="0.05" class="form-control" id="hourlyOperationFareWeekendsDecember" name="hourlyOperationFareWeekendsDecember" value="<?= htmlspecialchars($rate['hourlyOperationFareWeekendsDecember']) ?>">
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCashWeek'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCashWeek">Min Fare Cash Week</label>
                                            <input type="number" step="0.05" class="form-control min-fare-cash" id="minFareCashWeek" name="minFareCashWeek" value="<?= htmlspecialchars($rate['minFareCashWeek']) ?>">
                                            <div id="minFareCashWeekCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCashWeekend'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCashWeekend">Min Fare Cash Weekend</label>
                                            <input type="number" step="0.05" class="form-control min-fare-cash" id="minFareCashWeekend" name="minFareCashWeekend" value="<?= htmlspecialchars($rate['minFareCashWeekend']) ?>">
                                            <div id="minFareCashWeekendCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCashWeekDecember'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCashWeekDecember">Min Fare Cash Week December</label>
                                            <input type="number" step="0.05" class="form-control min-fare-cash" id="minFareCashWeekDecember" name="minFareCashWeekDecember" value="<?= htmlspecialchars($rate['minFareCashWeekDecember']) ?>">
                                            <div id="minFareCashWeekDecemberCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCashWeekendDecember'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCashWeekendDecember">Min Fare Cash Weekend December</label>
                                            <input type="number" step="0.05" class="form-control min-fare-cash" id="minFareCashWeekendDecember" name="minFareCashWeekendDecember" value="<?= htmlspecialchars($rate['minFareCashWeekendDecember']) ?>">
                                            <div id="minFareCashWeekendDecemberCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCardWeek'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCardWeek">Min Fare Card Week</label>
                                            <input type="number" step="0.05" class="form-control min-fare-card" id="minFareCardWeek" name="minFareCardWeek" value="<?= htmlspecialchars($rate['minFareCardWeek']) ?>">
                                            <div id="minFareCardWeekCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCardWeekend'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCardWeekend">Min Fare Card Weekend</label>
                                            <input type="number" step="0.05" class="form-control min-fare-card" id="minFareCardWeekend" name="minFareCardWeekend" value="<?= htmlspecialchars($rate['minFareCardWeekend']) ?>">
                                            <div id="minFareCardWeekendCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCardWeekDecember'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCardWeekDecember">Min Fare Card Week December</label>
                                            <input type="number" step="0.05" class="form-control min-fare-card" id="minFareCardWeekDecember" name="minFareCardWeekDecember" value="<?= htmlspecialchars($rate['minFareCardWeekDecember']) ?>">
                                            <div id="minFareCardWeekDecemberCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($rate['minFareCardWeekendDecember'] !== null) { ?>
                                        <div class="form-group">
                                            <label for="minFareCardWeekendDecember">Min Fare Card Weekend December</label>
                                            <input type="number" step="0.05" class="form-control min-fare-card" id="minFareCardWeekendDecember" name="minFareCardWeekendDecember" value="<?= htmlspecialchars($rate['minFareCardWeekendDecember']) ?>">
                                            <div id="minFareCardWeekendDecemberCalculation" class="fee-calculation"></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>     
            </div>     
        </div>     
    </div>
</div>

<script>
document.querySelectorAll('.min-fare-cash').forEach(function(input) {
    input.addEventListener('input', function() {
        let value = parseFloat(this.value);
        if (!isNaN(value)) {
            let bookingFee = (value * 0.20).toFixed(2);
            let driverFare = (value * 0.80).toFixed(2);
            document.getElementById(this.id + 'Calculation').innerHTML = 
                `Booking Fee: $${bookingFee} <br> Driver Fare: $${driverFare}`;
        } else {
            document.getElementById(this.id + 'Calculation').innerHTML = '';
        }
    });
    input.addEventListener('blur', function() {
        document.getElementById(this.id + 'Calculation').innerHTML = '';
    });
});

document.querySelectorAll('.min-fare-card').forEach(function(input) {
    input.addEventListener('input', function() {
        let value = parseFloat(this.value);
        if (!isNaN(value)) {
            let bookingFee = (value * 0.1852).toFixed(2);
            let driverFare = (value * 0.8148).toFixed(2);
            document.getElementById(this.id + 'Calculation').innerHTML = 
                `Booking Fee: $${bookingFee} <br> Driver Fare: $${driverFare}`;
        } else {
            document.getElementById(this.id + 'Calculation').innerHTML = '';
        }
    });
    input.addEventListener('blur', function() {
        document.getElementById(this.id + 'Calculation').innerHTML = '';
    });
});
</script>

<?php 
include('inc/footer.php');
include('inc/scripts.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ratename = $_POST['name'];
    $hourlyOperationFare = $_POST['hourlyOperationFare'];
    $hourlyOperationFareWeekends = $_POST['hourlyOperationFareWeekends'];
    $hourlyOperationFareDecember = $_POST['hourlyOperationFareDecember'];
    $hourlyOperationFareWeekendsDecember = $_POST['hourlyOperationFareWeekendsDecember'];
    $minFareCashWeek = $_POST['minFareCashWeek'];
    $minFareCashWeekend = $_POST['minFareCashWeekend'];
    $minFareCashWeekDecember = $_POST['minFareCashWeekDecember'];
    $minFareCashWeekendDecember = $_POST['minFareCashWeekendDecember'];
    $minFareCardWeek = $_POST['minFareCardWeek'];
    $minFareCardWeekend = $_POST['minFareCardWeekend'];
    $minFareCardWeekDecember = $_POST['minFareCardWeekDecember'];
    $minFareCardWeekendDecember = $_POST['minFareCardWeekendDecember'];

    $update = $baglanti->prepare("
        UPDATE rates SET 
            hourlyOperationFare = :hourlyOperationFare,
            hourlyOperationFareWeekends = :hourlyOperationFareWeekends,
            hourlyOperationFareDecember = :hourlyOperationFareDecember,
            hourlyOperationFareWeekendsDecember = :hourlyOperationFareWeekendsDecember,
            minFareCashWeek = :minFareCashWeek,
            minFareCashWeekend = :minFareCashWeekend,
            minFareCashWeekDecember = :minFareCashWeekDecember,
            minFareCashWeekendDecember = :minFareCashWeekendDecember,
            minFareCardWeek = :minFareCardWeek,
            minFareCardWeekend = :minFareCardWeekend,
            minFareCardWeekDecember = :minFareCardWeekDecember,
            minFareCardWeekendDecember = :minFareCardWeekendDecember
        WHERE id = :id
    ");

    $update->execute([
        'hourlyOperationFare' => $hourlyOperationFare,
        'hourlyOperationFareWeekends' => $hourlyOperationFareWeekends,
        'hourlyOperationFareDecember' => $hourlyOperationFareDecember,
        'hourlyOperationFareWeekendsDecember' => $hourlyOperationFareWeekendsDecember,
        'minFareCashWeek' => $minFareCashWeek,
        'minFareCashWeekend' => $minFareCashWeekend,
        'minFareCashWeekDecember' => $minFareCashWeekDecember,
        'minFareCashWeekendDecember' => $minFareCashWeekendDecember,
        'minFareCardWeek' => $minFareCardWeek,
        'minFareCardWeekend' => $minFareCardWeekend,
        'minFareCardWeekDecember' => $minFareCardWeekDecember,
        'minFareCardWeekendDecember' => $minFareCardWeekendDecember,
        'id' => $id
    ]);
	
		$action = "Changed " . $rate['ratename'] . " Rate!";

    // Logs tablosuna ekleme
    $log_satir = [
        'driverUsername' => $user,
        'driverName' => $name,
        'driverLastName' => $surname,
        'action' => $action,
		'perm' => $perm,
        'timestamp' => $updated_at,
    ];
    
    $sql = "INSERT INTO logs (driverUsername, driverName, driverLastName, action, perm, timestamp) VALUES (:driverUsername, :driverName, :driverLastName, :action, :perm, :timestamp)";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute($log_satir);

    header('location: admin_rate_management.php');
    exit;
}

?>
</body>
</html>
