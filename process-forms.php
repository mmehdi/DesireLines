<?php
include('core/init.core.php');

$result = db_fetch ('select count(*) from participant');
$count = pg_num_fields($result);

var_dump('db count: '.$count);


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  //var_dump($_POST);
  $twitter_handle=$_POST['twitter-handle'];
  $journey_name=$_POST['journey-name'];
  $going_from=$_POST['going-from'];
  $going_to=$_POST['going-to'];
  $leave_at=$_POST['leave-time'];
  $arrive_at=$_POST['arrive-time'];
  $arrive_at=$_POST['arrive-time'];
  $out_alert_time=$_POST['out-alert-time'];
  $journey_purpose=$_POST['journey-purpose'];
  $out_no_of_buses=$_POST['out-no-of-buses'];
  switch($out_no_of_buses){
    case'1':
    break;
    default:
    break;
  }
  $out_bus_route_1=$_POST['out-bus-route-1'];
  
  $is_return_journey = $_POST['returnJourneyRadio'];
  if($returnJourneyRadio=='1'){
    $ret_going_from=$_POST['ret-going-from'];
    $ret_going_to=$_POST['ret-going-to'];
    $ret_leave_at=$_POST['ret-leave-time'];
    $ret_arrive_at=$_POST['ret-arrive-time'];
    $ret_alert_time=$_POST['ret-alert-time'];
    $ret_no_of_buses=$_POST['ret-no-of-buses'];
  }
}

function to_pg_array($set) {
    settype($set, 'array'); // can be called with a scalar or array
    $result = array();
    foreach ($set as $t) {
        if (is_array($t)) {
            $result[] = to_pg_array($t);
        } else {
            $t = str_replace('"', '\\"', $t); // escape double quote
            if (! is_numeric($t)) // quote only non-numeric values
                $t = '"' . $t . '"';
            $result[] = $t;
        }
    }
    return '{' . implode(",", $result) . '}'; // format
}
?>