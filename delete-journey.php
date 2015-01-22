<?php
include('core/init.core.php');

//header("Content-Type: application/json");

$jid = $_GET['jid'];
$journey_name = $_GET['jname'];

$query = "UPDATE journey SET status='f' WHERE id=".$jid;

db_fetch($query);

  http_response_code(200);
  echo json_encode('success');
  //echo json_encode('200');

?>