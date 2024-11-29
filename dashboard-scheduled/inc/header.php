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
                            <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.php" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="17">
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

                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $name . " " . $surname; ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"><?=ucfirst($perm);?></span>
                            </span>
                        </span>
                    </button>
                 
                </div>
            </div>
        </div>
    </div>
</header>
