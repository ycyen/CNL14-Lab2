<?php
	include ("dbconfig.php");
	echo 'hello';
	$q = "SELECT * FROM `radacct` ;";
	//echo $q;
	// Run query
	$r = mysql_query($q);
	echo "<br>";
	echo "username/input/output/time/ip <br>";
	while($obj = @mysql_fetch_object($r)) {
		echo $obj->username . "/" . $obj->acctinputoctets . "bytes /" .  $obj->acctoutputoctets . "bytes /" . $obj->acctsessiontime . "secs /" . $obj->framedipaddress . "<br>";
	}
?>

