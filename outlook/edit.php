<?php
session_start();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('inc/init.php'); // Veritabanı bağlantısı
include('inc/db.php'); // Veritabanı bağlantısı
require "inc/countryselect.php"; // Ülke seçici

// ID GET parametresiyle çekiliyor
$id = $_GET['id'] ?? null;

if ($id) {
    // Veritabanından id'ye göre bilgileri çek
    $sql = "SELECT * FROM schedule_requests WHERE id = :id";
    $stmt = $baglanti->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $row = $stmt->fetch();
	
	$countryCode = $row['countryCode'];
	$countryName = $row['countryName'];

    if (!$row) {
        echo "Kayıt bulunamadı!";
        exit;
    }
} else {
    echo "ID değeri eksik!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $source = $_POST['source'];
    $date = $_POST['date'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $ampm = $_POST['ampm'];
    $duration = $_POST['duration'];
    $num_passengers = $_POST['num_passengers'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
	if ($duration == '60'){
		$pay = '40';
	}
	else if ($duration == '90'){
		$pay = '60';
	}
    
    $countryCode = $_POST['countryCode']; // Ülke kodu da burada alınıyor
	if ($_POST['countryName'] != ""){
    $countryName = $_POST['countryName']; // Ülke adı da burada alınıyor
	}
	    $timezone = new DateTimeZone('America/New_York');
    $nyDateTime = new DateTime('now', $timezone);
    $updated_at = $nyDateTime->format('Y-m-d H:i:s');
	
	    // Aynı tarih, saat ve dakika ile en az iki kayıt olup olmadığını kontrol et (güncellenen kayıt hariç)
    $sqlSameTime = "
        SELECT COUNT(*) AS record_count 
        FROM schedule_requests 
        WHERE date = ? AND hours = ? AND minutes = ? AND ampm = ? AND id != ?
        GROUP BY date, hours, minutes, ampm
        HAVING COUNT(*) >= 2
    ";
    $stmtSameTime = $baglanti->prepare($sqlSameTime);
    $stmtSameTime->execute([$date, $hours, $minutes, $ampm, $id]);
    $sameTimeExists = $stmtSameTime->fetch();

    // Aynı tarih, saat, dakika ve ampm ile yolcu sayısı 4 veya daha fazla olan kayıtları kontrol et (güncellenen kayıt hariç)
    $sqlHighPassenger = "
        SELECT COUNT(*) 
        FROM schedule_requests 
        WHERE date = ? AND hours = ? AND minutes = ? AND ampm = ? AND num_passengers >= 4 AND id != ?
    ";
    $stmtHighPassenger = $baglanti->prepare($sqlHighPassenger);
    $stmtHighPassenger->execute([$date, $hours, $minutes, $ampm, $id]);
    $highPassengerExists = $stmtHighPassenger->fetchColumn();

    // Uyarı durumu
    if ($sameTimeExists || $highPassengerExists) {
           header("Location: index.php?status=sametimeerror");
    } else {
    // Veritabanında kaydı güncelleme
$sql = "UPDATE schedule_requests SET 
            source = :source,
            date = :date,
            hours = :hours,
            minutes = :minutes,
            ampm = :ampm,
            duration = :duration,
            num_passengers = :num_passengers,
            name = :name,
            phone_number = :phone_number,
            pay = :pay,
            countryCode = :countryCode,
            countryName = :countryName,
            email_sent = 0, 
            updated_at = :updated_at
            WHERE id = :id";

$stmt = $baglanti->prepare($sql);

$stmt->bindParam(':source', $source);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':hours', $hours);
$stmt->bindParam(':minutes', $minutes);
$stmt->bindParam(':ampm', $ampm);
$stmt->bindParam(':duration', $duration);
$stmt->bindParam(':num_passengers', $num_passengers);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':phone_number', $phone_number);
$stmt->bindParam(':pay', $pay);
$stmt->bindParam(':countryCode', $countryCode);
$stmt->bindParam(':countryName', $countryName);
$stmt->bindParam(':updated_at', $updated_at);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);


    if ($stmt->execute()) {
        // Başarıyla güncellendi, index.php sayfasına yönlendir
        header("Location: index.php?status=updated");
        exit();
    } else {
        echo "Güncelleme sırasında bir hata oluştu.";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <title>SMS Schedule System - Edit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Edit Scheduled Central Park Pedicab Tour Form">
    <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>
    <link type="text/css" href="css/style.css" rel="stylesheet">
		    <style>
body {
    background-color: #f0f0f0;
    color: #333;
    font-family: 'Poppins', sans-serif;
	    animation: fadeIn 0.5s ease-in;
}

/* Fade-in animasyon tanımı */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Modal arka planı için animasyon */
.modal-backdrop {
    animation: fadeIn 0.3s ease-in-out;
}

/* Modal içeriği için büyüme efekti */
.modal-content {
    animation: scaleIn 0.3s ease-in-out;
}

/* Fade-in ve scale-in animasyon tanımları */
@keyframes scaleIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Başarılı mesaj animasyonu */
.alert-status {
    animation: slideDownFadeIn 0.5s ease-out;
}

/* Slide down ve fade-in animasyon tanımı */
@keyframes slideDownFadeIn {
    from {
        transform: translateY(-20px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Genel geçiş efektleri */
* {
    transition: all 0.3s ease;
}


/* Butonlar için animasyon */
.btn {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* Tıklama efekti */
.btn:active {
    transform: scale(0.95);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Hover efekti */
.btn:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}


.container {
    max-width: 100%; /* Konteynerin genişliğini %100 yap */
    margin: 0 auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Yatay taşmayı önlemek için */
}

.table {
    width: 100%;
    max-width: 100%; /* Tablonun genişliğini ekranın genişliğine sığdır */
    border-collapse: collapse;
    margin: 20px 0;
    overflow-x: auto; /* Tablonun taşmasını engelle */
}

.table thead th {
    background-color: #0044cc;
    color: #fff;
    padding: 12px 15px;
    text-align: left;
}

.table tbody tr {
    background-color: #fafafa;
    transition: background-color 0.3s;
}

.table tbody tr:hover {
    background-color: #eaeaea;
}

.btn {
    border-radius: 30px;
    padding: 8px 20px;
    font-size: 14px;
    text-transform: uppercase;
    transition: all 0.3s;
}

.btn-edit {
    background-color: #4caf50;
    color: #fff;
}

.btn-delete {
    background-color: #f44336;
    color: #fff;
}

.alert-status {
    background-color: #4caf50;
    color: #fff;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    margin-bottom: 20px;
}

/* Mobil cihazlarda tabloyu kart stiline dönüştür */
@media (max-width: 768px) {
    .table,
    .table thead,
    .table tbody,
    .table th,
    .table td,
    .table tr {
        display: block;
        width: 100%;
    }

    .table thead tr {
        display: none;
    }

    .table tbody tr {
        margin-bottom: 15px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .table td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table td:last-child {
        border-bottom: 0;
    }

    .table td:before {
        content: attr(data-label);
        font-weight: bold;
        flex-basis: 50%;
        text-align: left;
    }
}
.flame-text {
    font-size: 1em;
    color: #ff4500; /* Turuncu alev rengi */
    text-shadow: 0 0 5px #ff4500, 0 0 10px #ff8c00, 0 0 15px #ffa500, 0 0 20px #ff4500;
    animation: flame-flicker 1.5s infinite alternate;
    font-weight: bold;
}

@keyframes flame-flicker {
    0% {
        text-shadow: 0 0 10px #ff4500, 0 0 20px #ff8c00, 0 0 30px #ffa500, 0 0 40px #ff4500;
        transform: translateY(0px) scale(1);
    }
    50% {
        text-shadow: 0 0 20px #ff4500, 0 0 30px #ff8c00, 0 0 40px #ffa500, 0 0 50px #ff4500;
        transform: translateY(-2px) scale(1.1);
    }
    100% {
        text-shadow: 0 0 15px #ff4500, 0 0 25px #ff8c00, 0 0 35px #ffa500, 0 0 45px #ff4500;
        transform: translateY(1px) scale(1);
    }
}

.btn.active {
    background-color: #0066cc; /* Active button color */
    color: #fff; /* Active text color */
    box-shadow: 0 0 10px rgba(0, 102, 204, 0.5); /* Optional glow effect */
    font-weight: bold; /* Bold text for active */
}

    </style>
</head>
<body>

<form method="post" id="editForm" action="">
    <div class="container">

        <h1 class="text-center mb-4"><a href="index.php">Dashboard - Scheduled SMS</a></h1>


        <!-- Logout butonu -->
        <div class="text-right mb-4">
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
		

        <!-- Kayıt eklemek için artı butonu -->
        <div class="text-right">
			<a href="index.php?status=sametime" class="btn info-btn btn-sm">
                <i class="fas fa-plus"></i> SameTime Records
            </a>
			<a href="index.php?status=issue" class="btn info-btn btn-sm">
                <i class="fas fa-plus"></i> SMS Issue
            </a>
			<a href="index.php" class="btn info-btn btn-sm active">
                <i class="fas fa-plus"></i> Current
            </a>
		    <a href="index.php?status=past" class="btn info-btn btn-sm">
                <i class="fas fa-plus"></i> Past
            </a>
            <a href="addrecord.php" class="btn add-btn btn-sm">
                <i class="fas fa-plus"></i> Add New Record
            </a>
			<a href="available_times.php" class="btn info-btn btn-sm">
                <i class="fas fa-timer"></i> Available Times
            </a>
			<a href="closed_times.php" class="btn info-btn btn-sm">
                <i class="fas fa-timer"></i> Closed Times
            </a>
        </div>
		<div class="text-right mb-4" style='margin-top:3%;'>
    <input type="text" id="search" class="form-control" placeholder="Search a name..." style="display: inline-block; width: auto;"/>
    <button id="searchBtn" class="btn btn-primary btn-sm">Search</button>
</div>
<hr>
			        <div class="row justify-content-center">
            <div class="col-md-6">


                <div class="form-group">
                    <label for="serviceDuration">Source</label>
                    <select title="" class="form-control" required id="source" name="source">
                        <option value="">Select the source</option>
                        <option value="Viator" <?= $row['source'] == 'Viator' ? 'selected' : ''; ?>>Viator</option>
                        <option value="GetYourGuide" <?= $row['source'] == 'GetYourGuide' ? 'selected' : ''; ?>>GetYourGuide</option>
                        <option value="AirBnb" <?= $row['source'] == 'AirBnb' ? 'selected' : ''; ?>>AirBnb</option>
                        <option value="ClassPass" <?= $row['source'] == 'ClassPass' ? 'selected' : ''; ?>>ClassPass</option>
                        <option value="Klook" <?= $row['source'] == 'Klook' ? 'selected' : ''; ?>>Klook</option>
						<option value="Groupon" <?= $row['source'] == 'Groupon' ? 'selected' : ''; ?>>Groupon</option>
						<option value="Calendly" <?= $row['source'] == 'Calendly' ? 'selected' : ''; ?>>Calendly</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickUpDate">Date</label>
                    <input title="" autocomplete="off" type="date" required max="2025-12-31" class="form-control" id="pickUpDate" name="date" value="<?= $row['date']; ?>">
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hours">Hour</label>
                            <select title="" class="form-control" id="hours" name="hours" required>
                                <option value="">Select the hour</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo '<option value="' . $i . '" ' . ($row['hours'] == $i ? 'selected' : '') . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minutes">Minute</label>
                            <select title="" class="form-control" id="minutes" name="minutes" required>
                                <option value="">Select the minute</option>
                                <?php
                                $minutes = ["00", "15", "30", "45"];
                                foreach ($minutes as $minute) {
                                    echo '<option value="' . $minute . '" ' . ($row['minutes'] == $minute ? 'selected' : '') . '>' . $minute . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ampm">AM/PM</label>
                            <select title="" class="form-control" id="ampm" name="ampm" required>
                                <option value="">AM/PM</option>
                                <option value="AM" <?= $row['ampm'] == 'AM' ? 'selected' : ''; ?>>AM</option>
                                <option value="PM" <?= $row['ampm'] == 'PM' ? 'selected' : ''; ?>>PM</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="serviceDuration">Duration</label>
                    <select title="" class="form-control" required id="serviceDuration" name="duration">
                        <option value="">Select the duration</option>
                        <option value="60" <?= $row['duration'] == '60' ? 'selected' : ''; ?>>1 Hour</option>
                        <option value="90" <?= $row['duration'] == '90' ? 'selected' : ''; ?>>90 Minutes</option>
                    </select>
                </div>

<div class="form-group">
    <label for="num_passengers">Number of Passengers</label>
    <select title="" class="form-control" id="numPassengers" name="num_passengers" required>
        <option value="" selected>Select the number of passengers</option>
        <?php
        $passengerCounts = [1, 2, 3, 4, 5, 6];
        $pedicabCount = 1;

        foreach ($passengerCounts as $index => $count) {
            if ($index % 3 == 0 && $index != 0) {
                $pedicabCount++;
            }
            $pedicabLabel = $pedicabCount == 1 ? 'Pedicab' : 'Pedicabs';
            echo '<option value="' . $count . '"';
            if (
                isset($row["num_passengers"]) &&
                $row["num_passengers"] == $count
            ) {
                echo " selected";
            }
            echo ">" . $count . ' (' . $pedicabCount . ' ' . $pedicabLabel . ')' . "</option>";
        }
        ?>
    </select>
</div>


                <div class="form-group">
                    <label for="firstName">Name</label>
                    <input maxlength="50" title="" type="text" class="form-control" id="firstName" name="name" required value="<?= $row['name']; ?>">
                </div>

                <label for="countrySelect">Phone</label>
                <div style="display: flex;" class="form-group">
                    <?= countrySelector() ?>
                    <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phone_number" value="<?= $row['phone_number']; ?>" required>
                </div>

                <div class="text-center">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Update">
                </div>

            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('pickUpDate').setAttribute('min', today);
    });

    document.getElementById('pickUpDate').addEventListener('click', function() {
        this.showPicker();
    });

    $(document).ready(function() {
        $('#hours, #minutes, #ampm').change(function() {
            var hours = $('#hours').val();
            var minutes = $('#minutes').val();
            var ampm = $('#ampm').val();
            var time = hours + ':' + minutes + ' ' + ampm;
            $('#pickUpTime').val(time);
        });
    });;

</script>
<script>
document.getElementById('prevButton').addEventListener('click', function() {
    window.location.href = 'index.php';
});
</script>

</body>
</html>