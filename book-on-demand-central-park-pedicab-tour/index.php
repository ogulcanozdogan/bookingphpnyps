<?php
include('inc/init.php');

// PHP code to handle form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the next button is clicked, save the data to session variables
    if (isset($_POST["next"])) {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
    }
    // If the back button is clicked, clear the data from session variables
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
      <title>Book On Demand Central Park Pedicab Tour</title>
	  <meta name="description" content=" On Demand Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index, follow">
	     <link rel="shortcut icon" href="vendor/favicon.ico">
      <!-- Viewport meta tag added -->
  <link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>

<link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>

      <link type="text/css" href="css/style.css" rel="stylesheet">
   </head>
   <body>
      <form onsubmit="return validateForm()" method="post" id="myForm" action="step2.php">
         <div class="container">
            <div class="row justify-content-center">
               <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
               <input <?php if (!$_POST) {
                   echo "disabled";
               } ?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
               <div class="col-md-6">
                  <!-- Center the form within a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
					 <b>On Demand<br>Central Park Pedicab Tour<br>Booking Application</b>
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
        echo "You are trying to book a ride outside of our main service areas.<br>Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-scheduled-central-park-pedicab-tour/'>Request Scheduled Central Park Pedicab Tour</a>";
    } ?>
    </div>
</div>

<div class="error-message2" id="error-message2" <?php if (
                     $_GET["error"] != "unavailable"
                 ) {
                     echo 'style="display: none;"';
                 } ?>>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <div class="error-text">
    <?php if ($_GET["error"] == "unavailable") {
        echo "We are unavailable on this date.";
    } ?>
    </div>
</div>

<div class="error-message2" id="error-message2" <?php if (
                     $_GET["error"] != "unavailabletime"
                 ) {
                     echo 'style="display: none;"';
                 } ?>>
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <div class="error-text">
    <?php if ($_GET["error"] == "unavailabletime") {
        echo "We are unavailable on this time.";
    } ?>
    </div>
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
                                isset($_POST["numPassengers"]) &&
                                $_POST["numPassengers"] == $count
                            ) {
                                echo " selected";
                            }
                            echo ">" . $count . "</option>";
                        }
                        ?>
                     </select>
                  </div>
                  <div class="form-group">
                     <label class="form-label">Duration of Tour</label>
                     <div class="row">
                        <!-- Add a row to stack the contents vertically -->
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="durationA" value="40" <?php echo isset(
                                  $_POST["tourDuration"]
                              ) && $_POST["tourDuration"] == "40"
                                  ? "checked"
                                  : ""; ?>>
                              <label class="form-check-label" for="durationA">
                              40 Minutes (Non Stop)
                              </label>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="durationB" value="45" <?php echo isset(
                                  $_POST["tourDuration"]
                              ) && $_POST["tourDuration"] == "45"
                                  ? "checked"
                                  : ""; ?>>
                              <label class="form-check-label" for="durationB">
                              45 Minutes (Stop at Cherry Hill)
                              </label>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="durationC" value="50" <?php echo isset(
                                  $_POST["tourDuration"]
                              ) && $_POST["tourDuration"] == "50"
                                  ? "checked"
                                  : ""; ?>>
                              <label class="form-check-label" for="durationC">
                              50 Minutes (Stop at Cherry Hill + Strawberry Fields)
                              </label>
                           </div>
                        </div>
                        <div class="col-12">
                           <div class="form-check">
                              <input title="" class="form-check-input" required type="radio" name="tourDuration" id="durationD" value="60" <?php echo isset(
                                  $_POST["tourDuration"]
                              ) && $_POST["tourDuration"] == "60"
                                  ? "checked"
                                  : ""; ?>>
                              <label class="form-check-label" for="durationD">
                              1 Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- Pick Up Address -->
                  <div class="form-group">
                     <label for="pickUpAddress">Start Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter start address." oninvalid="this.setCustomValidity('Please, enter start address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="pickUpAddress" name="pickUpAddress" value="<?php echo isset(
                         $_POST["pickUpAddress"]
                     )
                         ? htmlspecialchars($_POST["pickUpAddress"])
                         : ""; ?>">
                  </div>
                  <!-- Destination Address -->
                  <div class="form-group">
                     <label for="destinationAddress">Finish Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter finish address." oninvalid="this.setCustomValidity('Please, enter finish address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="destinationAddress" name="destinationAddress" value="<?php echo isset(
                         $_POST["destinationAddress"]
                     )
                         ? htmlspecialchars($_POST["destinationAddress"])
                         : ""; ?>">
                  </div>
                  <!-- Payment Method -->
                  <div class="form-group">
                     <label>Driver Paid Separately</label>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCash" value="CASH" <?php echo isset(
                            $_POST["paymentMethod"]
                        ) && $_POST["paymentMethod"] == "CASH"
                            ? "checked"
                            : ""; ?> required>
                        <label class="form-check-label" for="payCash">
                        I will pay the driver cash
                        </label>
                     </div>
                     <div class="form-check">
                        <input title="" class="form-check-input" type="radio" name="paymentMethod" id="payCard" value="card" <?php echo isset(
                            $_POST["paymentMethod"]
                        ) && $_POST["paymentMethod"] == "card"
                            ? "checked"
                            : ""; ?> required>
                        <label class="form-check-label" for="payCard">
                        I will pay the driver with debit/credit card (10% fee applies to the driver fare)
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
    window.location.href = 'https://newyorkpedicabservices.com/central-park-pedicab-tours.html';
});

</script>
<?php
include('inc/db.php');
$zipCodes = [];
$sorgu = $baglanti->prepare("SELECT * FROM zip_codes WHERE app_id = 1");
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
        strictBounds: true // Restricts results to within the specified bounds
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

        if (zipCode && allowedZipCodes.includes(zipCode.long_name)) {
            var addressWithoutCountry = place.formatted_address.replace(/, USA$/, '');
            inputField.value = customPlaceName && !addressWithoutCountry.includes(customPlaceName) ? `${addressWithoutCountry} (${customPlaceName})` : addressWithoutCountry;
        } else {
            showError("You are trying to book a tour outside of our main service areas.<br> Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-scheduled-central-park-pedicab-tour/'>Request Scheduled Central Park Pedicab Tour</a>");
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
        } else {
            var formattedAddress = place.formatted_address.replace(/, USA$/, '');
            if (customPlaceName && !formattedAddress.includes(customPlaceName)) {
                inputField.value = `${formattedAddress} (${customPlaceName})`;
            } else {
                inputField.value = formattedAddress;
            }
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
   </body>
</html>
