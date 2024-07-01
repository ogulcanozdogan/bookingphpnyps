<?php
if (!$_POST) {
	header("location: index.php");
		exit;
}
ini_set("display_errors", 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';


// Dotenv Kütüphanesini yükleyin
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$firstName = htmlspecialchars($_POST["firstName"]); // default value 1
$lastName = htmlspecialchars($_POST["lastName"]); // default value 1
$email = htmlspecialchars($_POST["email"]); // default value 1
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]); // default value 1
$countryCode = htmlspecialchars($_POST["countryCode"]); // default value 1
$countryName = htmlspecialchars($_POST["countryName"]); // default value 1
$numPassengers = htmlspecialchars($_POST["numPassengers"] ?? 1); // default value 1
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

    $pay = $bookingFeeCent;

$paymentIntent = $stripe->paymentIntents->create([
    "automatic_payment_methods" => ["enabled" => true],
    "amount" => $pay,
    "currency" => "usd",
    "description" => "NYPS WEB On Demand Hourly Pedicab Tour",
    "receipt_email" => $email,
]);

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book On Demand Hourly Pedicab Service</title>
	  <meta name="description" content=" On Demand Central Park Pedicab Tour Booking Application ">
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
                     <b>On Demand<br>Hourly Pedicab Service<br>Booking Application</b>
                  </div>
                 <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Type</th>
                           <td>On Demand Central Park Pedicab Tour</td>
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
                           <th scope="row">Duration of Service</th>
                           <td><?php if (
                               $serviceDuration == 30 or
                               $serviceDuration == 90
                           ) {
                               echo $serviceDuration . " Minutes";
                           } else {
                               echo $serviceDuration . " Hours";
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
                            <tr>
                                <th scope="row">Booking Fee</th>
                                <td>$<?= number_format($bookingFee, 2) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Driver Fare</th>
                                <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                            </tr>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format(
                               $totalFare,
                               2
                           )?></b></td>
                        </tr>
                     </tbody>
                  </table>
                </form> 
                <form action="charge.php" method="post" id="payment-form">
				<label><input required type="checkbox" name="declaration1"> I confirm that I am ready to get picked up now.</label>
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
                  <input title="" type="hidden" name="countryName" value="<?= $countryName ?>">
                  <center><button type="submit">Pay $<?= number_format($bookingFee, 2)?> </button></center>
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
var serviceDetails = <?php echo json_encode($serviceDetails); ?>;
var serviceDuration = <?php echo json_encode($serviceDuration); ?>;


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
    "&serviceDetails=" + encodeURIComponent(serviceDetails) +
    "&serviceDuration=" + encodeURIComponent(serviceDuration) +
    "&phoneNumber=" + encodeURIComponent(phoneNumber);

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: 'https://newyorkpedicabservices.com/book-on-demand-hourly-pedicab-service/charge.php?'+ queryString,
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
    document.getElementById("prevButton").addEventListener("click", function() {
        var numPassengers = <?php echo json_encode(
            $_POST["numPassengers"] ?? 1
        ); ?>;
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
		var countryName = <?php echo json_encode(
            $_POST["countryName"] ?? ""
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
                          "&operationFare=" + encodeURIComponent(operationFare) +
                          "&serviceDetails=" + encodeURIComponent(serviceDetails) +
                          "&serviceDuration=" + encodeURIComponent(serviceDuration) +
						  "&countryCode=" + encodeURIComponent(countryCode) +
						  "&countryName=" + encodeURIComponent(countryName) +
                          "&phoneNumber=" + encodeURIComponent(phoneNumber);

        window.location.href = "step3.php?" + queryString;
    });
    </script>

   </body>
</html>
