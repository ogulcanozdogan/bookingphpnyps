<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen metni al
    $message = $_POST['message'];

    // Metni satır satır ayır ve boşlukları temizle
    $lines = array_map('trim', explode("\n", $message));

    // Gerekli bilgileri saklamak için bir dizi oluştur
    $bookingDetails = array();

    // Tüm satırlar üzerinde döngü oluşturup telefon ve yolcu sayısını arama
    foreach ($lines as $index => $line) {
        if (strpos($line, 'Event Type:') !== false) {
            $bookingDetails['EventType'] = isset($lines[$index + 1]) ? trim($lines[$index + 1]) : '';
        } elseif (strpos($line, 'Invitee:') !== false) {
            $bookingDetails['Customer'] = isset($lines[$index + 1]) ? trim($lines[$index + 1]) : '';
        } elseif (strpos($line, 'Event Date/Time:') !== false) {
            $bookingDetails['DateTime'] = isset($lines[$index + 1]) ? trim($lines[$index + 1]) : '';
        }

        // Telefon numarasını doğru bir şekilde yakala
        if (trim($line) == 'Cell Phone Number') {
            // Bir sonraki satırda telefon numarasını al
            $bookingDetails['Phone'] = isset($lines[$index + 2]) ? trim($lines[$index + 2]) : '';
        }

        // Yolcu sayısını doğru bir şekilde yakala
        if (trim($line) == 'Number of Passengers') {
            // Bir sonraki satırda yolcu sayısını al
            $bookingDetails['Participants'] = isset($lines[$index + 2]) ? trim($lines[$index + 2]) : '';
        }
    }

    // Katılımcı sayısını al ve sayısal değeri doğrula
    $passengers = isset($bookingDetails['Participants']) ? $bookingDetails['Participants'] : '';

    // Telefon numarasını işle
    $phoneNumber = isset($bookingDetails['Phone']) ? preg_replace('/[^0-9+]/', '', $bookingDetails['Phone']) : '';

    // Tarih ve saat işleme
    if (isset($bookingDetails['DateTime'])) {
        // Saati al
        preg_match('/(\d{1,2}:\d{2}[apAP][mM])/', $bookingDetails['DateTime'], $timeMatches);
        $time = isset($timeMatches[1]) ? $timeMatches[1] : '';

        // Saati 12 saatlik formata dönüştür
        $amPmTime = date("h:i A", strtotime($time));
        $amPmTime = ltrim($amPmTime, '0');

        // Tarihi al ve formatla
        preg_match('/(\w+), (\w+ \d{1,2}, \d{4})/', $bookingDetails['DateTime'], $dateMatches);
        $dayMonthYear = isset($dateMatches[2]) ? $dateMatches[2] : '';
        $formattedDate = date("F d l", strtotime($dayMonthYear));
    } else {
        $amPmTime = '';
        $formattedDate = '';
    }

    // Duration kısmını al ve formatla
    if (isset($bookingDetails['EventType'])) {
        preg_match('/(\d+)\s*(Minute|Hour)/', $bookingDetails['EventType'], $durationMatches);
        $duration = isset($durationMatches[0]) ? $durationMatches[0] : '';
        if (strpos($duration, 'Minute') !== false) {
            $duration = str_replace('Minute', 'Minutes', $duration);
        }
    } else {
        $duration = '';
    }

    // Pay kısmını belirleme
    if (strpos($duration, '90 Minutes') !== false) {
        $pay = '$60 CASH by ' . $bookingDetails['Customer'];
    } elseif (strpos($duration, '1 Hour') !== false) {
        $pay = '$40 CASH by ' . $bookingDetails['Customer'];
    } else {
        $pay = 'Unknown CASH by ' . $bookingDetails['Customer'];
    }

    // Veriyi ekrana yazdır
    echo "Type = Central Park Tour<br>";
    echo "Location = 6th Avenue & 57th Street<br>";
    echo "Date = " . $formattedDate . "<br>";
    echo "Time = " . $amPmTime . "<br>";
    echo "Duration = " . $duration . "<br>";
    echo "Passengers = " . $passengers . "<br>";
    echo "Name = " . $bookingDetails['Customer'] . "<br>";
    echo "Phone = " . $phoneNumber . "<br>";
    echo "Pay = " . $pay . "<br>";
    echo "Please, confirm by typing the start time.";
}

?>
