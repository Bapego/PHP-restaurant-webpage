<meta charset="utf-8">
<?php
mb_internal_encoding("utf-8");
if (isset($_POST["resoke"]))
{
	session_start();
	require_once('bapego_functions.php');
	$connect=dbconnect();
	$error_reservation["name"]=false;
	$error_reservation["email"]=false;
	$error_reservation["date"]=false;
	$error_reservation["time"]=false;
	$error_reservation["robot"]=false;
	$error_reservation["insert"]=false;
	$error_reservation["cookie"]=false;
	if (filter_var($_POST["email"],
	    FILTER_VALIDATE_EMAIL)===false || 
	    mb_strlen($_POST["email"])>35)
	{
		$error_reservation["email"]=true;
	}
	
	if(isset($_COOKIE["userID"]))
	{
		setcookie("userID", $_POST["email"], time()+100000000);
		$sql='UPDATE bapego_trackings SET userid=\''.$_POST["email"].'\' where userid=\''.$_COOKIE["userID"].'\'';
		if (!pg_query($connect,$sql))
		{
			$error_reservation["cookie"]=true;
		}
	}
	
	if ($_POST["name"]==="" || 
	    mb_strlen($_POST["name"])>35)
	{
		$error_reservation["name"]=true;
	}
	
	if ($_POST["date"]==="éééé. hh. nn." || $_POST["date"]==="")
	{
		$error_reservation["date"]=true;
	}
	if ($_POST["time"]==="--:--" || $_POST["time"]==="")
	{
		$error_reservation["time"]=true;
	}
	$a = $_SESSION["solution"];
	if ($_POST["robot"]==="" || $_POST["robot"] !== "$a")
	{
		print $a;
		$error_reservation["robot"]=true;
	}
	if (!in_array(true,$error_reservation))
	{
		$sql='INSERT INTO bapego_reservs (name, email, guestnum, resdate) VALUES
		    (\''.$_POST["name"].'\', \''.$_POST["email"].'\', \''.$_POST["guestnumb"].'\', \''.$_POST["date"].' '.$_POST["time"]. '\')';
		if (!pg_query($connect,$sql))
		{
			$error_reservation["insert"]=true;
		}
	}
	$_SESSION["error_reservation"]=$error_reservation;
/*
	$sql='SELECT * FROM pcontactform';
	$query=pg_query($connect,$sql);
	$result=pg_fetch_all($query);
//	print "<pre>"; var_dump($result); print "</pre>";
	print '<table border="1">';
	foreach ($result as $record)
	{
		print "<tr>";
		foreach ($record as $field)
		{
			print "<td>$field</td>";
		}
		print "</tr>";
	}
	print '</table>';
*/
	header("Location: bapego_index.php");
	//break;
}
else{
header("Location: bapego_index.php");}
?>
