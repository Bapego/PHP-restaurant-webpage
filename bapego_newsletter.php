<meta charset="utf-8">
<?php
mb_internal_encoding("utf-8");
if (isset($_POST["newsok"]))
{
	session_start();
	require_once('bapego_functions.php');
	$connect=dbconnect();
	$error_newsletter["email"]=false;
	$error_newsletter["robot"]=false;
	$error_newsletter["duplicate"]=false;
	$error_newsletter["insert"]=false;
	$error_newsletter["cookie"]=false;
	
	if (filter_var($_POST["email"],
	    FILTER_VALIDATE_EMAIL)===false || 
	    mb_strlen($_POST["email"])>35)
	{
		$error_newsletter["email"]=true;
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
	$a=$_SESSION["solution2"];
	if ($_POST["robot"]==="" || $_POST["robot"]!=="$a")
	{
		print 'alert("Üzenet küldése sikertelen5");';
		$error_newsletter["robot"]=true;
	}
	$sql='SELECT * FROM bapego_newsletter WHERE email=\''.$_POST["email"].'\'';
	$query=pg_query($connect,$sql);
	if (pg_num_rows($query)!==0)
	{
		$error_newsletter["duplicate"]=true;
	}
	if (!in_array(true,$error_newsletter))
	{
		//Leiratkozó link rögzítése
		$karakterek='qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789';
		$hossz=mb_strlen($karakterek);
		$link='';
		$darab=rand(30,40);
		for ($i=0;$i<$darab;$i++)
		{
			$link.=mb_substr($karakterek,rand(0,$hossz-1),1);
		}
		
		$sql='INSERT INTO bapego_newsletter (email, link) VALUES (
		    \''.$_POST["email"].'\',
		    \''.$link.'\')';
		//print $sql;
		$message="Kedves Feliratkozó!\r\n Köszönjük a feliratkozást!\r\n Amennyiben le szeretne iratkozni, az alábbi linken teheti meg azt!\r\n
		    <a href=\"http://193.6.62.96/~bapego/hazi_feladat/bapego_newsunsub.php?link=$link&email=".$_POST["email"]."\">Leiratkozás
		    </a>\r\n";
		$headers=array(
		    'Content-type: text/html; charset="utf-8";',
		    'From: Feliratkozás <felirtkozas@bapego-php.ttk.pte.hu>'
		);
		$header=implode("\r\n", $headers);
		mail ($_POST["email"],
		    'Feliratkozás visszajelzése',
		    nl2br($message),$header);
		
		if (!pg_query($connect,$sql))
		{
			$error_newsletter["insert"]=true;
		}
	}
	$_SESSION["error_newsletter"]=$error_newsletter;
	if(isset($_COOKIE["userID"]))
	{
		alert: "juhu";
	}
	header("Location: bapego_index.php");
//	break;
}
else
{
	header("Location: bapego_index.php");
}
?>
