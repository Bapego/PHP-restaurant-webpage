<?php
session_start();
if (isset($_SESSION["admin"]))
{
	require_once("bapego_functions.php");
	$connect=dbconnect();
	if(isset($_GET["key"]) && isset($_GET["field"]) && isset($_GET["table"]))
	{
		$sql='DELETE FROM '.$_GET["table"].' WHERE '.$_GET["field"].'=\''.$_GET["key"].'\'';
		pg_query($connect,$sql);
		header("Location: bapego_admin.php");
	}
}
else
{
	header("Location: bapego_login.php");
}
print $_GET["email"];
?>