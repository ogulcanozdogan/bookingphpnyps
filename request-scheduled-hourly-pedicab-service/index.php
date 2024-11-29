<?php
include('inc/init.php');
require "inc/countryselect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <title>Request Scheduled Hourly Pedicab Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Request Scheduled Hourly Pedicab Service Form">
    <!-- Preload CSS files -->
    <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>
    <link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>
	    <script src="https://www.google.com/recaptcha/api.js?render=6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP"></script>
    <link type="text/css" href="css/style.css" rel="stylesheet">
</head>
<body>
<form method="post" id="myForm" action="process.php">
    <div class="container">
        <div class="row justify-content-center">
            <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
            <div class="col-md-6">
                <!-- Center the form by fitting it into a narrower column -->
                <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                <div class="text-center mb-4">
                    <b>Scheduled<br>Hourly Pedicab Service<br>Request Form</b>
                </div>
				            <?php
            if (!empty($captcha_error)) {
                echo "<div class='alert alert-danger' role='alert'>$captcha_error</div>";
            }
            ?>
				<div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text">
					 </span>
                  </div>
                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input maxlength="50" title="" type="text" class="form-control" id="firstName" name="firstName" required placeholder="Enter your first name" oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                </div>
                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input maxlength="50" title="" type="text" class="form-control" id="lastName" name="lastName" required placeholder="Enter your last name" oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input maxlength="50" title="" type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address"  oninvalid="this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid');" 
        oninput="setCustomValidity(''); this.classList.remove('invalid');" 
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
        onchange="if(!this.value.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) { this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid'); } else { this.setCustomValidity(''); this.classList.remove('invalid'); }">
                </div>
<label for="countrySelect">Phone</label>
<div style="display: flex;" class="form-group">
    <?= countrySelector() ?>
    <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber"
           oninvalid="this.setCustomValidity('Please, enter phone number.'); this.classList.add('invalid');" oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" placeholder="Enter your phone number" required >
</div>
<div class="form-group">
    <label for="numPassengers">Number of Passengers</label>
    <select title="" class="form-control" id="numPassengers" name="numPassengers" oninvalid="this.setCustomValidity('Please, select the number of passengers.'); this.classList.add('invalid');" 
            oninput="this.setCustomValidity(''); this.classList.remove('invalid');" required>
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
                    <label for="pickUpDate">Date of Service</label>
                    <input title="" autocomplete="off" type="date" required max="2025-12-31" oninvalid="this.setCustomValidity('Please, select the date of service.'); this.classList.add('invalid');"
               oninput="this.setCustomValidity(''); this.classList.remove('invalid');"
               class="form-control" id="pickUpDate" name="pickUpDate">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hours">Hour</label>
                            <select title="" class="form-control" id="hours" name="hours" oninvalid="this.setCustomValidity('Please, enter hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" required>
                                <option value="">Select the hour</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    echo '<option value="' . $i . '">' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minutes">Minute</label>
                            <select title="" class="form-control" id="minutes" name="minutes" oninvalid="this.setCustomValidity('Please, select the hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" required>
                                <option value="">Select the minute</option>
                                <?php
                                $minutes = ["00", "15", "30", "45"];
                                foreach ($minutes as $minute) {
                                    echo '<option value="' . $minute . '">' . $minute . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ampm">AM/PM</label>
                            <select title="" class="form-control" id="ampm" name="ampm" oninvalid="this.setCustomValidity('Please, select AM or PM.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" required>
                                <option value="">AM/PM</option>
                                <?php
                                $am_pm_options = ["AM", "PM"];
                                foreach ($am_pm_options as $option) {
                                    echo '<option value="' . $option . '">' . $option . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
				 <div class="form-group">
                     <label for="serviceDuration">Duration of Service</label>
                     <select title="" class="form-control" required id="serviceDuration" name="serviceDuration" oninvalid="this.setCustomValidity('Please, select duration of service.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="">Select the duration of service</option>
                        <option value="30 Minutes">30 Minutes</option>
                        <option value="1 Hour">1 Hour</option>
                        <option value="90 Minutes">90 Minutes</option>
                        <option value="2 Hours">2 Hours</option>
                        <option value="3 Hours">3 Hours</option>
                        <option value="4 Hours">4 Hours</option>
                        <option value="5 Hours">5 Hours</option>
                        <option value="6 Hours">6 Hours</option>
                        <option value="7 Hours">7 Hours</option>
                        <option value="8 Hours">8 Hours</option>
                     </select>
                  </div>
                <div class="form-group">
                    <label for="pickUpAddress">Start Address</label>
                    <input title="" type="text" class="form-control" id="pickUpAddress" name="pickUpAddress" required placeholder="Enter the start address" oninvalid="this.setCustomValidity('Please, enter start address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                </div>
                <div class="form-group">
                    <label for="destinationAddress">Finish Address</label>
                    <input title="" type="text" class="form-control" id="destinationAddress" name="destinationAddress" required placeholder="Enter the finish address" oninvalid="this.setCustomValidity('Please, enter finish address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                </div>
                  <div class="form-group">
                     <label for="serviceDetails">Service Details</label>
                     <textarea class="form-control" id="serviceDetails" required placeholder="Please, send us more details about this service." oninvalid="this.setCustomValidity('Please, send us more details about this service.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" name="serviceDetails" rows="3"></textarea>
                  </div>
				<div class="form-group">
                    <label>Down Payment (Booking Fee) Required & Paid Online </label>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="downPayment" id="zelle" value="zelle" required>
                        <label class="form-check-label" for="zelle">I will pay the booking fee with Zelle (No fee)</label>
                    </div>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="downPayment" id="venmo" value="venmo" required>
                        <label class="form-check-label" for="venmo">I will pay the booking fee with Venmo (No Fee)</label>
                    </div>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="downPayment" id="card" value="card" required>
                        <label class="form-check-label" for="card">I will pay the booking fee with debit/credit card (10% fee applies to the booking fee)</label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Driver Paid Separately</label>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCash" value="CASH" required>
                        <label class="form-check-label" for="payCash">I will pay the driver cash</label>
                    </div>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCard" value="card" required>
                        <label class="form-check-label" for="payCard">I will pay the driver with debit/credit card (10% fee applies to the driver fare)</label>
                    </div>
                    <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payFullCard" value="fullcard" required>
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
    window.location.href = 'https://newyorkpedicabservices.com/hourly-pedicab-services.html';
});

</script>
	  <?php
include('inc/db2.php');
$zipCodes = [];
$sorgu = $baglanti->prepare("SELECT * FROM zip_codes WHERE app_id = 2");
$sorgu->execute();
while ($sonuc = $sorgu->fetch()) { 
$zipCodes[] = $sonuc['zip_code'];
}
?>
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

var allowedZipCodes = <?php echo json_encode($zipCodes); ?>;

// Function to extract zip code from the place object
function getZipCodeFromPlace(place) {
    for (var i = 0; i < place.address_components.length; i++) {
        var component = place.address_components[i];
        if (component.types.includes("postal_code")) {
            return component.long_name;
        }
    }
    return null;
}

var isPickupAddressSelected = false;
var isDestinationAddressSelected = false;

// Function to clear all input fields
function clearAllInputs() {
    var inputs = document.querySelectorAll('input');
    inputs.forEach(function(input) {
        input.value = '';
    });
    var selects = document.querySelectorAll('select');
    selects.forEach(function(select) {
        select.value = '';
    });
}

// Function to disable submit button
function disableSubmitButton() {
    var submitButton = document.querySelector('input[type="submit"]');
    submitButton.disabled = true;
    submitButton.style.display = 'none'; // Hide the submit button
}

// Function to show error and disable the form
function showError(message) {
    var errorMessage = document.getElementById('error-message');
    var errorText = document.getElementById('error-text');
    errorText.innerHTML = message;
    errorMessage.style.display = 'block';
    errorMessage.classList.add('show');
    errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });

    // Clear all inputs and disable submit button when error occurs
    clearAllInputs();
    disableSubmitButton();
}

// Modify the checkZipCodes function
function checkZipCodes(pickUpZip, destinationZip) {
    if (pickUpZip && destinationZip) {
        if (allowedZipCodes.includes(pickUpZip) && allowedZipCodes.includes(destinationZip)) {
 showError("You are trying to book a ride inside of our main service areas.<br> Please use this app: <a href='https://newyorkpedicabservices.com/book-scheduled-hourly-pedicab-service/'>Book Scheduled Hourly Pedicab Service</a>");
            return false; // Prevent form submission
        }
    }
    return true; // Allow form submission
}



// Modify initAutocomplete function to include zip code validation
function initAutocomplete() {
    var options = {
        componentRestrictions: { country: 'us' } 
    };

    var pickUpInput = document.getElementById('pickUpAddress');
    var destinationInput = document.getElementById('destinationAddress');

    var autocompletePickup = new google.maps.places.Autocomplete(pickUpInput, options);
    var autocompleteDestination = new google.maps.places.Autocomplete(destinationInput, options);

    var pickUpZip = null;
    var destinationZip = null;

    function handlePlaceChanged(autocomplete, isPickup) {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        var zipCode = getZipCodeFromPlace(place); // Extract the zip code

        if (isPickup) {
            pickUpZip = zipCode;
            isPickupAddressSelected = true; // Set flag to true
        } else {
            destinationZip = zipCode;
            isDestinationAddressSelected = true; // Set flag to true
        }

        checkZipCodes(pickUpZip, destinationZip); // Check zip codes after the address is selected
    }

    autocompletePickup.addListener('place_changed', function() {
        handlePlaceChanged(autocompletePickup, true);
    });

    autocompleteDestination.addListener('place_changed', function() {
        handlePlaceChanged(autocompleteDestination, false);
    });
}

// Ensure form submission is blocked if zip code check fails or address not selected
document.getElementById('myForm').addEventListener('submit', function(event) {
    // Check if user has selected addresses from Google suggestions
    if (!isPickupAddressSelected || !isDestinationAddressSelected) {
        showError("Please select a valid address from the suggestions for both pickup and destination.");
        event.preventDefault(); // Block form submission
    }

    // Additionally check the zip code validation
    if (!checkZipCodes(pickUpZip, destinationZip)) {
        event.preventDefault(); // Block form submission if the zip codes are restricted
    }
});

// Prevent users from manually typing or pasting addresses
document.getElementById('pickUpAddress').addEventListener('input', function() {
    isPickupAddressSelected = false;
});

document.getElementById('destinationAddress').addEventListener('input', function() {
    isDestinationAddressSelected = false;
});

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
