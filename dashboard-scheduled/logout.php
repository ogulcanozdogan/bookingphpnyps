<?php
session_start();
session_destroy();
	error_reporting(E_ALL);
ini_set("display_errors", 1);

setcookie("cerez", "", time()-3600);

header("location:login.php");

?>