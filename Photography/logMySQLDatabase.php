<?php
require("conexionData.php");
class connectMySQLi
{
	
	public $con;
	
	function __construct()
	{ 
		$this->con = new mysqli($mysql_server, $mysql_login, $mysql_pass, $db_name);
		if($this->con->connect_errno) die("Me muero");
   	} 
   	
   	public static function getCon()
   	{
		$con = new mysqli(MYSQL_SERVER, MYSQL_LOGIN, MYSQL_PASS, DB_NAME);
		if($con->connect_errno) die("Me muero");
		return $con;
	}
	
}

?>
