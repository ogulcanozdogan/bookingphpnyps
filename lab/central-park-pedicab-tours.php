<?php
$title = "Central Park Pedicab Tours with New York Pedicab Services";
$description = "Central Park Pedicab Tours starting from $25 per pedicab (not per person)";
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
        
		<h1 class="title py-2">BOOK A CENTRAL PARK TOUR</h1>
		
    <header>
      <ul>
		<li><a class="yellowbutton" href="https://newyorkpedicabservices.com/book-on-demand-central-park-pedicab-tour/" target="_blank">Book On Demand Central Park Tour</a></li>
		<li><a class="yellowbutton"  href="https://newyorkpedicabservices.com/book-scheduled-central-pedicab-tour/" target="_blank">Book Custom Scheduled Central Park Tour</a></li>
		<li><a class="yellowbutton"  href="https://calendly.com/d/27b-djb-5qs" target="_blank">Book Standard Scheduled Central Park Tour</a></li>
	  </ul>
    </header>
	
			<h2 class="title py-2">CENTRAL PARK PEDICAB TOUR RATES</h2>
			
			<h3 class="title py-2">On Demand Central Park Pedicab Tour Rates</h3>
		<p>$37.50 per hour per pedicab from Monday to Thursday</p>
		<p>$45 per hour per pedicab from Friday to Sunday</p>
			
			<h3 class="title py-2">Custom Scheduled Central Park Pedicab Tour Rates</h3>
<p>$30 base fare per pedicab from Monday to Thursday</p>
<p>$35 base fare per pedicab from Friday to Sunday</p>
<p>$30 per hour per pedicab from Monday to Thursday</p>
<p>$35 per hour per pedicab from Friday to Sunday</p>
<p>Total Fare = Base Fare + Per Hour Rate</p>


			<h3 class="title py-2">Standard Scheduled Central Park Pedicab Tour Rates</h3>
<p>$55 per pedicab for a 1 Hour Central Park Pedicab Tour</p>
<p>$80 per pedicab for a 90 Minute Central Park Pedicab Tour</p>

			<h4 class="title py-2">Other Booking Details</h4>
<p>• The per hour rates are calculated by including the duration of time that it takes the driver to pick you up and drop you off.</p>
<p>• Prices are per pedicab, not per person.</p>
<p>• Each pedicab can carry up to 3 passengers including children.</p>
<p>• Pedicabs are legally not allowed to carry more than 3 passengers including children.</p>
<p>• You book your tour with a very small down payment (booking fee) online. You will need to pay the remaining balance with cash or credit card to the assigned driver.</p>
<p>• A new window will open after you click the book button. Please, complete the booking in the new tab that opens.</p>
<p>• If you have a party of 4 or more passengers and if you would like to book an On Demand Central Park Pedicab Tour or Custom Scheduled Central Park Pedicab Tour, please, book separately for each pedicab in our booking system.</p>
<p>• Central Park Pedicab Tours are available between 10:00 AM and 6:00 PM. If you would like to book a tour earlier than 10:00 AM, please, send us an email.</p>
<p>• All indicated Central Park Pedicab Tour prices indicated below include all fees and taxes. There are no hidden fees.</p>
<p>• You can choose the start address and the finish address of your tour with the On Demand Central Park Pedicab Tours and Custom Scheduled Central Park Pedicab Tours.</p>
<p>• Please, understand that some of the tours have assigned hop off stops (to walk to the areas that can only be reached by walking and to take photos) and if you decide to skip the assigned hop off stops, your tour might be shortened. Please, choose the tour duration that suits your needs the best.</p>
<p>• Please, provide your cell phone number when you book your tour. We communicate with our customers. We notify our customers (sometimes in the last minute) when there are issues such as Central Park closures, cancellations due to rain, last minute delays, mechanical issues or health problems. So, it is very crucial for us to have your cell phone number. We do our best to provide the best customer service.</p>

<?php
$images = [
    "index_files/central-park-pedicab-tour.webp" => "Central Park Pedicab Tour",
    "index_files/central-park-pedicab-ride.webp" => "Central Park Pedicab Ride",
    "index_files/central-park-rickshaw-tour.webp" => "Central Park Rickshaw Tour",
    "index_files/central-park-rickshaw-ride.webp" => "Central Park Rickshaw Ride",
    "index_files/central-park-pedicabs.webp" => "Central Park Pedicabs",
    "index_files/central-park-rickshaws.webp" => "Central Park Rickshaws"
];
?>

<div class="image-slider">
  <div class="slide-track">
    <?php foreach ($images as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
    <?php foreach ($images as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
  </div>
</div>
			
			
			
	
	
		<h2 class="title py-2">ON DEMAND CENTRAL PARK PEDICAB TOURS</h2>
<p>• If you are ready to get picked up now, you can book an On Demand Central Pedicab Tour.</p>
<p>• On Demand Central Pedicab Tours start from $25 per pedicab (not per person), the closer you are to Central Park South, the cheaper your tour will be.</p>
<p>• On Demand Central Park Pedicab Tours are the cheapest Central Park Pedicab Tours available online and offline.</p>
<p>• On Demand Central Park Pedicab Tours operation hours are 10:00 AM to 6:00 PM.</p>
<p>• On Demand Central Park Pedicab Tours start and finish addresses are limited to Midtown Manhattan (59th Street to 34th Street).</p>

		
		<h2 class="title py-2">CUSTOM SCHEDULED CENTRAL PARK PEDICAB TOURS</h2>
<p>• Custom Scheduled Central Pedicab Tours start from $55 per pedicab (not per person), the closer you are to Central Park South, the cheaper your tour will be.</p>
<p>• On Demand Central Park Pedicab Tours operation hours are 10:00 AM to 6:00 PM.</p>
<p>• Custom Scheduled Central Park Pedicab Tours start and finish addresses are limited to Midtown Manhattan (59th Street to 34th Street).</p>
<p>• Custom Scheduled Central Park Pedicab Tours offer more start time options and unlimited availability.</p>
<p>• Custom Scheduled Central Park Pedicab Tours require 1 hour notice.</p>

		
		<h2 class="title py-2">STANDARD SCHEDULED CENTRAL PARK PEDICAB TOURS</h2>
		<p>• 1 Hour Standard Scheduled Central Pedicab Tour is $55 per pedicab (not per person).</p>
		<p>• 90 Minute Standard Scheduled Central Pedicab Tour is $80 per pedicab (not per person).</p>
		<p>• Standard Scheduled Central Park Pedicab Tours require 1 hour notice.</p>
		<p>• Standard Scheduled Central Park Pedicab Tour start times are 10:00 AM, 11:30 AM, 1:00 PM, 2:30 PM and 4:00 PM.</p>
		<p>• Standard Scheduled Central Park Pedicab Tour is subject to availability. Please, check the availability in our booking system.</p>
		<p>• Standard Scheduled Central Pedicab Tours start at the south west corner of 6th Avenue and West 57th Street New York NY 10019 (in front of Duane Reade Pharmacy)</p>
		<p><a href="https://goo.gl/maps/QGiWrPkiX6MUYvKk8" target="_blank">6th Avenue and West 57th Street New York NY 10019</a></p>
		<p>• Standard Scheduled Central Pedicab Tours finish at the north side of 7th Avenue and Central Park South New York NY 10019</p>
		<p><a href="https://goo.gl/maps/HFjauW4DWU4G3iU2A" target="_blank">7th Avenue and Central Park South New York NY 10019</a></p>
		<p>• You can book a Standard Scheduled Central Pedicab Tour only for 1 or 2 pedicabs with our booking system. If you would like to book 3 or more pedicabs, please, send us an email.</p>
		
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
		
		<h2 class="title py-2">CENTRAL PARK ATTRACTIONS:</h2>
		<h3 style="color:black !important;" class="sub-title py-2">CENTRAL PARK LOWER LOOP ATTRACTIONS</h3>
		<p>Wollman Rink, Victorian Gardens, Carousel, Chess & Checkers House, Dairy, Literary Walk, Statue of Balto, Summer Stage, Conservatory Water, Bethesda Terrace, Cherry Hill Plaza, Strawberry Fields, Sheep Meadow, Tavern on the Green, Heckscher Playground</p>
		<p>All Central Park Pedicab Tours cover the lower loop attractions.</p>
		<h3 style="color:black !important;" class="sub-title py-2">CENTRAL PARK MIDDLE LOOP ATTRACTIONS:</h3>
		<p>Museum of Natural History, Central Park West, Great Lawn, Belvedere Castle, Turtle Pond, Shakespeare Garden, Swedish Cottage, Ladies Pavilion, Delacorte Theater, Ramble</p>
		<p>90 Minute Central Park Pedicab Tours cover the middle loop attractions.</p>
		
		<h2 class="title py-2">CENTRAL PARK PEDICAB TOUR HOP OFF STOPS</h2>
		<p>40 MINUTES = NON STOP</p>
		<p>45 MINUTES = Cherry Hill Plaza</p>
		<p>50 MINUTES = Cherry Hill Plaza + Strawberry Fields</p>
		<p>1 HOUR = Bethesda Fountain + Cherry Hill Plaza + Strawberry Fields</p>
		<p>90 MINUTES = Conservatory Water + Bethesda Fountain + Cherry Hill Plaza + Strawberry Fields + Belvedere Castle</p>
		
				<?php
$images3 = [
    "index_files/central-park-pedicab-tour.webp" => "Central Park Pedicab Tour",
    "index_files/central-park-pedicab-ride.webp" => "Central Park Pedicab Ride",
    "index_files/central-park-rickshaw-tour.webp" => "Central Park Rickshaw Tour",
    "index_files/central-park-rickshaw-ride.webp" => "Central Park Rickshaw Ride",
    "index_files/central-park-pedicabs.webp" => "Central Park Pedicabs",
    "index_files/central-park-rickshaws.webp" => "Central Park Rickshaws"
];
?>

<div class="image-slider">
  <div class="slide-track">
    <?php foreach ($images3 as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
    <?php foreach ($images3 as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
  </div>
</div>
		
		<h2 class="title py-2">ABOUT CENTRAL PARK PEDICAB TOURS WITH NEW YORK PEDICAB SERVICES</h2>
<p>New York Pedicab Services provides Central Park Pedicab Tours that are well rated and highly recommended with Trip Advisor and Google Business reviews.</p>
<p>• You will relax, see, explore and enjoy Central Park while professional driver drives you around Central Park and its major attractions. You will have fun.</p>
<p>• By booking a Central Park Pedicab Ride or Tour with New York Pedicab Services, you save money and avoid the risk of a random person giving you a pedicab ride or getting scammed by a random pedicab driver. Let the professionals provide you the highlight of your New York City trip.</p>
<p>• Pedicab Tours of Central Park are fun! You will be informed about Central Park and its attractions. You will learn fun facts. You will remember the spots where movies such as Home Alone 2, Serendipity and Ghostbusters were shot. You will see celebrity homes. e.g. Dakota Building where John Lennon used to live or San Remo Towers where Bono (U2 Frontman) has a condo.</p>
<p>• There is no official website for any Central Park Pedicab Tours. There are 850 licensed pedicabs in New York City. All pedicab businesses in New York City are independent businesses.</p>
<p>• New York Pedicab Services guarantees that you will not be able to book a Central Park Pedicab Tour online cheaper than the prices offered on the website of New York Pedicab Services.</p>
<p>• You can hire New York Pedicab Services for any other custom or hourly pedicab service for any event such as a wedding or a photo shoot in Central Park.</p>
<p>• New York Pedicab Services allows you to customize your Central Park Pedicab Tour based on your plans. You can change the start address, you can change the finish address, you can change the route, you can add additional hop off stops, you can omit the assigned hop off stops, you can determine the route, you can add a new attraction that is not mentioned in the descriptions. Please, email us if you need a customized Central Park Pedicab Tour. We will send you a quote for your custom Central Park Pedicab Tour request.</p>

						<?php
$images4 = [
    "index_files/central-park-pedicab-tour.webp" => "Central Park Pedicab Tour",
    "index_files/central-park-pedicab-ride.webp" => "Central Park Pedicab Ride",
    "index_files/central-park-rickshaw-tour.webp" => "Central Park Rickshaw Tour",
    "index_files/central-park-rickshaw-ride.webp" => "Central Park Rickshaw Ride",
    "index_files/central-park-pedicabs.webp" => "Central Park Pedicabs",
    "index_files/central-park-rickshaws.webp" => "Central Park Rickshaws"
];
?>

<div class="image-slider">
  <div class="slide-track">
    <?php foreach ($images4 as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
    <?php foreach ($images4 as $src => $alt): ?>
    <div class="slide">
      <img src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" />
    </div>
    <?php endforeach; ?>
  </div>
</div>
		
		<h2 class="title py-2">MORE INFORMATION ABOUT CENTRAL PARK PEDICAB TOUR</h2>
<p>• Central Park pedicab drivers love getting tipped and the usual tip is 20% of the fare.</p>
<p>• You get a better price and a better driver by booking your Central Park Pedicab Tour online with New York Pedicab Services rather than showing up at Central Park and trying to find random drivers with random prices. The pedicab drivers waiting around Central Park do not charge less than what New York Pedicab Services charges for its Central Park tours online.</p>
<p>• New York Pedicab Services can provide customized Central Park Pedicab Tours, please, send us an email if you want to customize your Central Park Pedicab Tour.</p>
<p>• New York Pedicab Services can provide Central Park tours longer than 90 minutes upon request. Please, send New York Pedicab Services an email if you are interested in a 2 Hour or 3 Hour Central Park Pedicab Tour.</p>
<p>• You can bring your cat or dog (your pet) to your Central Park Pedicab Tour. Please, notify New York Pedicab Services if you have a larger dog.</p>
<p>• New York Pedicab Services does not provide Central Park Pedicab Tours when it rains. Instead, New York Pedicab Services proposes a new tour date and time and if you are not available, New York Pedicab Services issues a full refund.</p>
<p>• Central Park Pedicab Tours are offered every day, every month of the year as long as the weather allows and Central Park driveways are open.</p>
<p>• There is a weight limit to Central Park Pedicab Tours. The pedicab manufacturer recommends that the combined weight of the passengers does not exceed 600 pounds.</p>
<p>• Please, do not get tricked by companies who use labels like “Official Central Park Pedicab Tours”. There is no official Central Park Pedicab Tour company or business. All companies that offer Central Park Pedicab Tours are individual businesses that compete with each other. The word “Official” is just a marketing scam.</p>
<p>• New York Pedicab Services can provide the Central Park Pedicab Tours in other languages such as French and Spanish. Please, send us an email if you would like to take a Central Park Pedicab Tour in a different language before you book your tour.</p>


<?php include('inc/footer.php'); ?>
	</main>
    </div>
<?php include('inc/scripts.php'); ?>
  </body>
</html>
