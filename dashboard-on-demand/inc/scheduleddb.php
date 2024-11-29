<?php
$host3 = 'localhost';
$dbname3 = 'PedicabsScheduled';
$username = 'dashboard';
$password = 'Ogulcan07!?!';
$charset = 'utf8';
//$collate = 'utf8_unicode_ci';
$dsn3 = "mysql:host=$host3;dbname=$dbname3;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];
try {
    $baglanti3 = new PDO($dsn3, $username, $password, $options);
    $baglanti3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Bağlantı hatası: ' . $e->getMessage();
    exit;
}
?>