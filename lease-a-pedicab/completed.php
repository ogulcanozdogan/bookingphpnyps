<?php
require_once "vendor/autoload.php";

$firstName = htmlspecialchars($_POST["firstName"]);
$lastName = htmlspecialchars($_POST["lastName"]);
$emailAddress = htmlspecialchars($_POST["email"]);
$phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
$licenseNumber = htmlspecialchars($_POST["licenseNumber"]);
$leaseStartDate = htmlspecialchars($_POST["leaseStartDate"]);

$phoneNumber = "+1" . $phoneNumber;


$date = new DateTime($leaseStartDate);
$formattedDate = $date->format('m/d/Y (l)');

        // First email
        $email1 = new \SendGrid\Mail\Mail();
        $email1->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email1->setSubject("Lease A Pedicab Request");
        $email1->addTo("info@newyorkpedicabservices.com", "NYPS");

        $htmlContent1 = <<<EOD
        <html>
        <body>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Phone Number:</strong> $phoneNumber</p>
            <p><strong>Pedicab Driver License Number:</strong> $licenseNumber</p>
            <p><strong>Lease Start Date:</strong> $formattedDate</p>
		</body>
        </html>
EOD;

        $email1->addContent("text/html", $htmlContent1);
		
		
		        // Second email
        $email2 = new \SendGrid\Mail\Mail();
        $email2->setFrom("info@newyorkpedicabservices.com", "NYPS");
        $email2->setSubject("Lease A Pedicab Request");
        $email2->addTo($emailAddress, "NYPS");

        $htmlContent2 = <<<EOD
        <html>
        <body>
            <p><strong>First Name:</strong> $firstName</p>
            <p><strong>Last Name:</strong> $lastName</p>
            <p><strong>Email Address:</strong> $emailAddress</p>
            <p><strong>Phone Number:</strong> $phoneNumber</p>
            <p><strong>Pedicab Driver License Number:</strong> $licenseNumber</p>
            <p><strong>Lease Start Date:</strong> $formattedDate</p>
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
      <title>Lease A Pedicab Request</title>
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
                    <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">Lease A Pedicab Request</h2>
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
                            <th scope="row">Pedicab Driver License Number</th>
                            <td><?= $licenseNumber ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Lease Start Date</th>
                            <td><?= $formattedDate ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Declaration</th>
                            <td>I authorize New York Pedicab Services to publish my information on online pedicab groups to help me
reach out to pedicab owners to lease a pedicab.</td>
                        </tr>
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
    window.location.href = 'https://newyorkpedicabservices.com/lease-a-pedicab/';
});

</script>
</body>
</html>
