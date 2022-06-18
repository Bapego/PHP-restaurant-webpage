<?php
session_start();
if (isset($_SESSION["admin"]))
{
	require_once("bapego_functions.php");
	$connect=dbconnect();
	if(isset($_GET["key"]) && isset($_GET["field"]) && isset($_GET["table"]) && isset($_GET["email"]))
	{
		
		$sql='UPDATE '.$_GET["table"].' SET accepted = true where '.$_GET["field"].'=\''.$_GET["key"].'\'';
		pg_query($connect,$sql);
		
		$message="Kedves Vendégünk!\r\n Elfogadtuk foglalási szándékát. Várjuk önt sok szeretettel!";
		$headers=array(
		    'Content-type: text/html; charset="utf-8";',
		    'From: Foglalás elfogadása <fogalalas@c-ta-php.ttk.pte.hu>'
		);
		$header=implode("\r\n", $headers);
		mail ($_GET["email"],
		    'Foglalási kérelem elfogadása',
		    nl2br($message),$header);
		
		if (!pg_query($connect,$sql))
		{
			$error_registration["insert"]=true;
		}
		
		header("Location: bapego_admin.php");
	}
}
else
{
	header("Location: bapego_admin.php");
}
?>