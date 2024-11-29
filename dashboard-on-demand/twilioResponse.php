<?php
$number = $_POST['From'];


	
$name = '';

	
if ($name == ""){
	require 'inc/scheduleddb.php';
	    $tables = ['centralpark', 'hourly', 'pointatob'];
	    // Her tabloyu kontrol et
    foreach ($tables as $table) {
        $sql = "SELECT firstName, lastName FROM $table WHERE phoneNumber = :phoneNumber";
        $stmt = $baglanti3->prepare($sql);
        $stmt->execute(['phoneNumber' => $number]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kayıt bulunduysa isimleri birleştir ve döngüyü kır
        if ($row) {
            $name = $row['firstName'] . ' ' . $row['lastName'];
            break;
        }
    }
	}
	
if ($name == "") {
    require 'inc/outlookdb.php'; // İlgili veritabanı bağlantısını ekliyoruz.

    // schedule_requests tablosunu kontrol et
    $sql = "SELECT name, CONCAT('+', countryCode, phone_number) as fullNumber FROM schedule_requests";
    $stmt = $baglanti4->prepare($sql);
    $stmt->execute();

    // Tüm kayıtları döngü ile kontrol ediyoruz
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $dbNumber = $row['fullNumber']; // Veritabanındaki tam numara + ülke kodu ve numara birleşimi
        
        // Gelen $numberQuery ile veritabanındaki numarayı karşılaştır
        if ($dbNumber === $number) {
            $name = $row['name']; // Eşleşen kaydın ismini atayın
            break; // Eşleşme bulunduğunda döngüyü kır
        }
    }
}


if ($name == "") {
	require 'inc/vt.php';
    $tables = ['centralpark', 'hourly', 'pointatob'];

    // Her tabloyu kontrol et
    foreach ($tables as $table) {
        $sql = "SELECT firstName, lastName FROM $table WHERE phoneNumber = :phoneNumber";
        $stmt = $baglanti->prepare($sql);
        $stmt->execute(['phoneNumber' => $number]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kayıt bulunduysa isimleri birleştir ve döngüyü kır
        if ($row) {
            $name = $row['firstName'] . ' ' . $row['lastName'];
            break;
        }
    }
}

header('Content-Type: text/xml');
?>
<Response>
<Say voice="man">Hello, <?=$name?>.</Say>
<Pause length="1"/>
<Say voice="man"> Please, call us at, 2 1 2, 9 6 1, 7 4 3 5</Say>
<Pause length="1"/>
<Say voice="man">Once again, 2 1 2, 9 6 1, 7 4 3 5</Say>
<Pause length="1"/>
<Say voice="man">We do not answer calls at this phone number.</Say>
<Pause length="1"/>
<Say voice="man">Thank you, New York Pedicab Services.</Say>
</Response>