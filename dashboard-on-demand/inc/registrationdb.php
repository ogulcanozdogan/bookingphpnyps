<?php
// Database connection parameters for the second database
$host2 = 'localhost';
$dbname2 = 'pedicab_driver_registration';
$dsn2 = "mysql:host=$host2;dbname=$dbname2;charset=$charset";

try {
    $baglanti2 = new PDO($dsn2, $username, $password, $options);
    $baglanti2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error for pedicab_driver_registration database: ' . $e->getMessage();
    exit;
}	
?>