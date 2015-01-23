<?php include('core/init.core.php');?>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
        <script type="text/javascript">
            var geocoder = new google.maps.Geocoder();

            function geocodePosition(pos) {
                geocoder.geocode({
                    latLng: pos
                }, function(responses) {
                    if (responses && responses.length > 0) {
                        updateMarkerAddress(responses[0].formatted_address);
                    } else {
                        updateMarkerAddress('Cannot determine address at this location.');
                    }
                });
            }

            function updateMarkerStatus(str) {
                document.getElementById('markerStatus').innerHTML = str;
            }

            function updateMarkerPosition(latLng) {
                document.getElementById('info').innerHTML = [
                    latLng.lat(),
                    latLng.lng()
                ].join(', ');
            }

            function updateMarkerAddress(str) {
                document.getElementById('address').innerHTML = str;
            }

            function initialize() {


                ///57.147493,-2.095392
                var latLng = new google.maps.LatLng(57.147493, -2.095392);
                var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                    zoom: 8,
                    center: latLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var marker = new google.maps.Marker({
                    position: latLng,
                    title: 'Point A',
                    map: map,
                    draggable: true
                });

                var input = document.getElementById("keyword");
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo("bounds", map);

                // Update current position info.
                updateMarkerPosition(latLng);
                geocodePosition(latLng);

                // Add dragging event listeners.
                google.maps.event.addListener(marker, 'dragstart', function() {
                    updateMarkerAddress('Dragging...');
                });

                google.maps.event.addListener(marker, 'drag', function() {
                    updateMarkerStatus('Dragging...');
                    updateMarkerPosition(marker.getPosition());
                });

                google.maps.event.addListener(marker, 'dragend', function() {
                    updateMarkerStatus('Drag ended');
                    geocodePosition(marker.getPosition());
                });


                google.maps.event.addListener(autocomplete, "place_changed", function(){

                    var place = autocomplete.getPlace();

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(15);
                    }

                    marker.setPosition(place.geometry.location);
                });

                google.maps.event.addListener(map, "click", function(event){
                    marker.setPosition(event.latLng);
                });

            }

            // Onload handler to fire off the app.
            google.maps.event.addDomListener(window, 'load', initialize);
</script>
        <style type="text/css">
            #mapCanvas {
                width: 500px;
                height: 400px;
                float: left;
            }
            #infoPanel {
                float: left;
                margin-left: 10px;
            }
            #infoPanel div {
                margin-bottom: 5px;
            }
        </style>
    </head>
    <body>
        <div id="mapCanvas"></div>
        <div id="infoPanel">
            <b>Marker status:</b>
            <div id="markerStatus"><i>Click and drag the marker.</i></div>
            <b>Current position:</b>
            <div id="info"></div>
            <b>Closest matching address:</b>
            <div id="address"></div>

                    <div class="controls col-md-12 col-lg-12">
            <input type="text" name="keyword" id="keyword">
        </div>

            <button type="button" class="btn btn-default col-md-offset-4">Cancel</button>
            <button type="submit" class="btn btn-success" id="save-location">Done</button>
        </div>
    </body>
</html>