<?php
include('inc/init.php');
if (!$_POST) {
    header("location: index.php");
    exit;
}
require_once "vendor/autoload.php";

// Install Dotenv Library
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$firstName = htmlspecialchars($_POST["firstName"]);
$lastName = htmlspecialchars($_POST["lastName"]);
$email = htmlspecialchars($_POST["email"]);
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
$countryCode = htmlspecialchars($_POST["countryCode"]);
$countryName = htmlspecialchars($_POST["countryName"]);
$numPassengers = htmlspecialchars($_POST["numPassengers"] ?? 1);
$deneme2 = htmlspecialchars($_POST["pickUpAddress"]);
$destinationAddress = htmlspecialchars($_POST["destinationAddress"]);
$paymentMethod = htmlspecialchars($_POST["paymentMethod"]);
$rideDuration = htmlspecialchars($_POST["rideDuration"]);
$bookingFee = htmlspecialchars($_POST["bookingFee"]);
$driverFare = htmlspecialchars($_POST["driverFare"]);
$totalFare = htmlspecialchars($_POST["totalFare"]);
$returnDuration = htmlspecialchars($_POST["returnDuration"]);
$operationFare = htmlspecialchars($_POST["operationFare"]);
$tourDuration = htmlspecialchars($_POST["tourDuration"]);
$pickup1 = htmlspecialchars($_POST["pickup1"]);
$pickup2 = htmlspecialchars($_POST["pickup2"]);
$return1 = htmlspecialchars($_POST["return1"]);
$return2 = htmlspecialchars($_POST["return2"]);
$toursuresi = htmlspecialchars($_POST["toursuresi"]);
$hourlyOperationFare = htmlspecialchars($_POST["hourlyOperationFare"]);
$bookingFeeCent = intval($bookingFee * 100);

$stripe = new \Stripe\StripeClient([
    "api_key" => $_ENV["STRIPE_API_KEY"],
    "stripe_version" => "2020-08-27",
]);

$paymentIntent = $stripe->paymentIntents->create([
    "automatic_payment_methods" => ["enabled" => true],
    "amount" => $bookingFeeCent,
    "currency" => "usd",
    "description" => "NYPS WEB On Demand Central Park Pedicab Tour",
    "receipt_email" => $email,
]);

$todayDay = date("m/d/Y");
$todayDayName = date("l", strtotime($todayDay));
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
      <title>Book On Demand Central Park Pedicab Tour</title>
      <meta name="description" content=" On Demand Central Park Pedicab Tour Booking Application ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
       <link rel="shortcut icon" href="vendor/favicon.ico">
    <script src="https://js.stripe.com/v3/"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/step4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
	<!-- Google tag (gtag.js) --> <script async src=" https://www.googletagmanager.com/gtag/js?id=AW-16684451653 "></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16684451653'); </script>
</head>
<body>
    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="">
                    <!-- Form centered within a narrower column -->
                    <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                    <div class="text-center mb-4">
                     <b>On Demand<br>Central Park Pedicab Tour<br>Booking Application</b>
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
                           <td>+<?= $countryCode . $phoneNumber ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Number of Passengers</th>
                                <td><?= $numPassengers ?></td>
                            </tr>
                            <tr>
                           <th scope="row">Date Of Tour</th>
                           <td><?= $todayDay . ' ' . $todayDayName ?> (Today)</td>
                        </tr>
                        <tr>
                           <th scope="row">Time Of Tour</th>
                           <td>As Soon As Possible</td>
                        </tr>
                            <tr>
                           <th scope="row">Duration of Tour</th>
                           <td><?php
if ($tourDuration == 60){
	$tourDuration = "1 Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)";
}
else{
	if ($tourDuration == 50){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill + Strawberry Fields)";
	}
	else if ($tourDuration == 45){
		$tourDuration = $tourDuration . " Minutes (Stop at Cherry Hill)";
	}
	else if ($tourDuration == 40){
		$tourDuration = $tourDuration . " Minutes (Non Stop)";
	}
}
								echo $tourDuration; ?></td>
                        </tr>
                            <tr>
                                <th scope="row">Duration of Ride</th>
                                <td><?= number_format($rideDuration, 2) ?> Minutes</td>
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
                                <th scope="row">Booking Fee</th>
                                <td>$<?= number_format($bookingFee, 2) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Driver Fare</th>
                                 <td>$<?= number_format($driverFare, 2) ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                            </tr>
                            <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format($totalFare, 2); ?></b></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
                <form action="charge.php" method="post" id="payment-form">
                <label>
                <input required type="checkbox" name="declaration1"
                oninvalid="this.setCustomValidity('Please, check this box to proceed.')"
                oninput="this.setCustomValidity('')">
            I confirm that I am ready to get picked up now.
                </label>
                <label>
                <input required type="checkbox" name="declaration2"
                oninvalid="this.setCustomValidity('Please, check this box to proceed.')"
                oninput="this.setCustomValidity('')">
            I confirm that I am not booking a guided tour.
                </label>				
                    <div class="form-row">
                        <div id="card-element">
                            <!-- Stripe.js injects the Card Element -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>
                    <input title="" type="hidden" name="firstName" value="<?= $firstName ?>">
                    <input title="" type="hidden" name="lastName" value="<?= $lastName ?>">
                    <input title="" type="hidden" name="email" value="<?= $email ?>">
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
                    <input title="" type="hidden" name="operationFare" value="<?= $operationFare ?>">
                    <input title="" type="hidden" name="tourDuration" value="<?= $tourDuration ?>">
                    <input title="" type="hidden" name="pickup1" value="<?= $pickup1 ?>">
                    <input title="" type="hidden" name="pickup2" value="<?= $pickup2 ?>">
                    <input title="" type="hidden" name="return1" value="<?= $return1 ?>">
                    <input title="" type="hidden" name="return2" value="<?= $return2 ?>">
                    <input title="" type="hidden" name="toursuresi" value="<?= $toursuresi ?>">
                    <input title="" type="hidden" name="countryCode" value="<?= $countryCode ?>">
                    <input title="" type="hidden" name="hourlyOperationFare" value="<?= $hourlyOperationFare ?>">
                    <center><button type="submit">Pay $<?= $bookingFee ?> </button></center>
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

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(form);
        
        fetch('saveit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(uniqueId => {
            stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: 'https://newyorkpedicabservices.com/book-on-demand-central-park-pedicab-tour/charge.php?unique_id=' + uniqueId,
                },
            }).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    form.submit();
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput-jquery.min.js"></script>
<script>
document.getElementById("prevButton").addEventListener("click", function() {
    // Form verilerini hazırla
    var formData = {
        numPassengers: <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>,
        pickUpAddress: <?php echo json_encode($_POST["pickUpAddress"]); ?>,
        destinationAddress: <?php echo json_encode($_POST["destinationAddress"]); ?>,
        paymentMethod: <?php echo json_encode($_POST["paymentMethod"]); ?>,
        firstName: <?php echo json_encode($_POST["firstName"] ?? ""); ?>,
        lastName: <?php echo json_encode($_POST["lastName"] ?? ""); ?>,
        email: <?php echo json_encode($_POST["email"] ?? ""); ?>,
        phoneNumber: <?php echo json_encode($_POST["phoneNumber"] ?? ""); ?>,
        countryCode: <?php echo json_encode($_POST["countryCode"] ?? ""); ?>,
        countryName: <?php echo json_encode($_POST["countryName"] ?? ""); ?>,
        bookingFee: <?php echo json_encode($_POST["bookingFee"] ?? ""); ?>,
        driverFare: <?php echo json_encode($_POST["driverFare"] ?? ""); ?>,
        totalFare: <?php echo json_encode($_POST["totalFare"] ?? ""); ?>,
        returnDuration: <?php echo json_encode($_POST["returnDuration"] ?? ""); ?>,
        operationFare: <?php echo json_encode($_POST["operationFare"] ?? ""); ?>,
        rideDuration: <?php echo json_encode($_POST["rideDuration"] ?? ""); ?>,
        tourDuration: <?php echo json_encode($_POST["tourDuration"] ?? ""); ?>,
        return1: <?php echo json_encode($_POST["return1"] ?? ""); ?>,
        return2: <?php echo json_encode($_POST["return2"] ?? ""); ?>,
        pickup1: <?php echo json_encode($_POST["pickup1"] ?? ""); ?>,
        pickup2: <?php echo json_encode($_POST["pickup2"] ?? ""); ?>,
        toursuresi: <?php echo json_encode($_POST["toursuresi"] ?? ""); ?>,
        hourlyOperationFare: <?php echo json_encode($_POST["hourlyOperationFare"] ?? ""); ?>
    };

    // Create the form dynamically
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = 'step3.php';

    // Add form data
    for (var key in formData) {
        if (formData.hasOwnProperty(key)) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = formData[key];
            form.appendChild(input);
        }
    }

    // Add the form to the page and submit
    document.body.appendChild(form);
    form.submit();
});
</script>

</body>
</html>
