<?php
session_start(); //oturum başlattık

ob_start(); 

//oturumdaki bilgilerin doğruluğunu kontrol ediyoruz
if (isset($_SESSION["Oturumondemand"]) && $_SESSION["Oturumondemand"] == "6789ondemand") {
    //eğer veriler doğru ise sayfaya girmesine izin veriyoruz
    $user = $_SESSION["user"];
	if (!$user){
		    header("location:logout.php");
		
	}
} else {
    header("location:logout.php");
}
	include('inc/vt.php'); 
	include('inc/registrationdb.php'); 
	
	$pdf_id = $_GET['pdf_id'];
	if (!$pdf_id) {
		die('pdf_id parameter is missing.');
	}

	try {
		$sorgu = $baglanti2->prepare("SELECT * FROM registration WHERE id = :pdf_id");
		$sorgu->execute(['pdf_id' => $pdf_id]);
		$sonuc = $sorgu->fetch();
		
		if (!$sonuc) {
			die('No record found for the provided pdf_id.');
		}
	} catch (PDOException $e) {
		die('Database error: ' . $e->getMessage());
	}
	
$pdf_link = $sonuc['pdf_link'];

header("Location: https://newyorkpedicabservices.com/pedicab-driver-registration/signs/$pdf_link");
exit; // Kodun devam etmemesi için exit ekleyin
?>