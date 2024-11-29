<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include('inc/db.php');
include('../vendor/autoload.php'); // SendGrid için gerekli

if (isset($_GET['id']) && isset($_SESSION['username'])) {
    $id = $_GET['id'];
    $username = $_SESSION['username'];
	
    // Kullanıcıyı veritabanından sorgula
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $baglanti->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
	
	$email = $user['email'];

    try {
        // Mevcut accepted_count, drivers ve num_passengers değerlerini al
        $stmt = $baglanti->prepare("SELECT * FROM schedule_requests WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
			
			           $date = $record['date'];
            $hours = $record['hours'];
            $minutes = $record['minutes'];
            $ampm = $record['ampm'];

            // Aynı tarih ve saat çakışmasını kontrol et
            $conflictSQL = "SELECT COUNT(*) FROM schedule_requests 
                            WHERE date = :date AND hours = :hours AND minutes = :minutes AND ampm = :ampm AND FIND_IN_SET(:username, drivers)";
            $conflictStmt = $baglanti->prepare($conflictSQL);
            $conflictStmt->execute([
                ':date' => $date,
                ':hours' => $hours,
                ':minutes' => $minutes,
                ':ampm' => $ampm,
                ':username' => $username
            ]);
            $conflictCount = $conflictStmt->fetchColumn();

            if ($conflictCount > 0) {
                // Çakışma var, index.php'ye uyarı ile geri dön
                header("Location: index.php?status=conflict");
                exit();
            }
			
            $accepted_count = $record['accepted_count'];
            $drivers = explode(',', $record['drivers']);


    $id = $record['id'];
	$formattedDate = date("F d l", strtotime($date));
    $phone_number = "+" . $record['countryCode'] . $record['phone_number'];
    $name = $record['name'];
    $duration = $record['duration'];
    $source = $record['source'];
    $num_passengers = $record['num_passengers'];
    $pay = $record['pay'];
	$driver_reminder = $record['driver_reminder'];

    if ($duration == 60){
        $durationText = "1 Hour";
    } else if ($duration == 90){
        $durationText = "90 Minutes";
    }

    // Saat AM ya da PM durumunu kontrol edip 24 saat formatına çeviriyoruz
    if ($ampm == 'PM' && $hours != 12) {
        $hours += 12;
    } elseif ($ampm == 'AM' && $hours == 12) {
        $hours = 0;
    }

    $timeString = $date . ' ' . $hours . ':' . $minutes . ':00';
    $dateTime = new DateTime($timeString, new DateTimeZone('America/New_York'));

    $dateTimeEnd = clone $dateTime;
    $dateTimeEnd->modify("+$duration minutes");

    // .ics dosyası oluşturma
    $icsContent = "BEGIN:VCALENDAR\r\n";
    $icsContent .= "VERSION:2.0\r\n";
    $icsContent .= "PRODID:-//New York Pedicab Services//EN\r\n";
    $icsContent .= "METHOD:REQUEST\r\n";
    $icsContent .= "BEGIN:VEVENT\r\n";
    $icsContent .= "UID:" . uniqid() . "\r\n";
    $icsContent .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
    $icsContent .= "DTSTART;TZID=America/New_York:" . $dateTime->format('Ymd\THis') . "\r\n";
    $icsContent .= "DTEND;TZID=America/New_York:" . $dateTimeEnd->format('Ymd\THis') . "\r\n";
    $icsContent .= "SUMMARY:" . $durationText . " " . $name . "\r\n";
    $icsContent .= "DESCRIPTION:" . $durationText . " " . $name . "\r\n";
    $icsContent .= "LOCATION:6th Avenue & 57th Street, New York, NY\r\n";

    // Hatırlatma bildirimleri
    $icsContent .= "BEGIN:VALARM\r\n";
    $icsContent .= "TRIGGER:-PT1H\r\n";
    $icsContent .= "ACTION:DISPLAY\r\n";
    $icsContent .= "DESCRIPTION:" . $durationText . " " . $name . " in 1 hours\r\n";
    $icsContent .= "END:VALARM\r\n";
    $icsContent .= "END:VEVENT\r\n";
    $icsContent .= "END:VCALENDAR\r\n";

    $icsFile = tempnam(sys_get_temp_dir(), 'calendar') . '.ics';
    file_put_contents($icsFile, $icsContent);
	
	if ($source != "Calendly"){
	$payText = "\$" .$pay. " ZELLE by Ibrahim Donmez";
	}
	else {
	$payText = "\$" .$pay. " CASH by Customer " . $name;
	}

	

    // SendGrid ile e-posta gönderme
    $email1 = new \SendGrid\Mail\Mail();
    $email1->setFrom("info@newyorkpedicabservices.com", "New York Pedicab Services");
    $email1->setSubject("REMINDER: Scheduled Central Park Pedicab Tour - " . $name);
    $email1->addTo($email, 'NYPS');
$email1->addContent("text/html", "
<strong>Type:</strong> Central Park Tour<br>
<strong>Location:</strong> 6th Avenue & 57th Street<br>
<strong>Date:</strong> $formattedDate<br>
<strong>Time:</strong> $record[hours]:$minutes $ampm<br>
<strong>Duration:</strong> $durationText<br>
<strong>Passengers:</strong> $num_passengers<br>
<strong>Name:</strong> $name<br>
<strong>Phone:</strong> $phone_number<br>
<strong>Pay:</strong> {$payText}<br>
<strong>Please, confirm by typing the start time.</strong>
");

    $email1->addAttachment(
        base64_encode(file_get_contents($icsFile)),
        "text/calendar; method=REQUEST",
        "tour_reminder.ics",
        "attachment"
    );

    $sendgrid = new \SendGrid('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');
    $response1 = $sendgrid->send($email1);

    // Gönderim sonucu
    print $response1->statusCode() . "\n";
    print_r($response1->headers());
    print $response1->body() . "\n";
	
	
	$driver_reminder = $driver_reminder + 1;

    unlink($icsFile); // Geçici dosyayı sil
	
	            try {
                $pastSQL = $baglanti->prepare("UPDATE schedule_requests SET driver_reminder = :driver_reminder WHERE id = :id");
				$pastSQL->execute([':driver_reminder' => $driver_reminder, ':id' => $id]);
            } catch (PDOException $e) {
                //echo "Hata: " . $e->getMessage();
            }

            // Eğer sürücü henüz kabul etmemişse ve koşullar sağlanıyorsa
            if (!in_array($username, $drivers)) {
                if (($num_passengers >= 4 && $accepted_count < 2) || ($num_passengers <= 3 && $accepted_count == 0)) {
                    // accepted_count ve drivers alanlarını güncelle
                    $accepted_count++;
                    $drivers[] = $username;
                    $driversString = implode(',', $drivers);

                    // accepted_count ve drivers alanlarını veritabanında güncelle
                    $stmt = $baglanti->prepare("UPDATE schedule_requests SET accepted_count = :accepted_count, drivers = :drivers WHERE id = :id");
                    $stmt->bindParam(':accepted_count', $accepted_count);
                    $stmt->bindParam(':drivers', $driversString);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();

                    header("Location: index.php?status=accepted");
                    exit();
                }
            }
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
?>