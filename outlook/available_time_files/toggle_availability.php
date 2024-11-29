<?php
include('../inc/db2.php');

$date = $_POST['date'];
$timeSlot = $_POST['time_slot'];

// Durumu kontrol et
$query = $baglanti->prepare('SELECT status FROM unavailable_times WHERE date = ? AND time_slot = ?');
$query->execute([$date, $timeSlot]);
$currentStatus = $query->fetchColumn();

// Yeni durumu belirle
$newStatus = ($currentStatus === 'unavailable') ? 'available' : 'unavailable';

// Durumu güncelle
if ($currentStatus) {
    $updateQuery = $baglanti->prepare('UPDATE unavailable_times SET status = ? WHERE date = ? AND time_slot = ?');
    $updateQuery->execute([$newStatus, $date, $timeSlot]);
} else {
    $insertQuery = $baglanti->prepare('INSERT INTO unavailable_times (date, time_slot, status) VALUES (?, ?, ?)');
    $insertQuery->execute([$date, $timeSlot, $newStatus]);
}

echo $newStatus;
