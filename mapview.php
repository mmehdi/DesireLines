<!-- Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <!--h4 class="modal-title" id="mapModalLabel"></h4-->
      </div>
      <div class="modal-body">
        <p>Click on the map to select your location or use the search box.</p>
        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
        <div id="mapCanvas" class="col-lg-8 col-md-8"></div>
        <div id="infoPanel">
            <!--b>Marker status:</b-->
            <!--div id="markerStatus"><i>Click and drag the marker.</i></div-->
            <b>Current position:</b>
            <div id="info"></div>
            <b>Closest matching address:</b>
            <div id="address"></div>
            <input type="hidden" name="lat" id="lat" value=0>
            <input type="hidden" name="lat" id="long" value=0>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="mapviewSave();" id="mapModalSaveBtn" data-source="">Save changes</button>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
            #mapCanvas {
                  width: 100%;
                  min-height: 300px;
                  margin: 0;
            }
            #infoPanel {
                float: left;
                margin-left: 10px;
            }
            #infoPanel div {
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

      #pac-input {
        background-color: #fff;
        padding: 0 11px 0 13px;
        width: 400px;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        text-overflow: ellipsis;
      }

      #pac-input:focus {
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


.modal{
    z-index: 20;   
}
.modal-backdrop{
    z-index: 10;        
}

</style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
        <script type="text/javascript">
            var geocoder = new google.maps.Geocoder();
            var map;
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

            //get lat long from address
            function getLatLong(address){
                geocoder.geocode({'address':address},function(results, status){
                    if (status == google.maps.GeocoderStatus.OK) {

                        updateMarkerAddress(results[0].formatted_address);
                        //return results[0].geometry.location;
              } else {
                //alert("Geocode was not successful for the following reason: " + status)
                updateMarkerAddress('Cannot determine address at this location.')
                }
             });
            }

            function updateMarkerStatus(str) {
                //document.getElementById('markerStatus').innerHTML = str;
            }

            function updateMarkerPosition(latLng) {
                document.getElementById('info').innerHTML = [
                    latLng.lat(),
                    latLng.lng()
                ].join(', ');

                    $('#lat').val(latLng.lat());
                    $('#long').val(latLng.lng());
            }

            function updateMarkerAddress(str) {
                document.getElementById('address').innerHTML = str;
            }

            function initialize() {


                ///57.147493,-2.095392
                var latLng = new google.maps.LatLng(57.147493, -2.095392);
                map = new google.maps.Map(document.getElementById('mapCanvas'), {
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



                // Create the search box and link it to the UI element.
                  var input = /** @type {HTMLInputElement} */(
                      document.getElementById('pac-input'));
                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                  var searchBox = new google.maps.places.SearchBox((input));


                //listen to search box
                google.maps.event.addListener(searchBox, "places_changed", function(){

                    var places = searchBox.getPlaces();
                    var place = places[0];
                    //input.text(place['formatted_address']);
                    //  console.log(JSON.stringify(place));
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(15);
                    }

                    marker.setPosition(place.geometry.location);

                    //$("#pac-input").val(place['formatted_address']);
                    //searchBox.val(place['formatted_address']);
                    //document.getElementById('pac-input').innerHTML = str;
                    //input.value=place['formatted_address'];
                    //$("#keyword").val(place['formatted_address']);
                    updateMarkerAddress(place['formatted_address']);
                    //geocodePosition(marker.getPosition());
                });

                google.maps.event.addListener(map, "click", function(event){
                    // console.log(event.latLng);
                    marker.setPosition(event.latLng);
                    updateMarkerPosition(event.latLng);
                    geocodePosition(marker.getPosition());
                });

                //var bounds = map.getBounds();
                //searchBox.setBounds(bounds);
            
            }

            // Onload handler to fire off the app.
            google.maps.event.addDomListener(window, 'load', initialize);

            //fix modal issue with google map
            $('#mapModal').on('shown.bs.modal', function (e) {
                //alert('hi');
                google.maps.event.trigger(map, 'resize');
                map.setCenter(new google.maps.LatLng(57.147493, -2.095392));

                //find out which form field opened the map
                var btn = $(e.relatedTarget); // Button that triggered the modal
                var source = btn.data('source'); // Extract info from data-* attributes
                $('#mapModalSaveBtn').data('source', source);

               /* if($('#'+source).length>0)
                    getLatLong($('#'+source+'-lat').val($('#lat').val()),$('#'+source+'-lat').val($('#lat').val()));*/

           });

        
        //store map values in the form
            function mapviewSave(){
                //e.preventDefault();
                var source = '#'+$('#mapModalSaveBtn').data('source');
                
                $(source).val($('#address').html());
                
                $(source+'-lat').val($('#lat').val());
                $(source+'-long').val($('#long').val());

                 $('#mapModal').modal('hide');
        };
</script>