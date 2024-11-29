<?php
include('inc/init.php');
require('inc/countryselect.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="shortcut icon" href="vendor/favicon.ico">
      <meta charset="UTF-8">
      <title>Lease A Pedicab Request</title>
	  <meta name="description" content="Lease A Pedicab Request">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="index, follow">
      <!-- Viewport meta tag added -->
<link rel="preload" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"></noscript>

<link rel="preload" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"></noscript>


      <link type="text/css" href="css/style.css" rel="stylesheet">
<!-- Google tag (gtag.js) --> <script async src=" https://www.googletagmanager.com/gtag/js?id=AW-16684451653 "></script> <script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16684451653'); </script>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-G3HDRQGC05"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-G3HDRQGC05');
</script>
  </head>
   <body>
      <form onsubmit="return validateForm()" method="post" id="myForm" action="completed.php">
         <div class="container">
            <div class="row justify-content-center">
               <input title="" type="button" id="prevButton" class="btn btn-primary font-weight-bold" value="<">
               <input <?php if (!$_GET) {echo 'disabled';}?> title="" type="submit" id="nextButton" class="btn btn-primary font-weight-bold" value=">">
               <div class="col-md-6">
                  <!-- Center the form in a narrower column -->
                  <h2 class="text-center mb-4 font-weight-bold" style="color:#0909ff;">New York Pedicab Services</h2>
                  <div class="text-center mb-4">
                      <b>Lease A Pedicab</b><br>                       <b>Request Form</b>
                  </div>
                  <div class="error-message" id="error-message" style="display: none;">
                     <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                     <span id="error-text"></span>
                  </div>
<div class="form-group">
    <label for="firstName">First Name</label>
    <input maxlength="15" title="" type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" 
        required oninvalid="this.setCustomValidity('Please, enter first name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="lastName">Last Name</label>
    <input maxlength="15" title="" type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" 
        required oninvalid="this.setCustomValidity('Please, enter last name.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
<div class="form-group">
    <label for="email">Email Address</label>
    <input maxlength="30" title="" type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" 
        required 
        oninvalid="this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid');" 
        oninput="setCustomValidity(''); this.classList.remove('invalid');" 
        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
        onchange="if(!this.value.match(/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) { this.setCustomValidity('Please, enter a valid email address.'); this.classList.add('invalid'); } else { this.setCustomValidity(''); this.classList.remove('invalid'); }">
</div>
<div class="form-group">
    <label for="countrySelect">Phone</label>
    <div style="display: flex;">
        <?=countrySelector();?>
        <input maxlength="22" title="" style="flex: 2; margin-left: 10px;" type="tel" class="form-control phone-number-input" id="phoneNumber" name="phoneNumber" 
            onkeyup="updatePhoneNumber()" oninvalid="this.setCustomValidity('Please, enter phone number.'); this.classList.add('invalid');" 
            oninput="this.value = this.value.replace(/\D+/g, '');setCustomValidity(''); this.classList.remove('invalid');" 
            placeholder="Enter your phone number" required >
    </div>
</div>
<div class="form-group">
    <label for="lastName">Pedicab Driver License Number</label>
    <input maxlength="15" title="" type="text" class="form-control" id="licenseNumber" name="licenseNumber" placeholder="Enter your pedicab driver license number" 
        required oninvalid="this.setCustomValidity('Please, enter pedicab driver license number.'); this.classList.add('invalid');" 
        oninput="this.setCustomValidity(''); this.classList.remove('invalid'); this.value = this.value.replace(/[^a-zA-Z\s]/g, '');">
</div>
    <div class="form-group">
        <label for="leaseStartDate">Lease Start Date</label>
        <input title="" autocomplete="off" type="date" required
               max="2025-12-31"
               oninvalid="this.setCustomValidity('Please, select the date of pick up.'); this.classList.add('invalid');"
               oninput="this.setCustomValidity(''); this.classList.remove('invalid');"
               class="form-control" id="leaseStartDate" name="leaseStartDate" onchange="checkDate(this)">
    </div> <!-- we use it to change the calendar -->
	                <label>
                <input required type="checkbox" name="declaration1"
                oninvalid="this.setCustomValidity('Please, check this box to proceed.')"
                oninput="this.setCustomValidity('')">
            I authorize New York Pedicab Services to publish my information on online pedicab groups to help me
reach out to pedicab owners to lease a pedicab.
                </label>
                  <div style="text-align:center;"><input title="" type="submit" class="btn" style="background-color: #0909ff; color:white;" value="Submit"></div>
               </div>
            </div>
         </div>
      </form>
<script>
    window.onload = function() {
        script = document.createElement("script");
        script.src = "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js";
        document.body.appendChild(script);
    };
</script>
<script>
document.getElementById('prevButton').addEventListener('click', function() {
    window.location.href = 'https://newyorkpedicabservices.com';
});

</script>
<script> 
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('leaseStartDate').setAttribute('min', today);
    });

    document.getElementById('leaseStartDate').addEventListener('click', function() {
        this.showPicker();
    });
</script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   </body>
</html>
