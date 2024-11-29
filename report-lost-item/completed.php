<?php
require_once "vendor/autoload.php";

$firstName = htmlspecialchars($_POST["firstName"]);
$lastName = htmlspecialchars($_POST["lastName"]);
$emailAddress = htmlspecialchars($_POST["email"]);
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
$pickUpDate = htmlspecialchars($_POST["pickUpDate"]);
$hours = htmlspecialchars($_POST["hours"]);
$minutes = htmlspecialchars($_POST["minutes"]);
$ampm = htmlspecialchars($_POST["ampm"]);
$pickUpAddress = htmlspecialchars($_POST["pickUpAddress"]);
$destinationAddress = htmlspecialchars($_POST["destinationAddress"]);

$hedefKlasor = 'uploads/';
$hataMesaji = '';

if (isset($_FILES['passengerFace']) && $_FILES['passengerFace']['error'] == 0) {
    $dosyaUzantisi = pathinfo($_FILES['passengerFace']['name'], PATHINFO_EXTENSION);
    $passengerFaceAdi = uniqid('passenger_', true) . '.' . $dosyaUzantisi;
    $passengerFaceYol = $hedefKlasor . $passengerFaceAdi;

    if (move_uploaded_file($_FILES['passengerFace']['tmp_name'], $passengerFaceYol)) {
    } else {
        $hataMesaji .= "<p>Passenger face photo yüklenirken hata oluştu.</p>";
    }
}

// Lost Item Photo işlemleri
if (isset($_FILES['lostItem']) && $_FILES['lostItem']['error'] == 0) {
    $dosyaUzantisi = pathinfo($_FILES['lostItem']['name'], PATHINFO_EXTENSION);
    $lostItemAdi = uniqid('lostitem_', true) . '.' . $dosyaUzantisi;
    $lostItemYol = $hedefKlasor . $lostItemAdi;

    if (move_uploaded_file($_FILES['lostItem']['tmp_name'], $lostItemYol)) {
    } else {
        $hataMesaji .= "<p>Lost item photo yüklenirken hata oluştu.</p>";
    }
}





$phoneNumber = '+' . $_POST["countryCode"] . $phoneNumber;

$hoursC = $hours . ":" . $minutes . ' ' . $ampm;


$date = new DateTime($pickUpDate);
$formattedDate = $date->format('m/d/Y (l)');


 if ($passengerFaceYol) { 
$passengerFaceMail = '<p><strong>Passenger Face:</strong> <img src="https://newyorkpedicabservices.com/report-lost-item/' . $passengerFaceYol . '" alt="Passenger Face Photo" width="200"></p>';
}  if ($lostItemYol) { 
$lostItemMail = '<p><strong>Lost Item:</strong><img src="https://newyorkpedicabservices.com/report-lost-item/' . $lostItemYol .'" alt="Lost Item Photo" width="200"></p>';        
} 



        // First email
        $email1 = new \SendGrid\Mail\Mail();
        $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email1->setSubject("Report Lost Item");
        $email1->addTo("info@newyorkpedicabservices.com", "NYPS");

        $htmlContent1 = <<<EOD
        <html>
        <body>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Phone Number:</strong> $phoneNumber</p>
            <p><strong>Date of Pick Up:</strong> $formattedDate</p>
            <p><strong>Time:</strong> $hoursC</p>
			<p><strong>Pick Up Address:</strong> $pickUpAddress</p>
			<p><strong>Drop Off Address:</strong> $destinationAddress</p>
			$passengerFaceMail
			$lostItemMail
		</body>
        </html>
EOD;

        $email1->addContent("text/html", $htmlContent1);
		
		
		        // Second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject("Report Lost Item");
        $email2->addTo($emailAddress, "NYPS");

        $htmlContent2 = <<<EOD
        <html>
        <body>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Phone Number:</strong> $phoneNumber</p>
            <p><strong>Date of Pick Up:</strong> $formattedDate</p>
            <p><strong>Time:</strong> $hoursC</p>
			<p><strong>Pick Up Address:</strong> $pickUpAddress</p>
			<p><strong>Drop Off Address:</strong> $destinationAddress</p>
			$passengerFaceMail
			$lostItemMail
			<p><strong>“I authorize New York Pedicab Services to publish my information on online pedicab groups to help me
			reach out to pedicab owners to lease a pedicab.”</strong></p>
			<p><strong>We confirm that we received your request.</strong></p>
			<p><strong>We will get back to you as soon as we can.</strong></p>
			<p><strong>Thank you,</strong></p>
			<strong>New York Pedicab Services</strong><br>
			<strong>(212) 961-7435</strong>
		</body>
        </html>
EOD;


        $email2->addContent("text/html", $htmlContent2);
		
		
		        // SendGrid API key
        $sendgrid = new \SendGrid(
            "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"
        );

        try {
            // Send the first email
            $response1 = $sendgrid->send($email1);
            //print $response1->statusCode() . "\n";
            // print_r($response1->headers());
            // print $response1->body() . "\n";

            // Send the second email
            $response2 = $sendgrid->send($email2);
            // print $response2->statusCode() . "\n";
            // print_r($response2->headers());
            // print $response2->body() . "\n";
        } catch (Exception $e) {
            // echo 'Caught exception: '. $e->getMessage() ."\n";
        }

		
		?>
		
		
		<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="shortcut icon" href="vendor/favicon.ico">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Report Lost Item</title>
	  <meta name="description" content="Lease A Pedicab Request">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="top-controls">
        <input title="" type="button" id="prevButton" name="back" class="btn btn-primary font-weight-bold" value="<">
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                    <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Report Lost Item</h2>
                <div class="text-center mb-4">
                    <b>We confirm that we received your request.</b><br>
					<b>We will get back to you as soon as we can.</b>
                </div>
                <table class="table">
                    <tbody>
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
                            <td><?= $emailAddress ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Phone Number</th>
                            <td><?= $phoneNumber ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Date of Pick Up</th>
                            <td><?= $formattedDate ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Hour</th>
                            <td><?= $hoursC ?></td>
                        </tr>
						<tr>
                            <th scope="row">Pick Up Address</th>
                            <td><?= $pickUpAddress ?></td>
                        </tr>
						<tr>
                            <th scope="row">Drop Off Address</th>
                            <td><?= $destinationAddress ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Declaration</th>
                            <td>I authorize New York Pedicab Services to publish my information on online pedicab groups to help me
reach out to pedicab owners to lease a pedicab.</td>
                        </tr>
						<?php if ($passengerFaceYol) { ?>
						                        <tr>
                            <th scope="row">Passenger Face</th>
                            <td>       <img src="<?= $passengerFaceYol ?>" alt="Passenger Face Photo" width="200"></td>
                        </tr>
						<?php } ?>
						<?php if ($lostItemYol) { ?>
						                        <tr>
                            <th scope="row">Lost Item</th>
                            <td>       <img src="<?= $lostItemYol ?>" alt="Lost Item Photo" width="200"></td>
                        </tr>
						<?php } ?>
                    </tbody>
                </table>
                 <div class="text-center mt-4">
                    <strong>Thank you,</strong><br>
                    <strong>New York Pedicab Services</strong><br>
                    <strong><a href="tel:2129617435">(212) 961-7435</a></strong><br>
                    <strong><a href="mailto:info@newyorkpedicabservices.com" target="_blank">info@newyorkpedicabservices.com</a></strong><br>
                    <strong><a href="https://newyorkpedicabservices.com" target="_blank">newyorkpedicabservices.com</a></strong>
                </div>
            </div>
        </div>
    </div>
	<script>
document.getElementById('prevButton').addEventListener('click', function() {
    window.location.href = 'https://newyorkpedicabservices.com/report-lost-item/';
});

</script>
</body>
</html>
