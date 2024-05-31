<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Your Pedicab Ride</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Viewport meta etiketi eklendi -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKOygxViJ7v5bzNoEa_EFLOuHiQ8ofO-c&libraries=places&callback=initAutocomplete" async defer></script>

<style>
		.btn{
			margin-bottom:1%;
		}
		.container {
			margin-top:1%;
		}
        .ui-datepicker, .form-control, button.btn {
            font-size: 16px;  /* Artırılmış font boyutu */
        }
        .form-control, button.btn {
            height: auto; /* Daha büyük tıklama alanı */
            padding: 10px; /* Artırılmış padding */
        }
        @media (max-width: 576px) { /* Küçük ekranlar için stil ayarlamaları */
				.btn{
			margin-bottom:5%;
		}
		.container {
			margin-top:5%;
		}
            .form-group, .form-check {
                margin-bottom: 20px; /* Daha fazla boşluk */
            }
            button.btn {
                width: 100%; /* Tam genişlik */
            }
        }
    .ui-datepicker {
        background-color: #007bff; /* Mavi tema arka plan rengi */
        border: 1px solid #0056b3; /* Kenarlık rengi */
        color: white; /* Yazı rengi */
        padding: 10px; /* İç boşluk */
        border-radius: 5px; /* Kenar yuvarlaklığı */
    }
    .ui-datepicker a {
        color: white; /* Tüm link renkleri */
    }
    .ui-datepicker table {
        width: 100%; /* Tablo genişliği */
    }
    .ui-datepicker-header {
        background-color: #0056b3; /* Başlık arka plan rengi */
        color: white; /* Başlık yazı rengi */
        border-bottom: 1px solid #004080; /* Başlık alt çizgisi */
        line-height: 1.8; /* Başlık satır yüksekliği */
    }
    .ui-datepicker-title {
        font-weight: bold; /* Ay ve yıl yazı kalınlığı */
    }
    .ui-datepicker-prev, .ui-datepicker-next {
        cursor: pointer; /* Fare imleci */
    }
    .ui-datepicker-prev:hover, .ui-datepicker-next:hover {
        background-color: #0056b3; /* Fare üzerine gelince renk */
    }
    .ui-state-default {
        background: #0056b3; /* Gün kutuları arka plan */
        border: 1px solid #004080; /* Gün kutuları kenarlık */
        color: white; /* Gün kutuları yazı rengi */
    }
    .ui-state-hover {
        background: #004080; /* Fare ile üzerine gelince renk */
        color: white; /* Fare ile üzerine gelince yazı rengi */
    }
    .ui-state-active, .ui-state-highlight {
        background: #ffc107; /* Seçili veya bugünün tarihi */
        color: black; /* Seçili veya bugünün tarihi yazı rengi */
    }
</style>

</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Formu daha dar bir sütuna sığdırarak merkezle -->
            <h2 class="text-center mb-4">Book Your Pedicab Ride</h2>
            <?php if ($errorMessage): ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMessage ?>
            </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="numPassengers">Number of Passengers:</label>
                    <select class="form-control" id="numPassengers" name="numPassengers">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickUpDate">Date of Pick Up:</label>
                    <input type="text" class="form-control" id="pickUpDate" name="pickUpDate">
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hours">Hour:</label>
                            <select class="form-control" id="hours" name="hours">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="minutes">Minute:</label>
                            <select class="form-control" id="minutes" name="minutes">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ampm">AM/PM:</label>
                            <select class="form-control" id="ampm" name="ampm">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pickUpAddress">Pick Up Address:</label>
                    <input type="text" class="form-control" id="pickUpAddress" name="pickUpAddress">
                </div>
                <div class="form-group">
                    <label for="destinationAddress">Destination Address:</label>
                    <input type="text" class="form-control" id="destinationAddress" name="destinationAddress">
                </div>
                <div class="form-group">
                    <label>Driver Paid Separately</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="payCash" value="cash" checked>
                        <label class="form-check-label" for="payCash">
                            I will pay the driver cash
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="payCard" value="card">
                        <label class="form-check-label" for="payCard">
                            I will pay the driver with debit/credit card (10% fee applies to the driver fare)
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Calculate Fare</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-timepicker-addon.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.6.3/jquery-ui-sliderAccess.js"></script>
<script>
$(document).ready(function() {
    $("#pickUpDate").datepicker({
        changeYear: true,
		changeMonth: true,
        yearRange: "2024:2025",
        dateFormat: "mm-dd-yy"
    });
});
</script>
<script>
$(document).ready(function() {
    // Assuming you need to combine the hours, minutes, and AM/PM into a single time input
    $('#hours, #minutes, #ampm').change(function() {
        var hours = $('#hours').val();
        var minutes = $('#minutes').val();
        var ampm = $('#ampm').val();
        var time = hours + ':' + minutes + ' ' + ampm;
        $('#pickUpTime').val(time);
    });
});
</script>
<script type="text/javascript">
function initAutocomplete() {
    var manhattanBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(40.701466, -74.017948), // Southwest corner of Manhattan (Battery Park)
        new google.maps.LatLng(40.875912, -73.909498)  // Northeast corner of Manhattan (Inwood)
    );

    var options = {
        bounds: manhattanBounds,
        strictBounds: true // Bu seçenek sonuçları sadece belirtilen sınırlar içinde sınırlar
    };

    var allowedZipCodes = ['10000', '10001', '10002', '10003', '10004', '10005', '10006', '10007', '10008', '10009', '10010', '10011', '10012', '10013', '10014', '10015', '10016', '10017', '10018', '10019', '10020', '10021', '10022', '10023', '10024', '10025', '10026', '10028', '10029', '10036', '10038', '10041', '10043', '10045', '10055', '10060', '10065', '10069', '10075', '10080', '10081', '10087', '10090', '10101', '10102', '10103', '10104', '10105', '10106', '10107', '10108', '10109', '10110', '10111', '10112', '10113', '10114', '10116', '10117', '10118', '10119', '10120', '10121', '10122', '10123', '10124', '10126', '10128', '10129', '10130', '10131', '10132', '10133', '10138', '10151', '10152', '10153', '10154', '10155', '10156', '10157', '10158', '10159', '10160', '10162', '10163', '10164', '10165', '10166', '10167', '10168', '10169', '10170', '10171', '10172', '10173', '10174', '10175', '10176', '10177', '10178', '10179', '10185', '10199', '10203', '10211', '10212', '10242', '10249', '10256', '10258', '10259', '10260', '10261', '10265', '10268', '10269', '10270', '10271', '10272', '10273', '10274', '10275', '10276', '10277', '10278', '10279', '10280', '10281', '10282', '10285', '10286'
, /* Daha fazla posta kodu */];

    var pickUpInput = document.getElementById('pickUpAddress');
    var destinationInput = document.getElementById('destinationAddress');

    var autocompletePickup = new google.maps.places.Autocomplete(pickUpInput, options);
    var autocompleteDestination = new google.maps.places.Autocomplete(destinationInput, options);

    function checkZipCode(place, inputField) {
        var zipCode = place.address_components.find(function(component) {
            return component.types.indexOf("postal_code") > -1;
        });

        if (zipCode && allowedZipCodes.includes(zipCode.long_name)) {
            console.log("Valid location: ", place.formatted_address);
        } else {
            console.error("Invalid postal code.");
            alert("Selected address is outside of allowed regions.");
            inputField.value = ""; // Adres alanını temizle
        }
    }

    autocompletePickup.addListener('place_changed', function() {
        var place = autocompletePickup.getPlace();
        checkZipCode(place, pickUpInput);
    });

    autocompleteDestination.addListener('place_changed', function() {
        var place = autocompleteDestination.getPlace();
        checkZipCode(place, destinationInput);
    });
}
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
