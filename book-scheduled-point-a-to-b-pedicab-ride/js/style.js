<script>
$(document).ready(function() {
    $("#pickUpDate").datepicker({
        changeYear: true,
		changeMonth: true,
        yearRange: "2024:2025",
		minDate: 0,
        dateFormat: "mm/dd/yy"
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
<script>
document.addEventListener("DOMContentLoaded", function() {
    const hoursElement = document.getElementById('hours');
    const minutesElement = document.getElementById('minutes');
    const ampmElement = document.getElementById('ampm');
    const dateElement = document.getElementById('pickUpDate');
    const submitButton = document.querySelector('button[type="submit"]');
    const form = document.getElementById('myForm');

    function resetSelection() {
        hoursElement.value = '';
        minutesElement.value = '';
        ampmElement.value = '';
    }

    function validateTime() {
        if (!hoursElement.value || !minutesElement.value || !ampmElement.value) {
            // Saat, dakika veya AM/PM boşsa kontrol yapma
            return false;
        }

        const currentDate = new Date();
        const selectedDate = new Date(dateElement.value);

        // Saati 24 saatlik formata çevirme
        const hours = parseInt(hoursElement.value);
        const minutes = parseInt(minutesElement.value);
        const isPM = ampmElement.value === 'PM';
        const selectedHours = isPM ? (hours % 12) + 12 : (hours % 12);

        // Seçilen tarih ve saat
        const selectedDateTime = new Date(selectedDate);
        selectedDateTime.setHours(selectedHours, minutes, 0, 0);

        // Geçerli zaman + 1 saat
        const currentTimePlusOneHour = new Date(currentDate.getTime() + (60 * 60 * 1000));

        if (selectedDateTime < currentTimePlusOneHour) {
            alert("Please, select a pickup time that is at least 1 hour later than the current time.");
            return false;
        }

        // Gece saatleri için geçersiz zaman aralığı kontrolü
        if ((isPM && hours === 11 && minutes > 0) || (isPM && hours > 11) ||
            (!isPM && hours < 9) || (!isPM && hours === 12)) {
            alert("Please, do not use this application to book a ride between 11:01 pm and 8:59 am. Please, use the form below instead.");
            return false;
        }

        return true; // Geçerli zaman, formun submit edilmesine izin ver
    }

    // Form submit olduğunda validateTime fonksiyonunu çağır ve gerekirse submit işlemini engelle
    form.addEventListener('submit', function(event) {
        if (!validateTime()) {
            event.preventDefault(); // Form submissionu engelle
        }
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
            alert("You are trying to book a ride outside of our main service areas. Please, use the form below instead.");
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
