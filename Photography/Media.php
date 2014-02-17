<?php
class Media
{
	private $id;
	private $name;
	private $idAlbum;
	private $route;
	private $description;

	//Setters
	
	public function setId($i)
	{
		$this->id = $i;
	}
	
	public function setName($i)
	{
		$this->name = $i;
	}
	
	public function setIdAlbum($i)
	{
		$this->idAlbum = $i;
	}
	
	public function setDescription($i)
	{
		$this->description = $i;
	}
	
	function route()
	{
		$this-> route = 'albums/album'.$this->idAlbum . '/' . $this->name;
	}
	// End setters
	// Getters
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getIdAlbum()
	{
		return $this->idAlbum;
	}
	
	function getRoute()
	{
		return $this->route;
	}
	
	function getDescription()
	{
		return $this->description;
	}
	
	// End Getters
	
}
?>
