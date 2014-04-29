<?php

	// dbConfig.php is a file that contains your
	// database connection information. This
	// tutorial assumes a connection is made from
	// this existing file.
	include ("dbconfig.php");


//Input vaildation and the dbase code
	if ( $_GET["op"] == "reg" )
  {
  $bInputFlag = false;
  foreach ( $_POST as $field )
  	{
  	if ($field == "")
    {
    $bInputFlag = false;
    }
  	else
    {
    $bInputFlag = true;
    }
  	}
  // If we had problems with the input, exit with error
  if ($bInputFlag == false)
  	{
  	die( "Problem with your registration info. "
    ."Please go back and try again.");
  	}

  // Fields are clear, add user to database
  //  Setup query
  $q = "INSERT INTO `radcheck` (`username`, `attribute`, `op`, `value`) "
  	."VALUES ('".$_POST["username"]."', 'User-Password',':=', '"
  	.$_POST["password"]
  	."')";
  echo $q;
/*insert into radcheck (username,attribute,op,value) values ('
帳號','User-Password',':=','密碼');*/
  //  Run query
  $r = mysql_query($q);
  
  // Make sure query inserted user successfully
  if ( !mysql_insert_id() )
  	{
  	die("Error: User not added to database.");
  	}
  else
  	{
  	// Redirect to thank you page.
      $q = "INSERT INTO `radusergroup` (`username`, `groupname`)"
      ."VALUES('".$_POST["username"]."', "
      ."'user')";
      $r = mysql_query($q);
  	Header("Location: register.php?op=thanks");
  	}
  } // end if


//The thank you page
	elseif ( $_GET["op"] == "thanks" )
  {
  echo "<h2>Thanks for registering!</h2><br>";
  echo "<a href='javascript:history.go(-2)'>back to index</a>";
  }
  
//The web form for input ability
	else
  {
  echo "<form action=\"?op=reg\" method=\"POST\">\n";
  echo "Username: <input name=\"username\" MAXLENGTH=\"16\"><br />\n";
  echo "Password: <input type=\"password\" name=\"password\" MAXLENGTH=\"16\"><br />\n";
  echo "<input type=\"submit\">\n";
  echo "</form>\n";
  }
	// EOF
	?>