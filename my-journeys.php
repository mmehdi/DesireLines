<?php include('core/init.core.php');?>
<?php include('header.php');?>
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
              <th>Description</th>
              <th colspan="4">Options:</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($size == 0) { echo "<tr > <td colspan=\"7\">No products in the catalogue</td></tr>"; }
            
            for($index = 0, $k=1; $index<$size; $index++, $k++){
              echo "<tr>";
              echo "<td>".$k."</td>";
            
              
              echo "<td><a href=\"product.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\">".$data_arr->{'products'}[$index]->{'fn'}."</a></td>";
                        
              echo "<td>".$data_arr->{'products'}[$index]->{'description'}."</td>";
                        
              echo "<td><a href=\"product.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">View product</a></td>";
              echo "<td><a href=\"product-update.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\" class=\"btn btn-default btn-sm active\" role=\"button\">Update product</a></td>";
                //echo "<td><a href=\"#\" onclick=\"printImage(".$data_arr->{'products'}[$index]->{'id'}.",'".$data_arr->{'products'}[$index]->{'fn'}."');\" class=\"btn btn-primary btn-sm active\" role=\"button\">Print QR Code</a></td>";
              //echo "<td><a href=\"#add-bulk-items\" onclick='addBatchItems(".$data_arr->{'products'}[$index]->{'fn'}.", ".$data_arr->{'products'}[$index]->{'id'}.")' data-toggle=\"modal\" class=\"btn btn-primary btn-sm active\" role=\"button\">Add Items</a></td>";
              echo "<td><a href=\"#\" onClick='addBatchItems(\"".$data_arr->{'products'}[$index]->{'fn'}."\",".$data_arr->{'products'}[$index]->{'id'}.")' class=\"btn btn-primary btn-sm active\">Add Items</a></td>";
              echo "<td><a href=\"#\" data-label=\"".$data_arr->{'products'}[$index]->{'fn'}."\" data-href=\"product-delete.php?prodid=".$data_arr->{'products'}[$index]->{'id'}."\" class=\"btn btn-danger btn-sm active\" role=\"button\" data-toggle=\"modal\" data-target=\"#confirm-delete\" >Delete product</a></td>";
              echo "</tr>";
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