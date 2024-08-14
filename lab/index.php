<?php
$title = "New York Pedicab Services Homepage";
$description = "New York Pedicab Services provides Central Park Pedicab Tours, Point A to Point B Pedicab Rides, Hourly Pedicab Services, Pedicab Rentals and Pedicab Advertising.";
include('inc/head.php');
?>
    <link href="css/index_style.css" rel="stylesheet">
  </head>
  <body>
    <div class="main-wrapper">
<?php include('inc/header.php'); ?>
      <main class="pt-4">
        <h1 class="title py-2"><strong>CENTRAL PARK PEDICAB TOURS</strong></h1>
        <p class="text-red">New York Pedicab Services provides Central Park Pedicab Tours starting from $25 per pedicab (not per person).</p>
        <h1 class="title py-2"><strong>POINT A TO B PEDICAB RIDES</strong></h1>
        <p class="text-red">New York Pedicab Services provides Point A to B Pedicab Rides starting from $20 per pedicab (not per person).</p>
        <h1 class="title py-2"><strong>HOURLY PEDICAB SERVICES</strong></h1>
        <p class="text-red">New York Pedicab Services provides hourly pedicab services starting from $25 per pedicab (not per person).</p>
        <h1 class="title py-2"><strong>PEDICAB RENTALS</strong></h1>
        <p class="text-red">New York Pedicab Services provides pedicab rentals without drivers.</p>
        <h1 class="title py-2"><strong>PEDICAB ADVERTISING</strong></h1>
        <p class="text-red">New York Pedicab Services provides pedicab advertising and branding services with the pedicabs. New York Pedicab Services can provide the advertising and branding services either on daily / weekly / monthly basis or on an event with sponsored rides basis.</p>
       
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


	   <h1 class="title py-2"><strong>PEDICABS IN NEW YORK CITY</strong></h1>
        <p class="text-red">One pedicab can accommodate 3 adult passengers.</p>
        <p class="text-red">Pedicabs are legally not allowed to have more than 3 passengers, including children.</p>
        <p class="text-red">Pedicabs offer an environmentally friendly fun transportation alternative with a 360 degree view.</p>
        <p class="text-red">Pedicabs operate mainly in Midtown Manhattan and Central Park.</p>
        <p class="text-red">Pedicabs are Made in USA; manufactured in Broomfield, Colorado.</p>
        <h1 class="title py-2"><strong>ABOUT NEW YORK PEDICAB SERVICES</strong></h1>
        <p class="text-red">New York Pedicab Services has been in business since 2005.</p>
        <p class="text-red">New York Pedicab Services office hours are 10:00 am to 6:00 pm every day of the year.</p>
        <p class="text-red">New York Pedicab Services operation hours are 24 hours a day every day of the year.</p>
        <p class="text-red">New York Pedicab Services provided pedicab services to Saturday Night Live, Karlie Kloss, Netflix, Chobani and many other popular names, shows and brands and earned a star status with its humble love for pedicabs and professionalism.</p>
        <p class="text-red">New York Pedicab Services works only with prepaid bookings.</p>
        <p class="text-red">New York Pedicab Services does not charge per person. All displayed or quoted rates are per pedicab.</p>
        <p class="text-red">New York Pedicab Services works with licensed and insured pedicabs.</p>
        <p class="text-red">New York Pedicab Services works with licensed and experienced pedicab drivers.</p>
        <p class="text-red">New York Pedicab Services can accommodate requests from Brooklyn, Queens, Bronx and Staten Island.</p>
        <p class="text-red">New York Pedicab Services can accommodate requests from New York, New Jersey, Connecticut and Pennsylvania.</p>
        <p class="text-red">New York Pedicab Services accepts debit card, credit card, check, Venmo, Zelle and Cashapp payments.</p>
        <p class="text-red">New York Pedicab Services is pet friendly. We welcome dogs or cats or any other small pet you have. If you have a larger pet, we request that you send us an email with the details.</p>
        <p class="text-red">New York Pedicab Services provides blankets and canopies to keep you warm in cold winter days.</p>
        <p class="text-red">New York Pedicab Services can provide tours and rides in many other languages including but not limited to Spanish. Please, email us if you would like to take a tour in any other language.</p>
        <p class="text-red">New York Pedicab Services can accommodate a foldable single stroller or a foldable single wheelchair or a single luggage.</p>
        <p class="text-red">New York Pedicab Services would rather lose money, not your trust. If you have any concern with your booking, please, contact us before or after your booking. We will do our best to resolve your concern.</p>
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

        <h1 class="title py-2"><strong>NEW YORK PEDICAB SERVICES CANCELLATION POLICY</strong></h1>
        <p class="text-red">New York Pedicab Services allows you to reschedule or cancel your booking at any time. Only reschedule or cancellation requests made in less than 3 hours from the scheduled departure time will be subject to fees.</p>
        <p class="text-red">New York Pedicab Services issues full refund for rain cancellations. Rain cancellation decisions are made 3 hours before the scheduled ride time. Since it is not pleasant to give rides when it rains, we do not give tours when it rains. We offer a new date and time or issue full refund if we cancel the tour due to rain.</p>
        <p class="text-red">New York Pedicab Services issues full refund for cancellations made 3 hours before the scheduled ride time.</p>
        <p class="text-red">New York Pedicab Services does not issue any refund for cancellations made in less than 3 hours before the scheduled ride time.</p>

<?php include('inc/footer.php'); ?>
      </main>
    </div>
<?php include('inc/scripts.php'); ?>
  </body>
</html>