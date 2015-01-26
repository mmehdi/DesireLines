  <div class="panel panel-info" style="display:none;" id="return-journey">
    <div class="panel-heading">Return Journey</div>
   
  <div class="panel-body">
    <!--form class="form-horizontal" method="post" role="form" id="return-journey-form" class="myForms" action=""-->
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going from</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="ret-going-from" name="ret-going-from" placeholder="origin" required/> 
          <input type="hidden" name="ret-going-from-lat" id="ret-going-from-lat" value=0>
          <input type="hidden" name="ret-going-from-long" id="ret-going-from-long" value=0>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#mapModal" data-source="ret-going-from">Map</button> 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going to</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="ret-going-to" name="ret-going-to" placeholder="destination" required/> 
          <input type="hidden" name="ret-going-to-lat" id="ret-going-to-lat" value=0>
          <input type="hidden" name="ret-going-to-long" id="ret-going-to-long" value=0>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#mapModal" data-source="ret-going-to">Map</button>                 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I start return journey at</label>
        <div class="col-sm-2">
          <input type='text' class="form-control" name="ret-leave-time" id="ret-leave-time" data-date-format="HH:mm" placeholder="time" value="" required/>
        </div>
      </div>
        <div class="form-group">
        <label  class="col-sm-4 control-label">I arrive at</label>
        <div class="col-sm-2">
          <input type='text' class="form-control" name="ret-arrive-time" id="ret-arrive-time" data-date-format="HH:mm" placeholder="time" value="" required/>
        </div>
      </div>
     
      <div class="form-group">
        <label  class="col-sm-4 control-label">I want to start receiving updates</label>
         <div class="col-sm-6">
            <select class="form-control" id="ret-alert-time" name="ret-alert-time">
              <option value="0" >From start of the journey</option>
              <option value="10" >10 minutes earlier</option>
              <option value="20" >20 minutes earlier</option>
              <option value="30" >30 minutes earlier</option>                        
              <option value="40" >40 minutes earlier</option>
              <option value="50" >50 minutes earlier</option>
              <option value="60" >An hour earlier</option>            
            </select>
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-4 control-label">How many buses do you use?</label>
        <div class="col-sm-2">
          <select class="form-control" id="ret-no-of-buses" name="ret-no-of-buses" required>
            <option value='0'>Select</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
          </select>
        </div>
      </div>

     <div id="ret-bus-1"> <!--out-bus-1, out-bus-route-1, out-bus-route-1-alt-->
        <div class="form-group col-sm-8 ret-bus-route-1">
          <label class="col-sm-6 control-label">Bus route # (FirstAberdeen)</label>
          <div class="col-sm-4">
            <select class="form-control" id="ret-bus-route-1" name="ret-bus-route-1">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="15">15</option>
              <option value="16B">16B</option>
              <option value="17/17A/18">17/17A/18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21B">21B</option>
              <option value="23">23</option>
              <option value="27">27</option>
              <option value="62">62</option>
              <option value="419">419</option>
              <option value="X40">X40</option>  
            </select>
          </div>
        </div>

        <div class="form-group ret-bus-route-1-alt col-sm-8"> <!--todo-->
        </div>

        <div class="form-group col-sm-12 col-lg-12">
          <label class="col-sm-4 control-label"></label>
          <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-xs btn-primary" id="add-alternate-bus" style="margin-bottom: 5px;" data-name="ret-bus-route-1-alt" onClick="add_alt_button_click(this);">Add Alternative Bus</button>
          </div>
        </div>
      </div>


      <div id="ret-bus-2">
        <div class="form-group">
          <label  class="col-sm-4 control-label">Where do you get off from the first bus?</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="ret-bus-2-from" name="ret-bus-2-from" placeholder="origin" required/> 
          <input type="hidden" name="ret-bus-2-from-lat" id="ret-bus-2-from-lat" value=0>  
          <input type="hidden" name="ret-bus-2-from-long" id="ret-bus-2-from-long" value=0>                            
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#mapModal" data-source="ret-bus-2-from">Map</button>
          </div>
        </div>
        <div class="form-group">
          <label  class="col-sm-4 control-label">From where do you take the next bus?</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="ret-bus-2-to" name="ret-bus-2-to" placeholder="destination" required/>
          <input type="hidden" name="ret-bus-2-to-lat" id="ret-bus-2-to-lat" value=0>  
          <input type="hidden" name="ret-bus-2-to-long" id="ret-bus-2-to-long" value=0>                            
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#mapModal" data-source="ret-bus-2-to">Map</button>               
          </div>
        </div>

        <div class="form-group col-sm-8 ret-bus-route-2">
          <label class="col-sm-6 control-label">Bus route # (FirstAberdeen)</label>
          <div class="col-sm-4">
            <select class="form-control" id="ret-bus-route-2" name="ret-bus-route-2">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="15">15</option>
              <option value="16B">16B</option>
              <option value="17/17A/18">17/17A/18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21B">21B</option>
              <option value="23">23</option>
              <option value="27">27</option>
              <option value="62">62</option>
              <option value="419">419</option>
              <option value="X40">X40</option>  
            </select>
          </div>
        </div>

        <div class="form-group ret-bus-route-2-alt col-sm-8"> <!--todo-->
        </div>

        <div class="form-group col-sm-12 col-lg-12">
          <label class="col-sm-4 control-label"></label>
          <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-xs btn-primary" id="add-alternate-bus" style="margin-bottom: 5px;" data-name="ret-bus-route-2-alt" onClick="add_alt_button_click(this);">Add Alternative Bus</button>
          </div>
        </div>
      </div>

    <!--/form-->

    </div>      <!--div class="panel-body"-->

  </div>     <!--div class="panel panel-info"-->