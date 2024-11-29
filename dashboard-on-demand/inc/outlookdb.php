<?php
// Database connection parameters for the second database
$host4 = 'localhost';
$dbname4 = 'outlook';
$dsn4 = "mysql:host=$host4;dbname=$dbname4;charset=$charset";

try {
    $baglanti4 = new PDO($dsn4, $username, $password, $options);
    $baglanti4->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error for pedicab_driver_registration database: ' . $e->getMessage();
    exit;
}	
?>