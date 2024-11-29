<?php
include('inc/init.php');
require('inc/countryselect.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
      <title>Report Lost Item Form</title>
	  <meta name="description" content="Report Lost Item Form">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow">
      <!-- Viewport meta tag added -->
<link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>

<link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>


      <link type="text/css" href="css/style.css" rel="stylesheet">
<!-- Google tag (gtag.js) --> <script async src=" https://www.googletagmanager.com/gtag/js?id=AW-16684451653 "></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16684451653'); </script>
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
      <form onsubmit="return validateForm()" method="post" id="myForm" enctype="multipart/form-data" action="completed.php">
         <div class="container">
            <div class="row justify-content-center">
               <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
               <input <?php if (!$_GET) {echo 'disabled';}?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
               <div class="col-md-6">
                  <!-- Center the form in a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                      <b>Report Lost Item</b><br>                       <b>Form</b>
                  </div>
                  <div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text"></span>
                  </div>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input maxlength="15" title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
        required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="lastName">Last Name</label>
    <input maxlength="15" title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
        required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="email">Email Address</label>
    <input maxlength="30" title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
        required 
        oninvalid="this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid');" 
        oninput="setCustomValidity(''); this.classList.remove('invalid');" 
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
        onchange="if(!this.value.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) { this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid'); } else { this.setCustomValidity(''); this.classList.remove('invalid'); }">
</div>
<div class="form-group">
    <label for="countrySelect">Phone</label>
    <div style="display: flex;">
        <?=countrySelector();?>
        <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber" 
            onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter phone number.'); this.classList.add('invalid');" 
            oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" 
            placeholder="Enter your phone number" required >
    </div>
</div>
    <div class="form-group">
        <label for="pickUpDate">Date of Pick Up</label>
        <input title="" autocomplete="off" type="date" required
               max="2025-12-31"
               oninvalid="this.setCustomValidity('Please, select the date of pick up.'); this.classList.add('invalid');"
               oninput="this.setCustomValidity(''); this.classList.remove('invalid');"
               class="form-control" id="pickUpDate" name="pickUpDate" onchange="checkDate(this)">
    </div> <!-- we use it to change the calendar -->
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label for="hours">Hour</label>
                           <select title="" class="form-control" id="hours" name="hours" required  oninvalid="this.setCustomValidity('Please, select the hour.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">Select the hour</option>
                              <?php
                                 // Create options for hours
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
                           <select title="" class="form-control" id="minutes" name="minutes" required oninvalid="this.setCustomValidity('Please, select the minute.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">Select the minute</option>
                              <?php
                                 // Create options for minutes
                                 $minutes = ['00', '15', '30', '45'];
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
                           <select title="" class="form-control" id="ampm" name="ampm" required  oninvalid="this.setCustomValidity('Please, select AM or PM.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');">
                              <option value="">AM/PM</option>
                              <?php
                                 // Create options for AM and PM
                                 $am_pm_options = array("AM", "PM");
                                 foreach ($am_pm_options as $option) {
                                     echo '<option value="' . $option . '">' . $option . '</option>';
                                 }
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
				  <div class="form-group">
                     <label for="pickUpAddress">Pickup Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter start address." oninvalid="this.setCustomValidity('Please, enter pick up address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="pickUpAddress" name="pickUpAddress">
                  </div>
                  <!-- Destination Address -->
                  <div class="form-group">
                     <label for="destinationAddress">Drop Off Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter finish address." oninvalid="this.setCustomValidity('Please, enter destination address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="destinationAddress" name="destinationAddress">
                  </div>
				  <div class="form-group">
                     <label for="passengerFace">Upload Passenger Face Photo (max 10mb)</label>
                     <input title="" type="file" accept="image/*" class="form-control" placeholder="Please, upload passenger face photo." oninvalid="this.setCustomValidity('Please, upload passenger face photo.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="passengerFace" name="passengerFace">
                  </div>
				  <div class="form-group">
                     <label for="lostItem">Upload Lost Item Photo (max 10mb)</label>
                     <input title="" type="file" accept="image/*" class="form-control" placeholder="Please, upload lost item photo." oninvalid="this.setCustomValidity('Please, upload lost item photo.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="lostItem" name="lostItem">
                  </div>
	                <label>
                <input required type="checkbox" name="declaration1"
                oninvalid="this.setCustomValidity('Please, check this box to proceed.')"
                oninput="this.setCustomValidity('')">
            I authorize New York Pedicab Services to publish my information on online pedicab groups to help me
reach out to pedicab owners to lease a pedicab.
                </label>
                  <div style="text-align:center;"><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Submit"></div>
               </div>
            </div>
         </div>
      </form>
	  <script>
document.getElementById("myForm").addEventListener("submit", function(event) {
    const maxBoyut = 10 * 1024 * 1024; // 10 MB

    // Passenger Face Photo kontrolü
    const passengerFace = document.getElementById("passengerFace").files[0];
    if (passengerFace && passengerFace.size > maxBoyut) {
        alert("Maximum 10 MB file size for Passenger Face Photo.");
        event.preventDefault();
        return;
    }

    // Lost Item Photo kontrolü
    const lostItem = document.getElementById("lostItem").files[0];
    if (lostItem && lostItem.size > maxBoyut) {
        alert("Maximum 10 MB file size for Lost Item Photo");
        event.preventDefault();
        return;
    }
});
</script>

<script>
    window.onload = function() {
        script = document.createElement("script");
        script.src = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js";
        document.body.appendChild(script);
    };
</script>
<script>
document.getElementById('prevButton').addEventListener('click', function() {
    window.location.href = 'https://newyorkpedicabservices.com';
});

</script>
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
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('pickUpDate').setAttribute('max', today);
    });

    document.getElementById('pickUpDate').addEventListener('click', function() {
        this.showPicker();
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
            const selectedDate = new Date(dateElement.value + 'T00:00:00'); // takvimi degistirmek icin kullaniyoruz
         

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
	  <script>
function initAutocomplete() {
    var manhattanBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.699417303744625, -74.0283104499974), // Southwest corner of Manhattan (Battery Park)
        new google.maps.LatLng(40.81370673870937, -73.91583560578955)  // Northeast corner of Manhattan (Inwood)
    );

    var options = {
        bounds: manhattanBounds,
        strictBounds: true, // Restrict results within the specified bounds
        componentRestrictions: { country: 'us' } // Restrict results to the US
    };

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
            var formattedAddress = place.formatted_address;
            if (customPlaceName && !formattedAddress.includes(customPlaceName)) {
                inputField.value = `${formattedAddress} (${customPlaceName})`;
            } else {
                inputField.value = formattedAddress;
            }
            console.log("Address set to ", formattedAddress);
            checkZipCode(place, inputField, customPlaceName);
        }

        // Display coordinates
        var coordinates = place.geometry.location;
        console.log("Coordinates: ", coordinates.lat(), coordinates.lng());

        // Display coordinates on the page
        var coordinatesDisplay = document.getElementById('coordinates-display');
        coordinatesDisplay.innerHTML = `Coordinates: ${coordinates.lat()}, ${coordinates.lng()}`;
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
