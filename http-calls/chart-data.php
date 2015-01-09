<?php include('../core/init.core.php');?>
<?php
header("Content-Type: application/json");
$from = $_GET['from'];
$to = $_GET['to'];

$tweets_query = $_SESSION['tweets_query'];
$time_field = 'time_stamp';

/*if($from || $to){

}
else{
	$from = '2014-02-01 19:56:43';
	$to = '2014-07-01 19:56:43';
}*/

$ret_array = array("query"=>$tweets_query);
$ret_array = json_encode($ret_array);

//$select = "SELECT text,time_stamp,author,original_tweet_id from tweet WHERE time_stamp>= '2014-02-01 13:56:43' ORDER BY time_stamp LIMIT 10000";
$select = "SELECT ".$time_field.",author from tweet WHERE ".$time_field.">="."'".$from."'"." AND ".$time_field."<="."'".$to."'"." ORDER BY ".$time_field." LIMIT 10000";
	//$db_results = db_fetch($tweets_query);
//echo $select;
//die();
$db_results = db_fetch($select);
$db_array = array();

$timestamps=array();

//60=1minute
//60*60=1hour (3600)
//60*60*24=1day (86400)
//60*60*24*10=10days (864000)

for($ri = 0; $ri < pg_num_rows($db_results); $ri++) {

    $row = pg_fetch_array($db_results, $ri);

    $db_array[$ri]=array('author'=>$row['author']);
    $db_array[$ri]=array('text'=>$row['text']);
    $db_array[$ri]=array($time_field=>$row[$time_field]);
    $timestamps[]=$row[$time_field];
}

$begin = strtotime($timestamps[0]);
$end = strtotime($timestamps[count($timestamps)-1]);

$seconds = ($end-$begin);
$hours = ($end-$begin)/3600;
$days = ($end-$begin)/86400;

/*echo 'count: '. count($timestamps);
echo '<br/>first row date: '.($timestamps[0]);
echo '<br/>last row date: '.($timestamps[count($timestamps)-1]);
echo '<br/>time difference in seconds : '.$seconds;
echo '<br/>time difference in hours : '.$hours;
echo '<br/>time difference in days : '.$days;
*/

$interval = $seconds/23; //graph scale
$loop_time = $begin; //initiale with begining timestamp
$intervals=array();

//$loop_time = $loop_time+$interval;

while($loop_time<$end){
	//$intervals[]=date('Y-m-d H:i:s',$loop_time);

	//echo '<br/>time: '.	date('Y-m-d H:i:s',$loop_time);
	//echo '<br/>time: '.	gmdate('Y-m-d H:i:s',);

	$authors_query = "SELECT author from tweet WHERE ".$time_field.">="."'".date('Y-m-d H:i:s',$loop_time-$interval)."'"." AND ".
	$time_field."<="."'".date('Y-m-d H:i:s',$loop_time)."'"
	."GROUP BY author LIMIT 1000";

	$db_results = db_fetch($authors_query);
	$author_count=pg_num_rows($db_results);
	

	
	//$author_count=sql_count($db_array,date('Y-m-d H:i:s',$loop_time-$interval),date('Y-m-d H:i:s',$loop_time),'author',true);

	$tweets_query = "SELECT count(text) from tweet WHERE ".$time_field.">="."'".date('Y-m-d H:i:s',$loop_time-$interval)."'"." AND ".
	$time_field."<="."'".date('Y-m-d H:i:s',$loop_time)."'";
	
	$db_results = db_fetch($tweets_query);
	$tweets_count=pg_fetch_result($db_results,0);
	

	//$tweets_count=sql_count($db_array,date('Y-m-d H:i:s',$loop_time-$interval),date('Y-m-d H:i:s',$loop_time),'id',true);

	//echo $tweets_query;
	//echo '<br/>tweets_count'.$tweets_count;	
	//$intervals[] = $author_count.','.$tweets_count;
	//$intervals[$i]['timestamp'] = date('Y-m-d H:i:s',$loop_time);
	//$intervals[$i]['tweets_count'] = $tweets_count;
	//$intervals[$i]['author_count'] = $author_count;
	$intervals[] = array("timestamp"=>(string)date('Y-m-d H:i:s',$loop_time),
						"authors_count"=>$author_count,
						"tweets_count"=>$tweets_count);

	$loop_time = $loop_time+$interval;
}

function get_indexes($index_begin, $index_end, $source_array,$time_from, $time_to, $interval){
	$first=0;
	$last=count($source_array);

	//for($i=$index_begin, $i>=0, $i--)
		//if($source_array[$i][$time_field]>=$time_from)

	//while($time_from>=$source_array)
}

function sql_count($source_array, $time_from, $time_to, $field, $unique){
	$ret_array=array();
	foreach ($source_array as $value) {
		if($value[$time_field]<=$time_to)
			$ret_array[]=$value[$field];
		# code...
	}
	if($unique==true)
		$ret_array=array_unique($ret_array);

	return count($ret_array);

}
//for($i=0;$i<=count($intervals);i++)
//echo '<br/>time: '.	count($intervals);//['timestamp'];

/*foreach ($intervals as $key => $value) {
	echo '<br/>time: '.	$key. ' values: '.$value;

}*/

/*if($seconds<=60){
	$interval = 6;
}

else if($seconds<=3600){
	$interval=$seconds/60;
	if($interval<=10) //go back to seconds interal, if less than 10 minutes
		$interval= 6 
	else
		$interval=60;
		//end
}
*/

http_response_code(200);
echo json_encode($intervals);

//die();

//$users = array();
//$tweets = array();


//echo $_SESSION['tweets_query'];

//Declare the errors array:
/*$errors = array();

//Create the url
$url 	 = APIURL."/tracklist";

//Create the headers:
$headers = array("Content-Type: application/json","Authorization: ".$_SESSION['account']['apiKey']);

$dataArr = array(
	"name"=>$term_name,
	"type"=>$term_type
	);

$data 	 = json_encode($dataArr);

//Create the REST call:
$response  = rest_post($url,$data,$headers);

$userobj = json_decode($response);

if($status && $status!=201){
	$errors[] = $userobj->{'errors'}[0];
	$errors[] = $userobj->{'moreInfo'};
}
if(empty($errors)){
	http_response_code(200);
	echo $response;
}
else
	echo $errors;*/
?>