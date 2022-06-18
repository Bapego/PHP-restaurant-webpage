<meta charset="utf-8">
<?php	
    mb_internal_encoding("utf-8"); 
	session_start();
	if(isset($_SESSION["admin"])){
		require_once('bapego_functions.php');
		$connect = dbconnect();
        
        if (isset($_POST['modify']) && isset($_POST['soup']) && isset($_POST['soupprice']) && isset($_POST['main']) && isset($_POST['mainprice']) && isset($_POST['dessert']) && isset($_POST['dessertprice'])&& isset($_POST['id'])){
			$sql='UPDATE bapego_menu SET soup=\''.$_POST["soup"].'\', soupprice=\''.$_POST["soupprice"].'\', main=\''.$_POST["main"].'\', mainprice=\''.$_POST["mainprice"].'\', dessert=\''.$_POST["dessert"].'\', dessertprice=\''.$_POST["dessertprice"].'\'  where id='.$_POST["id"].'';
            print $sql;
            pg_query($connect, $sql);
		} 

		header('Location: bapego_admin.php');
	} else {
		header('Location: bapego_login.php');
	}	
?>