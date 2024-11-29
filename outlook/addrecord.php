<?php
session_start();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('inc/init.php');
include('inc/db.php');
include('inc/countryselect.php');
include('vendor/autoload.php'); // SendGrid için gerekli
include('inc/text.php');
include('inc/whatsapp.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Formdan gelen verileri al
    $source = $_POST['source'] ?? null;
    $date = $_POST['date'] ?? null;
    $hours = $_POST['hours'] ?? null;
    $minutes = $_POST['minutes'] ?? null;
    $ampm = $_POST['ampm'] ?? null;
    $duration = $_POST['duration'] ?? null;
    $num_passengers = $_POST['num_passengers'] ?? null;
    $name = $_POST['name'] ?? null;
	$countryName = $_POST['countryName'];
	$countryCode = $_POST['countryCode'];
    $phone_number = $_POST['phoneNumber'] ?? null;
	
	if ($duration == '60'){
		$pay = '40';
	}
	else if ($duration == '90'){
		$pay = '60';
	}
    

    $timezone = new DateTimeZone('America/New_York');
    $nyDateTime = new DateTime('now', $timezone);
    $nyDateTimeFormatted = $nyDateTime->format('Y-m-d H:i:s');
	
	function generateUUID() {
    return bin2hex(random_bytes(16));
	}
	
	$uuid = generateUUID();
	$uuid = substr($uuid, 0, 16);
	
	    // Aynı verilerle başka bir kayıt olup olmadığını kontrol et
    $sqlSameRecord = "
        SELECT * FROM schedule_requests 
        WHERE date = ? AND hours = ? AND minutes = ? AND ampm = ? AND duration = ? AND num_passengers = ? AND name = ? AND countryName = ? AND countryCode = ? AND phone_number = ?
    ";
    $stmtSameRecord = $baglanti->prepare($sqlSameRecord);
    $stmtSameRecord->execute([$date, $hours, $minutes, $ampm, $duration, $num_passengers, $name, $countryName, $countryCode, $phone_number]);
    $sameRecordExists = $stmtSameRecord->fetch();

    if ($sameRecordExists) {
        header("Location: index.php?status=samerecorderror");
        exit();
    }
	
    // Aynı tarih, saat ve dakika ile en az iki kayıt olup olmadığını kontrol et
    $sqlSameTime = "
        SELECT date, hours, minutes, ampm
        FROM schedule_requests
        WHERE date = ? AND hours = ? AND minutes = ? AND ampm = ?
        GROUP BY date, hours, minutes, ampm
        HAVING COUNT(*) >= 2
    ";
    $stmtSameTime = $baglanti->prepare($sqlSameTime);
    $stmtSameTime->execute([$date, $hours, $minutes, $ampm]);
    $sameTimeExists = $stmtSameTime->fetch();

    // Aynı tarih, saat, dakika ve ampm ile yolcu sayısı 4 veya daha fazla olan kayıtları kontrol et
    $sqlHighPassenger = "
        SELECT date, hours, minutes, ampm
        FROM schedule_requests
        WHERE date = ? AND hours = ? AND minutes = ? AND ampm = ? AND num_passengers >= 4
    ";
    $stmtHighPassenger = $baglanti->prepare($sqlHighPassenger);
    $stmtHighPassenger->execute([$date, $hours, $minutes, $ampm]);
    $highPassengerExists = $stmtHighPassenger->fetch();

    // Uyarı durumu
    if ($sameTimeExists || $highPassengerExists) {
           header("Location: index.php?status=sametimeerror");
    exit();
    } else {

    // Veritabanına ekleme işlemi
    try {
        $sql = "INSERT INTO schedule_requests (uuid, source, date, hours, minutes, ampm, duration, num_passengers, name, countryName, countryCode, phone_number, pay, created_at, status)
                VALUES (:uuid, :source, :date, :hours, :minutes, :ampm, :duration, :num_passengers, :name, :countryName, :countryCode, :phone_number, :pay, :nyDateTime, 'pending')";
        $stmt = $baglanti->prepare($sql);
		$stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':source', $source);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':hours', $hours);
		$stmt->bindParam(':minutes', $minutes);
		$stmt->bindParam(':ampm', $ampm);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':num_passengers', $num_passengers);
        $stmt->bindParam(':name', $name);
		$stmt->bindParam(':countryName', $countryName);
		$stmt->bindParam(':countryCode', $countryCode);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':pay', $pay);
        $stmt->bindParam(':nyDateTime', $nyDateTimeFormatted);
		
        // Veritabanına kaydet
        $stmt->execute();
		
		
date_default_timezone_set('America/New_York');

// $date değişkeninin formatı 'Y-m-d' ise bugünkü tarihi kontrol ediyoruz
$today = (new DateTime('today'))->format('Y-m-d');

if ($date === $today) {
    // Mesaj göndermek için sürücü bilgilerini alalım
    $driverSQL = "SELECT number, username FROM users WHERE perm = 'driver'";
    $driverStmt = $baglanti->prepare($driverSQL);
    $driverStmt->execute();
    $drivers = $driverStmt->fetchAll();

    foreach ($drivers as $driver) {
        $phone_number = "+1" . $driver['number'];
        $name = $driver['username'];

        try {
            // Message content
            $message = "Reminder: Hi " . $name . ". There is a scheduled tour for today. Please check the system for details.";

            // Send SMS
           //  sendTextMessage($twilio, $phone_number, "+16468527935", $message);
			
			// sendWhatsAppMessage($twilio, "whatsapp:" . $phone_number, $message);

            echo "SMS and WhatsApp message sent to driver: $phone_number\n";
        } catch (Exception $e) {
            echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
        }
    }
}
			
			
        // Başarıyla eklendikten sonra index.php'ye yönlendir
        header("Location: index.php?status=added");
        exit();

    } catch (PDOException $e) {
        echo "Kayıt eklenirken bir hata oluştu: " . $e->getMessage();
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <title>SMS Schedule System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Preload CSS files -->
    <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>
    <link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>
	    <script src="https://www.google.com/recaptcha/api.js?render=6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP"></script>
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
<form method="post" id="myForm" action="">
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
			<a href="index.php" class="btn info-btn btn-sm">
                <i class="fas fa-plus"></i> Current
            </a>
		    <a href="index.php?status=past" class="btn info-btn btn-sm">
                <i class="fas fa-plus"></i> Past
            </a>
            <a href="addrecord.php" class="btn add-btn btn-sm active">
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
                     <select title="" class="form-control" required id="source" name="source" oninvalid="this.setCustomValidity('Please, select source.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="">Select the source</option>
                        <option value="Viator">Viator</option>
                        <option value="GetYourGuide">GetYourGuide</option>
                        <option value="AirBnb">AirBnb</option>
                        <option value="ClassPass">ClassPass</option>
						<option value="Klook">Klook</option>
						<option value="Groupon">Groupon</option>
						<option value="Calendly">Calendly</option>
                     </select>
                </div>
				                <div class="form-group">
                    <label for="pickUpDate">Date</label>
                    <input title="" autocomplete="off" type="date" required max="2025-12-31" oninvalid="this.setCustomValidity('Please, select the date.'); this.classList.add('invalid');"
               oninput="this.setCustomValidity(''); this.classList.remove('invalid');"
               class="form-control" id="pickUpDate" name="date">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hours">Hour</label>
                            <select title="" class="form-control" id="hours" name="hours" oninvalid="this.setCustomValidity('Please, enter hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" required>
                                <option value="">Select the hour</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minutes">Minute</label>
                            <select title="" class="form-control" id="minutes" name="minutes" oninvalid="this.setCustomValidity('Please, select the hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" required>
                                <option value="">Select the minute</option>
                                <?php
                                $minutes = ["00", "15", "30", "45"];
                                foreach ($minutes as $minute) {
                                    echo '<option value="' . $minute . '">' . $minute . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ampm">AM/PM</label>
                            <select title="" class="form-control" id="ampm" name="ampm" oninvalid="this.setCustomValidity('Please, select AM or PM.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" required>
                                <option value="">AM/PM</option>
                                <?php
                                $am_pm_options = ["AM", "PM"];
                                foreach ($am_pm_options as $option) {
                                    echo '<option value="' . $option . '">' . $option . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
				<div class="form-group">
                     <label for="serviceDuration">Duration</label>
                     <select title="" class="form-control" required id="serviceDuration" name="duration" oninvalid="this.setCustomValidity('Please, select duration.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="">Select the duration</option>
                        <option value="60">1 Hour</option>
                        <option value="90">90 Minutes</option>
                     </select>
                </div>
				
<div class="form-group">
    <label for="num_passengers">Number of Passengers</label>
    <select title="" class="form-control" id="numPassengers" name="num_passengers" oninvalid="this.setCustomValidity('Please, select the number of passengers.'); this.classList.add('invalid');" 
            oninput="this.setCustomValidity(''); this.classList.remove('invalid');" required>
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
            echo ">" . $count . ' (' . $pedicabCount . ' ' . $pedicabLabel . ')' . "</option>";
        }
        ?>
    </select>
</div>
                <div class="form-group">
                    <label for="firstName">Name</label>
                    <input maxlength="50" title="" type="text" class="form-control" id="firstName" name="name" required placeholder="Enter name" oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                </div>
<label for="countrySelect">Phone</label>
<div style="display: flex;" class="form-group">
    <?= countrySelector() ?>
    <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
           oninvalid="this.setCustomValidity('Please, enter phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" placeholder="Enter phone number" required >
</div>


				
                <div class="text-center">
                    <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Create">
                </div>
            </div>
</div>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var inputs = document.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            this.setAttribute('autocomplete', 'new-password');
        });
    });
});

</script>
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

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&libraries=places&callback=initAutocomplete" async defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
