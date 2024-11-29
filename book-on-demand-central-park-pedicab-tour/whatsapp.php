<?php
require_once '/home/zlds82bav5q4/public_html/dashboard-scheduled/vendor/autoload.php';
use Twilio\Rest\Client;

// Initialize the Twilio client object globally
$sid = "ACad40c7a08a87a66592f03fcf32198309";
$token = "0c5ad8bba4a765183fd3365dce5cb5cf";
$twilio = new Client($sid, $token);

function sendWhatsAppMessage($twilio, $to, $message) {
    // sent messgae
    $sentMessage = $twilio->messages->create(
        $to, // Recipient WhatsApp Number
        [
            "from" => "whatsapp:+16468527935", // Twilio WhatsApp Number
            "body" => $message // Message text to send
        ]
    );

    // Return the SID of the message (if the operation was successful)
    return $sentMessage->sid;
}

?>
