 <style>
      html, body, #map-canvas {
        height: 300px;
        margin: 0px;
        padding: 0px
      }
    </style>
<?php include('core/init.core.php');

 if(empty($_SESSION['status']) || $_SESSION['status']!=='verified') {
  //var_dump($_SESSION);
  header('Location: login.php');
  die();
}
  include('header.php');


$jid = $_GET['jid'];

$result = db_fetch('SELECT * FROM journey WHERE id='.$jid);
$journey = pg_fetch_array($result);

//get travelling days
$result = db_fetch('SELECT array_to_json(days_travelling) FROM journey WHERE id='.$jid);
$row = pg_fetch_array($result);
$days = json_decode($row[0]);


//get stage ids
$result = db_fetch('SELECT array_to_json(stages) FROM journey WHERE id='.$jid);
$row = pg_fetch_array($result);
$stages_ids = json_decode($row[0]);

$stages = array();

//get each stage data
foreach ($stages_ids as $sid) {
  $result = db_fetch('SELECT * FROM journey_stage WHERE id='.$sid);
  $row = pg_fetch_array($result);

  $result = db_fetch('SELECT array_to_json(bus_routes) FROM journey_stage WHERE id='.$sid);
  $r_row = pg_fetch_array($result);
  $bus_routes = json_decode($r_row[0]);
  
  $row['bus_routes']=$bus_routes;
  $stages[]=$row;

  # code...
}

/*if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  var_dump($_POST);
  die();
   /*foreach ($_POST['name'] as $key => $value) {
        $_POST['name'][$key]; // make something with it
        $_POST['example'][$key];  // it will get the same index $key
        */
?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
  </div>
  <!-- /.col-lg-12 -->
  </div>


<div class="row col-xs-12 col-sm-12 col-lg-12 col-md-12">
<br/>
<form class="form-horizontal" role="form" id="journey-form" class="myForms" action="">
    
  <div class="panel panel-info">
    <div class="panel-heading">View journey</div>
  
  <div class="panel-body">
      <div class="form-group">
        <label  class="col-sm-4 control-label">Name</label>
        <div class="col-sm-6">
            <p class="form-control"><?php echo $journey['name'];?></p>
          </div>      
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">Going from</label>
        <div class="col-sm-8">
            <p class="form-control"><?php echo $journey['origin_master'];?></p>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">Going to</label>
        <div class="col-sm-8">
            <p class="form-control"><?php echo $journey['destination_master'];?></p>
        </div>
      </div>
      <div class="form-group" id='select-days'>
        <label  class="col-sm-4 control-label">Days of tavel</label>
        <div class="col-sm-6">
          <p class="form-control"><?php echo implode(', ', $days);?></p>
         </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">Leave time</label> 
        <div class="col-sm-2">
          <p class="form-control"><?php echo date('H:m',$journey['time_of_departure']);?></p>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">Arrive time</label>
        <div class="col-sm-2">
          <p class="form-control"><?php echo date('H:m',$journey['time_of_arrival']);?></p>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">Start receiving updates</label>
         <div class="col-sm-6">
            <p class="form-control"><?php echo $journey['alert_time'].' minutes before travelling.';?></p>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">Journey purpose</label>
        <div class="col-sm-4">
          <p class="form-control"><?php echo $journey['type'];?></p>        
        </div>
      </div>

      <?php
      $count = count($stages);
      if($count==1){
        echo '<div class="form-group">';
        echo '<label class="col-sm-4 control-label">Bus routes</label>';
        echo '<div class="col-sm-4">';
          echo '<p class="form-control">';
          $bus_routes = $stages[0]['bus_routes']; 
          echo implode(' or ', $bus_routes);
          echo '</p>';        
        echo'</div>';
      echo'</div>';
      }
      elseif($count==2){
      echo '<div class="form-group">';
        echo '<label class="col-sm-4 control-label">Bus routes for leg 1</label>';
        echo '<div class="col-sm-4">';
          echo '<p class="form-control">';
          $bus_routes = $stages[0]['bus_routes']; 
          echo implode(' or ', $bus_routes);
          echo '</p>';
        echo '</div>';
      echo '</div>';

      echo '<div class="form-group">';
        echo '<label class="col-sm-4 control-label">Get off from the first bus at</label>';
        echo '<div class="col-sm-8">';
          echo '<p class="form-control">'.$stages[0]['dest_bus_stop'].'</p>';
        echo '</div>';
      echo '</div>';

      echo '<div class="form-group">';
        echo '<label class="col-sm-4 control-label">Take the second bus from</label>';
        echo '<div class="col-sm-8">';
          echo '<p class="form-control">'.$stages[1]['origin_bus_stop'].'</p>';
        echo '</div>';
      echo '</div>';

      echo '<div class="form-group">';
        echo '<label class="col-sm-4 control-label">Bus routes for leg 2</label>';
        echo '<div class="col-sm-4">';
          echo '<p class="form-control">';
          $bus_routes = $stages[1]['bus_routes']; 
          echo implode(' or ', $bus_routes);
          echo '</p>';        
        echo '</div>';
      echo '</div>';
      }?>

            <div class="form-group">
        <label class="col-sm-4 control-label">Journey map</label>
        <div class="col-sm-8">
              <div id="map-canvas"></div>      
        </div>
      </div>

    <!--/form-->
    </div>      <!--div class="panel-body"-->

  </div>     <!--div class="panel panel-info"-->

<?php include('return-journey.php');?>

</form>
</div> <!--<div class="row col-xs-12 col-sm-12 col-lg-10 col-md-12"-->

<?php include('footer.php');?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
<script type="text/javascript">
    
$('#leave-time').datetimepicker({
  pickDate: false
});

$('#arrive-time').datetimepicker({
  pickDate: false
});

$('#ret-leave-time').datetimepicker({
  pickDate: false
});

$('#ret-arrive-time').datetimepicker({
  pickDate: false
});
// This example creates a 2-pixel-wide red polyline showing
// the path of William Kingsford Smith's first trans-Pacific flight between
// Oakland, CA, and Brisbane, Australia.

function initialize() {

  var count = <?php echo json_encode(count($stages)); ?>;
  var lat = <?php echo json_encode($stages[0]['origin_lat']); ?>;
  var longitude = <?php echo json_encode($stages[0]['dest_long']); ?>;
  
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(lat, longitude),
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

//mixing php with javascript
  <?php $index = 0; ?>

  var busRouteCoordinates=[];
  //while (i<count){
    <?php 

    while($index<count($stages)) {?>
   
    var origin_latitude = <?php echo json_encode($stages[$index]['origin_lat']); ?>;
    var origin_longitude = <?php echo json_encode($stages[$index]['origin_long']); ?>;
    var dest_lat = <?php echo json_encode($stages[$index]['dest_lat']); ?>;
    var dest_long = <?php echo json_encode($stages[$index]['dest_long']); ?>;

//console.log( <?php echo json_encode($stages[0]['dest_long']); ?>);
//console.log(i);

    busRouteCoordinates.push(new google.maps.LatLng(origin_latitude, origin_longitude), new google.maps.LatLng(dest_lat,dest_long));

  <?php $index++;}?>

//    console.log('cooordinates'+JSON.stringify(busRouteCoordinates));

  var busPath = new google.maps.Polyline({
    path: busRouteCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  busPath.setMap(map);

}

google.maps.event.addDomListener(window, 'load', initialize);
</script>