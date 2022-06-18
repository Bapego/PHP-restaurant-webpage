<?php
session_start();
session_unset();
session_destroy();
header("Location: bapego_login.php");
?>