<?php
include('inc/init.php');
if (!$_POST) {
    header('location: index.php');
    exit;
}
	require_once('vendor/autoload.php');

// Install Dotenv Library
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
$operationFare = htmlspecialchars($_POST["operationFare"]);
$tourDuration = htmlspecialchars($_POST["tourDuration"]);
$pickup1 = htmlspecialchars($_POST["pickup1"]);
$pickup2 = htmlspecialchars($_POST["pickup2"]);
$return1 = htmlspecialchars($_POST["return1"]);
$return2 = htmlspecialchars($_POST["return2"]);
$toursuresi = htmlspecialchars($_POST["toursuresi"]);
$pickUpDate = htmlspecialchars($_POST["pickUpDate"]);
$hours = htmlspecialchars($_POST["hours"]);
$minutes = htmlspecialchars($_POST["minutes"]);
$ampm = htmlspecialchars($_POST["ampm"]);
$baseFare = htmlspecialchars($_POST["baseFare"]);


$bookingFee = number_format($bookingFee, 2);
$bookingFeeCent = intval($bookingFee * 100);

$totalFare = number_format($totalFare, 2);
$driverFare = number_format($driverFare, 2);


$stripe = new \Stripe\StripeClient([
    'api_key' => $_ENV['STRIPE_API_KEY'],
    'stripe_version' => '2020-08-27',
]);

$paymentIntent = $stripe->paymentIntents->create([
    'automatic_payment_methods' => ['enabled' => true],
    'amount' => $bookingFeeCent,
    'currency' => 'usd',
	'description' => 'NYPS WEB Scheduled Central Park Pedicab Tour',
	'receipt_email' => $email,
]);



      
   $date = DateTime::createFromFormat('m/d/Y', $pickUpDate);

// Get day value
$pickUpDay = $date->format('l');

        $pedicabCount = ceil($numPassengers / 3);
		$driverFarePerDriver = number_format($driverFare/$pedicabCount, 2);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
      <title>Book Scheduled Central Park Pedicab Tour</title>
	  <meta name="description" content=" Scheduled Central Park Pedicab Tour Booking Application ">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
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
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                      <b>Scheduled<br>Central Park Pedicab Tour<br>Booking Application</b>
                  </div>
                  <table class="table">
                     <tbody>
                        <tr>
                           <th scope="row">Type</th>
                           <td>Scheduled Central Park Pedicab Tour</td>
                        </tr>
                        <tr>
                           <th scope="row">First Name</th>
                           <td><?=$firstName?></td>
                        </tr>
                        <tr>
                           <th scope="row">Last Name</th>
                           <td><?=$lastName?></td>
                        </tr>
                        <tr>
                           <th scope="row">Email Address</th>
                           <td><?=$email?></td>
                        </tr>
                        <tr>
                           <th scope="row">Phone Number</th>
                           <td>+<?=$countryCode . $phoneNumber?></td>
                        </tr>
<tr>
    <th scope="row">Number of Passengers</th>
    <td>
        <?php
        $pedicabCount = ceil($numPassengers / 3);
        $pedicabLabel = $pedicabCount == 1 ? 'Pedicab' : 'Pedicabs';
        echo $numPassengers . ' (' . $pedicabCount . ' ' . $pedicabLabel . ')';
        ?>
    </td>
</tr>
                        <tr>
                           <th scope="row">Date of Tour</th>
                           <td><?=$pickUpDate . ' ' . $pickUpDay?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Tour</th>
                           <td><?php echo $hours . ":" .  $minutes . " " . $ampm;?></td>
                        </tr>
						<tr>
                           <th scope="row">Duration of Tour</th>
                           <td><?=$tourDuration?> Minutes</td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Ride</th>
                           <td><?=number_format($rideDuration, 2)?> Minutes</td>
                        </tr>
                        <tr>
                           <th scope="row">Start Address</th>
                           <td><?=$deneme2?></td>
                        </tr>
                        <tr>
                           <th scope="row">Finish Address</th>
                           <td><?=$destinationAddress?></td>
                        </tr>
                             <tr>
                                <th scope="row">Booking Fee</th>
                                <td>$<?= number_format($bookingFee, 2) ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Driver Fare</th>
                                 <td>$<?= number_format($driverFare, 2) ?> 
								 <?php if ($pedicabCount != 1) {?>
								 ($<?= $driverFarePerDriver ?> per driver)
								 <?php } ?> with <?= $paymentMethod == 'card' ? 'debit/credit card' : $paymentMethod ?></td>
                            </tr>
                            <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?= number_format(
                               $totalFare,
                               2
                           );?></b></td>
                        </tr>
                     </tbody>
                  </table>
               </form>
               <form action="charge.php" method="post" id="payment-form">
                  <div class="form-row">
                        <div id="card-element">
                            <!-- Stripe.js injects the Card Element -->
                        </div>
                        <div id="card-errors" role="alert"></div>
                    </div>
                  <input title="" type="hidden" name="firstName" value="<?=$firstName?>">
                  <input title="" type="hidden" name="lastName" value="<?=$lastName?>">
                  <input title="" type="hidden" name="email" value="<?=$email?>">
                  <input title="" type="hidden" name="phoneNumber" value="<?=$phoneNumber?>">
                  <input title="" type="hidden" name="numPassengers" value="<?=$numPassengers?>">
                  <input title="" type="hidden" name="pickUpDate" value="<?=$pickUpDate?>">
                  <input title="" type="hidden" name="hours" value="<?=$hours?>">
                  <input title="" type="hidden" name="minutes" value="<?=$minutes?>">
                  <input title="" type="hidden" name="ampm" value="<?=$ampm?>">
                  <input title="" type="hidden" name="pickUpAddress" value="<?=$deneme2?>">
                  <input title="" type="hidden" name="destinationAddress" value="<?=$destinationAddress?>">
                  <input title="" type="hidden" name="paymentMethod" value="<?=$paymentMethod?>">
                  <input title="" type="hidden" name="rideDuration" value="<?=$rideDuration?>">		
                  <input title="" type="hidden" name="bookingFee" value="<?=$bookingFee?>">
                  <input title="" type="hidden" name="driverFare" value="<?=$driverFare?>">
                  <input title="" type="hidden" name="totalFare" value="<?=$totalFare?>">
                  <input title="" type="hidden" name="returnDuration" value="<?=$returnDuration?>">
                  <input title="" type="hidden" name="operationFare" value="<?=$operationFare?>">	
                  <input title="" type="hidden" name="tourDuration" value="<?=$tourDuration?>">	
                  <input title="" type="hidden" name="pickup1" value="<?=$pickup1?>">	
                  <input title="" type="hidden" name="pickup2" value="<?=$pickup2?>">
                  <input title="" type="hidden" name="return1" value="<?=$return1?>">	
                  <input title="" type="hidden" name="return2" value="<?=$return2?>">		
                  <input title="" type="hidden" name="toursuresi" value="<?=$toursuresi?>">		
                  <input title="" type="hidden" name="countryCode" value="<?= $countryCode ?>">
				  <input title="" type="hidden" name="baseFare" value="<?=$baseFare?>">			
				  
                  <center><button type="submit">Pay $<?=$bookingFee?> </button></center>
               </form>
            </div>
         </div>
      </div>

<script>
    var stripe = Stripe('<?php echo $_ENV['STRIPE_PUBLIC_KEY']; ?>');
    var elements = stripe.elements({
        clientSecret: '<?= $paymentIntent->client_secret; ?>'
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
                    return_url: 'https://newyorkpedicabservices.com/book-scheduled-central-pedicab-tour/charge.php?unique_id=' + uniqueId,
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
    // Use POST data
    var numPassengers = <?php echo json_encode($_POST["numPassengers"] ?? 1); ?>;
    var pickUpDate = <?php echo json_encode($_POST["pickUpDate"]); ?>;
    var hours = <?php echo json_encode($_POST["hours"]); ?>;
    var minutes = <?php echo json_encode($_POST["minutes"]); ?>;
    var ampm = <?php echo json_encode($_POST["ampm"]); ?>;
    var pickUpAddress = <?php echo json_encode($_POST["pickUpAddress"]); ?>;
    var destinationAddress = <?php echo json_encode($_POST["destinationAddress"]); ?>;
    var paymentMethod = <?php echo json_encode($_POST["paymentMethod"]); ?>;
    var firstName = <?php echo json_encode($_POST["firstName"] ?? ''); ?>;
    var lastName = <?php echo json_encode($_POST["lastName"] ?? ''); ?>;
    var email = <?php echo json_encode($_POST["email"] ?? ''); ?>;
    var phoneNumber = <?php echo json_encode($_POST["phoneNumber"] ?? ''); ?>;
    var countryCode = <?php echo json_encode($_POST["countryCode"] ?? ""); ?>;
    var countryName = <?php echo json_encode($_POST["countryName"] ?? ""); ?>;
    var bookingFee = <?php echo json_encode($_POST["bookingFee"] ?? ''); ?>;
    var driverFare = <?php echo json_encode($_POST["driverFare"] ?? ''); ?>;
    var totalFare = <?php echo json_encode($_POST["totalFare"] ?? ''); ?>;
    var returnDuration = <?php echo json_encode($_POST["returnDuration"] ?? ''); ?>;
    var operationFare = <?php echo json_encode($_POST["operationFare"] ?? ''); ?>;
    var rideDuration = <?php echo json_encode($_POST["rideDuration"] ?? ''); ?>;
    var tourDuration = <?php echo json_encode($_POST["tourDuration"] ?? ''); ?>;
    var return1 = <?php echo json_encode($_POST["return1"] ?? ''); ?>;
    var return2 = <?php echo json_encode($_POST["return2"] ?? ''); ?>;
    var pickup1 = <?php echo json_encode($_POST["pickup1"] ?? ''); ?>;
    var pickup2 = <?php echo json_encode($_POST["pickup2"] ?? ''); ?>;
    var toursuresi = <?php echo json_encode($_POST["toursuresi"] ?? ''); ?>;
    var baseFare = <?php echo json_encode($_POST["baseFare"] ?? ''); ?>;

    // Create a form and send it with POST
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "step3.php";

    // Add form fields
    form.appendChild(createHiddenInput("numPassengers", numPassengers));
    form.appendChild(createHiddenInput("pickUpDate", pickUpDate));
    form.appendChild(createHiddenInput("hours", hours));
    form.appendChild(createHiddenInput("minutes", minutes));
    form.appendChild(createHiddenInput("ampm", ampm));
    form.appendChild(createHiddenInput("pickUpAddress", pickUpAddress));
    form.appendChild(createHiddenInput("destinationAddress", destinationAddress));
    form.appendChild(createHiddenInput("paymentMethod", paymentMethod));
    form.appendChild(createHiddenInput("firstName", firstName));
    form.appendChild(createHiddenInput("lastName", lastName));
    form.appendChild(createHiddenInput("email", email));
    form.appendChild(createHiddenInput("phoneNumber", phoneNumber));
    form.appendChild(createHiddenInput("countryCode", countryCode));
    form.appendChild(createHiddenInput("countryName", countryName));
    form.appendChild(createHiddenInput("bookingFee", bookingFee));
    form.appendChild(createHiddenInput("driverFare", driverFare));
    form.appendChild(createHiddenInput("totalFare", totalFare));
    form.appendChild(createHiddenInput("returnDuration", returnDuration));
    form.appendChild(createHiddenInput("operationFare", operationFare));
    form.appendChild(createHiddenInput("rideDuration", rideDuration));
    form.appendChild(createHiddenInput("tourDuration", tourDuration));
    form.appendChild(createHiddenInput("return1", return1));
    form.appendChild(createHiddenInput("return2", return2));
    form.appendChild(createHiddenInput("pickup1", pickup1));
    form.appendChild(createHiddenInput("pickup2", pickup2));
    form.appendChild(createHiddenInput("toursuresi", toursuresi));
    form.appendChild(createHiddenInput("baseFare", baseFare));

    document.body.appendChild(form);
    form.submit();
});

function createHiddenInput(name, value) {
    var input = document.createElement("input");
    input.type = "hidden";
    input.name = name;
    input.value = value;
    return input;
}
</script>

   </body>
</html>
