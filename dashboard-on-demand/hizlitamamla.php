<?php
include('inc/vt.php');
include('inc/head.php');
include('inc/header.php');
include('inc/navbar.php');


function updateDriverBookings($pdo, $user) {
    $now = new DateTime("now", new DateTimeZone('America/New_York'));
    $currentDateTime = $now->format('Y-m-d H:i:s'); 

    $tables = ['centralpark', 'pointatob', 'hourly'];

    foreach ($tables as $table) {
        $stmt = $pdo->prepare("SELECT bookingNumber FROM $table WHERE driver = :user AND status = 'pending'");
        $stmt->execute([':user' => $user]);
        $bookings = $stmt->fetchAll();

        foreach ($bookings as $booking) {
            $bookingNumber = $booking['bookingNumber'];

            $updateStmt = $pdo->prepare("UPDATE $table SET status = 'past', updated_at = :updated_at WHERE bookingNumber = :bookingNumber");
            $updateStmt->execute([':updated_at' => $currentDateTime, ':bookingNumber' => $bookingNumber]);
        }
    }
}

updateDriverBookings($baglanti, $user);

?>
