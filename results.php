<?php

// this is database connection information
$database = 'host=s-l112.engr.uiowa.edu dbname=postgres user=student7 password=engr-2019-7';

// pg_connect command allows database connection
$connection = pg_connect($database);

$results = array();
for( $i = 1; $i<18; $i++){
	$results[strval($i)] = [0,0,0];
	$query = $query = 'SELECT "response" FROM response_table WHERE scenario=$1';
	$result = pg_prepare($connection, "qry1", $query);
	$result = pg_execute($connection, "qry1", array($i));

	while ($myrow = pg_fetch_assoc($result)) {
		$results[strval($i)][2]++;

		if ($myrow['response'] == 'L') {
			$results[strval($i)][0]++;
		}
		else {
			$results[strval($i)][1]++;
		}
	}
}
// echo json_encode($results);

?>

<!DOCTYPE html>
<meta charset="utf-8"/>
<meta name="description" content="Results and Analysis for Flood Thy Neighbor serious game">
<meta name="author" content="Gregory Ewing">
<meta name="keywords" content="HTML, CSS, javascript">
<html>
<head>
	<title>FTN: Results</title>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script > 

	<style type="text/css">

		<!-- Navigation bar styling -->
		.topnav {
		}

		.topnav a {
			float: right;
			color: #f2f2f2;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
			font-size: 30px;
		}

		.topnav a:hover {
			color: #80b3ffff;
		}

		.topnav a:active {
			color: #333;
		}
		
		.topnav img{
			position: absolute;
			left: 0px;
			padding-left: 10px;
			max-height: 40px;
		}

		.topnav hr {
			left:0;
			bottom:0;
			width:100%;
			color:black;
		}

		body {
			font-family: helvetica;
			background: #333;
			font-size: 20px;
			line-height: 25px;
			color:#f2f2f2;
			text-align: center;
		}

		div.outer-container {
			text-align: center;
			display: -webkit-inline-box;
		}

		div.result-container {
			width:30%;
			margin-left: 3%;
		}

		.result-container img{
			max-width: 100%;
		}
		.result-container p {
			text-align: center;
		}

		table {
			padding: 3%;
		}
		td {
			padding: 2%;
		}

		h1 {
			margin-bottom: 0;
		}


		p {
			text-align: justify;
			padding-left: 12.5%;
			padding-right: 12.5%;
			line-height: 25px;
			margin-top: 5px;
		}

		hr {
			height: 3px;
			background-color: #dbdee3ff;
			margin-bottom: 20px;
		}
		
	
		button,input{
			width: 150px;
			line-height: 30px;
			font-size: 16px;
			border-color: #80b3ffff;
			border-radius: 10px;
			border-width: 6px;
		}

		.bar{
			background-color: #303f9f ;
			width: 95%;
			height: 30px;
			margin-bottom: 0px;
			text-align: center;
			font-size: 14px;
			display: inline-block;
			border-width: 5px;
			border-color:  #878787 ;
			border-style: solid;
		}

		.chart-wrap hr{
			background-color: #333;
			border-color: #333;
		}

		.chart-wrap h4 {
			text-align: left;
			font-size: 14px;
			line-height: 14px;
			padding: 0%;
			margin-bottom: 2px;
		}

		.bar-inner{
			width:0%;
			height:100%;
			background-color: #80b3ff;
		}

		#feedback {
			text-align: center;
			font-size: 12px;
			color: #f2f2f2;
			text-decoration: none;
		}

		#feedback a{
			color: #f2f2f2;
			visited:#f2f2f2;
			active:#f2f2f2;
		}

		#footer {
			width:100%;
			margin-left: auto;
			margin-right: auto;
			padding-bottom: 1%;
			background-color:#6d7c91ff;
		}

		#footer a{
			color: #f2f2f2;
			size: 30px;
			visited:#f2f2f2;
			active:#f2f2f2;
			text-decoration: none;
		}

		#footer img {
			max-height: 115px;
		}

		#footer table{
			bottom: 0;
			text-align: center;
			padding-right:10%;
			padding-left:10%;
			width: 100%;
		}

		#footer td {
			width: 33%;
		}

	</style>

</head>
<body onload="make_results()">

	<script type="text/javascript">

		function make_results() {
			var results = <?php echo json_encode($results);  ?>;

			for (var i = 1; i <18; i++){
				var img_id = 'I'+ i.toString();
				var bar_id = "S"+ i.toString();
				var par_id = "P"+ i.toString();

				var left = Math.round((results[i][0]/results[i][2])*100); // percentage
				var right = (100 - left).toString() + "%";
				left = left.toString() + "%"
				document.getElementById(bar_id).style.width = left;

				document.getElementById(par_id).innerHTML = "Left: "+left+"<br>Right: "+right;

				if (results[i][0] > results[i][1]){
					// Choose Left Photo
					document.getElementById(img_id).src = 'images/L_img_'+i.toString()+'.png';

				} else {
					document.getElementById(img_id).src = 'images/R_img_'+i.toString()+'.png';
					// foto.src = 'images/R_img_'+i.toString()+'.png';
				}
			}
		}
		

	</script>

	<div class="topnav" style="position:fixed; background-color:#6d7c91ff; overflow:hidden; width:100%; top:0;right:0;height:70px;">

		<a href="landing.html"><img src="images/FTN_Logo.png" ></a>
		<a href="#feedback">Feedback</a>
		<!-- <a href="#about">About</a> -->
		<a href="scenarios.html">Judge</a>
		<a href="landing.html">Home</a>
		<!-- <a class="active" href="#home">Home</a> -->

		<br>
		<br>
		<hr>
	</div>

	<br>
	<br>
	<h1>Results</h1>

	<table class="result-container">
		<tr>
			<td>
				<h3>Scenario 1</h3>
				<img src="" id="I1">
				<div class="bar" >
					<!-- style="text-align: right;" -->
					<div class="bar-inner" id="S1" style="width:62%; text-align:left;"></div>
				</div>
				<p id="P1"></p>
			</td>
			<td>
				<h3>Scenario 2</h3>
				<img src="" id="I2">
				<div class="bar">
					<div class="bar-inner" id="S2" style="width:62%"></div>
				</div>
				<p id="P2"></p>
			</td>
			<td>
				<h3>Scenario 3</h3>
				<img src="" id="I3">
				<div class="bar">
					<div class="bar-inner" id="S3" style="width:62%"></div>
				</div>
				<p id="P3"></p>
			</td>
		</tr>

		<tr>
			<td>
				<h3>Scenario 4</h3>
				
				<img src="" id="I4">
				<div class="bar">
					<div class="bar-inner" id="S4" style="width:62%"></div>
				</div>
				<p id="P4"></p>
			</td>
			<td>
				<h3>Scenario 5</h3>
				
				<img src="" id="I5">
				<div class="bar">
					<div class="bar-inner" id="S5" style="width:62%"></div>
				</div>
				<p id="P5"></p>
			</td>
			<td>
				<h3>Scenario 6</h3>
				
				<img src="" id="I6">
				<div class="bar">
					<div class="bar-inner" id="S6" style="width:62%"></div>
				</div>
				<p id="P6"></p>
			</td>
		</tr>

		<tr>
			<td>
				<h3>Scenario 7</h3>
				
				<img src="" id="I7">
				<div class="bar">
					<div class="bar-inner" id="S7" style="width:62%"></div>
				</div>
				<p id="P7"></p>
			</td>
			<td>
				<h3>Scenario 8</h3>
				
				<img src="" id="I8">
				<div class="bar">
					<div class="bar-inner" id="S8" style="width:62%"></div>
				</div>
				<p id="P8"></p>
			</td>
			<td>
				<h3>Scenario 9</h3>
				
				<img src="" id="I9">
				<div class="bar">
					<div class="bar-inner" id="S9" style="width:62%"></div>
				</div>
				<p id="P9"></p>
			</td>
		</tr>

		<tr>
			<td>
				<h3>Scenario 10</h3>
				
				<img src="" id="I10">
				<div class="bar">
					<div class="bar-inner" id="S10" style="width:62%"></div>
				</div>
				<p id="P10"></p>
			</td>
			<td>
				<h3>Scenario 11</h3>
				
				<img src="" id="I11">
				<div class="bar">
					<div class="bar-inner" id="S11" style="width:62%"></div>
				</div>
				<p id="P11"></p>
			</td>
			<td>
				<h3>Scenario 12</h3>
				
				<img src="" id="I12">
				<div class="bar">
					<div class="bar-inner" id="S12" style="width:62%"></div>
				</div>
				<p id="P12"></p>
			</td>
		</tr>

		<tr>
			<td>
				<h3>Scenario 13</h3>
				
				<img src="" id="I13">
				<div class="bar">
					<div class="bar-inner" id="S13" style="width:62%"></div>
				</div>
				<p id="P13"></p>
			</td>
			<td>
				<h3>Scenario 14</h3>
				
				<img src="" id="I14">
				<div class="bar">
					<div class="bar-inner" id="S14" style="width:62%"></div>
				</div>
				<p id="P14"></p>
			</td>
			<td>
				<h3>Scenario 15</h3>
				
				<img src="" id="I15">
				<div class="bar">
					<div class="bar-inner" id="S15" style="width:62%"></div>
				</div>
				<p id="P15"></p>
			</td>
		</tr>

		<tr>
			<td>
				<h3>Scenario 16</h3>
				
				<img src="" id="I16">
				<div class="bar">
					<div class="bar-inner" id="S16" style="width:62%"></div>
				</div>
				<p id="P16"></p>
			</td>
			<td>
				<h3>Scenario 17</h3>
				
				<img src="" id="I17">
				<div class="bar">
					<div class="bar-inner" id="S17" style="width:62%"></div>
				</div>
				<p id="P17"></p>
			</td>
			<td>
				<!-- <h3>Scenario 3</h3>
				<img src="images/L_img_1.png">
				<div class="bar">
					<div class="bar-inner" id="S1" style="width:62%"></div>
				</div> -->
			</td>
		</tr>
	</table>


	

	<br>
	<br>
	<br>
	<a name="feedback"></a>
	<div id="feedback">
		Feedback? <br> 
		<a href="https://github.com/gregjewi/FloodThyNeighbor">Github</a> <br>
		gregory dot ewing at uiowa dot edu
	</div>

	<div id="footer">
		<hr>
		<table>
			<tr>
				<!-- Original Size 244x224 -->
				<td><a href="https://uiowa.edu/"><img src="images/UIOWA-LOGO.png"></a></td>

				<!-- Original size 800x400 -->
				<td><a href="https://hydroinformatics.uiowa.edu/#"><img src="images/uihilab_logo.png"><br><b>UIHI Lab</b></a></td>

				<!-- Original size 300x115 -->
				<td><a href="https://www.iihr.uiowa.edu/"><img src="images/IIHR-Logo.jpg"></a></td>
			</tr>
		</table>

	</div>

</body>
</html>



<!-- <div class="outer-container">
		
		<div class="result-container">
			<h3>Scenario 1</h3>
			<img src="images/L_img_1.png">
			<div class="bar">
				<div class="bar-inner" id="S1" style="width:62%"></div>
			</div>
		</div>

		
		<div class="result-container">
			<h3>Scenario 2</h3>
			<img src="images/L_img_2.png">
			<div class="bar">
				<div class="bar-inner" id="S2" style="width:24%"></div>
			</div>
		</div>

		<div class="result-container">
			<h3>Scenario 3</h3>
			<img src="images/L_img_3.png">
			<div class="bar">
				<div class="bar-inner" id="S3" style="width:24%"></div>
			</div>
		</div>


		<div class="result-container">
			<h3>Scenario 4</h3>
			<img src="images/L_img_4.png">
			<div class="bar">
				<div class="bar-inner" id="S3" style="width:24%"></div>
			</div>
		</div>

	</div> -->