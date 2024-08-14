<?php
$title = "Point A to Point B Pedicab Rides with New York Pedicab Services";
$description = "Point A to Point B Pedicab Rides starting from $20 per pedicab (not per person)";
include('inc/head.php');
?>
	<link rel="preload" href="css/jquery-ui.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
	<noscript><link rel="stylesheet" href="css/jquery-ui.min.css"></noscript>
	<link rel="stylesheet" href="css/central_park.css" />
  </head>

  <body>
	<div class="main-wrapper">
	<?php include('inc/header.php'); ?>
    <main class="pt-4">
        
		<h1 class="title py-2">BOOK A POINT A TO B RIDE</h1>
		
    <header>
      <ul>
		<li><a class="yellowbutton" href="https://newyorkpedicabservices.com/book-on-demand-point-a-to-b-pedicab-ride/" target="_blank">Book On Demand Point A to Point B Ride</a></li>
		<li><a class="yellowbutton"  href="https://newyorkpedicabservices.com/book-scheduled-point-a-to-b-pedicab-ride/" target="_blank">Book Scheduled Point A to Point B Ride</a></li>
		<li><a class="yellowbutton"  href="https://newyorkpedicabservices.com/lab/request-scheduled-point-a-to-b-pedicab-ride/" target="_blank">Request Scheduled Point A to Point B Ride</a></li>
	  </ul>
    </header>
	
			<h2 class="title py-2">POINT A TO POINT B PEDICAB RIDE RATES</h2>
			
			<h3 class="title py-2">On Demand Point A to B Pedicab Ride Rates</h3>
		<p>$37.50 per hour per pedicab from Monday to Thursday</p>
		<p>$45 per hour per pedicab from Friday to Sunday</p>
			
			<h3 class="title py-2">Scheduled Point A to B Pedicab Ride Rates</h3>
<p>$30 base fare per pedicab from Monday to Thursday</p>
<p>$35 base fare per pedicab from Friday to Sunday</p>
<p>$30 per hour per pedicab from Monday to Thursday</p>
<p>$35 per hour per pedicab from Friday to Sunday</p>
<p>Total Fare = Base Fare + Per Hour Rate</p>

			<h4 class="title py-2">Other Booking Details</h4>
<p>• The per hour rates are calculated by including the duration of time that it takes the driver to pick you up and drop you off.</p>
<p>• Prices are per pedicab, not per person.</p>
<p>• Each pedicab can carry up to 3 passengers including children.</p>
<p>• Pedicabs are legally not allowed to carry more than 3 passengers including children.</p>
<p>• You book your ride with a very small down payment (booking fee) online. You will need to pay the remaining balance with cash or credit card to the assigned driver.</p>
<p>• A new tab will open after you click the book button. Please, complete the booking in the new tab that opens.</p>
<p>• If you have a party of 4 or more passengers, please, book separately for each pedicab in our booking system.</p>
<p>• All indicated Point A to B Pedicab Ride prices include all fees and taxes. There are no hidden fees.</p>
<p>• Please, provide your cell phone number when you book your ride. We communicate with our customers. We notify our customers (sometimes in the last minute) when there are issues such as cancellations due to rain, last minute delays, mechanical issues or health problems. So, it is very crucial for us to have your cell phone number. We do our best to provide the best customer service.</p>


	<h2 class="title py-2">ON DEMAND POINT A TO POINT B PEDICAB RIDES</h2>
<p>• If you are ready to get picked up now, you can book an On Demand Point A to Point B Pedicab Ride.</p>
<p>• The closer you are to Central Park South, the cheaper your ride will be.</p>
<p>• On Demand Point A to Point B Pedicab Rides are the cheapest pedicab rides available online and offline.</p>
<p>• On Demand Point A to Point B Pedicab Rides operation hours are 10:00 AM to 6:00 PM.</p>
<p>• On Demand Point A to Point B Pedicab Rides start and finish addresses are limited to …</p>

		
		<h2 class="title py-2">SCHEDULED POINT A TO POINT B PEDICAB RIDES</h2>
<p>• Scheduled Point A to Point B Pedicab Rides operation hours are 9:00 AM to 11:00 PM.</p>
<p>• Scheduled Point A to Point B Pedicab Rides start and finish addresses are limited to …</p>
<p>• Scheduled Point A to Point B Pedicab Rides require 1 hour notice.</p>


		
		<h2 class="title py-2">REQUEST POINT A TO POINT B PEDICAB RIDES</h2>
		<p>• If you would like to request a Point A to Point B Pedicab Ride outside of the areas allowed in our applications, please, fill out the Request Point A to Point B Pedicab Ride.</p>
		<p>• If you would like to request a Point A to Point B Pedicab Ride outside of the times allowed in our applications, please, fill out the Request Point A to Point B Pedicab Ride.</p>

		<?php
$images2 = [
    "index_files/central-park-attractions-pedicab.webp" => "Central Park Attractions Pedicab",
    "index_files/central-park-pedicab-ride-new-york.webp" => "Central Park Pedicab Ride New York",
    "index_files/central-park-pedicab-rides.webp" => "Central Park Pedicab Rides",
    "index_files/central-park-pedicab-services.webp" => "Central Park Pedicab Services",
    "index_files/central-park-rickshaw-new-york.webp" => "Central Park Rickshaw New York"
];
?>

<div class="image-slider">
  <div class="slide-track">
    <?php foreach ($images2 as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
    <?php foreach ($images2 as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
  </div>
</div>
		


<?php include('inc/footer.php'); ?>
	</main>
    </div>
<?php include('inc/scripts.php'); ?>
  </body>
</html>
