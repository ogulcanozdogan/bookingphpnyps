<?php 
require 'inc/vt.php';
if (isset($_GET['id'])){
	$id = $_GET['id'];
	$sorgu = $baglanti->prepare("SELECT * FROM registration WHERE id=:id");
	$sorgu->execute(['id' => $id]);
	$sonuc = $sorgu->fetch();
	
	header('location: https://newyorkpedicabservices.com/pedicab-driver-registration/signs/' . $sonuc['pdf_link']);
}
else {
	header('location: https://newyorkpedicabservices.com');
}
?>