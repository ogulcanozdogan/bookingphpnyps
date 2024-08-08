<?php
include('inc/init.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once "vendor/autoload.php";
require_once "inc/db.php";
require_once "whatsapp.php";
if (
    !isset(
        $_POST["firstName"],
        $_POST["lastName"],
        $_POST["emailAddress"],
        $_POST["phoneNumber"],
        $_POST["numPassengers"],
        $_POST["pickUpAddress"],
        $_POST["destinationAddress"],
        $_POST["paymentMethod"],
        $_POST["rideDuration"],
        $_POST["bookingFee"],
        $_POST["driverFare"],
        $_POST["totalFare"],
        $_POST["orderMonth"],
        $_POST["orderDay"],
        $_POST["orderYear"],
        $_POST["current_time"],
        $_POST["tourDuration"],
        $_POST["pickUpDate"]
    )
) {
    header("Location: index.php");
    exit();
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
$tourDuration = htmlspecialchars($_POST["tourDuration"]);
$pickUpDate = htmlspecialchars($_POST["pickUpDate"]);
$current_time = htmlspecialchars($_POST["current_time"]);

$date = DateTime::createFromFormat("m/d/Y", $pickUpDate);

if ($date) {
    // Gün ismini almak için formatla
    $pickUpDay = $date->format("l");
}

$orderDate = $orderMonth . "/" . $orderDay . "/" . $orderYear;

$dateOrder = DateTime::createFromFormat("m/d/Y", $orderDate);

if ($dateOrder) {
    // Gün ismini almak için formatla
    $dayOfOrder = $dateOrder->format("l");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Book On Demand Central Park Pedicab Tour</title>
	  <meta name="description" content=" On Demand Central Park Pedicab Tour Booking Application ">
	     <link rel="shortcut icon" href="vendor/favicon.ico">
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
                            <th scope="row">Type</th>
                            <td>On Demand Central Park Pedicab Tour</td>
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
                            <th scope="row">Date of Tour</th>
                            <td><?= $orderMonth .
                                "/" .
                                $orderDay .
                                "/" .
                                $orderYear . ' ' . $dayOfOrder ?> (Today)</td>
                        </tr>
                        <tr>
                            <th scope="row">Time of Tour</th>
                            <td><?= $current_time ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Duration of Tour</th>
                            <td><?= $tourDuration ?> Minutes</td>
                        </tr>
                        <tr>
                            <th scope="row">Duration of Ride</th>
                            <td><?= $rideDuration ?> Minutes</td>
                        </tr>
                        <tr>
                            <th scope="row">Start Address</th>
                            <td><?= $pickUpAddress ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Finish Address</th>
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
                            <td>$<?= $bookingFee ?> paid on <?= $pickUpDate . ' ' . $dayOfOrder ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Driver Fare</th>
                            <td>$<?= $driverFare ?> with <?= $paymentMethod ?> due on <?= $pickUpDate .
     " " .
     $dayOfOrder ?></td>
                        </tr>
                        <tr style="background-color:green;">
                            <th scope="row" style="color:white;">Total Fare</th>
                            <td><b style="color:white;">$<?= $totalFare ?></b></td>
                        </tr>
                    </tbody>
                </table>
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
