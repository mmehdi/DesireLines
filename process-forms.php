<?php
include('core/init.core.php');
//header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  //var_dump($_POST);
  $twitter_handle=$_POST['twitter-handle'];
  $journey_purpose=$_POST['journey-purpose'];
  $days_travelling = $_POST['days-checkbox'];
  $days_travelling=to_pg_array($days_travelling,'string');
  $journey_name=pg_escape_string($_POST['journey-name']);

  //store user if doenst exist - todo move this to login
  save_user($twitter_handle);


  $master_going_from=pg_escape_string($_POST['going-from']);
  $master_going_to=pg_escape_string($_POST['going-to']);
  $leave_at=strtotime($_POST['leave-time']);
  $arrive_at=strtotime($_POST['arrive-time']);
  $alert_time=$_POST['out-alert-time'];
  
  $master_going_from_lat=($_POST['going-from-lat']);
  $master_going_from_long=($_POST['going-from-long']);
  $master_going_to_lat=($_POST['going-to-lat']);
  $master_going_to_long=($_POST['going-to-long']);


  $out_no_of_buses=$_POST['out-no-of-buses'];


  //iterate alternative buses
  $out_bus_route_1=$_POST['out-bus-route-1'];
  $out_bus_route_1_buses = array();
  $out_bus_route_1_buses[]=$out_bus_route_1;

  //store in 1 array
  foreach ($_POST['out-bus-route-1-alt'] as $key => $value)
    $out_bus_route_1_buses[]=$value;

  $out_bus_route_1_buses=to_pg_array($out_bus_route_1_buses,'string');

  //multi stage journey
  $journey_stage_ids=array();

  if($out_no_of_buses=='2'){
    $out_bus_route_2=$_POST['out-bus-route-2'];
    $out_bus_route_2_buses[]=$out_bus_route_2;
    
    $stage_going_from=pg_escape_string($_POST['out-bus-2-from']);
    $stage_going_to=pg_escape_string($_POST['out-bus-2-to']);

    $stage_going_from_lat=($_POST['out-bus-2-from-lat']);
    $stage_going_from_long=($_POST['out-bus-2-from-long']);
    $stage_going_to_lat=($_POST['out-bus-2-to-lat']);
    $stage_going_to_long=($_POST['out-bus-2-to-long']);

    foreach ($_POST['out-bus-route-2-alt'] as $key => $value)
      $out_bus_route_2_buses[]=$value;

    $out_bus_route_2_buses=to_pg_array($out_bus_route_2_buses,'string');
    //split master into stages

    save_journey_stage($master_going_from,$stage_going_from,$out_bus_route_1_buses,$master_going_from_lat,$master_going_from_long,$stage_going_from_lat,$stage_going_from_long);
    $journey_stage_ids[]=return_id('journey_stage');

    save_journey_stage($stage_going_to,$master_going_to,$out_bus_route_2_buses,$stage_going_to_lat,$stage_going_to_long,$master_going_to_lat,$master_going_to_long);
    $journey_stage_ids[]=return_id('journey_stage');
  }
  //single bus journey
  else{
    save_journey_stage($master_going_from,$master_going_to,$out_bus_route_1_buses,$master_going_from_lat,$master_going_from_long,$master_going_to_lat,$master_going_to_long);
    $journey_stage_ids[]=return_id('journey_stage');
  }
  
  $stages = to_pg_array($journey_stage_ids,'integer');

  //store journey and update participant table
  save_journey('t',$journey_name,$master_going_from,$master_going_to,$leave_at,$arrive_at,$days_travelling,$alert_time,date('Y-m-d H:i'),$stages,$journey_purpose,'');
  $journey_id = return_id('journey');
  update_participant($twitter_handle,$journey_id);

  $is_return_journey = $_POST['returnJourneyRadio'];
  
  if($is_return_journey==1)
    save_return_journey();


  http_response_code(200);
  echo json_encode('success');

//  die();
  //echo json_encode('200');
}

function save_return_journey(){
  
  $twitter_handle=$_POST['twitter-handle'];
  $journey_name = pg_escape_string($_POST['journey-name'].' return');
  $journey_purpose=$_POST['journey-purpose'];
  $days_travelling = $_POST['days-checkbox'];
  $days_travelling=to_pg_array($days_travelling,'string');
  $master_going_from=pg_escape_string($_POST['ret-going-from']);
  $master_going_to=pg_escape_string($_POST['ret-going-to']);
  $leave_at=strtotime($_POST['ret-leave-time']);
  $arrive_at=strtotime($_POST['ret-arrive-time']);
  $alert_time=$_POST['ret-alert-time'];
  $no_of_buses=$_POST['ret-no-of-buses'];

  $master_going_from_lat=($_POST['ret-going-from-lat']);
  $master_going_from_long=($_POST['ret-going-from-long']);
  $master_going_to_lat=($_POST['ret-going-to-lat']);
  $master_going_to_long=($_POST['ret-going-to-long']);

  //iterate alternative buses
  $bus_route_1=$_POST['ret-bus-route-1'];
  $bus_route_1_buses = array();
  $bus_route_1_buses[]=$bus_route_1;

  //store in 1 array
  foreach ($_POST['ret-bus-route-1-alt'] as $key => $value)
    $bus_route_1_buses[]=$value;

  $bus_route_1_buses=to_pg_array($bus_route_1_buses,'string');

  //multi stage journey
  $journey_stage_ids=array();

  if($no_of_buses=='2'){
    $bus_route_2=$_POST['ret-bus-route-2'];
    $bus_route_2_buses[]=$bus_route_2;
    
    $stage_going_from=pg_escape_string($_POST['ret-bus-2-from']);
    $stage_going_to=pg_escape_string($_POST['ret-bus-2-to']);

    $stage_going_from_lat=($_POST['ret-bus-2-from-lat']);
    $stage_going_from_long=($_POST['ret-bus-2-from-long']);
    $stage_going_to_lat=($_POST['ret-bus-2-to-lat']);
    $stage_going_to_long=($_POST['ret-bus-2-to-long']);

    foreach ($_POST['ret-bus-route-2-alt'] as $key => $value)
      $bus_route_2_buses[]=$value;

    $bus_route_2_buses=to_pg_array($bus_route_2_buses,'string');
    //split master into stages

    save_journey_stage($master_going_from,$stage_going_from,$bus_route_1_buses,$master_going_from_lat,$master_going_from_long,$stage_going_from_lat,$stage_going_from_long);

//    save_journey_stage($master_going_from,$stage_going_from,$bus_route_1_buses,0,0,0,0);
    $journey_stage_ids[]=return_id('journey_stage');

    save_journey_stage($stage_going_to,$master_going_to,$bus_route_2_buses,$stage_going_to_lat,$stage_going_to_long,$master_going_to_lat,$master_going_to_long);
    $journey_stage_ids[]=return_id('journey_stage');
  }
  //single bus journey
  else{
    save_journey_stage($master_going_from,$master_going_to,$bus_route_1_buses,$master_going_from_lat,$master_going_from_long,$master_going_to_lat,$master_going_to_long);
    $journey_stage_ids[]=return_id('journey_stage');
  }
  
  $stages = to_pg_array($journey_stage_ids,'integer');

  //store journey and update participant table
  save_journey('t',$journey_name,$master_going_from,$master_going_to,$leave_at,$arrive_at,$days_travelling,$alert_time,date('Y-m-d H:i'),$stages,$journey_purpose,'');
  $journey_id = return_id('journey');
  update_participant($twitter_handle,$journey_id);
}

//store data in journey table
function save_journey($status,$name,$from,$to,$time_of_departure,$time_of_arrival,$days_travelling,$alert_time,$created_at,$stages,$purpose,$direction){
    $query = "INSERT INTO journey (status, name, origin_master, destination_master, time_of_departure, time_of_arrival, days_travelling, alert_time, created_at, stages, type, direction) VALUES
    ('".$status."','".$name."','".$from."','".$to."',".$time_of_departure.",".$time_of_arrival.",'".$days_travelling."', ".$alert_time.",'".$created_at."','".$stages."','".$purpose."','".$direction."')";

    //var_dump('saving journey');
    db_fetch($query);
}

//store data in journey_stage table
function save_journey_stage($from,$to,$buses,$origin_lat,$origin_long,$dest_lat,$dest_long){
    $query = "INSERT INTO journey_stage (origin_bus_stop, dest_bus_stop, bus_routes, origin_lat, origin_long, dest_lat,dest_long) VALUES
    ('".$from."', '".$to."', '".$buses."', ".$origin_lat.",".$origin_long.",".$dest_lat.",".$dest_long.")";

    db_fetch($query);
}

//returns the recent inserted id
function return_id($tablename){
    $query = 'select id from '.$tablename.' ORDER BY id DESC LIMIT 1';
    $result = db_fetch($query);
    $row=pg_fetch_array($result);
    return $row['id'];
}


function save_user($twitter_handle){
  $result = db_fetch("select count(*) from participant where twitter_handle='".$twitter_handle."'");
  $row=pg_fetch_array($result);
  $count=$row['count'];

  if($count==0)
    db_fetch("INSERT INTO participant (twitter_handle) VALUES ('".$twitter_handle."')");
}

function update_participant($twitter_handle,$journey_id){
  $result = db_fetch("SELECT array_to_json(journeys) FROM participant where twitter_handle='".$twitter_handle."'");
  $row=pg_fetch_array($result);
  
  $journeys = json_decode($row[0]);
  if(count($journeys)>0)
    $journeys[]=$journey_id;
  else
    $journeys=array($journey_id); 

  $journeys = to_pg_array($journeys,'integer');
  $result = db_fetch("UPDATE participant SET journeys='".$journeys."' where twitter_handle='".$twitter_handle."'");
}

function to_pg_array($set,$type) {
    settype($set, 'array'); // can be called with a scalar or array
    $result = array();
    foreach ($set as $t) {
        if (is_array($t)) {
            $result[] = to_pg_array($t);
        } else {
            $t = str_replace('"', '\\"', $t); // escape double quote
            if ($type=='string') // quote only non-numeric values
                $t = '"' . $t . '"';
            $result[] = $t;
        }
    }
    return '{' . implode(',', $result) . '}'; // format
}
?>