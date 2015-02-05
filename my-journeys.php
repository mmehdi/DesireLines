<?php include('core/init.core.php');

 if(empty($_SESSION['status']) || $_SESSION['status']!=='verified') {
  //var_dump($_SESSION);
  header('Location: login.php');
  die();
}

include('header.php');

$result = db_fetch("SELECT array_to_json(journeys) FROM participant where twitter_handle='".$_SESSION['request_vars']['screen_name']."'");
$row=pg_fetch_array($result);

$journey_ids = json_decode($row[0]);
$journeys = array();

foreach ($journey_ids as $key => $value) {
  $journey_result=db_fetch("SELECT * FROM journey where id=".$value." AND status=TRUE");
  if(pg_num_rows($journey_result)>0){

    $result = db_fetch('SELECT array_to_json(days_travelling) FROM journey WHERE id='.$value);
    $days_row = pg_fetch_array($result);
    $days = json_decode($days_row[0]);

    $row = pg_fetch_array($journey_result);
    $row['days_travelling']=$days;
    $journeys[]= $row;

  }
}
  $size = count($journeys);
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">My journeys</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>

<div class="row">

           <?php foreach ($journeys as $key => $journey)
           {
              //get stage ids
                $result = db_fetch('SELECT array_to_json(stages) FROM journey WHERE id='.$journey['id']);
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

                switch (count($stages)) {
                  case 1:
                    include('journey-cards/single-journey-card.php');
                    break;
                  case 2:
                    include('journey-cards/multi-journey-card.php');
                    break;
                  default:
                    # code...
                    break;
                }
           }
           ?>

</div>



<?php include('footer.php');?>
<script type="text/javascript">
function deleteBtnClicked(event){
    var jid = $(event).data('id');
    var journey_name = $(event).data('name');
    var return_id = $(event).data('returnid');

    var message_with_return_journey='';
    if(return_id>0)
      message_with_return_journey='<div class="row"><div class="col-md-12"> <form class="form-horizontal">  This journey also has a return journey!  <div class="form-group">  <div class="col-md-12"> <div class="checkbox"> <label for="deleteReturn"> <input type="checkbox" name="deleteReturn" id="deleteReturn" value=1>Delete return journey.</label> </div> </div> </div></form> </div>  </div>';


bootbox.dialog({
  message: 'Are you sure want to delete the journey :<strong>'+ journey_name+'</strong><br/><br/>'+message_with_return_journey,
  title: "Confirmation",
  buttons: {
    cancel: {
      label: "Cancel",
      className: "btn-primary",
      callback: function() {
        //do nothing
      }
    },
    danger: {
      label: "Delete!",
      className: "btn-danger",
      callback: function() {
        if($("input[name$='deleteReturn']:checked").val()==1)
            deleteJourney(jid,journey_name,return_id);
        else
          deleteJourney(jid,journey_name,0); //if id is 0. dont delete return journey
//         console.log("Hi "+ $('#deleteReturn').val());
   
      }
    }
  }
});
}

function deleteJourney(journey_id, journey_name, return_journey_id){
        var base_url = <?php echo json_encode(BASE_URL); ?>;
      $.ajax({
            type: "GET",
            url: "delete-journey.php",
            data: "jid="+journey_id+"&jname="+journey_name+"&return_id="+return_journey_id,
            dataType: "json",
            success: function(response) {
            alert('successfully deleted!');
            window.location.replace(base_url+'/my-journeys.php');
         },
            error: function(response){
                  console.log(JSON.stringify(response));
                  alert('database not connecting!');
                  //window.location.replace("http://localhost:8888/DesireLines");
            }
        });
}
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});
</script>