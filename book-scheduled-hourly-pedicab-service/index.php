<?php
include('inc/init.php');
// PHP code to process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save data to session variables if next button is clicked
    if (isset($_POST["next"])) {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
    }
    // Clear session variables if back button is clicked
    elseif (isset($_POST["back"])) {
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
    }
}

$pickUpDate = $_POST['pickUpDate'];
      $dateTime = DateTime::createFromFormat('m/d/Y', $pickUpDate);
        if ($dateTime && $dateTime->format('m/d/Y') === $pickUpDate) {
            $pickUpDate = $dateTime->format('Y-m-d');
        }
// we use it to change the calendar
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
	  <title>Book Scheduled Hourly Pedicab Service</title>
	  <meta name="description" content="Scheduled Hourly Pedicab Service Booking Application">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow">
      <!-- Viewport meta tag added -->
<link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>

<link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>

      <link type="text/css" href="css/style.css" rel="stylesheet">
	  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G3HDRQGC05"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G3HDRQGC05');
</script>
   </head>
   <body>
      <form onsubmit="return validateForm()" method="post" id="myForm" action="step2.php">
         <div class="container">
            <div class="row justify-content-center">
               <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
               <input <?php if (!$_GET) {
                   echo "disabled";
               } ?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
               <div class="col-md-6">
                  <!-- Center the form by fitting it into a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>Scheduled<br>Hourly Pedicab Service<br>Booking Application</b>
                  </div>
                  <div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text"></span>
                  </div>
				 <div class="error-message2" id="error-message2" <?php if (
         $_GET["error"] != "yes"
     ) {
         echo 'style="display: none;"';
     } ?>>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <div class="error-text">
    <?php if ($_GET["error"] == "yes") {
        echo "You are trying to book a ride outside of our main service areas.<br>Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-scheduled-hourly-pedicab-service/'>Request Scheduled Hourly Pedicab Service</a>";
    } ?>
    </div>
</div>

<div class="form-group">
    <label for="numPassengers">Number of Passengers</label>
    <select title="" class="form-control" id="numPassengers" name="numPassengers" required oninvalid="this.setCustomValidity('Please, select the number of passengers.'); this.classList.add('invalid');" 
    oninput="this.setCustomValidity(''); this.classList.remove('invalid');">
        <option value="" selected>Select the number of passengers</option>
        <?php
        $passengerCounts = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $pedicabCount = 1;

        foreach ($passengerCounts as $index => $count) {
            if ($index % 3 == 0 && $index != 0) {
                $pedicabCount++;
            }
            $pedicabLabel = $pedicabCount == 1 ? 'Pedicab' : 'Pedicabs';
            echo '<option value="' . $count . '"';
            if (
                isset($_POST["numPassengers"]) &&
                $_POST["numPassengers"] == $count
            ) {
                echo " selected";
            }
            echo ">" . $count . ' (' . $pedicabCount . ' ' . $pedicabLabel . ')' . "</option>";
        }
        ?>
    </select>
</div>
    <div class="form-group">
        <label for="pickUpDate">Date of Service</label>
        <input title="" autocomplete="off" type="date" required
               max="2025-12-31"
               oninvalid="this.setCustomValidity('Please, select the date of pick up.'); this.classList.add('invalid');"
               oninput="this.setCustomValidity(''); this.classList.remove('invalid');"
               class="form-control" id="pickUpDate" name="pickUpDate" value="<?php echo isset($pickUpDate) ? htmlspecialchars($pickUpDate) : ''; ?>" onchange="checkDate(this)">
    </div> <!-- // we use it to change the calendar -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="hours">Hour</label>
                           <select title="" class="form-control" id="hours" name="hours" required  oninvalid="this.setCustomValidity('Please, select the hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">Select the hour</option>
                              <?php // Generate options for hours
                              for ($i = 1; $i <= 12; $i++) {
                                  echo '<option value="' . $i . '"';
                                  // If the hour is selected in GET data, mark it as selected
                                  if (
                                      isset($_POST["hours"]) &&
                                      $_POST["hours"] == $i
                                  ) {
                                      echo " selected";
                                  }
                                  echo ">" . $i . "</option>";
                              } ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="minutes">Minute</label>
                           <select title="" class="form-control" id="minutes" name="minutes" required oninvalid="this.setCustomValidity('Please, select the minute.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">Select the minute</option>
                              <?php
                              // Generate options for minutes
                              $minutes = ["00", "15", "30", "45"];
                              foreach ($minutes as $minute) {
                                  echo '<option value="' . $minute . '"';
                                  // If the minute is selected in GET data, mark it as selected
                                  if (
                                      isset($_POST["minutes"]) &&
                                      $_POST["minutes"] == $minute
                                  ) {
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
                           <select title="" class="form-control" id="ampm" name="ampm" required  oninvalid="this.setCustomValidity('Please, select AM or PM.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">AM/PM</option>
                              <?php
                              // Generate options for AM and PM
                              $am_pm_options = ["AM", "PM"];
                              foreach ($am_pm_options as $option) {
                                  echo '<option value="' . $option . '"';
                                  // If the option is selected in GET data, mark it as selected
                                  if (
                                      isset($_POST["ampm"]) &&
                                      $_POST["ampm"] == $option
                                  ) {
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
                     <label for="serviceDuration">Duration of Service</label>
                     <select title="" class="form-control" required id="serviceDuration" name="serviceDuration" oninvalid="this.setCustomValidity('Please, select duration of service.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="">Select the duration of service</option>
                        <option value="30" <?php echo $_POST[
                            "serviceDuration"
                        ] == "30"
                            ? "selected"
                            : ""; ?>>30 Minutes</option>
                        <option value="1" <?php echo $_POST["serviceDuration"] ==
                        "1"
                            ? "selected"
                            : ""; ?>>1 Hour</option>
                        <option value="90" <?php echo $_POST[
                            "serviceDuration"
                        ] == "90"
                            ? "selected"
                            : ""; ?>>90 Minutes</option>
                        <option value="2" <?php echo $_POST["serviceDuration"] ==
                        "2"
                            ? "selected"
                            : ""; ?>>2 Hours</option>
                        <option value="3" <?php echo $_POST["serviceDuration"] ==
                        "3"
                            ? "selected"
                            : ""; ?>>3 Hours</option>
                        <option value="4" <?php echo $_POST["serviceDuration"] ==
                        "4"
                            ? "selected"
                            : ""; ?>>4 Hours</option>
                        <option value="5" <?php echo $_POST["serviceDuration"] ==
                        "5"
                            ? "selected"
                            : ""; ?>>5 Hours</option>
                        <option value="6" <?php echo $_POST["serviceDuration"] ==
                        "6"
                            ? "selected"
                            : ""; ?>>6 Hours</option>
                        <option value="7" <?php echo $_POST["serviceDuration"] ==
                        "7"
                            ? "selected"
                            : ""; ?>>7 Hours</option>
                        <option value="8" <?php echo $_POST["serviceDuration"] ==
                        "8"
                            ? "selected"
                            : ""; ?>>8 Hours</option>
                     </select>
                  </div>
                  <!-- Pick Up Address -->
                  <div class="form-group">
                     <label for="pickUpAddress">Start Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter pick up address." oninvalid="this.setCustomValidity('Please, enter start address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="pickUpAddress" name="pickUpAddress" value="<?php echo isset(
                         $_POST["pickUpAddress"]
                     )
                         ? htmlspecialchars($_POST["pickUpAddress"])
                         : ""; ?>">
                    <a id="changePickUpLink" href="#" style="display:none; color:blue; font-size:12px; margin-top:5px;">If you want to change the pickup address, click here</a>
                 </div>
                  <!-- Destination Address -->
                  <div class="form-group">
                     <label for="destinationAddress">Finish Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter destination address." oninvalid="this.setCustomValidity('Please, enter finish address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="destinationAddress" name="destinationAddress" value="<?php echo isset(
                         $_POST["destinationAddress"]
                     )
                         ? htmlspecialchars($_POST["destinationAddress"])
                         : ""; ?>">
                    <a id="changeDestinationLink" href="#" style="display:none; color:blue; font-size:12px; margin-top:5px;">If you want to change the destination address, click here</a>
                </div>
                  <!-- Service Details -->
                  <div class="form-group">
                     <label for="serviceDetails">Service Details</label>
                     <textarea class="form-control" id="serviceDetails" required placeholder="Please, send us more details about this service." oninvalid="this.setCustomValidity('Please, send us more details about this service.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" name="serviceDetails" rows="3"><?php echo isset(
                         $_POST["serviceDetails"]
                     )
                         ? htmlspecialchars($_POST["serviceDetails"])
                         : ""; ?></textarea>
                  </div>
                  <!-- Payment Method -->
                  <div class="form-group">
                     <label>Driver Paid Separately</label>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payCash" value="CASH" <?php echo isset(
                            $_POST["paymentMethod"]
                        ) && $_POST["paymentMethod"] == "CASH"
                            ? "checked"
                            : ""; ?>>
                        <label class="form-check-label" for="payCash">
                        I will pay the driver cash
                        </label>
                     </div>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payCard" value="card" <?php echo isset(
                            $_POST["paymentMethod"]
                        ) && $_POST["paymentMethod"] == "card"
                            ? "checked"
                            : ""; ?>>
                        <label class="form-check-label" for="payCard">
                        I will pay the driver with debit/credit card (10% fee applies to the driver fare)
                        </label>
                     </div>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payFullCard" value="fullcard" <?php echo isset(
                            $_POST["paymentMethod"]
                        ) && $_POST["paymentMethod"] == "fullcard"
                            ? "checked"
                            : ""; ?>>
                        <label class="form-check-label" for="payFullCard">
                        I will pay all upfront to New York Pedicab Services and New York Pedicab Services will pay the driver (20% fee applies to the full fare)
                        </label>
                     </div>
                  </div>
                  <input title="" type="hidden" name="firstName" value="<?= $_POST[
                      "firstName"
                  ] ?>">
                  <input title="" type="hidden" name="lastName" value="<?= $_POST[
                      "lastName"
                  ] ?>">
                  <input title="" type="hidden" name="email" value="<?= $_POST[
                      "email"
                  ] ?>">
                  <input title="" type="hidden" name="phoneNumber" value="<?= $_POST[
                      "phoneNumber"
                  ] ?>">
                  <input title="" type="hidden" name="countryCode" value="<?= $_POST[
                      "countryCode"
                  ] ?>">
				  <input title="" type="hidden" name="countryName" value="<?= $_POST[
                      "countryName"
                  ] ?>">
                  <div style="text-align:center;"> <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Calculate Now"></div>
               </div>
            </div>
         </div>
      </form>

	  <script>
    window.onload = function() {
        var script = document.createElement("script");
        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDFigWHFZKkoNdO0r6siMTgawuNxwlabRU&libraries=places&callback=initAutocomplete";
        script.async = true;
        script.defer = true;
        document.body.appendChild(script);
    };
</script>
<script>
document.getElementById('prevButton').addEventListener('click', function() {
    window.location.href = 'https://newyorkpedicabservices.com/hourly-pedicab-services.html';
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
</script>
<script>
    $(document).ready(function() {
        $('#hours, #minutes, #ampm').change(function() {
            var hours = $('#hours').val();
            var minutes = $('#minutes').val();
            var ampm = $('#ampm').val();
            var time = hours + ':' + minutes + ' ' + ampm;
            $('#pickUpTime').val(time);
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const ampmElement = document.getElementById('ampm');
        const dateElement = document.getElementById('pickUpDate');
        const submitButton = document.querySelector('button[type="submit"]');
        const form = document.getElementById('myForm');

        function resetSelection() {
            hoursElement.value = '';
            minutesElement.value = '';
            ampmElement.value = '';
        }

        function showError(message) {
            var errorMessage = document.getElementById('error-message');
            var errorText = document.getElementById('error-text');
            errorText.innerHTML  = message;
            errorMessage.style.display = 'block';
            errorMessage.classList.add('show');
            errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' }); 
        }

        function validateTime() {
            if (!hoursElement.value || !minutesElement.value || !ampmElement.value) {
                showError("Please make sure to enter hour, minute, and AM/PM.");
                return false;
            }

            const currentDate = new Date();
            const selectedDate = new Date(dateElement.value + 'T00:00:00'); // we use it to change the calendar

            const hours = parseInt(hoursElement.value);
            const minutes = parseInt(minutesElement.value);
            const isPM = ampmElement.value === 'PM';
            const selectedHours = isPM ? (hours % 12) + 12 : (hours % 12);

            const selectedDateTime = new Date(selectedDate);
            selectedDateTime.setHours(selectedHours, minutes, 0, 0);

            const currentTimePlusOneHour = new Date(currentDate.getTime() + (60 * 60 * 1000));

            if (selectedDateTime < currentTimePlusOneHour) {
                showError("Please, select a pickup time that is at least 1 hour later than the current time.");
                return false;
            }

if ((isPM && hours === 11 && minutes > 0) || 
    (isPM && hours > 11 && hours < 12) || // PM'de gece yarısı sonrası saatler
    (!isPM && hours < 9) || // AM'de sabah 9'dan önce
    (!isPM && hours === 12)) { // Gece yarısı 12:00 AM
    showError("Please, do not use this application to book a ride between 11:01 pm and 8:59 am.<br> Please, use the form below instead.<br><a target='_blank' href='https://newyorkpedicabservices.com/request-scheduled-point-a-to-b-pedicab-ride/'>Request Scheduled Point A to B Pedicab Ride</a>");
    return false;
}

            return true; 
        }

        form.addEventListener('submit', function(event) {
            if (!validateTime()) {
                event.preventDefault();
            }
        });
    });
</script>
	  <?php
include('inc/db.php');
$zipCodes = [];
$sorgu = $baglanti->prepare("SELECT * FROM zip_codes WHERE app_id = 2");
$sorgu->execute();
while ($sonuc = $sorgu->fetch()) { 
$zipCodes[] = $sonuc['zip_code'];
}
?>
<script>
function initAutocomplete() {
    var manhattanBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.699417303744625, -74.0283104499974), // Southwest corner of Manhattan (Battery Park)
        new google.maps.LatLng(40.81370673870937, -73.91583560578955)  // Northeast corner of Manhattan (Inwood)
    );

    var options = {
        bounds: manhattanBounds,
        strictBounds: true // Restrict results within specified bounds
    };

var allowedZipCodes = <?php echo json_encode($zipCodes); ?>;

    var pickUpInput = document.getElementById('pickUpAddress');
    var destinationInput = document.getElementById('destinationAddress');

    var autocompletePickup = new google.maps.places.Autocomplete(pickUpInput, options);
    var autocompleteDestination = new google.maps.places.Autocomplete(destinationInput, options);

    function showError(message) {
        var errorMessage = document.getElementById('error-message');
        var errorText = document.getElementById('error-text');
        errorText.innerHTML = message;
        errorMessage.style.display = 'block';
        errorMessage.classList.add('show');
        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function checkZipCode(place, inputField, customPlaceName) {
        var zipCode = place.address_components.find(function(component) {
            return component.types.indexOf("postal_code") > -1;
        });

        if (zipCode && allowedZipCodes.includes(zipCode.short_name)) {
            console.log("Valid location: ", place.formatted_address);
            var addressWithoutCountry = place.formatted_address.replace(/, USA$/, '');
            if (customPlaceName && !addressWithoutCountry.includes(customPlaceName)) {
                inputField.value = `${addressWithoutCountry} (${customPlaceName})`;
            } else {
                inputField.value = addressWithoutCountry;
            }
        } else {
            console.error("Invalid postal code.");
            showError("You are trying to book a ride outside of our main service areas.<br> Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-scheduled-hourly-pedicab-service/'>Request Scheduled Hourly Pedicab Service</a>");
            inputField.value = ""; // Clear the address field
        }
    }

    function handlePlaceChanged(autocomplete, inputField) {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            console.error("Autocomplete's returned place contains no geometry");
            return;
        }

        var customPlaceName = place.name;

        // Columbus Circle check
        if (place.name.includes("Columbus Circle")) {
            inputField.value = "Columbus Circle, Columbus Circle, New York, NY, USA";
            console.log("Address set to Columbus Circle, Columbus Circle, New York, NY, USA");
        } else if (place.name.includes("Marriott Downtown") && place.formatted_address.includes("New York, NY 10006")) {
            inputField.value = "85 West Street At, Albany St, New York, NY 10006 (Marriott Downtown)";
            console.log("Address set to 85 West Street At, Albany St, New York, NY 10006 (Marriott Downtown)");
        } else {
            var formattedAddress = place.formatted_address.replace(/, USA$/, '');
            if (customPlaceName && !formattedAddress.includes(customPlaceName)) {
                inputField.value = `${formattedAddress} (${customPlaceName})`;
            } else {
                inputField.value = formattedAddress;
            }
            console.log("Address set to ", formattedAddress);
            checkZipCode(place, inputField, customPlaceName);
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
function checkDate(input) {
    const disabledDate = '2024-11-03';
    if (input.value === disabledDate) {
        alert('We are not available on this date.');
        input.value = '';  // Tarihi temizler
        input.setCustomValidity('');
    } else {
        input.setCustomValidity('');
    }
}
</script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   </body>
</html>
