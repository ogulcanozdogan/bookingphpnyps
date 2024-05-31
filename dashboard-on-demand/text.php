<?php
require_once '/home/zlds82bav5q4/public_html/dashboard-scheduled/vendor/autoload.php';
use Twilio\Rest\Client;

// Twilio client nesnesini global olarak başlatıyoruz
$sid = "ACad40c7a08a87a66592f03fcf32198309";
$token = "0c5ad8bba4a765183fd3365dce5cb5cf";
$twilio = new Client($sid, $token);


function sendTextMessage($twilio, $to, $from, $message) {
    // Mesajı gönder
    $sentMessage = $twilio->messages->create(
        $to, // Alıcı telefon numarası
        [
            "from" => $from, // Twilio telefon numarası
            "body" => $message // Gönderilecek mesaj metni
        ]
    );

    // Mesajın SID'ini döndür (işlem başarılıysa)
    return $sentMessage->sid;
}
?>