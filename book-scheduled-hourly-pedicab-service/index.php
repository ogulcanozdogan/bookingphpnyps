<?php
session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
	  <title>Book Scheduled Hourly Pedicab Service</title>
	  <meta name="description" content="Scheduled Hourly Pedicab Service Booking Application">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&libraries=places&callback=initAutocomplete" async defer></script>
      <link href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <form onsubmit="return validateForm()" method="post" id="myForm" action="arastep.php">
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
    <span id="error-text">
    <?php if ($_GET["error"] == "yes") {
        echo "You are trying to book a ride outside of our main service areas.<br><a href='https://newyorkpedicabservices.com/request-scheduled-hourly-pedicab-service/'>Request Scheduled Hourly Pedicab Service</a>";
    } ?>
    </span>
</div>

                  <div class="form-group">
                     <label for="numPassengers">Number of Passengers</label>
                     <select title="" class="form-control" id="numPassengers" name="numPassengers" required  oninvalid="this.setCustomValidity('Please, select the number of passengers.'); this.classList.add('invalid');" 
                        oninput="this.setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="" selected>Select the number of passengers</option>
                        <?php
                        $passengerCounts = [1, 2, 3];
                        foreach ($passengerCounts as $count) {
                            echo '<option value="' . $count . '"';
                            if (
                                isset($_GET["numPassengers"]) &&
                                $_GET["numPassengers"] == $count
                            ) {
                                echo " selected";
                            }
                            echo ">" . $count . "</option>";
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="pickUpDate">Date of Service</label>
                     <input title="" autocomplete="off" type="text" placeholder="Select the date of service" required 
                        oninvalid="this.setCustomValidity('Please, select the date of pick up.'); this.classList.add('invalid');" 
                        oninput="this.setCustomValidity(''); this.classList.remove('invalid');" 
                        class="form-control" id="pickUpDate" name="pickUpDate" value="<?php echo isset(
                            $_GET["pickUpDate"]
                        )
                            ? htmlspecialchars($_GET["pickUpDate"])
                            : ""; ?>">  
                  </div>
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
                                      isset($_GET["hours"]) &&
                                      $_GET["hours"] == $i
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
                                      isset($_GET["minutes"]) &&
                                      $_GET["minutes"] == $minute
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
                                      isset($_GET["ampm"]) &&
                                      $_GET["ampm"] == $option
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
                     <select title="" class="form-control" required id="serviceDuration" name="serviceDuration" required  oninvalid="this.setCustomValidity('Please, select duration of service.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="">Select the duration of service</option>
                        <option value="30" <?php echo $_GET[
                            "serviceDuration"
                        ] == "30"
                            ? "selected"
                            : ""; ?>>30 Minutes</option>
                        <option value="1" <?php echo $_GET["serviceDuration"] ==
                        "1"
                            ? "selected"
                            : ""; ?>>1 Hour</option>
                        <option value="90" <?php echo $_GET[
                            "serviceDuration"
                        ] == "90"
                            ? "selected"
                            : ""; ?>>90 Minutes</option>
                        <option value="2" <?php echo $_GET["serviceDuration"] ==
                        "2"
                            ? "selected"
                            : ""; ?>>2 Hours</option>
                        <option value="3" <?php echo $_GET["serviceDuration"] ==
                        "3"
                            ? "selected"
                            : ""; ?>>3 Hours</option>
                        <option value="4" <?php echo $_GET["serviceDuration"] ==
                        "4"
                            ? "selected"
                            : ""; ?>>4 Hours</option>
                        <option value="5" <?php echo $_GET["serviceDuration"] ==
                        "5"
                            ? "selected"
                            : ""; ?>>5 Hours</option>
                        <option value="6" <?php echo $_GET["serviceDuration"] ==
                        "6"
                            ? "selected"
                            : ""; ?>>6 Hours</option>
                        <option value="7" <?php echo $_GET["serviceDuration"] ==
                        "7"
                            ? "selected"
                            : ""; ?>>7 Hours</option>
                        <option value="8" <?php echo $_GET["serviceDuration"] ==
                        "8"
                            ? "selected"
                            : ""; ?>>8 Hours</option>
                     </select>
                  </div>
                  <!-- Pick Up Address -->
                  <div class="form-group">
                     <label for="pickUpAddress">Start Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter pick up address." oninvalid="this.setCustomValidity('Please, enter start address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="pickUpAddress" name="pickUpAddress" value="<?php echo isset(
                         $_GET["pickUpAddress"]
                     )
                         ? htmlspecialchars($_GET["pickUpAddress"])
                         : ""; ?>">
                    <a id="changePickUpLink" href="#" style="display:none; color:blue; font-size:12px; margin-top:5px;">If you want to change the pickup address, click here</a>
                 </div>
                  <!-- Destination Address -->
                  <div class="form-group">
                     <label for="destinationAddress">Finish Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter destination address." oninvalid="this.setCustomValidity('Please, enter finish address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="destinationAddress" name="destinationAddress" value="<?php echo isset(
                         $_GET["destinationAddress"]
                     )
                         ? htmlspecialchars($_GET["destinationAddress"])
                         : ""; ?>">
                    <a id="changeDestinationLink" href="#" style="display:none; color:blue; font-size:12px; margin-top:5px;">If you want to change the destination address, click here</a>
                </div>
                  <!-- Service Details -->
                  <div class="form-group">
                     <label for="serviceDetails">Service Details</label>
                     <textarea class="form-control" id="serviceDetails" required placeholder="Please, enter service details." oninvalid="this.setCustomValidity('Please, enter service details.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" name="serviceDetails" rows="3"><?php echo isset(
                         $_GET["serviceDetails"]
                     )
                         ? htmlspecialchars($_GET["serviceDetails"])
                         : ""; ?></textarea>
                  </div>
                  <!-- Payment Method -->
                  <div class="form-group">
                     <label>Driver Paid Separately</label>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payCash" value="cash" <?php echo isset(
                            $_GET["paymentMethod"]
                        ) && $_GET["paymentMethod"] == "cash"
                            ? "checked"
                            : ""; ?>>
                        <label class="form-check-label" for="payCash">
                        I will pay the driver cash
                        </label>
                     </div>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payCard" value="card" <?php echo isset(
                            $_GET["paymentMethod"]
                        ) && $_GET["paymentMethod"] == "card"
                            ? "checked"
                            : ""; ?>>
                        <label class="form-check-label" for="payCard">
                        I will pay the driver with debit/credit card (10% fee applies to the driver fare)
                        </label>
                     </div>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payFullCard" value="fullcard" <?php echo isset(
                            $_GET["paymentMethod"]
                        ) && $_GET["paymentMethod"] == "fullcard"
                            ? "checked"
                            : ""; ?>>
                        <label class="form-check-label" for="payFullCard">
                        I will pay all upfront to New York Pedicab Services and New York Pedicab Services will pay the driver (20% fee applies to the full fare)
                        </label>
                     </div>
                  </div>
                  <input title="" type="hidden" name="firstName" value="<?= $_GET[
                      "firstName"
                  ] ?>">
                  <input title="" type="hidden" name="lastName" value="<?= $_GET[
                      "lastName"
                  ] ?>">
                  <input title="" type="hidden" name="email" value="<?= $_GET[
                      "email"
                  ] ?>">
                  <input title="" type="hidden" name="phoneNumber" value="<?= $_GET[
                      "phoneNumber"
                  ] ?>">
                  <input title="" type="hidden" name="countryCode" value="<?= $_GET[
                      "countryCode"
                  ] ?>">
				  <input title="" type="hidden" name="countryName" value="<?= $_GET[
                      "countryName"
                  ] ?>">
                  <center> <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Calculate Now"></center>
               </div>
            </div>
         </div>
      </form>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
      <script>
         $(document).ready(function() {
             $("#pickUpDate").datepicker({
                 changeYear: true,
                 changeMonth: true,
                 yearRange: "2024:2025",
                 minDate: 0,
                 dateFormat: "mm/dd/yy",
                 onSelect: function(dateText) {
                     $(this).removeClass('invalid');
                     // trigger oninput event
                     this.setCustomValidity('');
                 }
             }).on('change', function() {
                 if (!this.value) {
                     this.setCustomValidity('Please, select the date of pick up.');
                 } else {
                     this.setCustomValidity('');
                 }
             });
         });
      </script>
      <script>
         $(document).ready(function() {
             // Assuming you need to combine the hours, minutes, and AM/PM into a single time input
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
                     // Do not check if hour, minute, or AM/PM is empty
                     showError("Please make sure to enter hour, minute, and AM/PM.");
                     return false;
                 }
         
                 const currentDate = new Date();
                 const selectedDate = new Date(dateElement.value);
         
                 // Convert time to 24-hour format
                 const hours = parseInt(hoursElement.value);
                 const minutes = parseInt(minutesElement.value);
                 const isPM = ampmElement.value === 'PM';
                 const selectedHours = isPM ? (hours % 12) + 12 : (hours % 12);
         
                 // Selected date and time
                 const selectedDateTime = new Date(selectedDate);
                 selectedDateTime.setHours(selectedHours, minutes, 0, 0);
         
                 // Current time + 1 hour
                 const currentTimePlusOneHour = new Date(currentDate.getTime() + (60 * 60 * 1000));
         
                 if (selectedDateTime < currentTimePlusOneHour) {
                     showError("Please, select a pickup time that is at least 1 hour later than the current time.");
                     return false;
                 }
         
                 // Invalid time range check for night hours
                 if ((isPM && hours === 11 && minutes > 0) || (isPM && hours > 11) ||
                     (!isPM && hours < 9) || (!isPM && hours === 12)) {
                     showError("Please, do not use this application to book a ride between 11:01 pm and 8:59 am.<br> Please, use the form below instead.<br><a target='_blank'	href='https://newyorkpedicabservices.com/request-point-a-to-b-pedicab-ride.html'>Request Point A to B Pedicab Ride</a>");
                     return false;
                 }
         
                 return true; // Valid time, allow form submission
             }
         
             // Call validateTime function when the form is submitted and prevent submission if necessary
             form.addEventListener('submit', function(event) {
                 if (!validateTime()) {
                     event.preventDefault(); // Prevent form submission
                 }
             });
         });
         
      </script>
<script type="text/javascript">
function initAutocomplete() {
    var manhattanBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.70172445894308, -74.02835332961955), // Southwest corner of Manhattan (Battery Park)
        new google.maps.LatLng(40.81370673870937, -73.91583560578955)  // Northeast corner of Manhattan (Inwood)
    );

    var options = {
        bounds: manhattanBounds,
        strictBounds: true // Restrict results within specified bounds
    };

    var allowedZipCodes = [
        '10000', '10001', '10002', '10003', '10004', '10005', '10006', '10007', '10008', '10009',
        '10010', '10011', '10012', '10013', '10014', '10015', '10016', '10017', '10018', '10019',
        '10020', '10021', '10022', '10023', '10024', '10025', '10026', '10028', '10029', '10036',
        '10038', '10041', '10043', '10045', '10055', '10060', '10065', '10069', '10075', '10080',
        '10081', '10087', '10090', '10101', '10102', '10103', '10104', '10105', '10106', '10107',
        '10108', '10109', '10110', '10111', '10112', '10113', '10114', '10116', '10117', '10118',
        '10119', '10120', '10121', '10122', '10123', '10124', '10126', '10128', '10129', '10130',
        '10131', '10132', '10133', '10138', '10151', '10152', '10153', '10154', '10155', '10156',
        '10157', '10158', '10159', '10160', '10162', '10163', '10164', '10165', '10166', '10167',
        '10168', '10169', '10170', '10171', '10172', '10173', '10174', '10175', '10176', '10177',
        '10178', '10179', '10185', '10199', '10203', '10211', '10212', '10242', '10249', '10256',
        '10258', '10259', '10260', '10261', '10265', '10268', '10269', '10270', '10271', '10272',
        '10273', '10274', '10275', '10276', '10277', '10278', '10279', '10280', '10281', '10282',
        '10285', '10286'
    ];

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
            showError("You are trying to book a ride outside of our main service areas.<br> Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-book-scheduled-hourly-pedicab-service.html'>Request Hourly Pedicab Service</a>");
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
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   </body>
</html>
