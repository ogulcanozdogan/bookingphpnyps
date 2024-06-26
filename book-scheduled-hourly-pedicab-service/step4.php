<?php
if (!$_POST) {
	header("location: index.php");
		exit;
}
ini_set("display_errors", 1);
error_reporting(E_ALL);
require_once "vendor/autoload.php";

// Dotenv Kütüphanesini yükleyin
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$firstName = htmlspecialchars($_POST["firstName"]); // default value 1
$lastName = htmlspecialchars($_POST["lastName"]); // default value 1
$email = htmlspecialchars($_POST["email"]); // default value 1
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]); // default value 1
$countryCode = htmlspecialchars($_POST["countryCode"]); // default value 1
$numPassengers = htmlspecialchars($_POST["numPassengers"] ?? 1); // default value 1
$pickUpDate = htmlspecialchars($_POST["pickUpDate"]);
$hours = htmlspecialchars($_POST["hours"]);
$minutes = htmlspecialchars($_POST["minutes"]);
$ampm = htmlspecialchars($_POST["ampm"]);
$deneme2 = htmlspecialchars($_POST["pickUpAddress"]);
$destinationAddress = htmlspecialchars($_POST["destinationAddress"]);
$paymentMethod = htmlspecialchars($_POST["paymentMethod"]);
$rideDuration = htmlspecialchars($_POST["rideDuration"]);
$bookingFee = htmlspecialchars($_POST["bookingFee"]);
$driverFare = htmlspecialchars($_POST["driverFare"]);
$totalFare = htmlspecialchars($_POST["totalFare"]);
$returnDuration = htmlspecialchars($_POST["returnDuration"]);
$pickUpDuration = htmlspecialchars($_POST["pickUpDuration"]);
$hub = htmlspecialchars($_POST["hub"]);
$baseFare = htmlspecialchars($_POST["baseFare"]);
$operationFare = htmlspecialchars($_POST["operationFare"]);
$serviceDetails = htmlspecialchars($_POST["serviceDetails"]);
$serviceDuration = htmlspecialchars($_POST["serviceDuration"]);

$bookingFee = number_format($bookingFee, 2);
$bookingFeeCent = intval($bookingFee * 100);

$totalFare = number_format($totalFare, 2);
$totalFareCent = intval($totalFare * 100);

$driverFare = number_format($driverFare, 2);

$stripe = new \Stripe\StripeClient([
    "api_key" => $_ENV["STRIPE_API_KEY"],
    "stripe_version" => "2020-08-27",
]);

if ($paymentMethod != "fullcard") {
    $pay = $bookingFeeCent;
} else {
    $pay = $totalFareCent;
}

$paymentIntent = $stripe->paymentIntents->create([
    "automatic_payment_methods" => ["enabled" => true],
    "amount" => $pay,
    "currency" => "usd",
    "description" => "NYPS WEB Scheduled Hourly Pedicab Tour",
    "receipt_email" => $email,
]);


$pickUpDateTime = DateTime::createFromFormat("m/d/Y", $pickUpDate);
$dayOfWeek = $pickUpDateTime->format("l");
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
      <script src="https://js.stripe.com/v3/"></script>
      <link href="css/style.css" rel="stylesheet">
    <link href="css/step4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
   </head>
   <body>
	    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6"> 
                <form method="post" action="">
                  <!-- Center the form within a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>Scheduled<br>Hourly Pedicab Service<br>Booking Application</b>
                  </div>
                 
                 <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Type</th>
                           <td>Scheduled Hourly Pedicab Service</td>
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
                           <td><?= $email ?></td>
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
                           <th scope="row">Date of Service</th>
                           <td><?php echo $pickUpDate . ' ' .$dayOfWeek;?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Service</th>
                           <td><?php echo $hours .
                               ":" .
                               $minutes .
                               " " .
                               $ampm; ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Service</th>
                           <td><?php if (
                               $serviceDuration == 30 or
                               $serviceDuration == 90
                           ) {
                               echo $serviceDuration . " Minutes";
                           } else {
                               echo $serviceDuration . " Hour";
                           } ?> </td>
                        </tr>
                        <tr>
                           <th scope="row">Start Address</th>
                           <td><?= $deneme2 ?></td>
                        </tr>
                        <tr>
                           <th scope="row">Finish Address</th>
                           <td><?= $destinationAddress ?></td>
                        </tr>
						<tr>
                        <th scope="row">Service Details</th>
                        <td><?= $serviceDetails ?></td>
                        </tr>
                        <?php if ($paymentMethod != "fullcard") { ?>
                            <tr>
                                <th scope="row">Booking Fee</th>
                                <td>$<?= number_format($bookingFee, 2) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Driver Fare</th>
                                <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                            </tr>
							<?php } ?>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format(
                               $totalFare,
                               2
                           ); if ($paymentMethod == 'fullcard') { echo ' with debit/credit card'; }?></b></td>
                        </tr>
                     </tbody>
                  </table>
                </form> 
                <form action="https://newyorkpedicabservices.com/book-scheduled-hourly-pedicab-service/charge.php" method="post" id="payment-form">
                    <div class="form-row">
                        <div id="card-element">
                            <!-- Stripe.js injects the Card Element -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <input title="" type="hidden" name="firstName" value="<?= $firstName ?>">
	                <input title="" type="hidden" name="lastName" value="<?= $lastName ?>">
	                <input title="" type="hidden" name="aq" value="<?= $email ?>">
	                <input title="" type="hidden" name="phoneNumber" value="<?= $phoneNumber ?>">
                    <input title="" type="hidden" name="numPassengers" value="<?= $numPassengers ?>">
                    <input title="" type="hidden" name="pickUpDate" value="<?= $pickUpDate ?>">
                    <input title="" type="hidden" name="hours" value="<?= $hours ?>">
                    <input title="" type="hidden" name="minutes" value="<?= $minutes ?>">
                    <input title="" type="hidden" name="ampm" value="<?= $ampm ?>">
                    <input title="" type="hidden" name="pickUpAddress" value="<?= $deneme2 ?>">
                    <input title="" type="hidden" name="destinationAddress" value="<?= $destinationAddress ?>">
                    <input title="" type="hidden" name="paymentMethod" value="<?= $paymentMethod ?>">
                    <input title="" type="hidden" name="rideDuration" value="<?= $rideDuration ?>">		
	                <input title="" type="hidden" name="bookingFee" value="<?= $bookingFee ?>">
                    <input title="" type="hidden" name="driverFare" value="<?= $driverFare ?>">
                    <input title="" type="hidden" name="totalFare" value="<?= $totalFare ?>">
	                <input title="" type="hidden" name="returnDuration" value="<?= $returnDuration ?>">
                    <input title="" type="hidden" name="pickUpDuration" value="<?= $pickUpDuration ?>">	
	                <input title="" type="hidden" name="hub" value="<?= $hub ?>">		
	                <input title="" type="hidden" name="baseFare" value="<?= $baseFare ?>">
                    <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">	
		            <input title="" type="hidden" name="serviceDetails" value="<?= $serviceDetails ?>">	
	                <input title="" type="hidden" name="serviceDuration" value="<?= $serviceDuration ?>">		
                   <center> <button type="submit">Pay $<?php if (
                       $paymentMethod != "fullcard"
                   ) {
                       echo $bookingFee;
                   } else {
                       echo $totalFare;
                   } ?></button></center>
                </form>
            </div>
        </div>
    </div>
    <script>
        var stripe = Stripe('<?php echo $_ENV["STRIPE_PUBLIC_KEY"]; ?>');
        var elements = stripe.elements({
            clientSecret: '<?= $paymentIntent->client_secret ?>'
        });
        var paymentElement = elements.create('payment');
        paymentElement.mount('#card-element');

        paymentElement.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

var numPassengers = <?php echo json_encode($numPassengers); ?>;
var pickUpAddress = <?php echo json_encode($deneme2); ?>;
var destinationAddress = <?php echo json_encode($destinationAddress); ?>;
var paymentMethod = <?php echo json_encode($paymentMethod); ?>;
var firstName = <?php echo json_encode($firstName); ?>;
var lastName = <?php echo json_encode($lastName); ?>;
var email = <?php echo json_encode($email); ?>;
var phoneNumber = <?php echo json_encode($phoneNumber); ?>;
var bookingFee = <?php echo json_encode($bookingFee); ?>;
var driverFare = <?php echo json_encode($driverFare); ?>;
var totalFare = <?php echo json_encode($totalFare); ?>;
var returnDuration = <?php echo json_encode($returnDuration); ?>;
var operationFare = <?php echo json_encode($operationFare); ?>;
var rideDuration = <?php echo json_encode($rideDuration); ?>;
var pickUpDuration = <?php echo json_encode($pickUpDuration); ?>;
var hub = <?php echo json_encode($hub); ?>;
var baseFare = <?php echo json_encode($baseFare); ?>;
var serviceDetails = <?php echo json_encode($serviceDetails); ?>;
var serviceDuration = <?php echo json_encode($serviceDuration); ?>;
var pickUpDate = <?php echo json_encode($pickUpDate); ?>;
var hours = <?php echo json_encode($hours); ?>;
var minutes = <?php echo json_encode($minutes); ?>;
var ampm = <?php echo json_encode($ampm); ?>;

var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
    "&pickUpAddress=" + encodeURIComponent(pickUpAddress) +
    "&destinationAddress=" + encodeURIComponent(destinationAddress) +
    "&paymentMethod=" + encodeURIComponent(paymentMethod) +
    "&firstName=" + encodeURIComponent(firstName) +
    "&lastName=" + encodeURIComponent(lastName) +
    "&email=" + encodeURIComponent(email) +
    "&bookingFee=" + encodeURIComponent(bookingFee) +
    "&driverFare=" + encodeURIComponent(driverFare) +
    "&totalFare=" + encodeURIComponent(totalFare) +
    "&rideDuration=" + encodeURIComponent(rideDuration) +
    "&returnDuration=" + encodeURIComponent(returnDuration) +
    "&operationFare=" + encodeURIComponent(operationFare) +
    "&pickUpDuration=" + encodeURIComponent(pickUpDuration) +
    "&hub=" + encodeURIComponent(hub) +
    "&baseFare=" + encodeURIComponent(baseFare) +
    "&serviceDetails=" + encodeURIComponent(serviceDetails) +
    "&serviceDuration=" + encodeURIComponent(serviceDuration) +
    "&pickUpDate=" + encodeURIComponent(pickUpDate) +
    "&hours=" + encodeURIComponent(hours) +
    "&minutes=" + encodeURIComponent(minutes) +
    "&ampm=" + encodeURIComponent(ampm) +
    "&phoneNumber=" + encodeURIComponent(phoneNumber);

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: 'https://newyorkpedicabservices.com/book-scheduled-hourly-pedicab-service/charge.php?'+ queryString,
                },
            }).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    form.submit();
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput-jquery.min.js"></script>
    <script>
        $("#phoneNumber").intlTelInput({
            initialCountry: "us", // Automatically selects the user's country
            separateDialCode: true, // Displays phone code as a separate field
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Utility script for formatting the code
        });
    </script>
    <script>
        // Get the phone number input field
        var phoneNumberInput = document.getElementById("phoneNumber");

        // Format the phone number on change
        phoneNumberInput.addEventListener("input", function(event) {
            // Get the input value
            var input = event.target.value;
            
            // Keep only digits
            var phoneNumber = input.replace(/\D/g, '');

            // Check the format of a 10-digit phone number
            var phoneNumberRegex = /^(\d{3})(\d{3})(\d{4})$/;
            if (phoneNumberRegex.test(phoneNumber)) {
                // Format the number and add parentheses
                var formattedPhoneNumber = phoneNumber.replace(phoneNumberRegex, "($1) $2-$3");

                // Place the formatted number into the input field
                event.target.value = formattedPhoneNumber;
            }
        });
    </script>

    <script>
    document.getElementById("prevButton").addEventListener("click", function() {
        var numPassengers = <?php echo json_encode(
            $_POST["numPassengers"] ?? 1
        ); ?>;
        var pickUpDate = <?php echo json_encode($_POST["pickUpDate"]); ?>;
        var hours = <?php echo json_encode($_POST["hours"]); ?>;
        var minutes = <?php echo json_encode($_POST["minutes"]); ?>;
        var ampm = <?php echo json_encode($_POST["ampm"]); ?>;
        var pickUpAddress = <?php echo json_encode($_POST["pickUpAddress"]); ?>;
        var destinationAddress = <?php echo json_encode(
            $_POST["destinationAddress"]
        ); ?>;
        var paymentMethod = <?php echo json_encode($_POST["paymentMethod"]); ?>;
        var firstName = <?php echo json_encode($_POST["firstName"] ?? ""); ?>;
        var lastName = <?php echo json_encode($_POST["lastName"] ?? ""); ?>;
        var email = <?php echo json_encode($_POST["email"] ?? ""); ?>;
        var phoneNumber = <?php echo json_encode(
            $_POST["phoneNumber"] ?? ""
        ); ?>;
        var countryCode = <?php echo json_encode(
            $_POST["countryCode"] ?? ""
        ); ?>;
        var bookingFee = <?php echo json_encode($_POST["bookingFee"] ?? ""); ?>;
        var driverFare = <?php echo json_encode($_POST["driverFare"] ?? ""); ?>;
        var totalFare = <?php echo json_encode($_POST["totalFare"] ?? ""); ?>;	
        var returnDuration = <?php echo json_encode(
            $_POST["returnDuration"] ?? ""
        ); ?>;
        var pickUpDuration = <?php echo json_encode(
            $_POST["pickUpDuration"] ?? ""
        ); ?>;
        var hub = <?php echo json_encode($_POST["hub"] ?? ""); ?>;
        var baseFare = <?php echo json_encode($_POST["baseFare"] ?? ""); ?>;
        var operationFare = <?php echo json_encode(
            $_POST["operationFare"] ?? ""
        ); ?>;	
        var rideDuration = <?php echo json_encode(
            $_POST["rideDuration"] ?? ""
        ); ?>;		
        var serviceDetails = <?php echo json_encode(
            $_POST["serviceDetails"] ?? ""
        ); ?>;	
        var serviceDuration = <?php echo json_encode(
            $_POST["serviceDuration"] ?? ""
        ); ?>;	

        var queryString = "numPassengers=" + encodeURIComponent(numPassengers) +
                          "&pickUpDate=" + encodeURIComponent(pickUpDate) +
                          "&hours=" + encodeURIComponent(hours) +
                          "&minutes=" + encodeURIComponent(minutes) +
                          "&ampm=" + encodeURIComponent(ampm) +
                          "&pickUpAddress=" + encodeURIComponent(pickUpAddress) +
                          "&destinationAddress=" + encodeURIComponent(destinationAddress) +
                          "&paymentMethod=" + encodeURIComponent(paymentMethod) +
                          "&firstName=" + encodeURIComponent(firstName) +
                          "&lastName=" + encodeURIComponent(lastName) +
                          "&email=" + encodeURIComponent(email) +
                          "&bookingFee=" + encodeURIComponent(bookingFee) +
                          "&driverFare=" + encodeURIComponent(driverFare) +
                          "&totalFare=" + encodeURIComponent(totalFare) +
                          "&rideDuration=" + encodeURIComponent(rideDuration) +
                          "&returnDuration=" + encodeURIComponent(returnDuration) +
                          "&pickUpDuration=" + encodeURIComponent(pickUpDuration) +
                          "&hub=" + encodeURIComponent(hub) +
                          "&baseFare=" + encodeURIComponent(baseFare) +
                          "&operationFare=" + encodeURIComponent(operationFare) +
                          "&serviceDetails=" + encodeURIComponent(serviceDetails) +
                          "&serviceDuration=" + encodeURIComponent(serviceDuration) +
						  "&countryCode=" + encodeURIComponent(countryCode) +
                          "&phoneNumber=" + encodeURIComponent(phoneNumber);

        window.location.href = "step3.php?" + queryString;
    });
    </script>

   </body>
</html>
