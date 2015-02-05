<div class="col-lg-6 col-md-8 col-sm-10">
    <div class="panel panel-info">
      <div class="panel-heading">
          <div class="btn-group pull-right"><a href="#" class="btn btn-danger btn-xs" onClick="deleteBtnClicked(this);" data-name="<?php echo $journey['name'];?>" data-id="<?php echo $journey['id'];?>" >Delete</a></div>
            <h3 class="panel-title"><?php echo $journey['name'];?> (<?php echo $journey['type'];?>)</h3>
        </div>

        <div class="panel-body">
          <div class="row" style="margin:0px; padding:0px;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="border-right:1px solid grey;">
              <label>Depart</label> 
              <div id="bdesc-txt"><p><?php echo $journey['origin_master'];?></p></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <label>Arrive</label> 
              <div id="bdesc-txt"><p><?php echo $journey['destination_master'];?></p></div>
            </div>
          </div>

          <div class="row" style="margin:0px; padding:2px;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div id="bdesc-txt"><p><strong>Leave at: </strong><?php echo sprintf('%02d', $journey['time_of_departure']/100).":".sprintf('%02d', $journey['time_of_departure']%100);?></p></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <div id="bdesc-txt"><p><strong>Arrive by: </strong><?php echo sprintf('%02d', $journey['time_of_arrival']/100).":".sprintf('%02d', $journey['time_of_arrival']%100);?></p></div>
            </div>
          </div>
        
          <a data-toggle="collapse" href="#collapse<?php echo $journey['id'];?>">More details</a>
            <div id="collapse<?php echo $journey['id'];?>" class="collapse">
              <div class="panel-body" style="border-bottom:1px solid grey;">
              <div id="bdesc-txt"><strong>Stage 1</strong></div>
              <div class="row" style="border-top:1px solid grey;">
                <br/>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <div class="panel-heading"><p class="text-center" style="margin:0px;"><strong>Bus route(s)</strong></p></div>
                  <?php $bus_routes = $stages[0]['bus_routes'];?>
                  <div class="panel-body"><p class="text-center" style="font-size: 21px;font-weight: bold;"><?php echo implode(' or ', $bus_routes);?></p></div>
                </div>
              </div>
                
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"></div>

            </div><!--row-->

          <div class="row" style="margin:0px; padding:0px; border-bottom:0px solid grey;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="border-right:1px solid grey;">
              <label>Depart</label> 
              <div id="bdesc-txt"><p><?php echo $stages[0]['origin_bus_stop'];?></p></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <label>Arrive</label> 
              <div id="bdesc-txt"><p><?php echo $stages[0]['dest_bus_stop'];?></p></div>
            </div>
          </div>

          <div id="bdesc-txt"><br/><p><strong>Stage 2</strong></p></div>

          <div class="row" style="border-top:1px solid grey;">
                <br/>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                  <div class="panel panel-default">
                  <!-- Default panel contents -->
                  <div class="panel-heading"><p class="text-center" style="margin:0px;"><strong>Bus route(s)</strong></p></div>
                <?php $bus_routes = $stages[1]['bus_routes'];?>
                  <div class="panel-body"><p class="text-center" style="font-size: 21px;font-weight: bold;"><?php echo implode(' or ', $bus_routes);?></p></div>
              </div>
              </div>
            </div><!--row-->

          <div class="row" style="margin:0px; padding:0px;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="border-right:1px solid grey;">
              <label>Depart</label> 
              <div id="bdesc-txt"><p><?php echo $stages[1]['origin_bus_stop'];?></p></div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
              <label>Arrive</label> 
              <div id="bdesc-txt"><p><?php echo $stages[1]['dest_bus_stop'];?></p></div>
            </div>
          </div>

          </div> <!--panel body-->
          <?php $days=array(); 
            foreach($journey['days_travelling'] as $day)
              $days[] = strtoupper(substr($day, 0,3));
            ?>
                  <div id="bdesc-txt"><br/><p><p><strong>Days: </strong><?php echo implode (', ',$days);?></p><strong>Send alerts: </strong><?php echo $journey['alert_time']?> minutes before journey.</p></div>
        </div><!--collapse-->
    </div> <!--panel body-->
  </div>
  </div>