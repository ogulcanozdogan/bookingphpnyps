
   <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: 40.712776, lng: -74.005974},
                styles: [
                    {elementType: 'geometry', stylers: [{color: '#ebe3cd'}]},
                    {elementType: 'labels.text.fill', stylers: [{color: '#523735'}]},
                    {elementType: 'labels.text.stroke', stylers: [{color: '#f5f1e6'}]},
                    {
                        featureType: 'administrative',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#c9b2a6'}]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#dcd2be'}]
                    },
                    {
                        featureType: 'administrative.land_parcel',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#ae9e90'}]
                    },
                    {
                        featureType: 'landscape.natural',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'poi',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#93817c'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'geometry.fill',
                        stylers: [{color: '#a5b076'}]
                    },
                    {
                        featureType: 'poi.park',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#447530'}]
                    },
                    {
                        featureType: 'road',
                        elementType: 'geometry',
                        stylers: [{color: '#f5f1e6'}]
                    },
                    {
                        featureType: 'road.arterial',
                        elementType: 'geometry',
                        stylers: [{color: '#fdfcf8'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry',
                        stylers: [{color: '#f8c967'}]
                    },
                    {
                        featureType: 'road.highway',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#e9bc62'}]
                    },
                    {
                        featureType: 'road.highway.controlled_access',
                        elementType: 'geometry',
                        stylers: [{color: '#e98d58'}]
                    },
                    {
                        featureType: 'road.highway.controlled_access',
                        elementType: 'geometry.stroke',
                        stylers: [{color: '#db8555'}]
                    },
                    {
                        featureType: 'road.local',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#806b63'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#8f7d77'}]
                    },
                    {
                        featureType: 'transit.line',
                        elementType: 'labels.text.stroke',
                        stylers: [{color: '#ebe3cd'}]
                    },
                    {
                        featureType: 'transit.station',
                        elementType: 'geometry',
                        stylers: [{color: '#dfd2ae'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry.fill',
                        stylers: [{color: '#b9d3c2'}]
                    },
                    {
                        featureType: 'water',
                        elementType: 'labels.text.fill',
                        stylers: [{color: '#92998d'}]
                    }
                ]
            });

            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer({
                map: map,
                suppressMarkers: true  // Varsayılan işaretçileri kaldır
            });

            var pickupAddress = <?php echo json_encode($deneme2); ?>;
            var destinationAddress = <?php echo json_encode($destinationAddress); ?>;

            calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress);
        }
function calculateAndDisplayRoute(directionsService, directionsRenderer, map, pickupAddress, destinationAddress) {
    directionsService.route({
        origin: pickupAddress,
        destination: destinationAddress,
        travelMode: 'BICYCLING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsRenderer.setDirections(response);
            addCustomMarkers(response, map, pickupAddress, destinationAddress); // addCustomMarkers fonksiyonuna gerekli parametreleri iletiyoruz
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}

function addCustomMarkers(directionsResult, map, pickupAddress, destinationAddress) {
    var leg = directionsResult.routes[0].legs[0];
    createMarker(leg.start_location, 'A', 'Start: ' + pickupAddress, map);
    createMarker(leg.end_location, 'B', 'End: ' + destinationAddress, map);
}
        function createMarker(position, label, title, map) {
            new google.maps.Marker({
                position: position,
                map: map,
                label: label,
                title: title
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKOygxViJ7v5bzNoEa_EFLOuHiQ8ofO-c&callback=initMap">
    </script>  
<script>
	document.getElementById('prevButton').addEventListener('click', function() {
    // Geri butonuna tıklandığında URL'e parametrelerle verileri ekleyerek index.php sayfasına yönlendir
var numPassengers = "<?php echo $numPassengers; ?>";
var pickUpDate = "<?php echo $pickUpDate; ?>";
var hours = "<?php echo $hours; ?>";
var minutes = "<?php echo $minutes; ?>";
var ampm = "<?php echo $ampm; ?>";
var pickUpAddress = "<?php echo $deneme2; ?>";
var destinationAddress = "<?php echo $destinationAddress; ?>";
var paymentMethod = "<?php echo $paymentMethod; ?>";


    var url = 'index.php?' + 
              'numPassengers=' + encodeURIComponent(numPassengers) +
              '&pickUpDate=' + encodeURIComponent(pickUpDate) +
              '&hours=' + encodeURIComponent(hours) +
              '&minutes=' + encodeURIComponent(minutes) +
              '&ampm=' + encodeURIComponent(ampm) +
              '&pickUpAddress=' + encodeURIComponent(pickUpAddress) +
              '&destinationAddress=' + encodeURIComponent(destinationAddress) +
              '&paymentMethod=' + encodeURIComponent(paymentMethod);

    window.location.href = url; // Sayfayı index.php'ye yönlendir
});</script>