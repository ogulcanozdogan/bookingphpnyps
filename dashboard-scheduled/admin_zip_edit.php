<?php
ob_start(); error_reporting(E_ALL);
ini_set("display_errors", 1);?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
<?php 
include('inc/vt.php'); 
include('inc/head.php'); 
// Tarayıcıdan gelen 'id' parametresini al
$app_id = isset($_GET['id']) ? intval($_GET['id']) : 1; // Varsayılan olarak app_id = 1
$title = "Rates Management";
$description = $sonucayar['siteaciklamasi'];?>
<meta content="<?=$description?>" name="description" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }
        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        .card-title {
            font-weight: 700;
        }
        .zip-code-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .zip-item {
            flex: 1 1 100px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            min-width: 100px;
        }
        .zip-item input {
            width: 60%;
            border: none;
            background: transparent;
            text-align: center;
        }
        .zip-item button {
            border: none;
            background: transparent;
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
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
			 <a href="admin_zip_codes.php" class="btn btn-danger btn-sm" style="float: left;"><-</a>
            <h4  class="card-title mb-0 flex-grow-1" style="text-align: center;">Zip Code Management (<?php if (htmlspecialchars($app_id) == 1){
				echo 'Central Park Tour';
			} 
			else if (htmlspecialchars($app_id) == 2){
				echo 'Hourly Service';
			}
			else if (htmlspecialchars($app_id) == 3){
				echo 'Point A to B';
			}
			?>)</h4>
        </div>
        <div class="card-body">
            <form id="zipForm">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="zip_code" placeholder="Enter Zip Code" required>
                    <input type="hidden" id="app_id" value="<?= htmlspecialchars($app_id) ?>">
                    <button class="btn btn-primary" type="submit">Add Zip Code</button>
                </div>
            </form>
            <div id="zipList" class="zip-code-list"></div>
        </div>
    </div>
</div>
               </div>
            </div>
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
<script>
$(document).ready(function() {
    // ZIP kodlarını yükle
    loadZipCodes();

    // Zip kodu ekle
    $('#zipForm').on('submit', function(e) {
        e.preventDefault();
        let zip_code = $('#zip_code').val();
        let app_id = $('#app_id').val();
        $.ajax({
            url: 'zip_codes_action.php',
            type: 'POST',
            data: {action: 'add', zip_code: zip_code, app_id: app_id},
            success: function(response) {
                $('#zip_code').val('');
                loadZipCodes();
            }
        });
    });

    // Zip kodlarını yükleyen fonksiyon
    function loadZipCodes() {
        let app_id = $('#app_id').val();
        $.ajax({
            url: 'zip_codes_action.php',
            type: 'POST',
            data: {action: 'load', app_id: app_id},
            success: function(data) {
                $('#zipList').html(data);
            }
        });
    }

    // Zip kodu güncelleme
    $(document).on('blur', '.zip-input', function() {
        let id = $(this).data('id');
        let new_zip = $(this).val();
        $.ajax({
            url: 'zip_codes_action.php',
            type: 'POST',
            data: {action: 'update', id: id, new_zip: new_zip},
            success: function(response) {
                loadZipCodes();
            }
        });
    });

    // Zip kodu sil
    $(document).on('click', '.deleteZip', function() {
        let id = $(this).data('id');
        $.ajax({
            url: 'zip_codes_action.php',
            type: 'POST',
            data: {action: 'delete', id: id},
            success: function(response) {
                loadZipCodes();
            }
        });
    });
});
</script>

<?php 
include('inc/footer.php');
include('inc/scripts.php');?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>