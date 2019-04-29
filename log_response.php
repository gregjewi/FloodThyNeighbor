<?php
	$scenario_key = $_GET['scenario_key'];
	$uid = $_GET['uid'];
	$LR = $_GET['LR'];

	// this is database connection information
	$database = 'host=s-l112.engr.uiowa.edu dbname=postgres user=student7 password=engr-2019-7';

	// pg_connect command allows database connection
	$connection = pg_connect($database);

	$query = 'INSERT INTO response_table (uid, scenario, response) VALUES ($1, $2, $3)';

	$result = pg_prepare($connection,"qry1",$query);
	$result = pg_execute($connection,"qry1",array($uid,$scenario_key,$LR));
?>