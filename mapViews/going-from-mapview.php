<div class="form-group going-from-map" style="display:none;">
    <div class="panel panel-default col-md-offset-4 col-md-6">
        <div id="going-from-map" class="panel-collapse collapse">
            <div class="panel-body">
                <p>Please enter the address of your location into the search box and drag the marker to the correct bus stop.</p>
                <div class="panel-group" id="">
                    <input id="going-from-map-pac-input" class="controls" type="text" placeholder="Search Box">
                    <div id="going-from-map-mapCanvas" class="col-lg-8 col-md-8"></div>
                    <div id="going-from-map-infoPanel">
                        <!--b>Marker status:</b-->
                        <!--div id="markerStatus"><i>Click and drag the marker.</i></div-->
                        <!--b>Current position:</b-->
                        <!--div id="info"></div-->
                        <b>Closest matching address:</b>
                        <div id="going-from-map-address"></div>
                        <input type="hidden" name="going-from-map-lat" id="going-from-map-lat" value=0>
                        <input type="hidden" name="going-from-map-lat" id="going-from-map-long" value=0>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="button" class="btn btn-default" onClick="going_from_map_close();">Close</button>
                <button type="button" class="btn btn-primary" onClick="going_from_map_save();" id="going-from-map-save-btn" data-source="">Save location</button>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
            #going-from-map-mapCanvas {
                  width: 100%;
                  min-height: 300px;
                  margin: 0;
            }
            #going-from-map-infoPanel {
                float: left;
                margin-left: 10px;
            }
            #going-from-map-infoPanel div {
                margin-bottom: 5px;
            }

        .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #going-from-map-pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
      }

      #going-from-map-pac-input:focus {
        border-color: #4d90fe;
        margin-left: -1px;
        padding-left: 14px;  /* Regular padding-left + 1. */
        width: 401px;
      }

      .pac-container {
        font-family: Roboto;
            background-color: #FFF;
        z-index: 20;
        position: fixed;
        display: inline-block;
        float: left;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
</style>
        <script type="text/javascript">
            var geocoder = new google.maps.Geocoder();
            var going_from_map;
            function going_from_geocodePosition(pos) {
                geocoder.geocode({
                    latLng: pos
                }, function(responses) {
                    if (responses && responses.length > 0) {
                        going_from_updateMarkerAddress(responses[0].formatted_address);
                    } else {
                        going_from_updateMarkerAddress('Cannot determine address at this location.');
                    }
                });
            }

            //get lat long from address
            function going_from_getLatLong(address){
                geocoder.geocode({'going-from-map-address':address},function(results, status){
                    if (status == google.maps.GeocoderStatus.OK) {

                        going_from_updateMarkerAddress(results[0].formatted_address);
                        //return results[0].geometry.location;
              } else {
                //alert("Geocode was not successful for the following reason: " + status)
                going_from_updateMarkerAddress('Cannot determine address at this location.')
                }
             });
            }

            function going_from_updateMarkerStatus(str) {
                //document.getElementById('markerStatus').innerHTML = str;
            }

            function going_from_updateMarkerPosition(latLng) {
                /*document.getElementById('info').innerHTML = [
                    latLng.lat(),
                    latLng.lng()
                ].join(', ');*/

                    $('#going-from-map-lat').val(latLng.lat());
                    $('#going-from-map-long').val(latLng.lng());
            }

            function going_from_updateMarkerAddress(str) {
                document.getElementById('going-from-map-address').innerHTML = str;
            }

            function going_from_initialize() {


                ///57.147493,-2.095392
                var latLng = new google.maps.LatLng(57.147493, -2.095392);
                going_from_map = new google.maps.Map(document.getElementById('going-from-map-mapCanvas'), {
                    zoom: 8,
                    center: latLng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                var marker = new google.maps.Marker({
                    position: latLng,
                    title: 'Point A',
                    map: going_from_map,
                    draggable: true
                });


                // Update current position info.
                going_from_updateMarkerPosition(latLng);
                going_from_geocodePosition(latLng);

                // Add dragging event listeners.
                google.maps.event.addListener(marker, 'dragstart', function() {
                    going_from_updateMarkerAddress('Dragging...');
                });

                google.maps.event.addListener(marker, 'drag', function() {
                    going_from_updateMarkerStatus('Dragging...');
                    going_from_updateMarkerPosition(marker.getPosition());
                });

                google.maps.event.addListener(marker, 'dragend', function() {
                    going_from_updateMarkerStatus('Drag ended');
                    going_from_geocodePosition(marker.getPosition());
                });



                // Create the search box and link it to the UI element.
                  var input = /** @type {HTMLInputElement} */(
                      document.getElementById('going-from-map-pac-input'));
                  going_from_map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                  var searchBox = new google.maps.places.SearchBox((input));


                //listen to search box
                google.maps.event.addListener(searchBox, "places_changed", function(){

                    var places = searchBox.getPlaces();
                    var place = places[0];
                    //input.text(place['formatted_address']);
                    //  console.log(JSON.stringify(place));
                    if (place.geometry.viewport) {
                        going_from_map.fitBounds(place.geometry.viewport);
                    } else {
                        going_from_map.setCenter(place.geometry.location);
                        going_from_map.setZoom(15);
                    }

                    marker.setPosition(place.geometry.location);

                    //$("#pac-input").val(place['formatted_address']);
                    //searchBox.val(place['formatted_address']);
                    //document.getElementById('pac-input').innerHTML = str;
                    //input.value=place['formatted_address'];
                    //$("#keyword").val(place['formatted_address']);
                    going_from_updateMarkerAddress(place['formatted_address']);
                    //geocodePosition(marker.getPosition());
                });

                google.maps.event.addListener(going_from_map, "click", function(event){
                    // console.log(event.latLng);
                    marker.setPosition(event.latLng);
                    going_from_updateMarkerPosition(event.latLng);
                    going_from_geocodePosition(marker.getPosition());
                });

                //var bounds = map.getBounds();
                //searchBox.setBounds(bounds);
            
            }

            // Onload handler to fire off the app.
            google.maps.event.addDomListener(window, 'load', going_from_initialize);

            //fix modal issue with google map
            $('#going-from-map').on('shown.bs.collapse', function (e) {
                //alert('hi');
                google.maps.event.trigger(going_from_map, 'resize');
                //going_from_map.setCenter(new google.maps.LatLng(57.147493, -2.095392));

              if($('#going-from-map-lat').val().length)
                    going_from_map.setCenter(new google.maps.LatLng($('#going-from-map-lat').val(), $('#going-from-map-long').val()));
                else
                    going_from_map.setCenter(new google.maps.LatLng(57.147493, -2.095392));

           });

        //store map values in the form
            function going_from_map_save(){
                $('#going-from').val($('#going-from-map-address').html());
                
                $('#going-from-lat').val($('#going-from-map-lat').val());
                $('#going-from-long').val($('#going-from-map-long').val());

              $("#going-from-map").collapse('hide');
        };
        
       //hide the div when collaspe is hidden
       $('#going-from-map').on('hidden.bs.collapse', function (e) {
            $('.going-from-map').hide();
        });
       
       function going_from_map_close(){
            $("#going-from-map").collapse('hide');
        };


        function going_from_showMap(input){
      $('.going-from-map').show();
      $("#going-from-map").collapse('show')
      //alert('click');
    //  if($(input).val()=='')
       //   $('#mapModal').modal('show');
    }
</script>