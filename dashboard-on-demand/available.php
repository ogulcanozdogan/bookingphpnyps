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
    }
    .card .card-body {
        background-color: #f8f9fa;
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
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php
include('inc/header.php');
include('inc/navbar.php');
if ($sayac > 0){
    header('location: pending.php');
    exit;
}
?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Point A to B Pedicab Rides -->
                <div class="col-12">
                    <h2 class="mb-3">Point A to B Rides</h2>
                    <hr>
                    <div class="row" id="pointatob-container">
                        <!-- Point A to B content will be loaded here by AJAX -->
                    </div>
                </div>

                <!-- Hourly Pedicab Rides -->
                <div class="col-12">
                    <h2 class="mb-3">Hourly Services</h2>
                    <hr>
                    <div class="row" id="hourly-container">
                        <!-- Hourly content will be loaded here by AJAX -->
                    </div>
                </div>

                <!-- Central Park Tours -->
                <div class="col-12">
                    <h2 class="mb-3">Central Park Tours</h2>
                    <hr>
                    <div class="row" id="centralpark-container">
                        <!-- Central Park content will be loaded here by AJAX -->
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
    document.querySelectorAll("form[id^='accept-form-']").forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            swal({
                title: 'Are you sure?',
                text: 'Do you want to accept this booking?',
                icon: 'info',
                buttons: {
                    cancel: {
                        text: 'No',
                        value: null,
                        visible: true,
                        className: '',
                        closeModal: true,
                    },
                    confirm: {
                        text: 'Yes',
                        value: true,
                        visible: true,
                        className: '',
                        closeModal: true,
                        style: 'background-color: blue; color: white;'
                    }
                },
                dangerMode: true,
            }).then((willAccept) => {
                if (willAccept) {
                    form.submit();
                } else {
                    swal('Action cancelled', 'The booking was not accepted.', 'info');
                }
            });
        });
    });

    function startCountdown(duration, display, button, card) {
        var timer = duration, minutes, seconds;
        var countdownInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (timer <= 60) {
                display.style.color = "red";
            }

            if (--timer < 0) {
                clearInterval(countdownInterval);
                display.textContent = "Expired";
                display.style.color = "red";
                button.disabled = true;
                card.style.display = "none";
            }
        }, 1000);
    }

    function loadData() {
        $.ajax({
            url: 'load_pedicab_data.php',
            method: 'GET',
            success: function(data) {
                var response = JSON.parse(data);
                $('#pointatob-container').html(response.pointatob);
                $('#hourly-container').html(response.hourly);
                $('#centralpark-container').html(response.centralpark);

                document.querySelectorAll("form[id^='accept-form-']").forEach(form => {
                    form.addEventListener("submit", function(event) {
                        event.preventDefault();
                        swal({
                            title: 'Are you sure?',
                            text: 'Do you want to accept this booking?',
                            icon: 'info',
                            buttons: {
                                cancel: {
                                    text: 'No',
                                    value: null,
                                    visible: true,
                                    className: '',
                                    closeModal: true,
                                },
                                confirm: {
                                    text: 'Yes',
                                    value: true,
                                    visible: true,
                                    className: '',
                                    closeModal: true,
                                    style: 'background-color: blue; color: white;'
                                }
                            },
                            dangerMode: true,
                        }).then((willAccept) => {
                            if (willAccept) {
                                form.submit();
                            } else {
                                swal('Action cancelled', 'The booking was not accepted.', 'info');
                            }
                        });
                    });
                });

                document.querySelectorAll('.countdown').forEach(function(element) {
                    var duration = element.dataset.remainingTime;
                    var card = element.closest('.card');
                    var button = card.querySelector('input[type=submit]');
                    startCountdown(duration, element, button, card);
                });
            }
        });
    }

    $(document).ready(function() {
        loadData(); 
        setInterval(loadData, 5000); 
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
