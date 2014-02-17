<?php

require_once ('../dades.php');
require_once ('../user.php');
ini_set("display_errors", "1"); // per mostrar els errors

class logUser
{
	private $con;
	
	function __construct()
	{ 
		global $con;
		$this->con = $con;
   	} 
	
	
	public function checkUser($mail, $password)
	{
		$nombre = 0;
		$psw = 0;
		//echo self::crypt_blowfish('a'); 
		$query = "SELECT mail,password FROM users WHERE mail='$mail'";
		$result = $this->con->prepare($query);
		$result->execute();
		$result->bind_result($nombre,$psw);
		$result->fetch();
		if ( $mail != $nombre || $psw != crypt($password, $psw) ) // Decrypt the password and try
		{

			//if( crypt('micontraseña', $passwordenBD) == $psw)
			return 0;
			
		} else {
			return 1;
			//echo "User: " . $mail . "</br>";
		}
	}
	
	public function createUser($mail, $password)
	{
		$psw = self::crypt_blowfish($password); // Keep the password encrypted, not the original password
		// its for the privacy of users and "anti-Obama/NSA" atacks ... :D
		$query = 'INSERT INTO users(mail,password) VALUES ("'. $mail .'","'. $psw .'")';
		if ($this->con->query($query) == TRUE) 
		{
			return true;
		} else return false;
	}
	
	public function createFullUser($mail, $password,$name,$lastname,$sex,$birthday)
	{
		$psw = self::crypt_blowfish($password); // Keep the password encrypted, not the original password
		// its for the privacy of users and "anti-Obama/NSA" atacks ... :D
		$query = 'INSERT INTO users(mail,password,name,lastname,sex,birthday) 
				VALUES ("'. $mail .'","'. $psw .'","'.$name.'",
						"'.$lastname.'","'.$sex.'","'.$birthday.'")';
		if ($this->con->query($query) == TRUE)
		{
			return true;
		} else return false;
	}
	
	public function crypt_blowfish($password) // crypt the password in BLOWFISH, later keep it in the BD (other method)
	{  
		$digito = 7;
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';  
		$salt = sprintf('$2a$%02d$', $digito);  
		for($i = 0; $i < 22; $i++)  
		{  
			$salt .= $set_salt[mt_rand(0, 63)];  
		}  
		//echo $salt;
		return crypt($password, $salt);  
	}  
	
	public function createUserObject($mail)
	{
		$query = "SELECT * FROM users WHERE mail = '$mail'";
		$result = $this -> con -> query($query);
		// Create the user object
		$row = $result->fetch_assoc();
		$user = new User($row['mail'], $row['password'], $row['rang']);
		$user ->setIdUser( $row['idUser']);
		$user ->setCreated( $row['created']);
		$user ->setLastname( $row['lastname']);
		$user ->setSex( $row['sex']);
		$user ->setName( $row['name']);
		$user ->setBirthday( $row['birthday']);
		
		return $user;
	}
	
	public function formSession($boto, $mail, $password)
	{
		
		/*
		 * 2 -> Loged in - All correct
		 * 1 - > no pasa, si es menor deja probar usuario
		 * 0 - > mail or password incorrect
		 * -1 - > Default
		 * -5 -> Users exists (only on create)
		 * */
		switch( $boto ) 
		{
			case "Login": 
				if ( $this -> checkUser($mail,$password) == 1 )
				{
					$_SESSION['session'] = 2;
					$user = $this->createUserObject($mail);
					//echo $mail;
					//print_r($user);
					$_SESSION['user'] = serialize($user); // Logged in
					
					header('Location: ../index.php');
				} else {
					$_SESSION['session'] = 0;
					echo "Incorrect mail or password";
					header('Location: ../formUser.php');
				}
				break;
			case "New User": 
				if ( $this -> createUser($mail,$password) == 1 )
				{
					$_SESSION['session'] = 1;
					header('Location: ../formUser.php');
				} else {
					$_SESSION['session'] = -5;
					//echo "User already exists";
					header('Location: ../formUser.php');
				}
			break;
			case "Logout":
				$_SESSION['session'] = -1;
				session_destroy();
				header('Location: ../index.php');
			break;
		}
	}
}
///////////////////////////////////////////////////////////////////////----------------------------------------------------------------------------------------

?>
