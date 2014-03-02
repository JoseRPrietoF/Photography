<?php
require_once ('dades.php');
class Album
{
	private $id;
	private $name;
	private $route; // albums/albumX 
	private $imgMin;
	private $category;
	private $description;
	
	// Getters
	public function getId()
	{
		return $this->id;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function getRoute()
	{
		$this -> route = 'albums/album' . $this -> id;
		return $this->route;
	}
	
	public function getImgMin()
	{
		return $this->imgMin;
	}
	
	public function getCategory()
	{
		return $this->category;
	}
	
	public function getDescription()
	{
		return $this->description;
	}
	// End Getters
	
	// Setters
	public function setId($i)
	{
		$this->id = $i;
	}
	
	public function setName($i)
	{
		$this->name = $i;
	}
	
	public function setRoute($i)
	{
		$this->route = $i;
	}
	
	public function setImgMin($i)
	{
		$this->imgMin = $i;
	}
	
	public function setCategory($i)
	{
		$this->category = $i;
	}
	
	public function setDescription($i)
	{
		$this->description = $i;
	}
	// End setters
	public static function printAlbums()
	{
		
	}
	
}
?>
