<?php

$date = date("Y-m-d");
$day  = 1;
$days = array('Sunday', 'Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday');


echo date('Y-m-d', strtotime($days[$day], strtotime($date)));


?>


<html>
<head>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2P1C7YwSvdMztdGj3tE6eKi1CzmJuHkw&libraries=places"></script>
    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('city2').value = place.name;
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
    <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />  
    <input type="hidden" id="city2" name="city2" />
    <input type="hidden" id="cityLat" name="cityLat" />
    <input type="hidden" id="cityLng" name="cityLng" />
</body>
</html>
////
