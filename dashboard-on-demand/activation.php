<?php session_start(); //oturum başlattık

ob_start();  ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); ?>
<link rel="shortcut icon" href="vendor/favicon.ico">
<meta charset="utf-8" />
<title><?php
$sorguayar = $baglanti->prepare("SELECT * FROM ayarlar WHERE dil=0");
$sorguayar->execute();
$sonucayar = $sorguayar->fetch();
if (isset($title)) {
    echo $title . " | " . $sonucayar['sitebasligi'];
} else {
    echo $sonucayar['sitebasligi'];
}
?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Ogulcan Ozdogan" name="author" />
<link rel="shortcut icon" href="assets/images/favicon.ico">
<link href="assets/libs/jsvectormap/css/jsvectormap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />
<script src="assets/js/layout.js"></script>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
<link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />
</head>

<?php
$title = "Activation";
$descripton = $sonucayar['siteaciklamasi']; ?>
<meta content="<?=$descripton?>" name="description" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .earnings-card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .earnings-card h4 {
        font-weight: 700;
    }
    .earnings-amount {
        font-size: 2rem;
        color: green;
    }
    .navbar, .footer {
        background-color: #343a40;
        color: white;
    }
    .navbar a, .footer a {
        color: white;
    }
    .disabled-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .glitch {
        font-size: 2rem;
        font-weight: bold;
        color: red;
        position: relative;
        text-align: center;
        overflow: hidden;
        line-height: 1.5;
    }
    .glitch::before, .glitch::after {
        content: attr(data-text);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
    }
    .glitch::before {
        left: 2px;
        text-shadow: -2px 0 red;
        animation: glitchTop 1.5s infinite linear alternate-reverse;
    }
    .glitch::after {
        left: -2px;
        text-shadow: -2px 0 blue;
        animation: glitchBotom 1.5s infinite linear alternate-reverse;
    }
    @keyframes glitchTop {
        0% {
            clip: rect(42px, 9999px, 44px, 0);
            transform: translate(0);
        }
        10% {
            clip: rect(85px, 9999px, 10px, 0);
            transform: translate(-5px, -5px);
        }
        20% {
            clip: rect(64px, 9999px, 10px, 0);
            transform: translate(5px, 5px);
        }
        30% {
            clip: rect(44px, 9999px, 36px, 0);
            transform: translate(-5px, -5px);
        }
        40% {
            clip: rect(24px, 9999px, 56px, 0);
            transform: translate(5px, 5px);
        }
        50% {
            clip: rect(84px, 9999px, 76px, 0);
            transform: translate(-5px, -5px);
        }
        60% {
            clip: rect(44px, 9999px, 36px, 0);
            transform: translate(5px, 5px);
        }
        70% {
            clip: rect(74px, 9999px, 56px, 0);
            transform: translate(-5px, -5px);
        }
        80% {
            clip: rect(24px, 9999px, 56px, 0);
            transform: translate(5px, 5px);
        }
        90% {
            clip: rect(44px, 9999px, 36px, 0);
            transform: translate(-5px, -5px);
        }
        100% {
            clip: rect(64px, 9999px, 76px, 0);
            transform: translate(0);
        }
    }
    @keyframes glitchBotom {
        0% {
            clip: rect(44px, 9999px, 56px, 0);
            transform: translate(0);
        }
        10% {
            clip: rect(85px, 9999px, 10px, 0);
            transform: translate(5px, 5px);
        }
        20% {
            clip: rect(64px, 9999px, 10px, 0);
            transform: translate(-5px, -5px);
        }
        30% {
            clip: rect(44px, 9999px, 36px, 0);
            transform: translate(5px, 5px);
        }
        40% {
            clip: rect(24px, 9999px, 56px, 0);
            transform: translate(-5px, -5px);
        }
        50% {
            clip: rect(84px, 9999px, 76px, 0);
            transform: translate(5px, 5px);
        }
        60% {
            clip: rect(44px, 9999px, 36px, 0);
            transform: translate(-5px, -5px);
        }
        70% {
            clip: rect(74px, 9999px, 56px, 0);
            transform: translate(5px, 5px);
        }
        80% {
            clip: rect(24px, 9999px, 56px, 0);
            transform: translate(-5px, -5px);
        }
        90% {
            clip: rect(44px, 9999px, 36px, 0);
            transform: translate(5px, 5px);
        }
        100% {
            clip: rect(64px, 9999px, 76px, 0);
            transform: translate(0);
        }
    }
    .logout-btn {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 1rem;
        background-color: #343a40;
        color: white;
        border: none;
        border-radius: 5px;
    }
    .logout-btn:hover {
        background-color: #495057;
    }
    
</style>
</head>
<body>

<?php
$user = $_SESSION["user"];
$sorgu = $baglanti->query("SELECT * FROM users WHERE user='$user'");
$sonuc = $sorgu->fetch();
$name = $sonuc["name"];
$surname = $sonuc["surname"];
$perm = $sonuc["perm"];

// Başlangıç sayacını tanımla
$sayac = 0;

// Kontrol edilecek tablo isimleri
$tablolar = ['centralpark', 'hourly', 'pointatob'];

// Her tabloyu kontrol et
foreach ($tablolar as $tablo) {
    // Sorguyu hazırla ve çalıştır
    $sorgu = $baglanti->prepare("SELECT COUNT(*) as count FROM $tablo WHERE status='pending' AND driver=:user");
    $sorgu->execute([':user' => $user]);
    
    // Sonucu al
    $sonuc = $sorgu->fetch();
    
    // Sayacı artır
    if ($sonuc['count'] > 0) {
        $sayac += 1;
    }
}
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
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Unverified Driver</span>
                            </span>
                        </span>
                    </button>
                 
                </div>
            </div>
        </div>
    </div>
</header>

<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.php" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="https://newyorkpedicabservices.com/buttons_files/new-york-pedicab-services-banner.webp" style="margin-left:-10%;" alt="" height="57">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
					<?php // if ($perm != "admin") { ?>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Driver Menu</span></li>
						<li class="nav-item">
                            <a class="nav-link menu-link" href="index.php">
                                <i class="bx bxs-dashboard"></i> <span data-key="t-dashboards">Your Dashboard</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="available.php">
                                <i class="bx bxs-pin"></i> <span data-key="t-dashboards">Available</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="pending.php">
                                <i class="bx bx-time-five"></i> <span data-key="t-dashboards">Pending</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="past.php">
                                <i class="bx bx-history"></i> <span data-key="t-dashboards">Past</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
				 <?php // } ?>
					<?php if ($perm == "admin") { ?>
					 <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Admin Menu</span></li>
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_drivers.php">
                                <i class="bx bx-user-pin"></i> <span data-key="t-dashboards">Verified Drivers</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_verify_drivers.php">
                                <i class="bx bx-user-pin"></i> <span data-key="t-dashboards">Driver Verification</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="admin_available.php">
                                <i class="bx bxs-pin"></i> <span data-key="t-dashboards">Available</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_pending.php">
                                <i class="bx bx-time-five"></i> <span data-key="t-dashboards">Pending</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_past.php">
                                <i class="bx bx-history"></i> <span data-key="t-dashboards">Past</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_failed.php">
                                <i class="bx bx-x"></i> <span data-key="t-dashboards">Failed</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
						<li class="nav-item">
                            <a class="nav-link menu-link" href="admin_earnings.php">
                                <i class="bx bx-money-withdraw"></i> <span data-key="t-dashboards">Earnings</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
					
					
					<?php } ?>
					<ul class="navbar-nav" id="navbar-nav">
						<li class="nav-item">
                            <a class="nav-link menu-link" href="logout.php">
                                <i class="bx bx-power-off"></i> <span data-key="t-dashboards">Logout</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->
                    </ul>
                </div>
                <!-- Sidebar -->
					
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">

                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Hello, <?php echo $name . ' ' . $surname; ?></h4>
                                    </div>
                                </div><!-- end card header --> 
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div> <!-- end .h-100-->

                </div> <!-- end col -->

            </div>

        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <div class="disabled-overlay">
        <div class="glitch" data-text="Your account is awaiting verification. Please contact the admin.">
            Your account is awaiting verification.
        </div>
        <div class="glitch" data-text="For any inquiries, please reach out to the support team.">
            Please contact the admin.
        </div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    </div>

<?php 
include('inc/footer.php');
include('inc/scripts.php');?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>
