  <div class="panel panel-info" style="display:none;" id="return-journey">
    <div class="panel-heading">Return Journey</div>
   
  <div class="panel-body">
    <form class="form-horizontal" role="form" id="return-journey-form">
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going from</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="ret-going-from" placeholder="origin - bus stop name"> 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going to</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="ret-going-to" placeholder="destination - bus stop name">                 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I start return journey at</label>
        <div class="col-sm-2">
          <input type='text' class="form-control" name="ret-leave-time" id="ret-leave-time" data-date-format="HH:mm" placeholder="Time" value=""/>
        </div>
      </div>
      <div class="form-group col-sm-8" id="ret-out-bus">
        <label class="col-sm-6 control-label">Bus #</label>
        <div class="col-sm-4">
          <select class="form-control" id="">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>11</option>
            <option>12</option>
            <option>13</option>
            <option>15</option>
            <option>16B</option>
            <option>17/17A/18</option>
            <option>19</option>
            <option>20</option>
            <option>21B</option>
            <option>23</option>
            <option>27</option>
            <option>62</option>
            <option>419</option>
            <option>N1</option>
            <option>N17</option>
            <option>N19</option>
            <option>N20</option>
            <option>N21</option>
            <option>N23</option>
            <option>X40</option>X40  
          </select>
        </div>
      </div>

      <div class="form-group ret-out-bus-alt col-sm-8"> <!--todo-->
      </div>

      <div class="form-group col-sm-12 col-lg-12">
        <label class="col-sm-4 control-label"></label>
        <div class="col-sm-4 col-lg-4">
          <button type="button" class="btn btn-xs btn-primary" id="add-alternate-bus" style="margin-bottom: 5px;" data-name="ret-out-bus-alt" onClick="add_alt_button_click(this);">Add Alternative Bus</button>
        </div>
      </div>




      <div class="form-group">
        <label class="col-sm-4 control-label">Do you change buses?</label>
        <div class="col-sm-8">
          <label class="radio-inline">
            <input name="retChangeBusRadio" id="yes" value=1 type="radio"/> Yes
          </label>
          <label class="radio-inline">
            <input name="retChangeBusRadio" id="no" value=0 type="radio" checked > No
          </label>
        </div>
      </div>

      <div class="form-group out-bus-change" id="ret-out-bus-change" style="display: none;">
      </div>

      <div class="form-group col-sm-12" style="">
        <label class="col-sm-4 control-label"></label>
        <div class="col-sm-4 col-lg-4">
          <button type="button" class="btn btn-xs btn-primary" id="add-bus-change" style="display: none;" name="ret-out-bus-change">Add Bus Leg</button>
        </div>
      </div>

    </form>

    </div>      <!--div class="panel-body"-->

  </div>     <!--div class="panel panel-info"-->