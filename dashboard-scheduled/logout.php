<?php
session_start();
session_destroy();
	error_reporting(E_ALL);
ini_set("display_errors", 1);

//çerezi siliyoruz
setcookie("cerez", "", time()-3600);

//sayfayı yönlendiriyoruz
header("location:login.php");

?>