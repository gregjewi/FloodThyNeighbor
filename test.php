<?php

$age = $_GET['age'];
$gen = $_GET['gen']; // gender
$ht = $_GET['ht']; // hometown
$st = $_GET['st']; // state
$ct = $_GET['ct']; // country
$pro = $_GET['pro']; // profession
$ed = $_GET['ed']; // education level
$inc = $_GET['inc']; // income
$uid = $_GET['uid']; // user id


// createUserInTable($uid_array);
// this is database connection information
$database = 'host=s-l112.engr.uiowa.edu dbname=postgres user=student7 password=engr-2019-7';

// pg_connect command allows database connection
$connection = pg_connect($database);

$query = 'INSERT INTO survey_table (uid, age, gen, pro, ht, st, ct, ed, inc) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)';
echo $query.'<br>';

$result = pg_prepare($connection,"qry1",$query);
$result = pg_execute($connection,"qry1",array($uid, $age, $gen, $pro, $ht, $st, $ct, $ed, $inc));


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		window.location.href = 'results.php';
		// window.location.href = 'results.html';
	</script>
	
</body>
</html>