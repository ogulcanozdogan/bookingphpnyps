<?php 	 
$user = $_SESSION["user"];
$sorgu = $baglanti->query("select * from users where user='$user'");
$sonuc = $sorgu->fetch();
if (!$sonuc){
		    header("location:logout.php");
		
	}
$name = $sonuc["name"];
$surname = $sonuc["surname"];
$perm = $sonuc["perm"];
$user = $_SESSION["user"];


// Rastgele kullanıcı bilgileri ve avatar almak için Random User Generator API'sini kullanıyoruz
$apiUrl = 'https://randomuser.me/api/?gender=male';

// cURL oturumu başlat
$ch = curl_init();

// cURL seçeneklerini ayarla
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// API yanıtını al
$response = curl_exec($ch);

// cURL oturumunu kapat
curl_close($ch);

// API yanıtını JSON formatından diziye dönüştür
$data = json_decode($response, true);

// Rastgele kullanıcının avatar URL'sini al
$avatarUrl = $data['results'][0]['picture']['large'];

										  ?>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.php" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

     
            </div>

            <div class="d-flex align-items-center">

             


                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>
				
				<div class="ms-1 header-item d-none d-sm-flex">
                    <a href="logout.php" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class=' bx bx-user-x fs-22'></i>
                    </a>
                </div>

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?=$avatarUrl?>" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $name . " " . $surname; ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"><?=$perm?></span>
                            </span>
                        </span>
                    </button>
                 
                </div>
            </div>
        </div>
    </div>
</header>