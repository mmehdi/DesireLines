<?php include('core/init.core.php');?>
<?php include('header.php');

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

              echo "<td><a href=\"journey-details.php?jid=".$value['id']."\" class=\"btn btn-default btn-sm active\" role=\"button\">View journey</a></td>";

              echo "<td><a href=\"#\" data-label=\"".$data_arr->{'products'}[$index]->{'fn'}."\" data-href=\"journey-delete.php?jid=".$value['id']."\" class=\"btn btn-danger btn-sm active\" role=\"button\" data-toggle=\"modal\" data-target=\"#confirm-delete\" >Delete journey</a></td>";

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
<?php include('footer.php');?>