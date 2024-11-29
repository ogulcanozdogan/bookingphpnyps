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

$username = $_SESSION['username'];

try {
    // New York saat dilimiyle bugünün tarihini al
    $nycDate = new DateTime('now', new DateTimeZone('America/New_York'));
    $today = $nycDate->format('Y-m-d');

    // Ertesi günün tarihini al
    $nycDate->modify('+1 day');
    $tomorrow = $nycDate->format('Y-m-d');

    // Ana sorgu; num_passengers, drivers, ve accepted_count koşullarını içerir
    $query = "SELECT * FROM schedule_requests 
              WHERE status = 'pending' 
              AND date BETWEEN :today AND :tomorrow 
              AND (
                  (num_passengers >= 4 AND accepted_count < 2 AND 
                   (drivers NOT LIKE :username_start AND drivers NOT LIKE :username_middle AND drivers NOT LIKE :username_end)) 
                  OR (num_passengers <= 3 AND drivers = '')
              )
              ORDER BY date";

    // Username'in başta, ortada veya sonda olma durumlarını ayarlama
    $username_start = "$username,%";
    $username_middle = "%,$username,%";
    $username_end = "%,$username";

    $stmt = $baglanti->prepare($query);
    $stmt->bindParam(':today', $today);
    $stmt->bindParam(':tomorrow', $tomorrow);
    $stmt->bindParam(':username_start', $username_start);
    $stmt->bindParam(':username_middle', $username_middle);
    $stmt->bindParam(':username_end', $username_end);

    $stmt->execute();
    $records = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}


if ($_GET['status'] == 'assigned') {
    try {
        // Sürücüyü bulmak için virgülle başlama, virgülle bitme veya ortada olma durumlarını kapsayan koşullar
        $stmt = $baglanti->prepare("SELECT * FROM schedule_requests 
                                    WHERE (drivers LIKE :username_start OR drivers LIKE :username_middle OR drivers LIKE :username_end) 
                                    AND status = 'pending' 
                                    ORDER BY date");

        // Username'in başta, ortada veya sonda olma durumlarını ayarlama
        $username_start = "$username,%";
        $username_middle = "%,$username,%";
        $username_end = "%,$username";

        $stmt->bindParam(':username_start', $username_start);
        $stmt->bindParam(':username_middle', $username_middle);
        $stmt->bindParam(':username_end', $username_end);

        $stmt->execute();
        $records = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}

if ($_GET['status'] == 'past') {
    try {
        // Username'in başta, ortada veya sonda olma durumlarını ayarlama
        $username_start = "$username,%";
        $username_middle = "%,$username,%";
        $username_end = "%,$username";

        // Sadece sürücüye atanmış geçmiş kayıtları tarihe göre sıralanmış olarak getir
        $stmt = $baglanti->prepare("SELECT * FROM schedule_requests 
                                    WHERE status = 'past' 
                                    AND (drivers LIKE :username_start OR drivers LIKE :username_middle OR drivers LIKE :username_end) 
                                    ORDER BY date");

        // Parametreleri bağla
        $stmt->bindParam(':username_start', $username_start);
        $stmt->bindParam(':username_middle', $username_middle);
        $stmt->bindParam(':username_end', $username_end);

        $stmt->execute();
        $records = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="../vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Central Park</title>
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

.btn.active {
    background-color: #0066cc; /* Active button color */
    color: #fff; /* Active text color */
    box-shadow: 0 0 10px rgba(0, 102, 204, 0.5); /* Optional glow effect */
    font-weight: bold; /* Bold text for active */
}

.alert-custom-danger {
    background-color: #f8d7da; /* Kırmızı arka plan */
    color: #721c24; /* Yazı rengi */
    border-color: #f5c6cb; /* Kenarlık rengi */
}

    </style>
</head>
<body>

    <div class="container">
        <h1 class="text-center mb-4"><a href="index.php">Dashboard - Central Park</a></h1>

        <!-- Başarılı mesajlar -->
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'accepted') {
                echo "<div class='alert alert-success alert-status'>Record is accepted successfully!</div>";
            }
elseif ($_GET['status'] == 'conflict') {
    echo "<div class='alert alert-custom-danger alert-status'>You have another tour at the same time!</div>";
}

					
        }
        ?>

        <!-- Logout butonu -->
        <div class="text-right mb-4">
            <a href="../logout.php" class="btn btn-danger">Logout</a>
        </div>
		

        <!-- Kayıt eklemek için artı butonu -->
        <div class="text-right">
			<a href="index.php" class="btn info-btn btn-sm <?php if ($_GET['status'] == "") echo "active"; ?>">
                <i class="fas fa-plus"></i> Available
            </a>
			<a href="index.php?status=assigned" class="btn info-btn btn-sm <?php if ($_GET['status'] == "assigned") echo "active"; ?>">
                <i class="fas fa-plus"></i> Pending
            </a>
		    <a href="index.php?status=past" class="btn info-btn btn-sm <?php if ($_GET['status'] == "past") echo "active"; ?>">
                <i class="fas fa-plus"></i> Past
            </a>
        </div>
<hr>
<div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Duration</th>
                    <th>Passengers</th>
                    <th>Name</th>
					<th>Country</th>
                    <th>Phone</th>
                    <th>Pay</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row) { ?>
<tr>
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
    echo '<img src="https://flagcdn.com/16x12/' . $countryCode . '.png" alt="' . $countryName . ' flag" style="margin-right: 5px; width=16px; height:12px;">';
    echo $countryName;
    ?>
</td>

    <td data-label="Phone">+<?= $row['countryCode'] . $row['phone_number'] ?></td>
    <td data-label="Pay" >$<?= $row['pay'] ?></td>
    <td data-label="Actions" style="text-align: center;">
        <?php   
		if ($_GET['status'] == 'assigned') { 
            echo "<b style='color:red;'>PENDING</b>";
        }
		else if ($row['status'] == 'past') { 
            echo "<b style='color:red;'>PAST</b>";
        }
		else if ($row['status'] == 'pending') {
        ?>
            <a href="accept.php?id=<?= $row['id'] ?>" class="btn btn-edit btn-sm">Accept</a>
        <?php 
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
