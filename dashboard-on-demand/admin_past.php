<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "Dashboard";
$descripton = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$descripton?>" name="description" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="assets/js/sweetalert.min.js"></script>
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        min-width: 250px;
        max-width: 250px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        user-select: none; /* Metin seçimini engellemek için */
    }
    .card .card-body {
        background-color: #f8f9fa;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card h5 {
        font-weight: 700;
    }
    .pay-amount {
        font-size: 1.1rem;
        font-weight: 600;
    }
    .navbar, .footer {
        background-color: #343a40;
        color: white;
    }
    .navbar a, .footer a {
        color: white;
    }
    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .scrolling-wrapper {
        display: flex;
        overflow-x: auto;
        padding: 10px;
        scroll-behavior: smooth;
        user-select: none; /* Metin seçimini engellemek için */
    }
    .scrolling-wrapper .card {
        margin-right: 15px;
    }
    .scroll-button {
        background-color: #000000;
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s, box-shadow 0.3s;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .scroll-button:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 8px rgba(0,0,0,0.1);
    }
    .scroll-button:focus {
        outline: none;
    }
    .scroll-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .card-bottom {
        margin-top: auto;
    }
    .badge-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }
</style>
</head>
<body>
<?php
include('inc/header.php');
if ($perm != "admin") { 
    header('location: index.php');
}
include('inc/navbar.php');
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Point A to B Pedicab Rides -->
                <div class="col-12">
                    <h2 class="section-title">Last 15 Point A to B Pedicab Rides [PAST]</h2>
                    <hr>
                    <div class="scroll-buttons">
                        <button class="scroll-button" onclick="scrollToStart('pointatob-scroll')"><i class="fa fa-chevron-left"></i></button>
                        <button class="scroll-button" onclick="scrollToEnd('pointatob-scroll')"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div id="pointatob-scroll" class="scrolling-wrapper">
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE status = 'past' ORDER BY createdAt DESC LIMIT 15");
                        $sorgu->execute();
                        $counter = 1;
                        while ($sonuc = $sorgu->fetch()) {
                            $drivername = $sonuc["driver"];
                            $sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = :drivername");
                            $sorgu2->execute(['drivername' => $drivername]);
                            $sonuc2 = $sorgu2->fetch();
                            $drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];
                        ?>
                        <div class="card">
                            <div class="card-body position-relative">
                                <h5 class="mb-3">Point A to B Pedicab Ride</h5>
                                <div class="vstack gap-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                    <i class="ri-apps-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Booking Number</h6>
                                            <b class="pay-amount"><?= htmlspecialchars($sonuc['bookingNumber']) ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <form method="POST" action="detailsatob.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                        <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                        <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                        <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Details" />
                                    </form>
                                    <div class="badge-container">
                                        <span class="badge bg-secondary">Driver: <?= $drivernamesurname ?></span>
                                        <?php if ($counter == 1): ?>
                                            <span class="badge bg-info">Last Tour</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $counter ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                        }
                        ?>
                    </div>
                </div>

                <!-- Hourly Pedicab Rides -->
                <div class="col-12">
                    <h2 class="section-title">Last 15 Hourly Pedicab Services [PAST]</h2>
                    <hr>
                    <div class="scroll-buttons">
                        <button class="scroll-button" onclick="scrollToStart('hourly-scroll')"><i class="fa fa-chevron-left"></i></button>
                        <button class="scroll-button" onclick="scrollToEnd('hourly-scroll')"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div id="hourly-scroll" class="scrolling-wrapper">
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE status = 'past' ORDER BY createdAt DESC LIMIT 15");
                        $sorgu->execute();
                        $counter = 1;
                        while ($sonuc = $sorgu->fetch()) {
                            $drivername = $sonuc["driver"];
                            $sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = :drivername");
                            $sorgu2->execute(['drivername' => $drivername]);
                            $sonuc2 = $sorgu2->fetch();
                            $drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];
                        ?>
                        <div class="card">
                            <div class="card-body position-relative">
                                <h5 class="mb-3">Hourly Pedicab Service</h5>
                                <div class="vstack gap-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                    <i class="ri-apps-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Booking Number</h6>
                                            <b class="pay-amount"><?= htmlspecialchars($sonuc['bookingNumber']) ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <form method="POST" action="detailshourly.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                        <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                        <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                        <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Details" />
                                    </form>
                                    <div class="badge-container">
                                        <span class="badge bg-secondary">Driver: <?= $drivernamesurname ?></span>
                                        <?php if ($counter == 1): ?>
                                            <span class="badge bg-info">Last Tour</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $counter ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                        }
                        ?>
                    </div>
                </div>

                <!-- Central Park Tours -->
                <div class="col-12">
                    <h2 class="section-title">Last 15 Central Park Pedicab Tours [PAST]</h2>
                    <hr>
                    <div class="scroll-buttons">
                        <button class="scroll-button" onclick="scrollToStart('centralpark-scroll')"><i class="fa fa-chevron-left"></i></button>
                        <button class="scroll-button" onclick="scrollToEnd('centralpark-scroll')"><i class="fa fa-chevron-right"></i></button>
                    </div>
                    <div id="centralpark-scroll" class="scrolling-wrapper">
                        <?php
                        $sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE status = 'past' ORDER BY createdAt DESC LIMIT 15");
                        $sorgu->execute();
                        $counter = 1;
                        while ($sonuc = $sorgu->fetch()) {
                            $drivername = $sonuc["driver"];
                            $sorgu2 = $baglanti->prepare("SELECT * FROM users WHERE user = :drivername");
                            $sorgu2->execute(['drivername' => $drivername]);
                            $sonuc2 = $sorgu2->fetch();
                            $drivernamesurname = $sonuc2["name"] . ' ' . $sonuc2["surname"];
                        ?>
                        <div class="card">
                            <div class="card-body position-relative">
                                <h5 class="mb-3">Central Park Pedicab Tour</h5>
                                <div class="vstack gap-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                                    <i class="ri-apps-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1">Booking Number</h6>
                                            <b class="pay-amount"><?= htmlspecialchars($sonuc['bookingNumber']) ?></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-bottom">
                                    <form method="POST" action="detailscentralpark.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                                        <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                                        <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                                        <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Details" />
                                    </form>
                                    <div class="badge-container">
                                        <span class="badge bg-secondary">Driver: <?= $drivernamesurname ?></span>
                                        <?php if ($counter == 1): ?>
                                            <span class="badge bg-info">Last Tour</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $counter ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $counter++;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
<?php 
include('inc/footer.php');
include('inc/scripts.php');
?>
<script>
function scrollToStart(id) {
    document.getElementById(id).scrollTo({ left: 0, behavior: 'smooth' });
}

function scrollToEnd(id) {
    let element = document.getElementById(id);
    element.scrollTo({ left: element.scrollWidth, behavior: 'smooth' });
}

document.querySelectorAll('.scrolling-wrapper').forEach(wrapper => {
    let isDown = false;
    let startX;
    let scrollLeft;

    wrapper.addEventListener('mousedown', (e) => {
        isDown = true;
        wrapper.classList.add('active');
        startX = e.pageX - wrapper.offsetLeft;
        scrollLeft = wrapper.scrollLeft;
        wrapper.style.cursor = 'grabbing'; // cursor değiştirme
    });

    wrapper.addEventListener('mouseleave', () => {
        isDown = false;
        wrapper.classList.remove('active');
        wrapper.style.cursor = 'default'; // cursor değiştirme
    });

    wrapper.addEventListener('mouseup', () => {
        isDown = false;
        wrapper.classList.remove('active');
        wrapper.style.cursor = 'default'; // cursor değiştirme
    });

    wrapper.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - wrapper.offsetLeft;
        const walk = (x - startX) * 2; // scroll-fast
        wrapper.scrollLeft = scrollLeft - walk;
    });
});
</script>
</body>
</html>
