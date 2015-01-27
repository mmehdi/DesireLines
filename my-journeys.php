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
  $result=db_fetch("SELECT * FROM journey where id=".$value." AND status=TRUE");
  if(pg_num_rows($result)>0)
    $journeys[]=pg_fetch_array($result);
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


<div class="row col-xs-12 col-sm-12 col-lg-12 col-md-12">


      <div class="table-responsive">
        <table class="table table-striped footable" data-page-size="10">
          <thead>
            <tr>
              <th>No:</th>
              <th>Name</th>
              <th>Going from</th>
              <th>Going to</th>
              <th colspan="4">Options</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($size < 1) { echo "<tr > <td colspan=\"7\">No journeys in the database</td></tr>"; }
            $index = 1;
            foreach ($journeys as $key => $value) {
              echo "<tr>";
              echo "<td>".$index."</td>";
              
              echo "<td>".$value['name']."</a></td>";
                        
              echo "<td>".$value['origin_master']."</td>";

              echo "<td>".$value['destination_master']."</td>";

              echo "<td><a href=\"view-journey.php?jid=".$value['id']."\" class=\"btn btn-default btn-sm active\" role=\"button\">View journey</a></td>";

              echo "<td><a href=\"#\" onClick='deleteBtnClicked(this);' data-name=\"".$value['name']."\" data-id=\"".$value['id']."\" data-returnid=\"".$value['return']."\" class=\"btn btn-danger btn-sm active\" role=\"button\" data-toggle=\"modal\" data-target=\"#confirm-delete\" >Delete journey</a></td>";

              echo "</tr>";
              $index++;
            }
            ?>
          </tbody>
          <tfoot>
              <tr>
                <td colspan="7">
                  <div class="pagination pagination-centered hide-if-no-paging"></div>
                </td>
              </tr>
          </tfoot>
        </table>
      </div><!--End of table-responsive-->

</div> <!--<div class="row col-xs-12 col-sm-12 col-lg-10 col-md-12"-->
<script>

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
            window.location.replace(base_url+'/DesireLines/my-journeys.php');
         },
            error: function(response){
                  console.log(JSON.stringify(response));
                  alert('database not connecting!');
                  //window.location.replace("http://localhost:8888/DesireLines");
            }
        });
}
</script>
<?php include('footer.php');?>

