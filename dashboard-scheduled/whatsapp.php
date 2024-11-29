<?php
require_once '/home/zlds82bav5q4/public_html/dashboard-scheduled/vendor/autoload.php';
use Twilio\Rest\Client;

$sid = "ACad40c7a08a87a66592f03fcf32198309";
$token = "0c5ad8bba4a765183fd3365dce5cb5cf";
$twilio = new Client($sid, $token);

function sendWhatsAppMessage($twilio, $to, $message) {
    $sentMessage = $twilio->messages->create(
        $to,
        [
            "from" => "whatsapp:+16468527935",
            "body" => $message
        ]
    );

    return $sentMessage->sid;
}

?>
