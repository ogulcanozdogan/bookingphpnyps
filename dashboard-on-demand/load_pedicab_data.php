<?php
include('inc/vt.php');

// Point A to B Pedicab Rides
$pointatob_content = '';
$sorgu = $baglanti->prepare("SELECT * FROM pointatob WHERE status = 'available' ORDER BY createdAt DESC");
$sorgu->execute();
while ($sonuc = $sorgu->fetch()) {
    $paymentMethod = $sonuc['paymentMethod'];
    if ($paymentMethod == "CARD" or $paymentMethod == "card") {
        $paymentMethod = "debit/credit card";
    } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
        $paymentMethod = "CASH";
    }

    $createdAt = new DateTime($sonuc['createdAt'], new DateTimeZone('America/New_York'));
    $expiryTime = clone $createdAt;
    $expiryTime->modify('+5 minutes');
    $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
    $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

    if ($remainingTime > 0) {
        ob_start();
        ?>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="card-<?= $sonuc['id'] ?>">
                <div class="card-body position-relative">
                    <h5 class="mb-3"><?= htmlspecialchars($sonuc["bookingNumber"]) ?></h5>
                    <div class="vstack gap-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-apps-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Type</h6>
                                <b class="pay-amount">Point A to B Pedicab Ride</b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-parent-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Passengers</h6>
                                <b class="pay-amount"><?= htmlspecialchars($sonuc['numberOfPassengers']) ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-calendar-2-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Date Of Ride</h6>
                                <b class="pay-amount">
                                    <?php
                                    $date = new DateTime($sonuc['date']);
                                    echo htmlspecialchars($date->format('m/d/Y'));
                                    ?>
                                    (<?= htmlspecialchars($date->format('l')) ?>) (Today)
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-time-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Time of Ride</h6>
                                <b class="pay-amount">
<?= htmlspecialchars($sonuc["pickUpTime"]) ?>
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-map-pin-time-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Duration of Ride</h6>
                                <b class="pay-amount"><?= htmlspecialchars(number_format($sonuc['duration'], 2)) ?> Minutes</b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-coin-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Driver Fare</h6>
                                <b class="pay-amount">$<?= htmlspecialchars($sonuc["driverFee"]) ?> with <?= $paymentMethod ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-time-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Remaining Time</h6>
                                <b class="pay-amount">
                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown" data-remaining-time="<?= $remainingTime ?>"><?= gmdate('i:s', $remainingTime) ?></span> minutes
                                </b>
                            </div>
                        </div>
                        <form method="POST" action="acceptatob.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                            <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                            <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                            <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Accept" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $pointatob_content .= ob_get_clean();
    }
}

// Hourly Pedicab Services
$hourly_content = '';
$sorgu = $baglanti->prepare("SELECT * FROM hourly WHERE status = 'available' ORDER BY createdAt DESC");
$sorgu->execute();
while ($sonuc = $sorgu->fetch()) {
    $paymentMethod = $sonuc['paymentMethod'];
    if ($paymentMethod == "CARD" or $paymentMethod == "card") {
        $paymentMethod = "debit/credit card";
    } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
        $paymentMethod = "CASH";
    }

    $createdAt = new DateTime($sonuc['createdAt'], new DateTimeZone('America/New_York'));
    $expiryTime = clone $createdAt;
    $expiryTime->modify('+5 minutes');
    $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
    $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

    if ($remainingTime > 0) {
        ob_start();
        ?>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="card-<?= $sonuc['id'] ?>">
                <div class="card-body position-relative">
                    <h5 class="mb-3"><?= htmlspecialchars($sonuc["bookingNumber"]) ?></h5>
                    <div class="vstack gap-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-apps-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Type</h6>
                                <b class="pay-amount">Hourly Pedicab Service</b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-parent-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Passengers</h6>
                                <b class="pay-amount"><?= htmlspecialchars($sonuc['numberOfPassengers']) ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-calendar-2-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Date Of Tour</h6>
                                <b class="pay-amount">
                                    <?php
                                    $date = new DateTime($sonuc['date']);
                                    echo htmlspecialchars($date->format('m/d/Y'));
                                    ?>
                                    (<?= htmlspecialchars($date->format('l')) ?>) (Today)
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-time-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Time of Tour</h6>
                                <b class="pay-amount">
<?= htmlspecialchars($sonuc["pickUpTime"]) ?>
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-map-pin-time-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Duration of Service</h6>
                                <b class="pay-amount"><?php
								
$serviceDuration = $sonuc['serviceDuration'];

if ($serviceDuration == 30 || $serviceDuration == 90) {
    $serviceDuration = $serviceDuration . " Minutes";
} 
else if ($serviceDuration == 1){
    $serviceDuration = $serviceDuration . " Hour";
}
else if ($serviceDuration == 2 or $serviceDuration == 3){
    $serviceDuration = $serviceDuration . " Hours";
}
echo $serviceDuration;
?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-coin-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Driver Fare</h6>
                                <b class="pay-amount">$<?= htmlspecialchars($sonuc["driverFee"]) ?> with <?= $paymentMethod ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-time-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Remaining Time</h6>
                                <b class="pay-amount">
                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown" data-remaining-time="<?= $remainingTime ?>"><?= gmdate('i:s', $remainingTime) ?></span> minutes
                                </b>
                            </div>
                        </div>
                        <form method="POST" action="accepthourly.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                            <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                            <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                            <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Accept"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $hourly_content .= ob_get_clean();
    }
}

// Central Park Pedicab Tours
$centralpark_content = '';
$sorgu = $baglanti->prepare("SELECT * FROM centralpark WHERE status = 'available' ORDER BY createdAt DESC");
$sorgu->execute();
while ($sonuc = $sorgu->fetch()) {
    $paymentMethod = $sonuc['paymentMethod'];
    if ($paymentMethod == "CARD" or $paymentMethod == "card") {
        $paymentMethod = "debit/credit card";
    } elseif ($paymentMethod == "CASH" or $paymentMethod == "cash") {
        $paymentMethod = "CASH";
    }

    $tourDuration = $sonuc["tourDuration"];


    $createdAt = new DateTime($sonuc['createdAt'], new DateTimeZone('America/New_York'));
    $expiryTime = clone $createdAt;
    $expiryTime->modify('+5 minutes');
    $currentTime = new DateTime('now', new DateTimeZone('America/New_York'));
    $remainingTime = $expiryTime->getTimestamp() - $currentTime->getTimestamp();

    if ($remainingTime > 0) {
        ob_start();
        ?>
        <div class="col-xl-3 col-md-6">
            <div class="card" id="card-<?= $sonuc['id'] ?>">
                <div class="card-body position-relative">
                    <h5 class="mb-3"><?= htmlspecialchars($sonuc["bookingNumber"]) ?></h5>
                    <div class="vstack gap-2">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-apps-2-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Type</h6>
                                <b class="pay-amount">Central Park Pedicab Tour</b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-parent-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Passengers</h6>
                                <b class="pay-amount"><?= htmlspecialchars($sonuc['numberOfPassengers']) ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-calendar-2-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Date Of Tour</h6>
                                <b class="pay-amount">
                                    <?php
                                    $date = new DateTime($sonuc['date']);
                                    echo htmlspecialchars($date->format('m/d/Y'));
                                    ?>
                                    (<?= htmlspecialchars($date->format('l')) ?>) (Today)
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-time-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Time of Tour</h6>
                                <b class="pay-amount">
							<?= htmlspecialchars($sonuc["pickUpTime"]) ?>
                                </b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-map-pin-time-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Duration of Tour</h6>
                                <b class="pay-amount"><?php
if ($tourDuration == 1){
	$tourDuration = $tourDuration . " Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)";
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
								echo htmlspecialchars($tourDuration); ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-map-pin-time-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Duration of Ride</h6>
                                <b class="pay-amount"><?= htmlspecialchars(number_format($sonuc['duration'], 2)) ?> Minutes</b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-coin-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Driver Fare</h6>
                                <b class="pay-amount">$<?= htmlspecialchars($sonuc["driverFee"]) ?> with <?= $paymentMethod ?></b>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-time-line"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Remaining Time</h6>
                                <b class="pay-amount">
                                    <span id="countdown-<?= $sonuc['id'] ?>" style='color:red;' class="countdown" data-remaining-time="<?= $remainingTime ?>"><?= gmdate('i:s', $remainingTime) ?></span> minutes
                                </b>
                            </div>
                        </div>
                        <form method="POST" action="acceptcentralpark.php" role="form" id="accept-form-<?= $sonuc['id'] ?>">
                            <input type="hidden" name="id" value="<?= $sonuc["id"] ?>" />
                            <input type="hidden" name="bookingNumber" value="<?= $sonuc["bookingNumber"] ?>" />
                            <input type="submit" class="btn btn-primary w-100 mt-3" id="confirm-btn-<?= $sonuc['id'] ?>" value="Accept"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $centralpark_content .= ob_get_clean();
    }
}

echo json_encode([
    'pointatob' => $pointatob_content,
    'hourly' => $hourly_content,
    'centralpark' => $centralpark_content
]);
?>
