<?php	
 session_start(); //oturum başlattık

ob_start(); 
if (isset($_SESSION["Oturumondemand"]) && $_SESSION["Oturumondemand"] == "6789ondemand") {
    // Eğer veriler doğru ise sayfaya girmesine izin veriyoruz
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("location:logout.php");
        exit();
    }
    
    $user = $_SESSION["user"];
    $sorgu = $baglanti->prepare("SELECT * FROM users WHERE user = :user");
    $sorgu->bindParam(':user', $user);
    $sorgu->execute();
    $sonuc = $sorgu->fetch(); // Sorgu çalıştırılıp veriler alınıyor
    
    if ($sonuc) {
        $verify = $sonuc['verify'];
        if ($verify == 0) {
            header("location:activation.php");
            exit();
        }
    } else {
        header("location:logout.php");
        exit();
    }
} else {
    header("location:logout.php");
    exit();
}



?>
   <link rel="shortcut icon" href="vendor/favicon.ico">
<meta charset="utf-8" />
   <title><?php 
$sorguayar = $baglanti->prepare("SELECT * FROM ayarlar WHERE dil=0");
$sorguayar->execute();
$sonucayar = $sorguayar->fetch();//sorgu çalıştırılıp veriler alınıyor
if (isset($title)){
	echo $title . " | " . $sonucayar['sitebasligi'];
	
}

else {
	
	echo $sonucayar['sitebasligi'];
}
 ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Ogulcan Ozdogan" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- jsvectormap css -->
    <link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
	<!-- <script src="assets/js/effect.js"></script> -->
</head>