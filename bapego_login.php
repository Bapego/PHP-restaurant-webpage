<meta charset="utf-8">
<?php
session_start();
mb_internal_encoding("utf-8");
require_once("bapego_functions.php");
print '<form name="login" method="post" action="">';
print 'Username: <input type="text" name="username"><br />';
print 'Password: <input type="password" name="password">
    <br />';
print '<input type="submit" name="oke" value="Login">';
print '</form>';
if(isset($_POST["oke"]))
{
	$connect=dbconnect();
	$sql='SELECT * FROM bapego_admin WHERE username=\''.
	    $_POST["username"].'\' AND password=\''.
	    md5($_POST["password"]).'\'';
	$query=pg_query($connect,$sql);
	if (pg_num_rows($query)===1)
	{
		$admin=pg_fetch_all($query);
		$_SESSION["admin"]=$admin[0]["username"];
		header("Location: bapego_admin.php");
	}
	else
	{
		unset($_SESSION["admin"]);
		print "Sikertelen belépés";
	}
}
?>