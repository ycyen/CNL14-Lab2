<?php
// Replace the variable values below
// with your specific database information.
$host = "localhost";
$user = "radius";
$pass = "radius";
$db   = "radius";

// This part sets up the connection to the 
// database (so you don't need to reopen the connection
// again on the same page).
$ms = mysql_pconnect($host, $user, $pass);
if ( !$ms )
	{
	echo "Error connecting to database.\n";
	}
else {
	echo "Ya~~~~\n";
}

// Then you need to make sure the database you want
// is selected.
$tmp = mysql_select_db($db);

if( !$tmp )
	{
	echo "jizz select db";
	}
?>
