<?php
   session_start();
   
   // PHP code to handle form data
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Save data to session variables if the next button is clicked
       if(isset($_POST['next'])) {
           $_SESSION['name'] = $_POST['name'];
           $_SESSION['email'] = $_POST['email'];
       }
       // Clear session variables if the back button is clicked
       elseif(isset($_POST['back'])) {
           unset($_SESSION['name']);
           unset($_SESSION['email']);
       }
   }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book Scheduled Central Park Pedicab Tour</title>
	  <meta name="description" content="Scheduled Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta tag added -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg9HV0g-8ddiAHH6n2s_0nXOwHIk2f1DY&libraries=places&callback=initAutocomplete" async defer></script>
      <link type="text/css" href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <form onsubmit="return validateForm()" method="post" id="myForm" action="arastep.php">
         <div class="container">
            <div class="row justify-content-center">
               <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
               <input <?php if (!$_GET) {echo 'disabled';}?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
               <div class="col-md-6">
                  <!-- Center the form in a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                      <b>Scheduled<br>Central Park Pedicab Tour<br>Booking Application</b>
                  </div>
                  <div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text"></span>
                  </div>
				  				 <div class="error-message2" id="error-message2" <?php 
    if ($_GET['error'] != 'yes') { 
        echo 'style="display: none;"'; 
    } 
?>>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <span id="error-text">
    <?php 
    if ($_GET['error'] == 'yes') {
        echo "You are trying to book a tour outside of our main service areas.<br><a href='https://newyorkpedicabservices.com/request-central-park-pedicab-tour.html'>Request Central Park Pedicab Tour</a>";
    }
    ?>
    </span>
</div>
                  <div class="form-group">
                     <label for="numPassengers">Number of Passengers</label>
                     <select title="" class="form-control" id="numPassengers" name="numPassengers" required  oninvalid="this.setCustomValidity('Please, select the number of Passengers.'); this.classList.add('invalid');" 
                        oninput="this.setCustomValidity(''); this.classList.remove('invalid');">
                        <option value="" selected>Select the number of Passengers</option>
                        <?php
                           $passengerCounts = array(1, 2, 3);
                           foreach ($passengerCounts as $count) {
                               echo '<option value="' . $count . '"';
                               if (isset($_GET['numPassengers']) && $_GET['numPassengers'] == $count) {
                                   echo ' selected';
                               }
                               echo '>' . $count . '</option>';
                           }
                           ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="pickUpDate">Date of Tour</label>
                     <input title="" autocomplete="off" type="text" placeholder="Select the date of pick up" required 
                        oninvalid="this.setCustomValidity('Please, select the date of pick up.'); this.classList.add('invalid');" 
                        oninput="this.setCustomValidity(''); this.classList.remove('invalid');" 
                        class="form-control" id="pickUpDate" name="pickUpDate" value="<?php echo isset($_GET['pickUpDate']) ? htmlspecialchars($_GET['pickUpDate']) : ''; ?>">     
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="hours">Hour</label>
                           <select title="" class="form-control" id="hours" name="hours" required  oninvalid="this.setCustomValidity('Please, select the hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">Select the hour</option>
                              <?php
                                 // Create options for hours
                                 for ($i = 1; $i <= 12; $i++) {
                                     echo '<option value="' . $i . '"';
                                     // If the hour is selected in the GET data, mark it as selected
                                     if (isset($_GET['hours']) && $_GET['hours'] == $i) {
                                         echo ' selected';
                                     }
                                     echo '>' . $i . '</option>';
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="minutes">Minute</label>
                           <select title="" class="form-control" id="minutes" name="minutes" required oninvalid="this.setCustomValidity('Please, select the minute.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">Select the minute</option>
                              <?php
                                 // Create options for minutes
                                 $minutes = ['00', '15', '30', '45'];
                                 foreach ($minutes as $minute) {
                                     echo '<option value="' . $minute . '"';
                                     // If the minute is selected in the GET data, mark it as selected
                                     if (isset($_GET['minutes']) && $_GET['minutes'] == $minute) {
                                         echo ' selected';
                                     }
                                     echo '>' . $minute . '</option>';
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
                                 // Create options for AM and PM
                                 $am_pm_options = array("AM", "PM");
                                 foreach ($am_pm_options as $option) {
                                     echo '<option value="' . $option . '"';
                                     // If the option is selected in the GET data, mark it as selected
                                     if (isset($_GET['ampm']) && $_GET['ampm'] == $option) {
                                         echo ' selected';
                                     }
                                     echo '>' . $option . '</option>';
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label >Duration of Tour</label>
                     <div class="row">
                        <!-- Add row to align the contents vertically -->
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="duration40" value="40" <?php echo (isset($_GET['tourDuration']) && $_GET['tourDuration'] == '40') ? 'checked' : ''; ?>>
                              <label class="form-check-label" for="duration40">
                              40 Minutes
                              </label>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="duration60" value="60" <?php echo (isset($_GET['tourDuration']) && $_GET['tourDuration'] == '60') ? 'checked' : ''; ?>>
                              <label class="form-check-label" for="duration60">
                              1 Hour
                              </label>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="duration90" value="90" <?php echo (isset($_GET['tourDuration']) && $_GET['tourDuration'] == '90') ? 'checked' : ''; ?>>
                              <label class="form-check-label" for="duration90">
                              90 Minutes
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Pick Up Address -->
                  <div class="form-group">
                     <label for="pickUpAddress">Start Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter pick up address." oninvalid="this.setCustomValidity('Please, enter pick up address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="pickUpAddress" name="pickUpAddress" value="<?php echo isset($_GET['pickUpAddress']) ? htmlspecialchars($_GET['pickUpAddress']) : ''; ?>">
                  </div>
                  <!-- Destination Address -->
                  <div class="form-group">
                     <label for="destinationAddress">Finish Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter destination address." oninvalid="this.setCustomValidity('Please, enter destination address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="destinationAddress" name="destinationAddress" value="<?php echo isset($_GET['destinationAddress']) ? htmlspecialchars($_GET['destinationAddress']) : ''; ?>">
                  </div>
                  <!-- Payment Method -->
                  <div class="form-group">
                     <label>Driver Paid Separately</label>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCash" value="cash" <?php echo isset($_GET['paymentMethod']) && $_GET['paymentMethod'] == 'cash' ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="payCash">
                        I will pay the driver cash
                        </label>
                     </div>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCard" value="card" <?php echo isset($_GET['paymentMethod']) && $_GET['paymentMethod'] == 'card' ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="payCard">
                        I will pay the driver with debit/credit card (10% fee applies to the driver fare)
                        </label>
                     </div>
                  </div>
                  <input title="" type="hidden" name="firstName" value="<?=$_GET["firstName"]?>">
                  <input title="" type="hidden" name="lastName" value="<?=$_GET["lastName"]?>">
                  <input title="" type="hidden" name="email" value="<?=$_GET["email"]?>">
                  <input title="" type="hidden" name="phoneNumber" value="<?=$_GET["phoneNumber"]?>">
                  <input title="" type="hidden" name="countryCode" value="<?=$_GET["countryCode"]?>">
				  <input title="" type="hidden" name="countryName" value="<?= $_GET[
                      "countryName"
                  ] ?>">
                  <center><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Calculate Now"></center>
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
                     // If hour, minute, or AM/PM is empty, alert the user
                     alert("Please make sure to enter hour, minute, and AM/PM.");
                     return false;
                 }
         
                 const currentDate = new Date();
                 const selectedDate = new Date(dateElement.value);
         
                 // Convert time to 24-hour format
                 const hours = parseInt(hoursElement.value);
                 const minutes = parseInt(minutesElement.value);
                 const isPM = ampmElement.value === 'PM';
                 const selectedHours = isPM ? (hours % 12) + 12 : (hours % 12);
         
                 // Set the selected date and time
                 const selectedDateTime = new Date(selectedDate);
                 selectedDateTime.setHours(selectedHours, minutes, 0, 0);
         
                 // Current time + 1 hour
                 const currentTimePlusOneHour = new Date(currentDate.getTime() + (60 * 60 * 1000));
         
                 if (selectedDateTime < currentTimePlusOneHour) {
                     showError("Please, select a tour time that is at least 1 hour later than the current time.");
                     return false;
                 }
         
                 // Validate time restrictions: the tour must be booked between 9:00 AM and 5:00 PM
                 if (selectedHours < 9 || selectedHours > 17 || (selectedHours === 17 && minutes > 0)) {
                     showError("Please, do not use this application to book a tour between 5:01 pm and 8:59 am.<br> Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-scheduled-central-park-pedicab-tour.html'>Request Scheduled Central Park Pedicab Tour</a>");
                     return false;
                 }
         
                 return true; // If all validations pass, allow form submission
             }
         
             // Prevent form submission if validations fail
             form.addEventListener('submit', function(event) {
                 if (!validateTime()) {
                     event.preventDefault();
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
        strictBounds: true // Restrict results within the specified bounds
    };

    var allowedZipCodes = [
        '10017', '10018', '10019', '10020', '10022', '10036', '10055',
        '10101', '10102', '10103', '10104', '10105', '10106', '10107',
        '10108', '10109', '10110', '10111', '10112', '10124', '10126',
        '10129', '10151', '10152', '10153', '10154', '10155', '10163',
        '10164', '10166', '10167', '10169', '10170', '10171', '10172',
        '10173', '10174', '10175', '10176', '10177', '10179', '10185'
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

        if (zipCode && allowedZipCodes.includes(zipCode.long_name)) {
            console.log("Valid location: ", place.formatted_address);
            var addressWithoutCountry = place.formatted_address.replace(/, USA$/, '');
            if (customPlaceName && !addressWithoutCountry.includes(customPlaceName)) {
                inputField.value = `${addressWithoutCountry} (${customPlaceName})`;
            } else {
                inputField.value = addressWithoutCountry;
            }
        } else {
            console.error("Invalid postal code.");
            showError("You are trying to book a tour outside of our main service areas.<br> Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-central-park-pedicab-tour.html'>Request Central Park Pedicab Tour</a>");
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