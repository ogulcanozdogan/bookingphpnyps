<?php
session_start();

// Kullanıcı giriş yapmamışsa login sayfasına yönlendir
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include('inc/db.php'); // Veritabanı bağlantısını dahil ediyoruz

try {
    $baglanti = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo 'Bağlantı hatası: ' . $e->getMessage();
    exit;
}

// Kayıtları listeleme
try {
    $query = "SELECT * FROM schedule_requests WHERE status = 'pending' AND sms_issue = 0";
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $query = "SELECT * FROM schedule_requests WHERE name LIKE :search";
    }
    $query .= " ORDER BY date";
    
    $stmt = $baglanti->prepare($query);
    
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $stmt->bindParam(':search', $search);
    }
    
    $stmt->execute();
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}



// Silme işlemi
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        $stmt = $baglanti->prepare("DELETE FROM schedule_requests WHERE id = :id");
        $stmt->bindParam(':id', $delete_id);
        $stmt->execute();
        header("Location: index.php?status=deleted");
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}


// Silme işlemi
if (isset($_GET['sametime_check_id'])) {
    $sametime_check_id = $_GET['sametime_check_id'];
    try {
        $stmt = $baglanti->prepare("UPDATE schedule_requests SET sametime_check = 1 WHERE id = :id");
        $stmt->bindParam(':id', $sametime_check_id);
        $stmt->execute();
        header("Location: index.php?status=sametime");
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}

// Güncelleme işlemi (POST isteği ile)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'])) {
    $edit_id = $_POST['edit_id'];
    $source = $_POST['source'];
    $date = $_POST['date'];
    $hours = $_POST['hours'];
    $minutes = $_POST['minutes'];
    $ampm = $_POST['ampm'];
    $duration = $_POST['duration'];
    $num_passengers = $_POST['num_passengers'];
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $pay = $_POST['pay'];

    try {
        $stmt = $baglanti->prepare("UPDATE schedule_requests SET source=:source, date=:date, hours=:hours, minutes=:minutes, ampm=:ampm, duration=:duration, num_passengers=:num_passengers, name=:name, phone_number=:phone_number, pay=:pay WHERE id=:id");
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
        $stmt->bindParam(':id', $edit_id);
        $stmt->execute();
        header("Location: dashboard.php?success=updated");
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Scheduled SMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Genel stil */
        body {
            background-color: #000;
            color: #00ff00;
            font-family: "Courier New", Courier, monospace;
        }
        a {
            color: #00ff00;
        }
        a:hover {
            color: #fff;
        }
        .container {
            margin-top: 50px;
            max-width: 100%;
        }
        /* Buton stilleri */
        .btn {
            background-color: #333;
            color: #00ff00;
            border: 1px solid #00ff00;
        }
        .btn:hover {
            background-color: #00ff00;
            color: #000;
        }
        .btn-edit {
            background-color: #333;
        }
        .btn-delete {
            background-color: #333;
        }
        /* Tablo stilleri */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead th {
            background-color: #111;
            color: #00ff00;
        }
        .table tbody tr {
            background-color: #000;
			color:white;
        }
        .table tbody tr:hover {
            background-color: #004400;
        }
        .alert-status {
            background-color: #333;
            color: #00ff00;
            border: 1px solid #00ff00;
        }
        /* Matrix arka plan animasyonu */
        .matrix {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: black;
            overflow: hidden;
        }
        .matrix span {
            font-family: "Courier New", monospace;
            color: #00ff00;
            font-size: 18px;
            position: absolute;
            top: -100px;
            animation: drop 3s infinite linear;
        }
        @keyframes drop {
            0% { top: -100px; }
            100% { top: 100vh; }
        }
		
    </style>
</head>
<body>
<div class="matrix"></div>
    <div class="container">
        <h1 class="text-center mb-4"><a href="index.php">Dashboard - Scheduled SMS</a></h1>

        <!-- Başarılı mesajlar -->
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'added') {
                echo "<div class='alert alert-success alert-status'>New record is added successfully!</div>";
            } elseif ($_GET['status'] == 'updated') {
                echo "<div class='alert alert-success alert-status'>Record updated successfully!</div>";
            }
			elseif ($_GET['status'] == 'deleted') {
                echo "<div class='alert alert-success alert-status'>Record is deleted!</div>";
            }
			elseif ($_GET['status'] == 'past') {
               try {
    $stmt = $baglanti->prepare("SELECT * FROM schedule_requests WHERE status = 'past' AND sms_issue = 0 ORDER BY date DESC");
    $stmt->execute();
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
            }
						elseif ($_GET['status'] == 'issue') {
							  // New York saat dilimine göre geçerli tarihi alın
    $ny_timezone = new DateTimeZone('America/New_York');
    $current_date = new DateTime('now', $ny_timezone);
    $current_date_str = $current_date->format('Y-m-d');
               try {
    $stmt = $baglanti->prepare("SELECT * FROM schedule_requests WHERE sms_issue = 1 AND date >= :current_date ORDER BY date");
	    // Geçerli tarihi parametre olarak bağla
    $stmt->bindParam(':current_date', $current_date_str);
    $stmt->execute();
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
            }
			


			
			elseif ($_GET['status'] == 'sametime') {
    $records = []; // Tüm kayıtları depolamak için birleştirici dizi oluştur
	


    try {
        // İlk sorgu
        $stmt = $baglanti->prepare("
            SELECT * 
            FROM schedule_requests AS sr
            WHERE status = 'pending' AND EXISTS (
                SELECT 1 
                FROM schedule_requests 
                WHERE date = sr.date 
                AND hours = sr.hours 
                AND minutes = sr.minutes 
                AND ampm = sr.ampm 
                HAVING COUNT(*) > 1
            ) ORDER BY date
        ");
        $stmt->execute();
        $records = array_merge($records, $stmt->fetchAll());
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }

    try {
        // İkinci sorgu
        $stmt2 = $baglanti->prepare("SELECT * FROM schedule_requests WHERE num_passengers >= 4 AND status = 'pending' ORDER BY date");
        $stmt2->execute();
        $records = array_merge($records, $stmt2->fetchAll());

    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}

			
        }
        ?>

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
			<a href="closed_times.php" class="btn info-btn btn-sm">
                <i class="fas fa-timer"></i> Closed Times
            </a>
        </div>
<div class="text-right mb-4">
    <input type="text" id="search" class="form-control" placeholder="Search a name..." style="display: inline-block; width: auto;"/>
    <button id="searchBtn" class="btn btn-primary btn-sm">Search</button>
</div>

<script>
    document.getElementById("searchBtn").addEventListener("click", function () {
        var searchValue = document.getElementById("search").value;
        window.location.href = "index.php?search=" + encodeURIComponent(searchValue);
    });
</script>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Duration</th>
                    <th>Passengers</th>
                    <th>Name</th>
					<th>Country</th>
                    <th>Phone</th>
                    <th>Pay</th>
					<th>Email</th>
					<th>Thanks Message</th>
					<th>WA Thanks Message</th>
                    <th>Reminder Message</th>
                    <th>Review Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row) { ?>
                    <tr>
                        <td><?= $row['source'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['hours'] . ":" . $row['minutes'] . " " . $row['ampm'] ?></td>
                        <td><?php if ($row['duration'] == 90) { echo '90 Minutes';}
else if ($row['duration'] == 60){
	echo '1 Hour';
}					?></td>
                        <td><?= $row['num_passengers'] ?></td>
                        <td><?= $row['name'] ?></td>
						<td><?php if ($row['countryName'] == '') {echo "UNITED STATES";} else {echo $row['countryName'];} ?></td>
                        <td>+<?= $row['countryCode'] . $row['phone_number'] ?></td>
                        <td>$<?= $row['pay'] ?></td>
						<td><?= $row['email_sent'] == 1 ? "Yes" : "Not yet"; ?></td>
						<td><?= $row['thanks_sent'] == 1 ? "Yes" : "Not yet"; ?></td>
						<td><?= $row['thankswp_sent'] == 1 ? "Yes" : "Not yet"; ?></td>
						<td><?= $row['reminder_sent'] == 1 ? "Yes" : "Not yet"; ?></td>
						<td><?= $row['review_sent'] == 1 ? "Yes" : "Not yet"; ?></td>						
						<td>
						<?php  if ($_GET['status'] == 'sametime') { 
						if ($row['sametime_check'] == 0){
						?> 
						<a href="?sametime_check_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?');">Check It!</a>
						<?php } else { echo "<b style='color:red;'>ALREADY CHECKED</b>";}  } else if ($row['status'] != 'past'){ ?>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit btn-sm">Edit</a>
                            <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                      	<?php } else { echo "<b style='color:red;'>PAST</b>";}?>
					  </td>
			
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
