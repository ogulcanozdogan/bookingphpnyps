<?php
   ini_set('display_errors', 1);
   error_reporting(E_ALL);
   
	$firstName = $_POST["firstName"]; // varsayılan değer 1
	$lastName = $_POST["lastName"]; // varsayılan değer 1
	$email = $_POST["email"]; // varsayılan değer 1
	$phoneNumber = $_POST["phoneNumber"]; // varsayılan değer 1
   $numPassengers = $_POST["numPassengers"] ?? 1; // varsayılan değer 1
   $pickUpDate = $_POST["pickUpDate"];
   $hours = $_POST["hours"];
   $minutes = $_POST["minutes"];
   $ampm = $_POST["ampm"];
   $deneme2 = $_POST["pickUpAddress"];
   $destinationAddress = $_POST["destinationAddress"];
   $paymentMethod = $_POST["paymentMethod"];
   $rideDuration = $_POST["rideDuration"];
      $bookingFee = $_POST["bookingFee"];
   $driverFare = $_POST["driverFare"];
   $totalFare = $_POST["totalFare"];
       $returnDuration = $_POST["returnDuration"];
   $pickUpDuration = $_POST["pickUpDuration"];
      $hub = $_POST["hub"];
   $baseFare = $_POST["baseFare"];
   $operationFare = $_POST["operationFare"];  
    $serviceDetails = $_POST["serviceDetails"];  
	$serviceDuration = $_POST["serviceDuration"];  	
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Book Your Pedicab Ride</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Viewport meta etiketi eklendi -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
	   <script src="https://js.stripe.com/v3/"></script>
      <link href="css/style.css" rel="stylesheet">
	   <style>
       /* Buton ve Card Element Stilleri */
        .form-row {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        #card-element {
            width: 300px;
            height: 40px;
            background-color: white;
            border: 1px solid #ccc;
            padding: 10px;
        }

        /* Buton stilini ayarlama */
        button {
            background-color: #4CAF50; /* Yeşil arka plan */
            color: white; /* Beyaz yazı rengi */
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s, color 0.3s; /* Geçiş animasyonu */
			
			margin-bottom: 20px;
        }

        button:hover {
            background-color: #45a049; /* Daha koyu yeşil */
            color: #ffffff;
        }

        /* Formu sayfanın ortasına hizalamak için ek stiller */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 30px;
        }
        .top-controls {
            position: absolute;
            top: 10px; /* Sayfanın en üstünden 10px aşağıda */
            right: 50%; /* Yatayda ortalanacak */
            transform: translateX(-50%); /* Sol tarafından %50 geri gelerek tam ortalanmış olacak */
            z-index: 1000; /* Diğer içeriklerin üzerinde görünür */
        }
        .centered-title {
            text-align: center;
            margin-top: 70px; /* Butonlar ve başlık için üstten boşluk */
        }
		/* Container */
.m-6d731127 {
  display: flex;
  flex-direction: column;
  align-items: center;
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border-radius: 10px;
  background-color: #f8f9fa;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Stripe Element */
.StripeElement {
  margin-bottom: 20px;
  border-radius: 5px;
  overflow: hidden;
}

/* Payment Button Container */
.m-1b7284a3 {
  width: 100%;
}

/* Inner Stack */
.m-6d731127 .m-6d731127 {
  justify-content: center;
}

/* Payment Button */
.m-77c9d27d {
  background-color: var(--button-bg, #007bff);
  color: var(--button-color, #fff);
  border: var(--button-bd, none);
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  padding: 10px 20px;
  font-size: 16px;
}

.m-77c9d27d:hover {
  background-color: var(--button-hover, #0056b3);
}

    </style>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
   </head>
   <body>
     
	    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
    </div>
         <div class="container">
            <div class="row justify-content-center">
               
               <div class="col-md-6"> <form method="post" action="">
                  <!-- Formu daha dar bir sütuna sığdırarak merkezle -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                     <b>Hourly Ride<br>Booking Application</b>
                  </div>
                 
                 <table class="table">
                     <tbody>
					  <tr>
                           <th scope="row">Type</th>
                           <td>	Point A to B Pedicab Ride</td>
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
                           <td><?=$phoneNumber?></td>
                        </tr>
                        <tr>
                           <th scope="row">Number of Passengers</th>
                           <td><?=$numPassengers?></td>
                        </tr>
                        <tr>
                           <th scope="row">Date of Service</th>
                           <td><?=$pickUpDate?></td>
                        </tr>
                        <tr>
                           <th scope="row">Time of Service</th>
                           <td><?php echo $hours . ":" .  $minutes . " " . $ampm;?></td>
                        </tr>
                        <tr>
                           <th scope="row">Duration of Service</th>
                           <td><?php 
						  if  ($serviceDuration == 30 OR $serviceDuration == 90){
							  
							  echo $serviceDuration . " mins";
						  }
						  else{
							  echo $serviceDuration . " hour";
						  }
						   
						   ?> </td>
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
                        <th scope="row">Service Details</th>
                        <td><?=$serviceDetails?></td>
                        </tr>
                        <tr>
                           <th scope="row">Booking Fee</th>
                           <td>$<?=number_format($bookingFee, 2)?></td>
                        </tr>
                        <tr>
                           <th scope="row">Driver Fare</th>
                           <td>$<?=number_format($driverFare, 2)?></td>
                        </tr>
                        <tr style="background-color:green;">
                           <th scope="row" style="color:white;">Total Fare</th>
                           <td><b style="color:white;">$<?=number_format($totalFare, 2)?></b></td>
                        </tr>
                     </tbody>
                  </table>


      </form> <form action="https://newyorkpedicabservices.com/book-scheduled-hourly-pedicab-service/charge.php" method="post" id="payment-form">
        <div class="form-row">
            <div id="card-element">
                <!-- Stripe.js injects the Card Element -->
            </div>

            <div id="card-errors" role="alert"></div>
        </div>
			<input title="" type="hidden" name="firstName" value="<?=$firstName?>">
	<input title="" type="hidden" name="lastName" value="<?=$lastName?>">
	<input title="" type="hidden" name="aq" value="<?=$email?>">
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
	<input title="" type="hidden" name="bookingFee" value="<?=number_format($bookingFee, 2)?>">
    <input title="" type="hidden" name="driverFare" value="<?=number_format($driverFare, 2)?>">
    <input title="" type="hidden" name="totalFare" value="<?=number_format($totalFare, 2)?>">
	<input title="" type="hidden" name="returnDuration" value="<?=$returnDuration?>">
    <input title="" type="hidden" name="pickUpDuration" value="<?=$pickUpDuration?>">	
	<input title="" type="hidden" name="hub" value="<?=$hub?>">		
	<input title="" type="hidden" name="baseFare" value="<?=$baseFare?>">
    <input title="" type="hidden" name="operationFare" value="<?=$operationFare?>">	
		<input title="" type="hidden" name="serviceDetails" value="<?=$serviceDetails?>">	
	<input title="" type="hidden" name="serviceDuration" value="<?=$serviceDuration?>">		
       <center> <button type="submit">$<?php 
	  if ($paymentMethod != "fullcard"){
	 echo number_format($bookingFee, 2);
	  }
	  else {
		echo	  number_format($totalFare, 2);
	  }
	  ?> Pay</button></center>
    </form>
               </div>
            </div>
         </div>

	  
    <script>
        var stripe = Stripe('pk_test_51MhFmmGdhoanQCDN6a9BbsMOSm0bVEGdtqQCbU0BF8XaPl1FBtatRqFUiF4szp4JkR8QxJ9J83puGYxeZBXiwOhh00sI8fKXEs'); // Public keyinizi buraya girin
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
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
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            form.submit();
        }
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput-jquery.min.js"></script>
<script>
    $("#phoneNumber").intlTelInput({
        initialCountry: "us", // Kullanıcının bulunduğu ülkeyi otomatik olarak seçer
        separateDialCode: true, // Telefon kodunu ayrı bir alan olarak gösterir
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js" // Kodu formatlamak için gerekli yardımcı script
    });
</script>
<script>
    // Telefon numarası giriş alanını al
    var phoneNumberInput = document.getElementById("phoneNumber");

    // Değişiklik olduğunda telefon numarasını biçimlendir
    phoneNumberInput.addEventListener("input", function(event) {
        // Kullanıcının girdiği metni al
        var input = event.target.value;
        
        // Sadece rakamları al
        var phoneNumber = input.replace(/\D/g, '');

        // 10 haneli telefon numarası biçimini kontrol et
        var phoneNumberRegex = /^(\d{3})(\d{3})(\d{4})$/;
        if (phoneNumberRegex.test(phoneNumber)) {
            // Numarayı biçimlendir ve parantezler ekleyerek döndür
            var formattedPhoneNumber = phoneNumber.replace(phoneNumberRegex, "($1) $2-$3");

            // Biçimli numarayı giriş alanına yerleştir
            event.target.value = formattedPhoneNumber;
        }
    });
</script>

<script>
document.getElementById("prevButton").addEventListener("click", function() {
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
    var bookingFee = <?php echo json_encode($_POST["bookingFee"] ?? ''); ?>;
    var driverFare = <?php echo json_encode($_POST["driverFare"] ?? ''); ?>;
    var totalFare = <?php echo json_encode($_POST["totalFare"] ?? ''); ?>;	
    var returnDuration = <?php echo json_encode($_POST["returnDuration"] ?? ''); ?>;
    var pickUpDuration = <?php echo json_encode($_POST["pickUpDuration"] ?? ''); ?>;
    var hub = <?php echo json_encode($_POST["hub"] ?? ''); ?>;
    var baseFare = <?php echo json_encode($_POST["baseFare"] ?? ''); ?>;
    var operationFare = <?php echo json_encode($_POST["operationFare"] ?? ''); ?>;	
    var rideDuration = <?php echo json_encode($_POST["rideDuration"] ?? ''); ?>;		
    var serviceDetails = <?php echo json_encode($_POST["serviceDetails"] ?? ''); ?>;	
    var serviceDuration = <?php echo json_encode($_POST["serviceDuration"] ?? ''); ?>;	


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
                      "&phoneNumber=" + encodeURIComponent(phoneNumber);

    window.location.href = "step3.php?" + queryString;
});

</script>

   </body>
</html>