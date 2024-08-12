<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Pedicab Driver Registration">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex,nofollow">
    <title>Pedicab Driver Registration</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="shortcut icon" href="vendor/favicon.ico">
    <script src="https://www.google.com/recaptcha/api.js?render=6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP"></script>
</head>
<body>
    <div class="container">
        <center> <h1>New York Pedicab Services</h1>
        <h2 style='color:red;'>Pedicab Driver Registration</h2></center>
        
        <form id="registration-form" action="process.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <label for="driverLicenseFile">Upload Pedicab Driver License (max 10mb)</label>
            <input required type="file" id="driverLicenseFile" name="driverLicenseFile" accept="image/*">
            
            <label for="driverFirstName">Pedicab Driver First Name</label>
            <input required type="text" id="driverFirstName" name="driverFirstName" oninput="updateDeclaration()" class="text-only">

            <label for="driverLastName">Pedicab Driver Last Name</label>
            <input required type="text" id="driverLastName" name="driverLastName" oninput="updateDeclaration()" class="text-only">

            <label for="driverLicenseNumber">Pedicab Driver License Number</label>
            <input required type="text" id="driverLicenseNumber" name="driverLicenseNumber" class="number-allowed">

            <label for="driverLicenseExpiration">Pedicab Driver License Expiration Date</label>
            <input required type="date" id="driverLicenseExpiration" name="driverLicenseExpiration" onkeydown="return false;">

            <label for="driverPhone">Pedicab Driver Phone</label>
            <input required type="tel" id="driverPhone" name="driverPhone" class="phone-only">

            <label for="driverEmail">Pedicab Driver Email Address</label>
            <input required type="email" id="driverEmail" name="driverEmail">

            <label for="driverStreetAddress">Pedicab Driver Street Address</label>
            <input required type="text" id="driverStreetAddress" name="driverStreetAddress" class="number-allowed">

            <label for="driverApartmentNumber">Pedicab Driver Apartment Number</label>
            <input required type="text" id="driverApartmentNumber" name="driverApartmentNumber" class="number-allowed">

            <label for="driverCity">Pedicab Driver City</label>
            <input required type="text" id="driverCity" name="driverCity" class="text-only">

            <label for="driverState">Pedicab Driver State</label>
            <input required type="text" id="driverState" name="driverState" class="text-only">

            <label for="driverZipCode">Pedicab Driver Zip Code</label>
            <input required type="text" id="driverZipCode" name="driverZipCode" class="number-allowed">

            <label for="businessName">Pedicab Business Name</label>
            <input required type="text" id="businessName" name="businessName" class="number-allowed">

            <label for="businessLicenseNumber">Pedicab Business License Number</label>
            <input required type="text" id="businessLicenseNumber" name="businessLicenseNumber" class="number-allowed">

            <label for="businessRegistrationNumber">Pedicab Business Registration Number</label>
            <input required type="text" id="businessRegistrationNumber" name="businessRegistrationNumber" class="number-allowed">

            <label for="businessLicenseExpiration">Pedicab Business License Expiration Date</label>
            <input required type="date" id="businessLicenseExpiration" name="businessLicenseExpiration" onkeydown="return false;">

            <label for="businessPhone">Pedicab Business Phone</label>
            <input required type="tel" id="businessPhone" name="businessPhone" class="phone-only">

            <label for="businessEmail">Pedicab Business Email Address</label>
            <input required type="email" id="businessEmail" name="businessEmail">

            <label for="businessStreetAddress">Pedicab Business Street Address</label>
            <input required type="text" id="businessStreetAddress" name="businessStreetAddress" class="number-allowed">

            <label for="businessApartmentNumber">Pedicab Business Apartment Number</label>
            <input required type="text" id="businessApartmentNumber" name="businessApartmentNumber" class="number-allowed">

            <label for="businessCity">Pedicab Business City</label>
            <input required type="text" id="businessCity" name="businessCity" class="text-only">

            <label for="businessState">Pedicab Business State</label>
            <input required type="text" id="businessState" name="businessState" class="text-only">

            <label for="businessZipCode">Pedicab Business Zip Code</label>
            <input required type="text" id="businessZipCode" name="businessZipCode" class="number-allowed">

            <div class="declaration full-width">
                <center><h2 style='color:red;'>Declaration</h2></center>
                <p id="declaration-text">I, First Name and Last Name, declare that:</p>
                 <div class="checkboxes">
                <label><input required type="checkbox" name="declaration1"> I am a licensed pedicab driver and I operate a licensed pedicab with a valid insurance.</label>
                <label><input required type="checkbox" name="declaration2"> I provided the true details of my pedicab driver license and the licensed pedicab that I operate above.</label>
                <label><input required type="checkbox" name="declaration3"> I will never operate without a valid pedicab driver license.</label>
                <label><input required type="checkbox" name="declaration4"> I will never operate without a licensed and insured pedicab.</label>
                <label><input required type="checkbox" name="declaration5"> I will notify Ibrahim Donmez and New York Pedicab Services if my pedicab driver license details change.</label>
                <label><input required type="checkbox" name="declaration6"> I will notify Ibrahim Donmez and New York Pedicab Services if I do not renew my pedicab driver license before its expiration date.</label>
                <label><input required type="checkbox" name="declaration7"> I will notify Ibrahim Donmez and New York Pedicab Services if my pedicab business license details change.</label>
                <label><input required type="checkbox" name="declaration8"> I will notify Ibrahim Donmez and New York Pedicab Services if the pedicab business license that I operate with does not get renewed before its expiration date.</label>
                <label><input required type="checkbox" name="declaration9"> I agree to indemnify, defend and hold harmless Ibrahim Donmez and New York Pedicab Services from any and all claims and/or lawsuits for personal injury (including death) and property damage, and all damages, liabilities, losses, expenses and costs, including reasonable attorneys' fees, incurred in connection with any claims (including, but not limited to, claims of negligence) arising out of or related in any way to all pedicab services that I provide.</label>
                <label><input required type="checkbox" name="declaration10"> I acknowledge that this agreement may be executed in any number of counterparts and each such counterpart shall for all purposes be deemed an original. Delivery of an executed counterpart of a signature page to this agreement by facsimile, pdf or electronic signature shall be as effective as delivery of a manually executed counterpart of this Agreement.</label>
            </div>
            </div>
            <br>
            <div class="signature full-width">
                <center><h2 style='color:red;'>Signature</h2></center>
                <label for="signature-box">Please sign this box</label>
                <canvas id="signature-box" style="border:1px solid #ccc;"></canvas>
                <input required type="hidden" id="signature-svg" name="signature">
                <button type="button" onclick="clearCanvas()">Clear</button>
            </div>

            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
            <button class="submit-btn" type="submit">Submit</button>
        </form>
    </div>
    <script src="js/sign.js"></script>
    <script src="js/validate.js"></script>
    <script>
        // reCAPTCHA setup
        grecaptcha.ready(function() {
            document.getElementById('registration-form').addEventListener('submit', function(event) {
                event.preventDefault();
                grecaptcha.execute('6Le19xYqAAAAAK849sP9SHXzCdOARW6gD3Su4RgP', {action: 'register'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    document.getElementById('registration-form').submit();
                });
            });
        });

        // Clear form data when the page loads (to prevent back button issues)
        window.onload = function() {
            document.getElementById('registration-form').reset();
        };
    </script>
</body>
</html>
