<?php
	function get_db(){
		// database constants
		$table = '';
		$hostname = "localhost";
		//$hostname = "sj.abdn.ac.uk";
		$port = '5432';
		//$user = "postgres";
		$user = "dotrural";
		$password = "postgres";
		$database = "userStudyFeb2015";

		$db = pg_connect('host='.$hostname.' port='.$port.' dbname='.$database.' user='.$user.' password='.$password)
		or die('Could not connect database!');
		return $db;

	}

	function db_fetch($query){

	$db = get_db();
	echo "<br/><br/>query in db_fetch: ".$query;
	//exit();

	$result = pg_exec($db, $query);
	// query to get data from database

// 	$rows = 

	//$field = pg_num_fields($result);
	//$returnArray = pg_copy_to($db, $table);

/*		while($row=pg_fetch_array($result)){	
			$returnArray[]=$row;
			
		}

	
	*/
	pg_close();
	return $result;
	}

	function db_count(){
		$db = get_db();
		$result = pg_exec($db, 'SELECT count (id) from tweet');

		return pg_fetch_result($result,0);
	}
?>