<?php
include('inc/init.php');
require_once "inc/db.php";

if (!$_POST) {
    header("location: index.php");
    exit;
}

// POST verilerini al
$requestNumber = isset($_POST["requestNumber"]) ? htmlspecialchars($_POST["requestNumber"]) : '';
$firstName = isset($_POST["firstName"]) ? htmlspecialchars($_POST["firstName"]) : '';
$lastName = isset($_POST["lastName"]) ? htmlspecialchars($_POST["lastName"]) : '';
$emailAddress = isset($_POST["emailAddress"]) ? htmlspecialchars($_POST["emailAddress"]) : '';
$phoneNumber = isset($_POST["phoneNumber"]) ? htmlspecialchars($_POST["phoneNumber"]) : ''; 
$numPassengers = isset($_POST["numPassengers"]) ? htmlspecialchars($_POST["numPassengers"]) : '';
$pickUpDate = isset($_POST["pickUpDate"]) ? htmlspecialchars($_POST["pickUpDate"]) : '';
$pickUpDay = isset($_POST["pickUpDay"]) ? htmlspecialchars($_POST["pickUpDay"]) : '';
$timeOfPickUp = isset($_POST["timeOfPickUp"]) ? htmlspecialchars($_POST["timeOfPickUp"]) : ''; 
$pickUpAddress = isset($_POST["pickUpAddress"]) ? htmlspecialchars($_POST["pickUpAddress"]) : '';
$destinationAddress = isset($_POST["destinationAddress"]) ? htmlspecialchars($_POST["destinationAddress"]) : '';
$downPaymentDescription = isset($_POST["downPaymentDescription"]) ? htmlspecialchars($_POST["downPaymentDescription"]) : '';
$paymentDescription = isset($_POST["paymentDescription"]) ? htmlspecialchars($_POST["paymentDescription"]) : '';
$serviceDuration = isset($_POST["serviceDuration"]) ? htmlspecialchars($_POST["serviceDuration"]) : '';
$serviceDetails = isset($_POST["serviceDetails"]) ? htmlspecialchars($_POST["serviceDetails"]) : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Request Scheduled Central Park Pedicab Tour</title>
    <meta name="description" content="Scheduled Point A to B Pedicab Ride Booking Application">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Request Confirmation</h2>
                <div class="text-center mb-4">
                    <b>Thank you for choosing New York Pedicab Services</b><br>
                    <b>Below are the confirmed details of your booking request:</b>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Request Number</th>
                            <td><?=$requestNumber?></td>
                        </tr>
                        <tr>
                            <th scope="row">Type</th>
                            <td>Scheduled Central Park Pedicab Tour</td>
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
                            <td><?= $pickUpDate . " " . $pickUpDay ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Time of Tour</th>
                            <td><?= $timeOfPickUp ?></td>
                        </tr>
						<tr>
                            <th scope="row">Duration of Tour</th>
                            <td><?= $serviceDuration ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Start Address</th>
                            <td><?= $pickUpAddress ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Finish Address</th>
                            <td><?= $destinationAddress ?></td>
                        </tr>
						<tr>
                            <th scope="row">Tour Details</th>
                            <td><?= $serviceDetails ?></td>
                        </tr>
						<tr>
                            <th scope="row">Down Payment Method</th>
                            <td><?= $downPaymentDescription ?></td>
                        </tr>
						<tr>
                            <th scope="row">Payment Method</th>
                            <td><?= $paymentDescription ?></td>
                        </tr>
<tr><th></th><td></td> </tr>
                    </tbody>
                </table>
                <div class="text-center mt-4">
                    <strong>Thank you,</strong><br>
                    <strong>New York Pedicab Services</strong><br>
                    <strong><a href="tel:2129617435">(212) 961-7435</a></strong><br>
                    <strong><a href="mailto:info@newyorkpedicabservices.com" target="_blank">info@newyorkpedicabservices.com</a></strong><br>
                    <strong><a href="https://newyorkpedicabservices.com" target="_blank">https://newyorkpedicabservices.com</a></strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
