<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('inc/db.php');
include('vendor/autoload.php'); // SendGrid için gerekli
include('inc/text.php');
include('inc/whatsapp.php');




function mailInvite() {
	 global $baglanti;
	 global $twilio;
	 
	 
	$sql = "SELECT * FROM schedule_requests WHERE thankswp_sent = 0";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute();
    $rows3 = $stmt->fetchAll();

    if ($rows3) {
        foreach ($rows3 as $row3) {
				$id = $row3['id'];
			    $phone_number = "+" . $row3['countryCode'] . $row3['phone_number'];
			
			 try {
                    // WhatsApp mesajı gönderme
                    sendWhatsAppMessage($twilio, "whatsapp:" . $phone_number, "Thank you for booking Central Park Pedicab Tours with New York Pedicab Services:
https://newyorkpedicabservices.com/central-park-pedicab-tours.html");

                    // Veritabanında durumu güncelle
                    $pastSQL = $baglanti->prepare("UPDATE schedule_requests SET thankswp_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
					$pastSQL = $baglanti->prepare("UPDATE schedule_requests SET thankswp_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
			
		}
	}
	
	 
	$sql = "SELECT * FROM schedule_requests WHERE thanks_sent = 0 AND sms_issue = 0";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute();
    $rows2 = $stmt->fetchAll();

    if ($rows2) {
        foreach ($rows2 as $row2) {
				$id = $row2['id'];
			    $phone_number = "+" . $row2['countryCode'] . $row2['phone_number'];
			
			 try {
                    // SMS gönderme fonksiyonu
                    sendTextMessage($twilio, $phone_number, "+16468527935", "Thank you for booking Central Park Pedicab Tours with New York Pedicab Services:
https://newyorkpedicabservices.com/central-park-pedicab-tours.html");

                    // Veritabanında durumu güncelle
                    $pastSQL = $baglanti->prepare("UPDATE schedule_requests SET thanks_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
					$pastSQL = $baglanti->prepare("UPDATE schedule_requests SET sms_issue = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
			
		}
	}
    // New York saat dilimi ayarı
    date_default_timezone_set('America/New_York');
	$sql = "SELECT * FROM schedule_requests WHERE status = 'pending' AND email_sent = 0";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    if ($rows) {
        foreach ($rows as $row) {

    $id = $row['id'];
    $date = $row['date'];
	$formattedDate = date("F d l", strtotime($date));
    $hours = $row['hours'];
    $minutes = $row['minutes'];
    $ampm = $row['ampm'];
    $phone_number = "+" . $row['countryCode'] . $row['phone_number'];
    $name = $row['name'];
    $email = "info@newyorkpedicabservices.com";
    $duration = $row['duration'];
    $source = $row['source'];
    $num_passengers = $row['num_passengers'];
    $pay = $row['pay'];

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
    $icsContent .= "SUMMARY:" . $source . " " . $durationText . " " . $name . "\r\n";
    $icsContent .= "DESCRIPTION:" . $source . " " . $durationText . " " . $name . "\r\n";
    $icsContent .= "LOCATION:6th Avenue & 57th Street, New York, NY\r\n";

    // Hatırlatma bildirimleri
    $icsContent .= "BEGIN:VALARM\r\n";
    $icsContent .= "TRIGGER:-PT20H\r\n";
    $icsContent .= "ACTION:DISPLAY\r\n";
    $icsContent .= "DESCRIPTION:" . $source . " " . $durationText . " " . $name . " in 20 hours\r\n";
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
    $email1->setSubject("REMINDER: Scheduled Central Park Pedicab Tour - " . $source . " - " . $name);
    $email1->addTo($email, 'NYPS');
$email1->addContent("text/html", "
<strong>Source:</strong> $source<br>
<strong>Type:</strong> Central Park Tour<br>
<strong>Location:</strong> 6th Avenue & 57th Street<br>
<strong>Date:</strong> $formattedDate<br>
<strong>Time:</strong> $row[hours]:$minutes $ampm<br>
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

    unlink($icsFile); // Geçici dosyayı sil
	
	            try {
                $pastSQL = $baglanti->prepare("UPDATE schedule_requests SET email_sent = 1 WHERE id = :id");
                $pastSQL->execute([':id' => $id]);
            } catch (PDOException $e) {
                //echo "Hata: " . $e->getMessage();
            }
		}
	}
}
mailInvite();

function reminderSMS() 
{
    global $baglanti;
    global $twilio;

    // New York saat dilimi ayarı
    date_default_timezone_set('America/New_York');

    // Veritabanından 'pending' durumundaki verileri çekiyoruz
    $sql = "SELECT * FROM schedule_requests WHERE status = 'pending' AND sms_issue = 0";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    if ($rows) {
        foreach ($rows as $row) {
            $id = $row['id'];
            $date = $row['date'];
            $hours = $row['hours'];
            $minutes = $row['minutes'];
            $ampm = $row['ampm'];
			$fullhour = $hours . ":" . $minutes . " " . $ampm;
            $phone_number = "+" . $row['countryCode'] . $row['phone_number'];
            $name = $row['name'];

            // AM ve PM durumunu kontrol ediyoruz ve 24 saat formatına çeviriyoruz
            if ($ampm == 'PM' && $hours != 12) {
                $hours += 12;
            } elseif ($ampm == 'AM' && $hours == 12) {
                $hours = 0;
            }

            // Zamanı oluştur
            $timeString = $date . ' ' . $hours . ':' . $minutes . ':00';
            $dateTime = new DateTime($timeString, new DateTimeZone('America/New_York'));

            // 2 saat geriye alıyoruz
            $dateTime->modify('-2 hours');

            // Mevcut New York zamanı
            $currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));

            // Eğer şu anki zaman, planlanan zamandan sonraysa SMS gönder
            if ($currentDateTime >= $dateTime) {
                try {
                    // WhatsApp mesajı gönderme
                    sendWhatsAppMessage($twilio, "whatsapp:" . $phone_number, "Hello " . $name . ". You have a Central Park Tour with us at " . $fullhour . ". See you soon. Thank you. -New York Pedicab Services");

                    // Veritabanında durumu güncelle
                    $pastSQL = $baglanti->prepare("UPDATE schedule_requests SET status = 'past', reminder_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
					$pastSQL = $baglanti->prepare("UPDATE schedule_requests SET status = 'past', sms_issue = 1, reminder_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
				
				try {
                    // SMS gönderme fonksiyonu
                    sendTextMessage($twilio, $phone_number, "+16468527935", "Hello " . $name . ". You have a Central Park Tour with us at " . $fullhour . ". See you soon. Thank you. -New York Pedicab Services");

                    // Veritabanında durumu güncelle
                    $pastSQL = $baglanti->prepare("UPDATE schedule_requests SET status = 'past', reminder_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending message to $phone_number: " . $e->getMessage() . "\n";
					$pastSQL = $baglanti->prepare("UPDATE schedule_requests SET status = 'past', sms_issue = 1, reminder_sent = 1 WHERE id = :id");
                    $pastSQL->execute([':id' => $id]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
            }
        }
    }
}
reminderSMS();


function sendReviewReminderSMS() 
{
    global $baglanti;
    global $twilio;

    // New York saat dilimi ayarı
    date_default_timezone_set('America/New_York');

    // Veritabanındaki date, hours, minutes ve ampm verisini çekelim
    $sql = "SELECT * FROM schedule_requests WHERE status = 'past' AND review_sent = 0";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll();

    if ($rows) {
        foreach ($rows as $row) {
            $id = $row['id'];
            $date = $row['date'];
            $hours = $row['hours'];
            $minutes = $row['minutes'];
            $ampm = $row['ampm'];
            $phone_number = "+" . $row['countryCode'] . $row['phone_number'];
            $name = $row['name'];

            // Saat AM ya da PM durumunu kontrol edip 24 saat formatına çeviriyoruz
            if ($ampm == 'PM' && $hours != 12) {
                $hours += 12;
            } elseif ($ampm == 'AM' && $hours == 12) {
                $hours = 0;
            }

            // Zamanı oluştur
            $timeString = $date . ' ' . $hours . ':' . $minutes . ':00';
            $dateTime = new DateTime($timeString, new DateTimeZone('America/New_York'));

            // 2 saat ekleyelim
            $dateTime->modify('+2 hours');

            // Mevcut New York zamanı
            $currentDateTime = new DateTime('now', new DateTimeZone('America/New_York'));

            // Eğer 2 saat sonra ise SMS gönder
            if ($currentDateTime >= $dateTime) {
                try {
                    // WhatsApp mesajı da gönderelim
                    sendWhatsAppMessage($twilio, "whatsapp:" . $phone_number, "We hope you enjoyed your tour. Please, consider dropping stars for us on Google. Thank you.
https://g.page/r/Cfz9bhvf1E2dEBM/review");

                    // Durumu 'review_sent' olarak güncelleyelim
                    $updateSQL = $baglanti->prepare("UPDATE schedule_requests SET review_sent = '1' WHERE id = :id");
                    $updateSQL->execute([':id' => $id]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending review message to $phone_number: " . $e->getMessage() . "\n";
					$updateSQL = $baglanti->prepare("UPDATE schedule_requests SET sms_issue = '1', review_sent = '1' WHERE id = :id");
                    $updateSQL->execute([':id' => $id]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
				
				try {
                    // SMS gönderme
                    sendTextMessage($twilio, $phone_number, "+16468527935", "We hope you enjoyed your tour. Please, consider dropping stars for us on Google. Thank you.
https://g.page/r/Cfz9bhvf1E2dEBM/review");

                    // Durumu 'review_sent' olarak güncelleyelim
                    $updateSQL = $baglanti->prepare("UPDATE schedule_requests SET review_sent = '1' WHERE id = :id");
                    $updateSQL->execute([':id' => $id]);
                } catch (Exception $e) {
                    // Hata durumunda hatayı loglayabilir veya sadece atlayabilirsiniz
                    echo "Error sending review message to $phone_number: " . $e->getMessage() . "\n";
					$updateSQL = $baglanti->prepare("UPDATE schedule_requests SET sms_issue = '1', review_sent = '1' WHERE id = :id");
                    $updateSQL->execute([':id' => $id]);
                    continue; // Devam et ve sıradaki numaraya geç
                }
            }
        }
    }
}

sendReviewReminderSMS();

function updateUnavailableTimes() {
    include('inc/db.php');  // İlk bağlantı schedule_requests için
    global $baglanti;  // schedule_requests bağlantısı

    // New York saat dilimi ayarı
    date_default_timezone_set('America/New_York');

    // Aynı tarih ve saatte en az iki kaydı olanları bul
    $sql = "
        SELECT date, hours, minutes, ampm
        FROM schedule_requests
        GROUP BY date, hours, minutes, ampm
        HAVING COUNT(*) >= 2
    ";
    $stmt = $baglanti->prepare($sql);
    $stmt->execute();
    $sameTimeRecords = $stmt->fetchAll();

    // Aynı tarih ve saatte en az iki kayıt varsa onu unavailable_times olarak ekleyin
    foreach ($sameTimeRecords as $record) {
        $date = $record['date'];
        $timeSlot = $record['hours'] . ':' . str_pad($record['minutes'], 2, '0', STR_PAD_LEFT) . ' ' . $record['ampm'];

        // unavailable_times tablosuna eklemek için db2.php'yi dahil et
        include('inc/db2.php');
        global $baglanti;

        // unavailable_times tablosunda zaten mevcut mu kontrol et
        $checkQuery = $baglanti->prepare("SELECT status FROM unavailable_times WHERE date = ? AND time_slot = ?");
        $checkQuery->execute([$date, $timeSlot]);
        $currentStatus = $checkQuery->fetchColumn();

        if ($currentStatus === false) {
            // Eğer kayıt yoksa, yeni kayıt ekle
            $insertQuery = $baglanti->prepare('INSERT INTO unavailable_times (date, time_slot, status) VALUES (?, ?, ?)');
            $insertQuery->execute([$date, $timeSlot, 'unavailable']);
        } elseif ($currentStatus == 'available') {
            // Eğer kayıt varsa ve status 'available' ise, 'unavailable' olarak güncelle
            $updateQuery = $baglanti->prepare("UPDATE unavailable_times SET status = 'unavailable' WHERE date = ? AND time_slot = ?");
            $updateQuery->execute([$date, $timeSlot]);
        }
    }

    // Tek bir kaydın num_passengers değeri 4 veya daha fazla ise onu kontrol et
    include('inc/db.php'); // Tekrar schedule_requests bağlantısını yükle
    $sqlSingleRecord = "
        SELECT date, hours, minutes, ampm
        FROM schedule_requests
        WHERE num_passengers >= 4
    ";
    $stmtSingleRecord = $baglanti->prepare($sqlSingleRecord);
    $stmtSingleRecord->execute();
    $singlePassengerRecords = $stmtSingleRecord->fetchAll();

    foreach ($singlePassengerRecords as $record) {
        $date = $record['date'];
        $timeSlot = $record['hours'] . ':' . str_pad($record['minutes'], 2, '0', STR_PAD_LEFT) . ' ' . $record['ampm'];

        // unavailable_times tablosuna eklemek için db2.php'yi tekrar dahil et
        include('inc/db2.php');
        global $baglanti;

        // unavailable_times tablosunda zaten mevcut mu kontrol et
        $checkQuery = $baglanti->prepare("SELECT status FROM unavailable_times WHERE date = ? AND time_slot = ?");
        $checkQuery->execute([$date, $timeSlot]);
        $currentStatus = $checkQuery->fetchColumn();

        if ($currentStatus === false) {
            // Eğer kayıt yoksa, yeni kayıt ekle
            $insertQuery = $baglanti->prepare('INSERT INTO unavailable_times (date, time_slot, status) VALUES (?, ?, ?)');
            $insertQuery->execute([$date, $timeSlot, 'unavailable']);
        } elseif ($currentStatus == 'available') {
            // Eğer kayıt varsa ve status 'available' ise, 'unavailable' olarak güncelle
            $updateQuery = $baglanti->prepare("UPDATE unavailable_times SET status = 'unavailable' WHERE date = ? AND time_slot = ?");
            $updateQuery->execute([$date, $timeSlot]);
        }
    }
}

// Fonksiyonu çağırarak çalıştır
updateUnavailableTimes();
?>
