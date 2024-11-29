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
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Scheduled SMS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

.alert-danger {
    background-color: #ff4c4c !important; /* Özel bir kırmızı tonu */
    color: white; /* Metin rengini beyaz yaparak görünürlüğü artırabilirsiniz */
}


    </style>
</head>
<body>

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
			elseif ($_GET['status'] == 'sametimeerror') {
                echo "<div class='alert alert-danger alert-status'>No registrations can be made on this date and time. There must not be two registrations in the same time slot or 4 or more passengers in one registration.</div>";
            }
			elseif ($_GET['status'] == 'samerecorderror') {
                echo "<div class='alert alert-danger alert-status'>There must not be two registrations in the same values.</div>";
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
    $recordIds = []; // Eklenen kayıtların id'lerini takip etmek için

    try {
        // İlk sorgu
        $stmt = $baglanti->prepare("
            SELECT * 
            FROM schedule_requests AS sr
            WHERE EXISTS (
                SELECT 1 
                FROM schedule_requests 
                WHERE date = sr.date 
                AND hours = sr.hours 
                AND minutes = sr.minutes 
                AND ampm = sr.ampm 
                HAVING COUNT(*) > 1
            )
        ");
        $stmt->execute();
        foreach ($stmt->fetchAll() as $record) {
            if (!in_array($record['id'], $recordIds)) {
                $records[] = $record;
                $recordIds[] = $record['id'];
            }
        }
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }

    try {
        // İkinci sorgu
        $stmt2 = $baglanti->prepare("SELECT * FROM schedule_requests WHERE num_passengers >= 4");
        $stmt2->execute();
        foreach ($stmt2->fetchAll() as $record) {
            if (!in_array($record['id'], $recordIds)) {
                $records[] = $record;
                $recordIds[] = $record['id'];
            }
        }
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }

    // New York zaman dilimine göre bugünün tarihini al
    $nyTimezone = new DateTimeZone('America/New_York');
    $today = new DateTime('now', $nyTimezone);
    $todayDate = $today->format('Y-m-d');

    // Bugünkü tarihten önce olanları filtrele
    $records = array_filter($records, function ($record) use ($todayDate) {
        return $record['date'] >= $todayDate;
    });

    // Kayıtları date alanına göre sıralama
    usort($records, function ($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    });

    // Sıralanmış ve filtrelenmiş kayıtlar burada kullanılabilir
    foreach ($records as $record) {
        // Kayıtların işlenmesi
        // Örneğin: echo $record['date'];
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
			<a href="index.php?status=sametime" class="btn info-btn btn-sm <?php if ($_GET['status'] == "sametime") echo "active"; ?>">
                <i class="fas fa-plus"></i> SameTime Records
            </a>
			<a href="index.php?status=issue" class="btn info-btn btn-sm <?php if ($_GET['status'] == "issue") echo "active"; ?>">
                <i class="fas fa-plus"></i> SMS Issue
            </a>
			<a href="index.php" class="btn info-btn btn-sm <?php if ($_GET['status'] == "") echo "active"; ?>">
                <i class="fas fa-plus"></i> Current
            </a>
		    <a href="index.php?status=past" class="btn info-btn btn-sm <?php if ($_GET['status'] == "past") echo "active"; ?>">
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
<div class="table-responsive">
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
					<th style="text-align: center;">Assigned</th>
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
    <td data-label="Source"><?= $row['source'] ?></td>
    <td data-label="Date"><?= $row['date'] ?></td>
    <td data-label="Time"><?= $row['hours'] . ":" . $row['minutes'] . " " . $row['ampm'] ?></td>
    <td data-label="Duration">
        <?php 
        if ($row['duration'] == 90) {
            echo '90 Minutes';
        } else if ($row['duration'] == 60) {
            echo '1 Hour';
        } 
        ?>
    </td>
    <td data-label="Passengers"><?= $row['num_passengers'] ?> |
	<?php
	if ($row['num_passengers'] >= 4){
	?>
	<img src="https://static-00.iconduck.com/assets.00/pedicab-emoji-1024x945-6egbgc13.png" alt="customer" style="margin-right: 5px; width:20px; height:20px;">
	<img src="https://static-00.iconduck.com/assets.00/pedicab-emoji-1024x945-6egbgc13.png" alt="customer" style="margin-right: 5px; width:20px; height:20px;">
	<?php } 
	else {
	?>
	<img src="https://static-00.iconduck.com/assets.00/pedicab-emoji-1024x945-6egbgc13.png" alt="customer" style="margin-right: 5px; width:20px; height:20px;">
	<?php } ?></td>
    <td data-label="Name"><img src="https://static.thenounproject.com/png/1852161-200.png" alt="customer" style="margin-right: 5px; width:20px; height:20px;"><?= $row['name'] ?></td>
<td data-label="Country">
    <?php 
    $countryName = $row['countryName'] == '' ? 'UNITED STATES' : $row['countryName'];

$countryFlags = [
    'AFGHANISTAN' => 'af',
    'ALBANIA' => 'al',
    'ALGERIA' => 'dz',
    'ANDORRA' => 'ad',
    'ANGOLA' => 'ao',
    'ANTIGUA AND BARBUDA' => 'ag',
    'ARGENTINA' => 'ar',
    'ARMENIA' => 'am',
    'AUSTRALIA' => 'au',
    'AUSTRIA' => 'at',
    'AZERBAIJAN' => 'az',
    'BAHAMAS' => 'bs',
    'BAHRAIN' => 'bh',
    'BANGLADESH' => 'bd',
    'BARBADOS' => 'bb',
    'BELARUS' => 'by',
    'BELGIUM' => 'be',
    'BELIZE' => 'bz',
    'BENIN' => 'bj',
    'BHUTAN' => 'bt',
    'BOLIVIA' => 'bo',
    'BOSNIA AND HERZEGOVINA' => 'ba',
    'BOTSWANA' => 'bw',
    'BRAZIL' => 'br',
    'BRUNEI' => 'bn',
    'BULGARIA' => 'bg',
    'BURKINA FASO' => 'bf',
    'BURUNDI' => 'bi',
    'CABO VERDE' => 'cv',
    'CAMBODIA' => 'kh',
    'CAMEROON' => 'cm',
    'CANADA' => 'ca',
    'CENTRAL AFRICAN REPUBLIC' => 'cf',
    'CHAD' => 'td',
    'CHILE' => 'cl',
    'CHINA' => 'cn',
    'COLOMBIA' => 'co',
    'COMOROS' => 'km',
    'CONGO, DEMOCRATIC REPUBLIC OF THE' => 'cd',
    'CONGO, REPUBLIC OF THE' => 'cg',
    'COSTA RICA' => 'cr',
    'CROATIA' => 'hr',
    'CUBA' => 'cu',
    'CYPRUS' => 'cy',
    'CZECH REPUBLIC' => 'cz',
    'DENMARK' => 'dk',
    'DJIBOUTI' => 'dj',
    'DOMINICA' => 'dm',
    'DOMINICAN REPUBLIC' => 'do',
    'ECUADOR' => 'ec',
    'EGYPT' => 'eg',
    'EL SALVADOR' => 'sv',
    'EQUATORIAL GUINEA' => 'gq',
    'ERITREA' => 'er',
    'ESTONIA' => 'ee',
    'ESWATINI' => 'sz',
    'ETHIOPIA' => 'et',
    'FIJI' => 'fj',
    'FINLAND' => 'fi',
    'FRANCE' => 'fr',
    'GABON' => 'ga',
    'GAMBIA' => 'gm',
    'GEORGIA' => 'ge',
    'GERMANY' => 'de',
    'GHANA' => 'gh',
    'GREECE' => 'gr',
    'GRENADA' => 'gd',
    'GUATEMALA' => 'gt',
    'GUINEA' => 'gn',
    'GUINEA-BISSAU' => 'gw',
    'GUYANA' => 'gy',
    'HAITI' => 'ht',
    'HONDURAS' => 'hn',
    'HUNGARY' => 'hu',
    'ICELAND' => 'is',
    'INDIA' => 'in',
    'INDONESIA' => 'id',
    'IRAN' => 'ir',
    'IRAQ' => 'iq',
    'IRELAND' => 'ie',
    'ISRAEL' => 'il',
    'ITALY' => 'it',
    'JAMAICA' => 'jm',
    'JAPAN' => 'jp',
    'JORDAN' => 'jo',
    'KAZAKHSTAN' => 'kz',
    'KENYA' => 'ke',
    'KIRIBATI' => 'ki',
    'KOREA, NORTH' => 'kp',
    'KOREA, SOUTH' => 'kr',
    'KOSOVO' => 'xk',
    'KUWAIT' => 'kw',
    'KYRGYZSTAN' => 'kg',
    'LAOS' => 'la',
    'LATVIA' => 'lv',
    'LEBANON' => 'lb',
    'LESOTHO' => 'ls',
    'LIBERIA' => 'lr',
    'LIBYA' => 'ly',
    'LIECHTENSTEIN' => 'li',
    'LITHUANIA' => 'lt',
    'LUXEMBOURG' => 'lu',
    'MADAGASCAR' => 'mg',
    'MALAWI' => 'mw',
    'MALAYSIA' => 'my',
    'MALDIVES' => 'mv',
    'MALI' => 'ml',
    'MALTA' => 'mt',
    'MARSHALL ISLANDS' => 'mh',
    'MAURITANIA' => 'mr',
    'MAURITIUS' => 'mu',
    'MEXICO' => 'mx',
    'MICRONESIA' => 'fm',
    'MOLDOVA' => 'md',
    'MONACO' => 'mc',
    'MONGOLIA' => 'mn',
    'MONTENEGRO' => 'me',
    'MOROCCO' => 'ma',
    'MOZAMBIQUE' => 'mz',
    'MYANMAR' => 'mm',
    'NAMIBIA' => 'na',
    'NAURU' => 'nr',
    'NEPAL' => 'np',
    'NETHERLANDS' => 'nl',
    'NEW ZEALAND' => 'nz',
    'NICARAGUA' => 'ni',
    'NIGER' => 'ne',
    'NIGERIA' => 'ng',
    'NORTH MACEDONIA' => 'mk',
    'NORWAY' => 'no',
    'OMAN' => 'om',
    'PAKISTAN' => 'pk',
    'PALAU' => 'pw',
    'PANAMA' => 'pa',
    'PAPUA NEW GUINEA' => 'pg',
    'PARAGUAY' => 'py',
    'PERU' => 'pe',
    'PHILIPPINES' => 'ph',
    'POLAND' => 'pl',
    'PORTUGAL' => 'pt',
    'QATAR' => 'qa',
    'ROMANIA' => 'ro',
    'RUSSIA' => 'ru',
    'RWANDA' => 'rw',
    'SAINT KITTS AND NEVIS' => 'kn',
    'SAINT LUCIA' => 'lc',
    'SAINT VINCENT AND THE GRENADINES' => 'vc',
    'SAMOA' => 'ws',
    'SAN MARINO' => 'sm',
    'SAO TOME AND PRINCIPE' => 'st',
    'SAUDI ARABIA' => 'sa',
    'SENEGAL' => 'sn',
    'SERBIA' => 'rs',
    'SEYCHELLES' => 'sc',
    'SIERRA LEONE' => 'sl',
    'SINGAPORE' => 'sg',
    'SLOVAKIA' => 'sk',
    'SLOVENIA' => 'si',
    'SOLOMON ISLANDS' => 'sb',
    'SOMALIA' => 'so',
    'SOUTH AFRICA' => 'za',
    'SOUTH SUDAN' => 'ss',
    'SPAIN' => 'es',
    'SRI LANKA' => 'lk',
    'SUDAN' => 'sd',
    'SURINAME' => 'sr',
    'SWEDEN' => 'se',
    'SWITZERLAND' => 'ch',
    'SYRIA' => 'sy',
    'TAIWAN' => 'tw',
    'TAJIKISTAN' => 'tj',
    'TANZANIA' => 'tz',
    'THAILAND' => 'th',
    'TIMOR-LESTE' => 'tl',
    'TOGO' => 'tg',
    'TONGA' => 'to',
    'TRINIDAD AND TOBAGO' => 'tt',
    'TUNISIA' => 'tn',
    'TURKEY' => 'tr',
    'TURKMENISTAN' => 'tm',
    'TUVALU' => 'tv',
    'UGANDA' => 'ug',
    'UKRAINE' => 'ua',
    'UNITED ARAB EMIRATES' => 'ae',
    'UNITED KINGDOM' => 'gb',
    'UNITED STATES' => 'us',
    'URUGUAY' => 'uy',
    'UZBEKISTAN' => 'uz',
    'VANUATU' => 'vu',
    'VATICAN CITY' => 'va',
    'VENEZUELA' => 've',
    'VIETNAM' => 'vn',
    'YEMEN' => 'ye',
    'ZAMBIA' => 'zm',
    'ZIMBABWE' => 'zw'
];


    // Ülke kodunu belirle
    $countryCode = strtolower($countryFlags[$countryName] ?? 'us'); // Varsayılan olarak 'us' kullan
    
    // Ülke adını ve bayrağı göster
    echo '<img src="https://flagcdn.com/16x12/' . $countryCode . '.png" alt="' . $countryName . ' flag" style="margin-right: 5px; width:16px; height:12px;">';
    echo $countryName;
    ?>
</td>

    <td data-label="Phone">+<?= $row['countryCode'] . $row['phone_number'] ?></td>
    <td data-label="Pay"><center>$<?= $row['pay'] ?></center></td>
	<td data-label="Assigned" style="text-align: center;">
	<?php if ($row['drivers'] == '') {
		echo "<img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'>";
	} 
else {
    $drivers = trim($row['drivers'], ','); // Baştaki veya sondaki virgülleri kaldır
    $driverNames = explode(',', $drivers); // İsimleri virgüle göre ayır
echo "<div class='flame-text'>";
    // Eğer tek isim varsa baş harfi büyük yap
    if (count($driverNames) === 1) {
        echo ucfirst($driverNames[0]);
    } 
    // Eğer iki isim varsa her iki ismin baş harfini büyük yaparak yaz
    elseif (count($driverNames) === 2) {
        echo ucfirst($driverNames[0]) . ', ' . ucfirst($driverNames[1]);
    }
	echo "</div>";
}
?> </td>
    <td data-label="Email"><?= $row['email_sent'] == 1 ? "<img src='https://e7.pngegg.com/pngimages/799/130/png-clipart-computer-icons-symbol-approve-icon-miscellaneous-logo.png' style='margin-right: 5px; width:20px; height:20px;'>" : "<img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'>"; ?></td>
    <td data-label="Thanks Message"><?= $row['thanks_sent'] == 1 ? "<img src='https://e7.pngegg.com/pngimages/799/130/png-clipart-computer-icons-symbol-approve-icon-miscellaneous-logo.png' style='margin-right: 5px; width:20px; height:20px;'>" : "<img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'>"; ?></td>
    <td data-label="WA Thanks Message"><?= $row['thankswp_sent'] == 1 ? "<img src='https://e7.pngegg.com/pngimages/799/130/png-clipart-computer-icons-symbol-approve-icon-miscellaneous-logo.png' style='margin-right: 5px; width:20px; height:20px;'>" : "<img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'>"; ?></td>
    <td data-label="Reminder Message"><?= $row['reminder_sent'] == 1 ? "<img src='https://e7.pngegg.com/pngimages/799/130/png-clipart-computer-icons-symbol-approve-icon-miscellaneous-logo.png' style='margin-right: 5px; width:20px; height:20px;'>" : "<img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'>"; ?></td>
    <td data-label="Review Message"><?= $row['review_sent'] == 1 ? "<img src='https://e7.pngegg.com/pngimages/799/130/png-clipart-computer-icons-symbol-approve-icon-miscellaneous-logo.png' style='margin-right: 5px; width:20px; height:20px;'>" : "<img src='https://www.freeiconspng.com/thumbs/x-png/x-png-15.png' style='margin-right: 5px; width:20px; height:20px;'>"; ?></td>
    <td data-label="Actions">
        <?php   
        if ($_GET['status'] == 'sametime') { 
            if ($row['sametime_check'] == 0) { 
        ?> 
                <a href="?sametime_check_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure?');">Check It!</a>
        <?php 
            } else { 
                echo "<b style='color:red;'>ALREADY CHECKED</b>";
            }  
        } else if ($row['status'] != 'past') { 
        ?>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit btn-sm">Edit</a>
            <a href="?delete_id=<?= $row['id'] ?>" class="btn btn-delete btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
        <?php 
        } else { 
            echo "<b style='color:red;'>PAST</b>";
        }
        ?>
    </td>
</tr>

                <?php } ?>
            </tbody>
        </table>
		</div>
    </div>
<script>
    document.getElementById("searchBtn").addEventListener("click", function () {
        var searchValue = document.getElementById("search").value;
        window.location.href = "index.php?search=" + encodeURIComponent(searchValue);
    });
</script>

</body>
</html>
