<?php 	 session_start(); //oturum başlattık

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
?>
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

</head>