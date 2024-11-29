<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen metni al
    $message = $_POST['message'];

    // Metni satır satır ayır
    $lines = explode("\n", $message);

    // Gerekli bilgileri saklamak için bir dizi oluştur
    $bookingDetails = array();

    foreach ($lines as $line) {
        $line = trim($line);

        if (strpos($line, 'Great news! The following offer has been booked:') !== false) {
            // Bu satırı geç
        } elseif (strpos($line, 'Date:') === 0) {
            $bookingDetails['Date'] = trim(str_replace('Date:', '', $line));
        } elseif (strpos($line, 'Price:') === 0) {
            $bookingDetails['Price'] = trim(str_replace('Price:', '', $line));
        } elseif (strpos($line, 'Number of participants:') === 0) {
            $isParticipantsNext = true;
        } elseif (isset($isParticipantsNext) && $isParticipantsNext) {
            $bookingDetails['Participants'] = $line;
            $isParticipantsNext = false;
        } elseif (strpos($line, 'Reference number:') === 0) {
            $bookingDetails['Reference'] = trim(str_replace('Reference number:', '', $line));
        } elseif (strpos($line, 'Main customer:') === 0) {
            $isCustomerNext = true;
        } elseif (isset($isCustomerNext) && $isCustomerNext) {
            $bookingDetails['Customer'] = $line;
            $isCustomerNext = false;
        } elseif (strpos($line, 'Phone:') === 0) {
            $bookingDetails['Phone'] = trim(str_replace('Phone:', '', $line));
        } elseif (strpos($line, 'Option:') === 0) {
            $bookingDetails['Option'] = trim(str_replace('Option:', '', $line));
        } elseif (strpos($line, 'Tour language:') === 0) {
            $bookingDetails['Language'] = trim(str_replace('Tour language:', '', $line));
        }
    }

    // Option kısmındaki tur ismini çekme ve Pedicab kelimesini silme
    if (isset($bookingDetails['Option'])) {
        if (strpos($bookingDetails['Option'], 'Minute') !== false) {
            preg_match('/Minute\s(.+?)\s\(/', $bookingDetails['Option'], $matches);
        } elseif (strpos($bookingDetails['Option'], 'Hour') !== false) {
            preg_match('/Hour\s(.+?)\s\(/', $bookingDetails['Option'], $matches);
        } else {
            $matches = array();
        }
        $tourType = isset($matches[1]) ? str_replace('Pedicab', '', $matches[1]) : 'Unknown';
        $tourType = trim($tourType); // Boşlukları temizle
    } else {
        $tourType = 'Unknown'; // Eğer Option bulunamazsa varsayılan bir değer
    }

// Tarih ve saat işleme
$dateTime = trim(str_replace("Date:", "", $bookingDetails['Date']));

// Tarih ve saat bilgisini `strtotime` ile doğrudan işleme
$timestamp = strtotime($dateTime);

// Tarihi istenilen formata dönüştür
$formattedDate = date("F d l", $timestamp);

// Saati 12 saatlik formata dönüştür
$amPmTime = date("g:i A", $timestamp);


    // Katılımcı sayısını "x" olmadan al
    preg_match('/(\d+)\s*x/', $bookingDetails['Participants'], $matches);
    $passengers = isset($matches[1]) ? trim($matches[1]) : '';

    // Telefon numarasını işle
    $phoneNumber = preg_replace('/[^0-9]/', '', $bookingDetails['Phone']);

    // Fiyatı belirle
    $price = trim(str_replace('$', '', $bookingDetails['Price']));

    // Duration kısmındaki ilk iki kelimeyi alma ve Minute'i Minutes olarak değiştirme
    if (isset($bookingDetails['Option'])) {
        preg_match('/^\d+\s\w+/', $bookingDetails['Option'], $durationMatches);
        $duration = isset($durationMatches[0]) ? $durationMatches[0] : '';
        if (strpos($duration, 'Minute') !== false) {
            $duration = str_replace('Minute', 'Minutes', $duration);
        }
    } else {
        $duration = '';
    }

    // Pay kısmını belirleme
    if (strpos($duration, '90 Minutes') !== false) {
        $pay = '$60 ZELLE by Ibrahim Donmez';
    } elseif (strpos($duration, '1 Hour') !== false) {
        $pay = '$40 ZELLE by Ibrahim Donmez';
    } else {
        $pay = 'Unknown ZELLE by Ibrahim Donmez'; // Eğer beklenmeyen bir değer gelirse
    }

    // Veriyi ekrana yazdır
    echo "Type = Central Park Pedicab Tour<br>";
    echo "Location = 6th Avenue & 57th Street<br>";
    echo "Date = " . $formattedDate . "<br>";
    echo "Time = " . $amPmTime . "<br>";
    echo "Duration = " . $duration . "<br>";
    echo "Passengers = " . $passengers . "<br>";
    echo "Name = " . $bookingDetails['Customer'] . "<br>";
    echo "Phone = +" . $phoneNumber . "<br>";
    echo "Pay = " . $pay . "<br>";
    echo "Please, confirm by typing the start time. ";
}

?>
