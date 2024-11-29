<?php
session_start();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('inc/db.php'); // Veritabanı bağlantısını dahil ediyoruz
include('inc/db2.php'); // Veritabanı bağlantısını dahil ediyoruz

try {
    $baglanti = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Bağlantı hatası: ' . $e->getMessage();
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Scheduled SMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

.btn.active {
    background-color: #0066cc; /* Active button color */
    color: #fff; /* Active text color */
    box-shadow: 0 0 10px rgba(0, 102, 204, 0.5); /* Optional glow effect */
    font-weight: bold; /* Bold text for active */
}
	
    </style>
</head>
<body>

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
            <a href="addrecord.php" class="btn add-btn btn-sm">
                <i class="fas fa-plus"></i> Add New Record
            </a>
			<a href="available_times.php" class="btn info-btn btn-sm">
                <i class="fas fa-timer"></i> Available Times
            </a>
			<a href="closed_times.php" class="btn info-btn btn-sm active">
                <i class="fas fa-timer"></i> Closed Times
            </a>
        </div>
<div class="text-right mb-4" style='margin-top:3%;'>
    <input type="text" id="search" class="form-control" placeholder="Search a name..." style="display: inline-block; width: auto;"/>
    <button id="searchBtn" class="btn btn-primary btn-sm">Search</button>
</div>
<hr>
<?php
try {
    // New York saat dilimine göre geçerli tarihi alın
    $ny_timezone = new DateTimeZone('America/New_York');
    $current_date = new DateTime('now', $ny_timezone);
    $current_date_str = $current_date->format('Y-m-d');

    $query = "SELECT * FROM unavailable_times WHERE status = 'unavailable' AND date >= :current_date ORDER BY date";
    $stmt = $baglanti->prepare($query);
    
    // Geçerli tarihi parametre olarak bağla
    $stmt->bindParam(':current_date', $current_date_str);
    
    $stmt->execute();
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}

?>
   
           <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Tour</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row) { ?>
<tr>
    <td data-label="Date"><?= $row['date'] ?></td>
    <td data-label="Time Slot"><?= $row['time_slot'] ?></td>
    <td data-label="Tour"><?= $row['tour'] ?></td>
    <td data-label="Status"><b style="color:red;"><img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'></b></td>
</tr>

                <?php } ?>
            </tbody>
        </table>
   
    </div>
	
	
<script>
    document.getElementById("searchBtn").addEventListener("click", function () {
        var searchValue = document.getElementById("search").value;
        window.location.href = "index.php?search=" + encodeURIComponent(searchValue);
    });
</script>

<script>
// Tarih değiştiğinde saatleri yükle
$('#date').on('change', function() {
    const date = $(this).val();
    if (date) {
        loadTimeSlots(date);
    }
});

function loadTimeSlots(date) {
    $.ajax({
        url: 'available_time_files/load_time_slots.php',
        type: 'POST',
        data: { date: date },
        success: function(response) {
            $('#timeSlots').html(response);
        },
        error: function() {
            alert('Saatleri yüklerken bir hata oluştu.');
        }
    });
}

function toggleAvailability(date, timeSlot) {
    $.ajax({
        url: 'available_time_files/toggle_availability.php',
        type: 'POST',
        data: { date: date, time_slot: timeSlot },
        success: function(response) {
            const button = $('#btn-' + timeSlot.replace(/:/g, '').replace(/\s/g, ''));
            const badge = $('#badge-' + timeSlot.replace(/:/g, '').replace(/\s/g, ''));

            // Update button class and text
            if (response === 'unavailable') {
                button.removeClass('btn-success').addClass('btn-danger');
                button.text('Unavailable');
                badge.removeClass('badge-success').addClass('badge-danger');
            } else {
                button.removeClass('btn-danger').addClass('btn-success');
                button.text('Available');
                badge.removeClass('badge-danger').addClass('badge-success');
            }
        },
        error: function() {
            alert('Durumu değiştirme sırasında bir hata oluştu.');
        }
    });
}



// New York saat dilimini kullanarak bugünün tarihini ayarla
function getNewYorkDate() {
    const now = new Date();
    const newYorkOffset = -4 * 60; // New York'un UTC-4 yaz saati farkı
    const newYorkTime = new Date(now.getTime() + (now.getTimezoneOffset() + newYorkOffset) * 60000);
    return newYorkTime.toISOString().split('T')[0];
}

document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const today = getNewYorkDate();

    // New York tarihini input'un minimum değeri olarak ayarla
    dateInput.setAttribute('min', today);

    // Input'a tıklandığında takvim açılacak
    dateInput.addEventListener('click', function() {
        this.showPicker(); // Takvimi aç
    });
});
</script>

</body>
</html>
