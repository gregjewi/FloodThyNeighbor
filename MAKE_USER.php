<?php

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


$ip = getUserIpAddr();
$t = time();
$uid = $t.'-'.$ip;

$uid_array = [
	"time" 	=> $t,
	"ip"	=> $ip,
	"uid"	=> $t.'-'.$ip,
];


echo json_encode($uid_array);



// createUserInTable($uid_array);
// this is database connection information
$database = 'host=s-l112.engr.uiowa.edu dbname=postgres user=student7 password=engr-2019-7';

// pg_connect command allows database connection
$connection = pg_connect($database);

// $query = 'INSERT INTO uid_table (ip, t_epoch,  uid) VALUES (\'$ip\', $t, \'$uid\')';
$query = 'INSERT INTO uid_table (ip, t_epoch,  uid) VALUES ($1, $2, $3)';

$result = pg_prepare($connection,"qry1",$query);
// $result = pg_execute($connection,"qry1",$array());
$result = pg_execute($connection,"qry1",array($ip,$t,$uid));
// echo $result


?>