<?php
include('inc/init.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";
require_once "inc/db.php";
require_once "whatsapp.php";

if (!$_POST) {
	header("location: index.php");
		exit;
}

$firstName = htmlspecialchars($_POST["firstName"]);
$lastName = htmlspecialchars($_POST["lastName"]);
$emailAddress = htmlspecialchars($_POST["emailAddress"]);
$phoneNumber = str_replace("whatsapp:", "", $_POST["phoneNumber"]);
$numPassengers = htmlspecialchars($_POST["numPassengers"]);
$pickUpAddress = htmlspecialchars($_POST["pickUpAddress"]);
$destinationAddress = htmlspecialchars($_POST["destinationAddress"]);
$paymentMethod = htmlspecialchars($_POST["paymentMethod"]);
$rideDuration = htmlspecialchars($_POST["rideDuration"]);
$bookingFee = htmlspecialchars($_POST["bookingFee"]);
$driverFare = htmlspecialchars($_POST["driverFare"]);
$totalFare = htmlspecialchars($_POST["totalFare"]);
$orderMonth = htmlspecialchars($_POST["orderMonth"]);
$orderDay = htmlspecialchars($_POST["orderDay"]);
$orderYear = htmlspecialchars($_POST["orderYear"]);
$current_time = htmlspecialchars($_POST["current_time"]);
$pickUpDate = htmlspecialchars($_POST["pickUpDate"]);
$bookingNumber = htmlspecialchars($_POST["bookingNumber"]);
$current_time = htmlspecialchars($_POST["current_time"]);

$date = DateTime::createFromFormat("m/d/Y", $pickUpDate);

if ($date) {
    // Format to get the day name
    $pickUpDay = $date->format("l");
}

$orderDate = $orderMonth . "/" . $orderDay . "/" . $orderYear;

$dateOrder = DateTime::createFromFormat("m/d/Y", $orderDate);

if ($dateOrder) {
    // Format to get the day name
    $dayOfOrder = $dateOrder->format("l");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Book On Demand Point A to B Pedicab Ride</title>
	  <meta name="description" content="On Demand Point A to B Pedicab Ride Booking Application">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Booking Confirmation</h2>
                  <div class="text-center mb-4">
                    <b>Thank you for choosing New York Pedicab Services</b><br>
					<b>Below are the confirmed details of your booking:</b>
                  </div>
                <table class="table">
                    <tbody>
					    <tr>
                            <th scope="row">Booking Number</th>
                            <td><?=$bookingNumber?></td>
                        </tr>
                        <tr>
                            <th scope="row">Type</th>
                            <td>On Demand Point A to B Pedicab Ride</td>
                        </tr>
                        <tr>
                            <th scope="row">First Name</th>
                            <td><?= $firstName ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Last Name</th>
                            <td><?= $lastName ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email Address</th>
                            <td><?= $emailAddress ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone Number</th>
                            <td><?= $phoneNumber ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Number of Passengers</th>
                            <td><?= $numPassengers ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date of Pick Up</th>
                            <td><?= $orderMonth .
                                "/" .
                                $orderDay .
                                "/" .
                                $orderYear . ' ' . $dayOfOrder ?> (Today)</td>
                        </tr>
                        <tr>
                            <th scope="row">Time of Pick Up</th>
                            <td><?= $current_time ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Duration of Ride</th>
                            <td><?= $rideDuration ?> Minutes</td>
                        </tr>

                        <tr>
                            <th scope="row">Pick Up Address</th>
                            <td><?= $pickUpAddress ?></td>
                        </tr>
						 <tr>
                            <th scope="row">Destination Address</th>
                            <td><?= $destinationAddress ?></td>
                        </tr>
<?php 

if ($paymentMethod == "CARD" or $paymentMethod == "card"){
	$paymentMethod = "debit/credit card";
}
if ($paymentMethod == "CASH" or $paymentMethod == "cash"){
	$paymentMethod = "CASH";
}
?>
                        <tr>
                            <th scope="row">Booking Fee</th>
                            <td>$<?= number_format($bookingFee, 2) ?> paid on <?= $orderMonth .
     "/" .
     $orderDay .
     "/" .
     $orderYear .
     " " .
     $dayOfOrder ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Driver Fare</th>
                            <td>$<?= number_format($driverFare, 2) ?>  with <?= $paymentMethod ?> due on <?= $orderMonth .
     "/" .
     $orderDay .
     "/" .
     $orderYear .
     " " .
     $dayOfOrder ?></td>
                        </tr>
						<tr style="background-color:green;">
                            <th scope="row" style="color:white;">Total Fare</th>
                            <td><b style="color:white;">$<?= number_format($totalFare, 2) ?></b></td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <strong>Thank you,</strong><br>
                    <strong>New York Pedicab Services</strong><br>
                    <strong><a href="tel:2129617435">(212) 961-7435</a></strong><br>
                    <strong><a href="mailto:info@newyorkpedicabservices.com" target="_blank">info@newyorkpedicabservices.com</a></strong><br>
                    <strong><a href="https://newyorkpedicabservices.com" target="_blank">newyorkpedicabservices.com</a></strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
