<?php
require_once("bapego_functions.php");
$connect=dbconnect();
if (isset($_GET["link"]) && isset($_GET["email"]))
{
	$sql='SELECT * FROM bapego_newsletter WHERE link=\''.
	    $_GET["link"].'\' and email=\''.$_GET["email"].'\'';
	$query=pg_query($connect,$sql);
	if (pg_numrows($query)===1)
	{
		$sql='DELETE FROM bapego_newsletter WHERE email=\''.$_GET["email"].'\'';
		pg_query($connect,$sql);
	}
}
header('Location: bapego_index.php');
?>
