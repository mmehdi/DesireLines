<?php include('core/init.core.php');

 if(empty($_SESSION['status']) || $_SESSION['status']!=='verified') {
  //var_dump($_SESSION);
  header('Location: login.php');
  die();
}
  include('header.php');


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
      <h1 class="page-header">Register a journey</h1>
  </div>
  <!-- /.col-lg-12 -->
</div>


<div class="row col-xs-12 col-sm-12 col-lg-12 col-md-12">

<div class="alert alert-success" role="alert">Welcome <?php echo '<strong>'.$_SESSION['request_vars']['screen_name'].'!</strong>';?></div>

    
  <div class="panel panel-info">
    <div class="panel-heading">Journey details</div>
   
  <div class="panel-body">
    <form class="form-horizontal" method="post" role="form" id="journey-form" class="myForms" action="">
      <div class="form-group">
        <label  class="col-sm-4 control-label">Your twitter handle</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="twitter-handle" name="twitter-handle" placeholder="e.g commuting to work" readonly value="<?php echo $_SESSION['request_vars']['screen_name'];?>">
           </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">Name this journey</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="journey-name" name="journey-name" placeholder="e.g commuting to work"> 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going from</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="going-from" name="going-from" placeholder="origin - bus stop name"> 
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I'm going to</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" id="going-to" name="going-to" placeholder="destination - bus stop name">                 
        </div>
      </div>
      <div class="form-group" id='select-days'>
        <label  class="col-sm-4 control-label">Days of tavel</label>
        <div class="col-sm-8">
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="monday">Mon</label>
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="tuesday">Tue</label>
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="wednesday">Wed</label>
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="thursday">Thu</label>
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="friday">Fri</label>
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="saturday">Sat</label>
          <label class="checkbox-inline"><input type="checkbox" name="days-checkbox" id="days-checkbox" value="sunday">Sun</label>
         </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I leave at</label>
        <div class="col-sm-2">
          <input type='text' class="form-control" name="leave-time" id="leave-time" data-date-format="HH:mm" placeholder="time" value=""/>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I arrive at</label>
        <div class="col-sm-2">
          <input type='text' class="form-control" name="arrive-time" id="arrive-time" data-date-format="HH:mm" placeholder="time" value=""/>
        </div>
      </div>
      <div class="form-group">
        <label  class="col-sm-4 control-label">I want to start receiving updates</label>
         <div class="col-sm-6">
            <select class="form-control" id="out-alert-time" name="out-alert-time">
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
        <div class="col-sm-4">
          <select class="form-control" id="journey-purpose" name="journey-purpose">
            <option value = "commuting">Commuting</option>
            <option value = "leisure">Leisure</option>
            <option value = "school">School run</option>
            <option value = "business">Business Trip</option>
          </select>
        </div>
      </div>
       <div class="form-group">
        <label class="col-sm-4 control-label">How many buses do you use?</label>
        <div class="col-sm-2">
          <select class="form-control" id="out-no-of-buses" name="out-no-of-buses">
            <option value=0>Select</option>
            <option value=1>1</option>
            <option value=2>2</option>
          </select>
        </div>
      </div>

      <div id="out-bus-1"> <!--out-bus-1, out-bus-route-1, out-bus-route-1-alt-->
        <div class="form-group col-sm-8 out-bus-route-1" >
          <label class="col-sm-6 control-label">Bus route # (FirstAberdeen)</label>
          <div class="col-sm-4">
            <select class="form-control" id="out-bus-route-1" name="out-bus-route-1">
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

        <div class="form-group out-bus-route-1-alt col-sm-8"> <!--todo-->
        </div>

        <div class="form-group col-sm-12 col-lg-12">
          <label class="col-sm-4 control-label"></label>
          <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-xs btn-primary" id="add-alternate-bus" style="margin-bottom: 5px;" data-name="out-bus-route-1-alt" onClick="add_alt_button_click(this);">Add Alternative Bus</button>
          </div>
        </div>
      </div>


      <div id="out-bus-2">
        <div class="form-group">
          <label  class="col-sm-4 control-label">Where do you get off from the first bus?</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="out-bus-2-from" name="out-bus-2-from" placeholder="bus stop name"> 
          </div>
        </div>
        <div class="form-group">
          <label  class="col-sm-4 control-label">From where do you take the next bus?</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="out-bus-2-to" name="out-bus-2-to" placeholder="bus stop name">                 
          </div>
        </div>

        <div class="form-group col-sm-8">
          <label class="col-sm-6 control-label">Bus route # (FirstAberdeen)</label>
          <div class="col-sm-4">
            <select class="form-control" id="out-bus-route-2" name="out-bus-route-2">
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

        <div class="form-group out-bus-route-2-alt col-sm-8"> <!--todo-->
        </div>

        <div class="form-group col-sm-12 col-lg-12">
          <label class="col-sm-4 control-label"></label>
          <div class="col-sm-4 col-lg-4">
            <button type="button" class="btn btn-xs btn-primary" id="add-alternate-bus" style="margin-bottom: 5px;" data-name="out-bus-route-2-alt" onClick="add_alt_button_click(this);">Add Alternative Bus</button>
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

      <button type="button" class="btn btn-default col-md-offset-4">Cancel</button>
      <button type="button" class="btn btn-success" id="saveForms">Save</button>

</div> <!--<div class="row col-xs-12 col-sm-12 col-lg-10 col-md-12"-->

<?php include('footer.php');?>

<script type="text/javascript">

$('#leave-time').datetimepicker({
  pickDate: false
});

$('#arrive-time').datetimepicker({
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
      var bus_div = '<label class="col-sm-6 control-label alt-title">Alternative bus</label><div class="col-sm-4"><select class="form-control" id=""><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="15">15</option><option value="16B">16B</option><option value="17/17A/18">17/17A/18</option><option value="19">19</option><option value="20">20</option><option value="21B">21B</option><option value="23">23</option><option value="27">27</option><option value="62">62</option><option value="419">419</option><option value="X40">X40</option></select></div>'; 
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
                //$(this).parent().parent('div.dynamic-bus-form').remove(); //remove text box
                zk--; //decrement textbox
        }
        return false;
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
    
    $('#out-bus-1').hide(); 
    $('#out-bus-2').hide(); 
    $('#ret-bus-1').hide(); 
    $('#ret-bus-2').hide(); 

    $('#out-no-of-buses').change(function(){

        if($('#out-no-of-buses').val() == 1) {
            $('#out-bus-1').fadeIn('slow');
            $('#out-bus-2').fadeOut('slow');
        } else if($('#out-no-of-buses').val() == 2) {
            $('#out-bus-1').fadeIn('slow');
            $('#out-bus-2').fadeIn('slow');
        } 
    });

    $('#ret-no-of-buses').change(function(){

        if($('#ret-no-of-buses').val() == 1) {
            $('#ret-bus-1').fadeIn('slow');
            $('#ret-bus-2').fadeOut('slow');
        } else if($('#ret-no-of-buses').val() == 2) {
            $('#ret-bus-1').fadeIn('slow');
            $('#ret-bus-2').fadeIn('slow');
        } 
    });

    $("input[name$='returnJourneyRadio']").click(function() {
        var radioVal = $(this).val();
        if(radioVal==1) {
          $('#return-journey').fadeIn('slow');
          prePopulateReturnJourney();
        } else {
          $('#return-journey').fadeOut('slow');
        } 
    });

    function prePopulateReturnJourney(){
      var going_from = $('#going-from').val();
      var going_to = $('#going-to').val();
      var leave_time = $('#leave-time').val();
      var arrive_time = $('#arrive-from').val();
      var alert_time = $('#out-alert-time').val();
      var no_of_buses = $('#out-no-of-buses').val();;

      //alert(alert_time);
      $('#ret-bus-1').hide(); 
      $('#ret-bus-2').hide(); 
      $('#ret-going-from').val(going_to);
      $('#ret-going-to').val(going_from);
      $('#ret-alert-time').val(alert_time);
      $('#ret-no-of-buses').val(no_of_buses);

      set_ret_journey_buses(no_of_buses);
    }

    function set_ret_journey_buses(no_of_buses){
      if(no_of_buses==2){
        var out_bus_2_to = $('#out-bus-2-to').val();
        var out_bus_2_from = $('#out-bus-2-from').val();
        $('#ret-bus-2-to').val(out_bus_2_from);
        $('#ret-bus-2-from').val(out_bus_2_to);

        $('#ret-bus-1').show(); 
        $('#ret-bus-2').show(); 
        var bus_route_1 = $('#out-bus-route-1').val();
        var bus_route_2 = $('#out-bus-route-2').val();
        $('#ret-bus-route-2').val(bus_route_1);
        $('#ret-bus-route-1').val(bus_route_2);
        set_ret_journey_alternative_buses('.out-bus-route-1-alt',2);
        set_ret_journey_alternative_buses('.out-bus-route-2-alt',1);
      }
      else if(no_of_buses==1){
        $('#ret-bus-1').show(); 
        var bus_route_1 = $('#out-bus-route-1').val();
        $('#ret-bus-route-1').val(bus_route_1);
        set_ret_journey_alternative_buses('.out-bus-route-1-alt',1);
      }
      else
        bus_route_1='Select';
    }

    function set_ret_journey_alternative_buses(parent_div,route){
//      alert($(parent_div+' >div').length);
      count = $(parent_div+' >div').length+1;
      if(count>1)
      $(parent_div).each(function(i,obj) {
//    var count = $(parent_div+' >div').length+1;
      var alt_bus = $('select', obj).val();
//    alert($(this).(find)('option:selected').text());
//    alert(alt_bus);
      var id = alt_bus;
      var bus_div = '<label class="col-sm-6 control-label alt-title">Alternative bus</label><div class="col-sm-4"><select class="form-control" id="ret-bus-route-alt-'+id+'"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="15">15</option><option value="16B">16B</option><option value="17/17A/18">17/17A/18</option><option value="19">19</option><option value="20">20</option><option value="21B">21B</option><option value="23">23</option><option value="27">27</option><option value="62">62</option><option value="419">419</option><option value="X40">X40</option></select></div>'; 
      $('.ret-bus-route-'+route+'-alt').append('<div class="dynamic-bus-form" id="">'+bus_div+'<a href="#" id="removeclass5" name="ret-bus-route-'+route+'-alt" class="removeclass5">&times;</a></div>');
      $('#ret-bus-route-alt-'+id).val(alt_bus);
      });
    }


    $("#saveForms").click(function () {
      submitForms();
      //$(".myForms").submit(); // should show 3 alerts (one for each form submission
  });

    $(".myForms").submit(function () {
            alert('hi');
      console.log("aaaaa");
    return true;
  });

    function submitForms(){
      var datastring = $("#journey-form,#return-journey-form").serialize();
      $.ajax({
            type: "POST",
            url: "process-forms.php",
            data: datastring,
            dataType: "json",
            success: function(data) {
                //var obj = jQuery.parseJSON(data); if the dataType is not specified as json uncomment this
                // do what ever you want with the server response
            },
            error: function(){
                  alert('something went wrong!');
            }
        });
    }
</script>