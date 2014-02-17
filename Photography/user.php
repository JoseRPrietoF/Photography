<?php
class User
{
	
	private $name;
	private $idUser;
	private $lastname;
	private $rang;
	private $birthday;
	private $mail;
	private $sex;
	private $created;
	private $password;
	
	function __construct($mail,$password,$rang)
	{ 
		$this -> mail = $mail;
		$this -> password = $password;
		$this -> rang = $rang;
   	} 
	// Getters
	function getRang()
	{
		return $this -> rang;
	}
	
	function getName()
	{
		return $this -> name;
	}
	
	function getIdUser()
	{
		return $this -> idUser;
	}
	
	function getLastname()
	{
		return $this -> lastname;
	}
	
	function getBirthday()
	{
		return $this -> birthday;
	}
	
	function getMail()
	{
		return $this -> mail;
	}
	
	function getSex()
	{
		return $this -> sex;
	}
	
	function getCreated()
	{
		return $this -> created;
	}
	
	function getPassword()
	{
		return $this -> password;
	}
	
	// End getters
	// Setters
	function setRang($i)
	{
		$this -> rang = $i;
	}
	
	function setName($i)
	{
		$this -> name = $i;
	}
	
	function setIdUser($i)
	{
		$this -> idUser = $i;
	}
	
	function setLastname($i)
	{
		$this -> lastname = $i;
	}
	
	function setBirthday($i)
	{
		$this -> birthday = $i;
	}
	
	function setMail($i)
	{
		$this -> mail = $i;
	}
	
	function setSex($i)
	{
		$this -> sex = $i;
	}
	
	function setCreated($i)
	{
		$this -> created = $i;
	}
	
	function setPassword($i)
	{
		$this -> password = $i;
	}
}

?>
 
