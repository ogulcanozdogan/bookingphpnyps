<?php
include('inc/vt.php'); 
if ($_GET) {
    if ($_GET['table'] && $_GET['process'] && $_GET['id']) {
        $table = $_GET['table'];
        $process = $_GET['process'];
        $driverid = $_GET['id'];

        if ($table == 'users_temporary') {
            $sorgu = $baglanti->prepare("SELECT * FROM $table WHERE id=:driverid");
            $sorgu->execute(['driverid' => $driverid]);
            $sonuc = $sorgu->fetch();

            if ($process == 'verify') {
                $user = $sonuc['user'];
                $name = $sonuc['name'];
                $surname = $sonuc['surname'];
                $email = $sonuc['email'];
                $perm = $sonuc['perm'];
                $number = $sonuc['number'];
                $pass = $sonuc['pass'];

                $durum = $baglanti->prepare("DELETE FROM $table WHERE id=:driverid")->execute(['driverid' => $driverid]);

                $satir = [
                    'user' => $user,
                    'pass' => $pass,
                    'name' => $name,
                    'surname' => $surname,
                    'email' => $email,
                    'number' => $number,
                    'perm' => $perm,
                ];

                $sql = "INSERT INTO users (user, pass, name, surname, email, number, perm) VALUES (:user, :pass, :name, :surname, :email, :number, :perm)";
                $stmt = $baglanti->prepare($sql);
                $durum = $stmt->execute($satir);

                if ($durum) {
                    header('location: admin_verify_drivers.php');
                } else {
                    echo "SQL Error: " . implode(", ", $stmt->errorInfo()) . "<br>";
                }
            } elseif ($process == 'delete') {
				$durum = $baglanti->prepare("DELETE FROM $table WHERE id=:driverid")->execute(['driverid' => $driverid]);
			if ($durum) {
			header("location:admin_verify_drivers.php");
			}
            } else {
                header('location: admin_drivers.php');
            }
        } elseif ($table == 'users') {
             if ($process == 'delete') {
				 $durum = $baglanti->prepare("DELETE FROM $table WHERE id=:driverid")->execute(['driverid' => $driverid]);
			if ($durum) {
			header("location:admin_drivers.php");
			}
            } else {
                header('location: index.php');
            }
        }
    } else {
        header('location: index.php');
    }
} else {
    header('location: index.php');
}
?>
