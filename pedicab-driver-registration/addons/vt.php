<?php
$host = 'localhost';
$dbname = 'pedicab_driver_registration';
$username = 'dashboard';
$password = 'Ogulcan07!?!';
$charset = 'utf8';
//$collate = 'utf8_unicode_ci';
$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_PERSISTENT => false,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    //   PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
];
try {
    $baglanti = new PDO($dsn, $username, $password, $options);
    $baglanti->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Bağlantı hatası: ' . $e->getMessage();
    exit;
}
function generateUUID()
{
    return bin2hex(random_bytes(16));
}
?>