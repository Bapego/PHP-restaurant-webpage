<?php
function dbconnect()
{
	$host='localhost';
	$port='5432';
	$dbname='bapego';
	$user='bapego';
	$password='kjdkfjshdjkfhsdjfshdf3847248JGIUZj"!)(=';
	$connect=pg_connect('host=\''.$host.'\' port=\''.$port.'\' dbname=\''.
	    $dbname.'\' user=\''.$user.'\' password=\''.$password.'\'');
	return($connect);
}
?>
