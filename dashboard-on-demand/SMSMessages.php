<?php ob_start(); ?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 

$title = "SMS Dashboard";
$description = $sonucayar['siteaciklamasi'];
?>
<meta content="<?= $description ?>" name="description" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="assets/js/sweetalert.min.js"></script>
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card .card-header {
        background-color: #f8f9fa;
    }
    .card h4 {
        font-weight: 700;
    }
    .message-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: transform 0.2s;
    }
    .message-card:hover {
        transform: scale(1.02);
    }
    .message-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }
    .message-body {
        padding: 15px;
    }
    .message-footer {
        background-color: #f1f1f1;
        padding: 10px;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    .phone-number {
        font-weight: bold;
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


// Fetch messages from the database
$query = $baglanti->prepare("SELECT * FROM messages ORDER BY sent_at DESC");
$query->execute();
$messages = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Incoming SMS Messages</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <?php foreach ($messages as $message): ?>
                                <div class="message-card">
                                    <div class="message-header">
										<div class="phone-number">Customer: <?= htmlspecialchars($message['name']); ?></div>
                                        <div class="phone-number">Number: <?= htmlspecialchars($message['phone_number']); ?></div>
                                    </div>
                                    <div class="message-body">
                                        <p><?= nl2br(htmlspecialchars($message['body'])); ?></p>
                                    </div>
                                    <div class="message-footer">
                                        <small>Received at: <?= date('F j, Y, g:i A', strtotime($message['sent_at'])); ?></small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<?php 
include('inc/footer.php');
include('inc/scripts.php');?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
