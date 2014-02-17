<?php
ini_set("display_errors", "1"); // per mostrar els errors
require("conexionData.php");
// Data from project
session_cache_limiter ('nocache,private');
session_start();
if ( !isset( $_SESSION['session'] ) )
	$_SESSION['session'] = -1;

$con = new mysqli(MYSQL_SERVER, MYSQL_LOGIN, MYSQL_PASS, DB_NAME);
if($con->connect_errno) die("Me muero");
//$_SESSION['user'] = "";	
?>
 
