<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen metni al
    $message = $_POST['message'];

    // Metni satır satır ayır
    $lines = explode("\n", $message);

    // Gerekli bilgileri saklamak için bir dizi oluştur
    $bookingDetails = array();

    // Her satırı kontrol et
    foreach ($lines as $line) {
        // Satırı ikiye ayır
        $parts = explode(":", $line, 2); // İlk ":" karakterine kadar böl
        // Anahtar ve değer arasındaki boşlukları temizle
        $key = trim($parts[0]);
        // Tour Grade Code ise özel bir işlem yap
        if ($key === 'Tour Grade Code') {
            // Anahtar olarak Tour Grade Code olarak kullan
            $value = trim($parts[1]); // ":" karakterinden sonraki kısmı al
        } else {
            $value = trim($parts[1]);
        }
        // Bilgiyi diziye ekle
        $bookingDetails[$key] = $value;
    }
    // "Travel Date" değerini işle
    $travelDate = $bookingDetails['Travel Date'];
    // Virgülle ayrılan parçalara ayır
    $dateParts = explode(",", $travelDate);
    // İkinci parçayı al ve boşluklara göre ayır
    $dateInfo = explode(" ", trim($dateParts[1]));
    // İlk kısmı al
    $day = $dateInfo[1];
    $monthShort = $dateInfo[0];
    $year = trim($dateParts[2]);

    // Ay ve gün tam adlarını almak için dizi
    $months = [
        "Jan" => "January", "Feb" => "February", "Mar" => "March", "Apr" => "April",
        "May" => "May", "Jun" => "June", "Jul" => "July", "Aug" => "August",
        "Sep" => "September", "Oct" => "October", "Nov" => "November", "Dec" => "December"
    ];

    $days = [
        "Sun" => "Sunday", "Mon" => "Monday", "Tue" => "Tuesday", "Wed" => "Wednesday",
        "Thu" => "Thursday", "Fri" => "Friday", "Sat" => "Saturday"
    ];

    // Kısa ay ve gün adlarını tam adlarına dönüştür
    $month = $months[$monthShort];
    $dayOfWeekShort = trim($dateParts[0]);
    $dayOfWeek = $days[$dayOfWeekShort];

    // "Travelers" değerinden sadece rakamları alıp topla
    preg_match_all('!\d+!', $bookingDetails['Travelers'], $matches);
    $passengers = array_sum($matches[0]);

    // "Tour Grade" değerinden sadece süre bilgisini al
    $tourGrade = $bookingDetails['Tour Grade'];
    // Süreyi al
    preg_match('/\d+\s*\w+/', $tourGrade, $matches);
    $duration = $matches[0];

    // "Tour Grade Code" değerinden sadece saat bilgisini al
    $tourGradeCode = $bookingDetails['Tour Grade Code'];
    // Saati al
    preg_match('/\d{1,2}:\d{2}/', $tourGradeCode, $matches);
    $time = $matches[0];

    // Saati 12 saatlik formata dönüştür
    $amPmTime = date("h:i A", strtotime($time));

    // Saati 12 saatlik formata dönüştür
    $amPmTime = date("h:i A", strtotime($time));

    // Başında sıfır varsa sil
    $amPmTime = ltrim($amPmTime, '0');

    // "Phone" değerini işle
    $phone = $bookingDetails['Phone'];

    // Telefon numarasından sadece rakamları al
    $phoneNumber = preg_replace('/[^0-9]/', '', $phone);

    // Varsayılan fiyatlar
    $defaultPrice = 0;
    $price = $defaultPrice;

    // Süre ve zamanı içeren dizin
    $durations = array(
        '90' => array('AM' => 60, 'PM' => 60),
        '1' => array('AM' => 40, 'PM' => 40)
    );

    // Eğer süre ve zaman varsa fiyatı belirle
    if (preg_match('/(90|1)/', $duration, $matches) && preg_match('/(AM|PM)/', $amPmTime, $matches2)) {
        $price = $durations[$matches[0]][$matches2[0]];
    }

    // Tour ismini al
    $tourName = $bookingDetails['Tour Name'];

    // İlk iki kelimeyi al
    $words = explode(' ', $tourName, 3);
    $tourType = implode(' ', array_slice($words, 0, 2));

    // Elde edilen bilgileri kullanarak istediğiniz görünümü oluştur
    // Örneğin:
    echo "Type = " . $tourType . " Tour <br>";
    echo "Location = 6th Avenue & 57th Street<br>";
    echo "Date = " . $month . " " . $day . " " . $dayOfWeek . "<br>"; // "October 11, 2024 Friday" gibi bir çıktı oluştur
    echo "Time = " . $amPmTime . "<br>"; // Saati 12 saatlik formata dönüştürüp ekrana yazdır

    // Eğer süre "hour" ise s'yi ekleme
    if (strpos($duration, 'Hour') !== false) {
        echo "Duration = " . $duration . "<br>";
    } else {
        // "minute" ise s'yi ekle
        echo "Duration = " . $duration . "s<br>";
    }

    echo "Passengers = " . $passengers . "<br>"; // Travelers kısmından alınan yolcu sayısını ekrana yazdır
    echo "Name = " . $bookingDetails['Lead Traveler Name'] . "<br>";
    echo "Phone = +" . $phoneNumber . "<br>"; // Telefon numarasını belirtilen formatta ekrana yazdır
    echo "Pay = $" . $price . " ZELLE by Ibrahim Donmez<br>";
    echo "Please, confirm by typing the start time. ";
}

?>
