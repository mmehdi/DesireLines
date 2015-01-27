<?php
include('core/init.core.php');

//header("Content-Type: application/json");

$jid = $_GET['jid'];
$journey_name = $_GET['jname'];
$return_journey_id = $_GET['return_id'];

$query = "UPDATE journey SET status='f' WHERE id=".$jid."OR id=".$return_journey_id;
db_fetch($query);

  http_response_code(200);
  echo json_encode('success');
  //echo json_encode('200');

?>