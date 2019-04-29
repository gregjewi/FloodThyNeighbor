<?php

$scenario_key = $_GET['scenario_key'];

// this is database connection information
$database = 'host=s-l112.engr.uiowa.edu dbname=postgres user=student7 password=engr-2019-7';

// pg_connect command allows database connection
$connection = pg_connect($database);

// Get all information back from scenario_table from key provided
$query = 'SELECT * FROM scenario_table WHERE key=$1';

// Prepare and exectue query
$result = pg_prepare($connection, "qry1", $query);
$result = pg_execute($connection, "qry1", array($scenario_key));

// Convert to associative array
$data = pg_fetch_assoc($result);

// Print as JSON
echo json_encode($data);

?>