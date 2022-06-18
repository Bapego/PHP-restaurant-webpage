<meta charset="utf-8">
<?php
session_start();
if (isset($_SESSION["admin"]))
{
	mb_internal_encoding("utf-8");
	require_once("bapego_functions.php");
	
	
	$connect=dbconnect();
	//Menü módosítás
	$sql='SELECT * FROM bapego_menu ORDER BY id ASC;';
		$query2=pg_query($connect, $sql);
		
		$menu = pg_fetch_all($query2);
        
        print '<h1>Menü</h1>';
        print "<table border=1>";
		print "<tr>";
		print "<th>Id</th>";
		print "<th>Nap</th>";
		print "<th>Leves</th>";
		print "<th>Leves ár</th>";
		print "<th>Főétel</th>";
		print "<th>Főétel ár</th>";
		print "<th>Desszert</th>";
		print "<th>Desszert ár</th>";
		print "<th>Módosítás gomb</th>";
        print "</tr>";
		
		
		for($i=0; $i<count($menu); $i++){
			
			print "<tr>";
			if(isset($_GET["modosito"]) && $_GET["modosito"]===$menu[$i]["id"]){
				print '<form action="bapego_modosit.php" method="post" >'; 
				print '<td><input name="id" type="text" size="1" value="'.$menu[$i]["id"].'" readonly></td>';
                print '<td><input name="day" type="text"  value="'.$menu[$i]["day"].'" readonly /></td>';
                print '<td><input name="soup" type="text" value="'.$menu[$i]["soup"].'" /></td>';
                print '<td><input name="soupprice" type="number" value="'.$menu[$i]["soupprice"].'" /></td>';
                print '<td><input name="main" type="text" value="'.$menu[$i]["main"].'"></td>';
                print '<td><input name="mainprice" type="number" value="'.$menu[$i]["mainprice"].'"></td>';
                print '<td><input name="dessert" type="text" value="'.$menu[$i]["dessert"].'"></td>';
                print '<td><input name="dessertprice" type="number" value="'.$menu[$i]["dessertprice"].'"></td>';
				print '<td><input name="modify" type="submit" value="Módosítás"></td>';
				print '</form>';
            } else {
                print "<td>".$menu[$i]["id"]."</td>";
                print "<td>".$menu[$i]["day"]."</td>";
                print "<td>".$menu[$i]["soup"]."</td>";
                print "<td>".$menu[$i]["soupprice"]."</td>";
                print "<td>".$menu[$i]["main"]."</td>";
                print "<td>".$menu[$i]["mainprice"]."</td>";
                print "<td>".$menu[$i]["dessert"]."</td>";
                print "<td>".$menu[$i]["dessertprice"]."</td>";
                print "<td><a href=\"bapego_admin.php?modosito=".$menu[$i]["id"]."\">Módosít</a></td>";
                
            }
				
            print "</tr>";
        }
		print "</table>";
		
	print '<hr>';
	print "<h1>Adminok kezelése</h1>";
	
	print $_SESSION["admin"];
	print '<a href="bapego_logout.php"> Kijelentkezés</a>';
	if (isset($_POST["adminaddoke"]))
	{
		$sql='SELECT * FROM bapego_admin WHERE username=\''.
		    $_POST["email"].'\'';
		$query=pg_query($connect,$sql);
		if (pg_numrows($query)===0)
		{
			$sql='INSERT INTO bapego_admin VALUES (\''.
			    $_POST["email"].'\', \''.
			    md5($_POST["password"]).'\')';
			if (pg_query($connect,$sql))
			{
				print "Admin hozzáadása sikeres";
			}
			else
			{
				print "Admin hozzáadása sikertelen";
			}
		}
		else
		{
			print "Már létező e-mail cím";
		}
	}
	$sql='SELECT * FROM bapego_admin order by username asc';
	$query=pg_query($connect,$sql);
	$admins=pg_fetch_all($query);
	print "<table border=\"1\">";
	print "<tr>";
		print "<th>Felhasználónév</th>";
		print "<th>Titkosított jelszó</th>";
		print "<th>Törlés gomb</th>";
        print "</tr>";
	foreach($admins as $admin)
	{
		print "<tr>";
		foreach($admin as $ertek)
		{
			print "<td>$ertek</td>";
		}
		print "<td>";
		if ($_SESSION["admin"]!==$admin["username"])
		{
			print "<a href=\"bapego_torol.php?table=bapego_admin&
			field=username&key=".$admin["username"]."\">Törlés
			</a>";
		}
		print "</td>";
		print "</tr>";
	}
	print "</table>";
	print "<br />";
	print '<form name="adminadd" method="post" action="">';
	print 'Email: <input type="text" name="email"> ';
	print 'Password: <input type="password" name="password">';
	print '<input type="submit" name="adminaddoke" value="Admin hozzáadása">';
	print '</form>';
	print "<hr>";
	
	
	print "<h1>Asztalfoglalások</h1>";
	$sql='SELECT * FROM bapego_reservs order by id asc';
	$query=pg_query($connect,$sql);
	$result=pg_fetch_all($query);
	if ($result!==false)
	{
		print '<table border="1">';
		print "<tr>";
		print "<th>Id</th>";
		print "<th>Név</th>";
		print "<th>Email</th>";
		print "<th>Vendégek száma</th>";
		print "<th>Belépési idő</th>";
		print "<th>Foglallási idő</th>";
		print "<th>Elfogadott</th>";
		print "<th>Elfogad gomb</th>";
		print "<th>Elutasít gomb</th>";
        print "</tr>";
		foreach ($result as $record)
		{
			print "<tr>";
			foreach ($record as $field)
			{
				print "<td>$field</td>";
			}
			//Elfogad------------------------------
			print "<td>";
				print "<a href=\"bapego_elfogad.php?table=bapego_reservs&field=id&email=".$record["email"]."&key=".$record["id"]." \">Elfogad</a>";
			print "</td>";
		
			//Elutasít----------------------------
			print "<td>";
				print "<a href=\"bapego_nemfogad.php?table=bapego_reservs&field=id&email=".$record["email"]."&key=".$record["id"]." \">Elutasít</a>";
			print "</td>";

			print "</tr>";
		}
		print '</table>';
	}
	print "<hr>";
	print "<h1>Hírlevélre feliratkozók</h1>";
	$sql='SELECT * FROM bapego_newsletter order by id asc';//p WHERE NOT EXISTS (SELECT * FROM pregtemp t WHERE p.email=t.email)';
	$query=pg_query($connect,$sql);
	$result=pg_fetch_all($query);
	if ($result!==false)
	{
		print '<table border="1">';
		print "<tr>";
		print "<th>Id</th>";
		print "<th>Email</th>";
		print "<th>Belépési idő</th>";
		print "<th>Egyéni link</th>";
		print "<th>Leiratkozás gomb</th>";
        print "</tr>";
		foreach ($result as $record)
		{
			print "<tr>";
			foreach ($record as $field)
			{
				print "<td>$field</td>";
			}
			
			print "<td>";
				print "<a href=\"bapego_torol.php?table=bapego_newsletter&field=id&key=".$record["id"]."\">Leiratkozás</a>";
			print "</td>";

			print "</tr>";
		}
		print '</table>';
	}

	print "<hr>";	
	
	//Követett felhasználók
	print "<h1>Követett Felhasználók</h1>";
	$sql='SELECT * FROM bapego_trackings order by userid asc';
	$query=pg_query($connect,$sql);
	$result=pg_fetch_all($query);
	if ($result!==false)
	{
		print '<table border="1">';
				print "<tr>";
		print "<th>Id</th>";
		print "<th>Belépések száma</th>";
		print "<th>Törlés gomb</th>";
        print "</tr>";
		foreach ($result as $record)
		{
			print "<tr>";
			foreach ($record as $field)
			{
				print "<td>$field</td>";
			}
			
			print "<td>";
				print "<a href=\"bapego_torol.php?table=bapego_trackings&field=userid&key=".$record["userid"]."\">Törlés</a>";
			print "</td>";
			print "</tr>";
		}
		print '</table>';
	}
	
        print '<hr>';
	
}
else
{
	header("Location: bapego_login.php");
}
?>
