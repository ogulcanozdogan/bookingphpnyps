<?php
include('inc/init.php');
// PHP code to process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save data to session variables if the next button is clicked
    if (isset($_POST["next"])) {
        $_SESSION["firstName"] = $_POST["firstName"];
        $_SESSION["lastName"] = $_POST["lastName"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["phoneNumber"] = $_POST["phoneNumber"];
        $_SESSION["numPassengers"] = $_POST["numPassengers"];
        $_SESSION["pickUpDate"] = $_POST["pickUpDate"];
        $_SESSION["hours"] = $_POST["hours"];
        $_SESSION["minutes"] = $_POST["minutes"];
        $_SESSION["ampm"] = $_POST["ampm"];
        $_SESSION["pickUpAddress"] = $_POST["pickUpAddress"];
        $_SESSION["destinationAddress"] = $_POST["destinationAddress"];
        $_SESSION["paymentMethod"] = $_POST["paymentMethod"];
    }
    // Clear session variables if the back button is clicked
    elseif (isset($_POST["back"])) {
        session_unset();
    }
}

$pickUpDate = $_POST['pickUpDate'] ?? '';
$dateTime = DateTime::createFromFormat('m/d/Y', $pickUpDate);
if ($dateTime && $dateTime->format('m/d/Y') === $pickUpDate) {
    $pickUpDate = $dateTime->format('Y-m-d');
}
require "inc/countryselect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <title>Request Scheduled Point A to B Pedicab Ride</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Request Point A to B Pedicab Ride Form">
    <!-- Preload CSS files -->
    <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>
    <link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>
    <link type="text/css" href="css/style.css" rel="stylesheet">
</head>
<body>
<form onsubmit="return validateForm()" method="post" id="myForm" action="process.php">
    <div class="container">
        <div class="row justify-content-center">
            <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
            <div class="col-md-6">
                <!-- Center the form by fitting it into a narrower column -->
                <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                <div class="text-center mb-4">
                    <b>Scheduled<br>Point A to B Pedicab Ride<br>Request Form</b>
                </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input title="" type="text" class="form-control" id="firstName" name="firstName" required placeholder="Enter your first name" value="<?php echo isset($_POST["firstName"]) ? htmlspecialchars($_POST["firstName"]) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input title="" type="text" class="form-control" id="lastName" name="lastName" required placeholder="Enter your last name" value="<?php echo isset($_POST["lastName"]) ? htmlspecialchars($_POST["lastName"]) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input title="" type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address" value="<?php echo isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : ''; ?>">
                </div>
<label for="countrySelect">Phone</label>
<div style="display: flex;" class="form-group">
    <?= countrySelector() ?>
    <input title="" style="flex: 2; margin-left: 10px;" type="tel" pattern=".{10,10}" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
           onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter a 10 digit phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" value="<?php echo htmlspecialchars($_POST['phoneNumber'] ?? ''); ?>" placeholder="Enter your phone number" required >
</div>
<div class="form-group">
    <label for="numPassengers">Number of Passengers</label>
    <select title="" class="form-control" id="numPassengers" name="numPassengers" required>
        <option value="">Select the number of passengers</option>
        <?php
        $passengerCounts = range(1, 12);
        foreach ($passengerCounts as $count) {
            $pedicabCount = ceil($count / 3);

            $optionValue = $count;
            $optionText = $count . " (" . $pedicabCount . " Pedicab" . ($pedicabCount > 1 ? "s" : "") . ")";
            
            echo '<option value="' . $optionText  . '">' . $optionText . '</option>';
        }
        ?>
    </select>
</div>

                <div class="form-group">
                    <label for="pickUpDate">Date of Pick Up</label>
                    <input title="" autocomplete="off" type="date" required max="2025-12-31" class="form-control" id="pickUpDate" name="pickUpDate" value="<?php echo isset($pickUpDate) ? htmlspecialchars($pickUpDate) : ''; ?>">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hours">Hour</label>
                            <select title="" class="form-control" id="hours" name="hours" required>
                                <option value="">Select the hour</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo '<option value="' . $i . '"';
                                    if (isset($_POST["hours"]) && $_POST["hours"] == $i) {
                                        echo " selected";
                                    }
                                    echo ">" . $i . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minutes">Minute</label>
                            <select title="" class="form-control" id="minutes" name="minutes" required>
                                <option value="">Select the minute</option>
                                <?php
                                $minutes = ["00", "15", "30", "45"];
                                foreach ($minutes as $minute) {
                                    echo '<option value="' . $minute . '"';
                                    if (isset($_POST["minutes"]) && $_POST["minutes"] == $minute) {
                                        echo " selected";
                                    }
                                    echo ">" . $minute . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ampm">AM/PM</label>
                            <select title="" class="form-control" id="ampm" name="ampm" required>
                                <option value="">AM/PM</option>
                                <?php
                                $am_pm_options = ["AM", "PM"];
                                foreach ($am_pm_options as $option) {
                                    echo '<option value="' . $option . '"';
                                    if (isset($_POST["ampm"]) && $_POST["ampm"] == $option) {
                                        echo " selected";
                                    }
                                    echo ">" . $option . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pickUpAddress">Pick Up Address</label>
                    <input title="" type="text" class="form-control" id="pickUpAddress" name="pickUpAddress" required placeholder="Enter the pick up address" value="<?php echo isset($_POST["pickUpAddress"]) ? htmlspecialchars($_POST["pickUpAddress"]) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="destinationAddress">Destination Address</label>
                    <input title="" type="text" class="form-control" id="destinationAddress" name="destinationAddress" required placeholder="Enter the destination address" value="<?php echo isset($_POST["destinationAddress"]) ? htmlspecialchars($_POST["destinationAddress"]) : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Driver Paid Separately</label>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCash" value="CASH" required <?php echo isset($_POST["paymentMethod"]) && $_POST["paymentMethod"] == "CASH" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="payCash">I will pay the driver cash</label>
                    </div>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCard" value="card" required <?php echo isset($_POST["paymentMethod"]) && $_POST["paymentMethod"] == "card" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="payCard">I will pay the driver with debit/credit card (10% fee applies to the driver fare)</label>
                    </div>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payFullCard" value="fullcard" required <?php echo isset($_POST["paymentMethod"]) && $_POST["paymentMethod"] == "fullcard" ? "checked" : ""; ?>>
                        <label class="form-check-label" for="payFullCard">I will pay all upfront to New York Pedicab Services and New York Pedicab Services will pay the driver (20% fee applies to the full fare)</label>
                    </div>
                </div>
                <div class="text-center">
                    <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Submit">
                </div>
            </div>
        </div>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
<script>
document.getElementById('prevButton').addEventListener('click', function() {
    window.location.href = '../index.php';
});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('pickUpDate').setAttribute('min', today);
    });

    document.getElementById('pickUpDate').addEventListener('click', function() {
        this.showPicker();
    });

    $(document).ready(function() {
        $('#hours, #minutes, #ampm').change(function() {
            var hours = $('#hours').val();
            var minutes = $('#minutes').val();
            var ampm = $('#ampm').val();
            var time = hours + ':' + minutes + ' ' + ampm;
            $('#pickUpTime').val(time);
        });
    });;

function initAutocomplete() {
    // ABD genelini kapsayacak şekilde hiçbir sınırlama olmadan Google Maps Autocomplete'u başlatın
    var options = {
        componentRestrictions: { country: 'us' } // ABD ile sınırlandırma
    };

    var pickUpInput = document.getElementById('pickUpAddress');
    var destinationInput = document.getElementById('destinationAddress');

    var autocompletePickup = new google.maps.places.Autocomplete(pickUpInput, options);
    var autocompleteDestination = new google.maps.places.Autocomplete(destinationInput, options);

    function handlePlaceChanged(autocomplete, inputField) {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        var customPlaceName = place.name;

        if (place.name.includes("Columbus Circle")) {
            inputField.value = "Columbus Circle, Columbus Circle, New York, NY, USA";
        } else if (place.name.includes("Marriott Downtown") && place.formatted_address.includes("New York, NY 10006")) {
            inputField.value = "85 West Street At, Albany St, New York, NY 10006 (Marriott Downtown)";
        } else if (place.name.includes("Square")) {
            showError("You cannot select a location with 'Square' in its name.");
            inputField.value = ""; // Clear the address field
        } else {
            var formattedAddress = place.formatted_address.replace(/, USA$/, '');
            if (customPlaceName && !formattedAddress.includes(customPlaceName)) {
                inputField.value = `${formattedAddress} (${customPlaceName})`;
            } else {
                inputField.value = formattedAddress;
            }
        }
    }

    autocompletePickup.addListener('place_changed', function() {
        handlePlaceChanged(autocompletePickup, pickUpInput);
    });

    autocompleteDestination.addListener('place_changed', function() {
        handlePlaceChanged(autocompleteDestination, destinationInput);
    });
}

</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var inputs = document.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            this.setAttribute('autocomplete', 'new-password');
        });
    });
});

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&libraries=places&callback=initAutocomplete" async defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
