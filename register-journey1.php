<?php include('core/init.core.php');?>
<?php include('header.php');?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Register a journey</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>


<div class="row col-xs-12 col-sm-12 col-lg-12 col-md-12">
    
  <div class="panel panel-info">
    <div class="panel-heading">Journey details</div>
   
  <div class="panel-body">
    <form class="form-horizontal" role="form" id="journey-form">
      <div class="form-group">
        <label  class="col-sm-4 control-label">Name this journey</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="journey-name" placeholder="e.g commuting to work"> 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going from</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="going-from" placeholder="origin - bus stop name"> 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going to</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="going-to" placeholder="destination - bus stop name">                 
        </div>
      </div>
      <div class="form-group" id='select-days'>
        <label  class="col-sm-4 control-label">Days I tavel</label>
        <div class="col-sm-8">
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Mon</label>
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Tue</label>
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Wed</label>
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Thu</label>
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Fri</label>
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Sat</label>
          <label class="checkbox-inline"><input type="checkbox" name="monday-checkbox" id="monday-checkbox" value="1">Sun</label>
         </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I leave home at</label>
        <div class="col-sm-2">
          <input type='text' class="form-control" name="leave_time" id="leave_time" data-date-format="HH:mm" placeholder="time" value=""/>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I want to start receiving updates</label>
         <div class="col-sm-8">
            <select class="form-control" id="">
              <option value=0 >From start of the journey</option>
              <option value=10 >10 minutes earlier</option>
              <option value=20 >20 minutes earlier</option>
              <option value=30 >30 minutes earlier</option>                        
              <option value=40 >40 minutes earlier</option>
              <option value=50 >50 minutes earlier</option>
              <option value=60 >An hour earlier</option>            
            </select>
        </div>

      </div>
      <div class="form-group">
        <label class="col-sm-4 control-label">Purpose of journey</label>
        <div class="col-sm-2">
          <select class="form-control" id="">
            <option>Commuting</option>
            <option>Leisure</option>
            <option>School run</option>
            <option>Business Trip</option>
          </select>
        </div>
      </div>
       <div class="form-group">
        <label class="col-sm-4 control-label">How many buses do you use?</label>
        <div class="col-sm-2">
          <select class="form-control" id="">
            <option>Select</option>
            <option>1</option>
            <option>2</option>
          </select>
        </div>
      </div>

      <div id="out-bus-1" style="display:none;">
        <div class="form-group col-sm-8" id="out-bus-1" >
          <label class="col-sm-6 control-label">Bus route #</label>
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

        <div class="form-group out-bus-1-alt col-sm-8"> <!--todo-->
        </div>

        <div class="form-group col-sm-12 col-lg-12">
          <label class="col-sm-4 control-label"></label>
          <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-xs btn-primary" id="add-alternate-bus" style="margin-bottom: 5px;" data-name="out-bus-1-alt" onClick="add_alt_button_click(this);">Add Alternative Bus</button>
          </div>
        </div>
      </div>


      <div class="form-group">
        <label  class="col-sm-4 control-label">Is there a return journey?</label>
        <div class="col-sm-8">
          <label class="radio-inline">
            <input name="returnJourneyRadio" id="yes" value=1 type="radio"/> Yes
          </label>
          <label class="radio-inline">
            <input name="returnJourneyRadio" id="no" value=0 type="radio" checked/> No
          </label>
        </div>
      </div>

    </form>

    </div>      <!--div class="panel-body"-->

  </div>     <!--div class="panel panel-info"-->

<?php include('return-journey.php');?>

</div> <!--<div class="row col-xs-12 col-sm-12 col-lg-10 col-md-12"-->

<?php include('footer.php');?>

<script type="text/javascript">



$('#leave_time').datetimepicker({
  pickDate: false
});

//add alternate buses

    var fieldCount = 1; //to keep track of text box added

    function add_alt_button_click(obj){

        var form_class = $(obj).data('name'); //the button name is div id. e.g "out-bus-alt"
      //var form_class = $(this).attr('name'); //the button name is div id. e.g "out-bus-alt"

      //alert(form_class);
      var maxInputs      = 20; //maximum input boxes allowed
      var inputsWrapper  = $("form ."+form_class); //Input boxes wrapper ID
       // var addButton       = $("#add-keyword"); //Add button ID
      var count = $("form ."+form_class+" > div").length+1;
      var zk = inputsWrapper.length; //initlal text box count
      var bus_div = '<label class="col-sm-6 control-label">Alternative Bus'+count+'</label><div class="col-sm-4"><select class="form-control" id=""><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>11</option><option>12</option><option>13</option><option>15</option><option>16B</option><option>17/17A/18</option><option>19</option><option>20</option><option>21B</option><option>23</option><option>27</option><option>62</option><option>419</option><option>N1</option><option>N17</option><option>N19</option><option>N20</option><option>N21</option><option>N23</option><option>X40</option>X40</select></div>'; 
      //var alt_div_title= '<label class="col-sm-12 col-sm-offset-4">Alt Bus '+count+'</label>'
      if(zk <= maxInputs) //max input box allowed
        {
            fieldCount++; //text box added increment
            //add input box $(".form-group. > div").length
            $(inputsWrapper).append('<div class="dynamic-bus-form" id='+form_class+'-'+fieldCount+'>'+bus_div+'<a href="#" id="removeclass5" name="'+form_class+'" class="removeclass5">&times;</a></div>');
            zk++; //text box increment
        }

        return false;

    };


  $("body").on("click",".removeclass5", function(e){ 

        var form_class = $(this).attr('name'); //the button name is div id. e.g "out-bus-alt"
        //alert('trying to remove');
        var inputsWrapper  = $("form ."+form_class); //Input boxes wrapper ID

        //user click on remove text
        var zk = inputsWrapper.length; //initlal text box count
        if( zk >= 1 ) {
               // alert(form_class);
               //alert($(this).parent().parent().attr('class'));
                $(this).parent('div.dynamic-bus-form').remove(); //remove text box
                //$(this).parent().parent('div.out-bus-change').remove(); //remove text box
                zk--; //decrement textbox
        }
        return false;
    });

  
    });

/*$('#select-days').hide(); 
    $('#journey-frequency').change(function(){

        if($('#journey-frequency').val() == 'daily') {
            $('#select-days').hide(); 
        } else {
            $('#select-days').show(); 
        } 
    });
*/
  //$("#returnJourneyRadio").change();

    $("input[name$='returnJourneyRadio']").click(function() {
        var radioVal = $(this).val();
        if(radioVal==1) {
          $('#return-journey').fadeIn('slow');
        } else {
          $('#return-journey').fadeOut('slow');
        } 
    });


</script>