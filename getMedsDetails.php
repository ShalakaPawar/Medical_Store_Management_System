<?php
	include 'config.php';

	if(!($dbconn = @mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
	mysqli_select_db($dbconn, $db);
	
	$q=$_GET["q"];
	//$q = name,buy_timestamp,expiry_date,chem_amt,cp;
	$p = explode(",", $q);
	$name=$p[0];
	$ts=$p[1];
	$expd=$p[2];
	$chemamt=$p[3];
	$cp=$p[4];

	$check = "SELECT * FROM medicine WHERE name='".$name."' AND buy_timestamp='".$ts."' AND expiry_date='".$expd."' AND chem_amount='".$chemamt."' AND cp='".$cp."'";
	$query = mysqli_query($dbconn, $check);
	$query = mysqli_fetch_array($query);
	$qty = $query['qty'];
	echo $qty;
?>
