<?php
include('inc/vt.php'); 
if ($_GET) {
    if ($_GET['process'] && $_GET['id']) {
        $table = "users";
        $process = $_GET['process'];
        $driverid = $_GET['id'];


            $sorgu = $baglanti->prepare("SELECT * FROM $table WHERE id=:driverid");
            $sorgu->execute(['driverid' => $driverid]);
            $sonuc = $sorgu->fetch();

            if ($process == 'verify') {

// Veri güncelleme sorgusu
$sql = "UPDATE $table SET verify=1 WHERE id=:driverid";
$durum = $baglanti->prepare($sql)->execute(['driverid' => $driverid]);

 

                if ($durum) {
                    header('location: admin_verify_drivers.php');
                } else {
                    echo "SQL Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
                }
            } elseif ($process == 'delete') {
				$durum = $baglanti->prepare("DELETE FROM $table WHERE id=:driverid")->execute(['driverid' => $driverid]);
			if ($durum) {
			header("location:admin_drivers.php"); // Eğer sorgu çalışırsa index.php sayfasına gönderiyoruz.
			}
            } else {
                header('location:admin_drivers.php');
            }
 
    } else {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}
?>
