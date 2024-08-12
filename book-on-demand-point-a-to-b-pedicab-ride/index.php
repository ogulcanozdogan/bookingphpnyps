<?php
include('inc/init.php');
// PHP code to process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Save data to session variables if the next button is clicked
    if (isset($_POST["next"])) {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
    }
    // Clear session variables if the back button is clicked
    elseif (isset($_POST["back"])) {
        unset($_SESSION["name"]);
        unset($_SESSION["email"]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
	  <title>Book On Demand Point A to B Pedicab Ride</title>
	  <meta name="description" content="On Demand Point A to B Pedicab Ride Booking Application">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  	<meta name="robots" content="noindex,nofollow">
      <!-- Added viewport meta tag -->
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
               <input <?php if (!$_GET) {
                   echo "disabled";
               } ?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
               <div class="col-md-6">
                  <!-- Center the form by fitting it into a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>On Demand<br>Point A to B Pedicab Ride<br>Booking Application</b>
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
        echo "You are trying to book a ride outside of our main service areas.<br>Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-on-demand-central-park-pedicab-tour/'>Request On Demand Central Park Pedicab Tour</a>";
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
                  <div class="row">
                  </div>
                  <!-- Pick Up Address -->
                  <div class="form-group">
                     <label for="pickUpAddress">Pick Up Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter pick up address." oninvalid="this.setCustomValidity('Please, enter pick up address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="pickUpAddress" name="pickUpAddress" value="<?php echo isset(
                         $_POST["pickUpAddress"]
                     )
                         ? htmlspecialchars($_POST["pickUpAddress"])
                         : ""; ?>">
				  </div>
                  <!-- Destination Address -->
                  <div class="form-group">
                     <label for="destinationAddress">Destination Address</label>
                     <input title="" type="text" class="form-control" required placeholder="Please, enter destination address." oninvalid="this.setCustomValidity('Please, enter destination address.'); this.classList.add('invalid');" oninput="setCustomValidity(''); this.classList.remove('invalid');" id="destinationAddress" name="destinationAddress" value="<?php echo isset(
                         $_POST["destinationAddress"]
                     )
                         ? htmlspecialchars($_POST["destinationAddress"])
                         : ""; ?>">
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
      <input title="" class="form-check-input" type="radio" required name="paymentMethod" id="payCard" value="CARD" <?php echo isset(
          $_POST["paymentMethod"]
      ) && $_POST["paymentMethod"] == "CARD"
          ? "checked"
          : ""; ?>>
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
    <input title="" type="hidden" name="email" value="<?= $_POST["email"] ?>">
    <input title="" type="hidden" name="phoneNumber" value="<?= $_POST[
        "phoneNumber"
    ] ?>">
                  <input title="" type="hidden" name="countryCode" value="<?= $_POST[
                      "countryCode"
                  ] ?>">
				  				  <input title="" type="hidden" name="countryName" value="<?= $_POST[
                      "countryName"
                  ] ?>">
                 <div style="text-align:center;"> <input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Calculate Now"> </div>
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
function initAutocomplete() {
    var manhattanBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.70172445894308, -74.02835332961955), // Southwest corner of Manhattan (Battery Park)
        new google.maps.LatLng(40.81370673870937, -73.91583560578955)  // Northeast corner of Manhattan (Inwood)
    );

    var options = {
        bounds: manhattanBounds,
        strictBounds: true // Restricts results to within the specified bounds
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

        if (zipCode && allowedZipCodes.includes(zipCode.long_name)) {
            console.log("Valid location: ", place.formatted_address);
            var addressWithoutCountry = place.formatted_address.replace(/, USA$/, '');
            inputField.value = customPlaceName && !addressWithoutCountry.includes(customPlaceName) ? `${addressWithoutCountry} (${customPlaceName})` : addressWithoutCountry;
        } else {
            console.error("Invalid postal code.");
            showError("You are trying to book a tour outside of our main service areas.<br> Please, use the form below instead.<br><a href='https://newyorkpedicabservices.com/request-point-a-to-b-pedicab-tour.html'>Request Point A to B Pedicab Tour</a>");
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
        } else if (place.name.includes("Square")) {
            console.error("Invalid location: Square results are not allowed");
            showError("You cannot select a location with 'Square' in its name.");
            inputField.value = ""; // Clear the address field
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


    function checkTimeValidity() {
        var now = new Date();
        var utcHour = now.getUTCHours();
        var nyHour = utcHour - 4; // New York Time (EST) is UTC-4

        if (nyHour < 0) nyHour += 24;

        if (nyHour < 9 || nyHour > 22) {
            showError("Please, do not use this application to book a tour between 5:01 pm and 8:59 am.");
            return false;
        }
        return true;
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
