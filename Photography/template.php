<?php 
require_once ('dades.php');	
require_once ('photos.php');
require_once ('user.php');
ini_set("display_errors", "1"); // per mostrar els errors
// Liquid Gem Template
class Template
{
	private $p;
	private $albumsArray;
	private $user;
	
	public function __construct()
	{
		$this->p = new photos();
	}
	
	public function checkRang() // more 1 = OK else go to index.php
	{
		if(isset($_SESSION['user']) )
		{
			$user = unserialize($_SESSION['user']);
			if(!$user->getRang() > 1) // Comprovem el rang dels usuaris
				header('Location: index.php');
		} else  header('Location: index.php');
		return true;
	}
	
	public function checkRangUser(){
		if(isset($_SESSION['user']) )
		{
			$user = unserialize($_SESSION['user']);
			if($user->getRang() < 1) // Comprovem el rang dels usuaris
				return false;
		} else return false;
		return true;
	}
	
	public function deleteAlbumButton($album){
		if ($this -> checkRangUser()){
			echo '<a href="operations/deleteAlbum.php?album='.urlencode(serialize($album)).'"
					class="deleteAlbumLink"  onclick="return confirmar()">
					<div class="deleteAlbum"><i class="fa fa-minus-square-o"> Delete this album</i> </div>
					</a>';
			echo '<a href="updateAlbum.php"
					class="deleteAlbumLink" >
					<div class="deleteAlbum"><i class="fa fa-minus-square-o"> Update this album</i> </div>
					</a>';
		}
	}
	
	public function includes()
	{
		echo '<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700|Cookie" rel="stylesheet" type="text/css">
				<link rel="stylesheet" type="text/css" href="css/style.css">
				<link rel="stylesheet" type="text/css" href="css/smoothbox.css">
				<link rel="stylesheet" href="fontAwesome/css/font-awesome.min.css">
				<link rel="stylesheet" href="fontAwesome/css/font-awesome.css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
				<script src="scripts/jquery.carouFredSel-5.5.2.js" type="text/javascript"></script>
				<script type="text/javascript" src="scripts/jquery.easing.1.3.js"></script>
				<script type="text/javascript" src="scripts/jquery.form.js"></script> 
				<script type="text/javascript" src="scripts/scripts.js"></script>
				<script type="text/javascript" src="scripts/smoothbox.min.js"></script>
				<script type="text/javascript" src="scripts/smoothbox.js"></script> 
				<script type="text/javascript" src="scripts/functions.js"></script>';
	}
	
	public function printAlbums()
	{
		$this->albumsArray = photos::getAlbumsObject(); // Get the albums by name
		foreach ($this->albumsArray as $album)
		{
			
			$salbum = serialize($album); // Album serialized
			echo '<div class="item">';
			echo '<a href="work-template.php?album='.urlencode($salbum).'">';
			echo '<img  height="140"  src="'.$album->getImgMin().'" alt="'.$album->getDescription().'"></a><!-- Image must be 400px by 300px -->';
			echo '<h3>'.$album->getName().'</h3><!--Title-->';
			echo '<p>'.$album->getCategory().'</p><!--Category-->';
			echo ' </div><!--/item-->';
		}
		
		if( isset($_SESSION['user']) ) 
		{
			$user = unserialize($_SESSION['user']);
			if($user->getRang() > 1) // Comprovem el rang dels usuaris
			{
				echo '<a href="newAlbum.php">';
				echo '<div class="item add">';
				echo '<i class="fa fa-plus fa-5x plus"></i>';
				echo ' </div><!--/item--></a><!-- Image must be 400px by 300px -->';
			}
		}
	}
	
	private function deleteMediaButton($media)
	{
		if($this -> checkRangUser())
		{
			echo '<a href="operations/deleteMedia.php?media='.urlencode(serialize($media)).'" 
					class="deleteMediaLink"  onclick="return confirmar()">
					<div class="deletePhoto"><i class="fa fa-minus-square-o"></i> Delete </div>
					</a>';
			echo '<a href="updateMedia.php?media='.urlencode(serialize($media)).'">
					<div class="deletePhoto modifyLinkMedia"><i class="fa fa-refresh"></i> Update this photo </div>
					</a>';
		}
	}
	
	public function pringMediaAlbum($id)
	{
		$mediaArray = $this-> p -> getMediasAlbumObject($id);
		foreach ($mediaArray as $media)
		{
			echo '<div class="divImages">';
			$this -> deleteMediaButton($media);
			echo '<a class="sb" href="'.$media->getRoute().'" title="'.$media->getDescription().'"> 
					<img src="'.$media->getRoute().'" alt="'.$media->getName().'"> </a>';
			
			/* <!-- Use whatever images you like - they will automatically fit the width of the page -->*/
			echo '<h5>&ndash; '.$media->getDescription().'</h5>';
			echo '</br></br></br></br></br></br></br></br></br>';
			/*<!-- Image title -->*/
			echo '</div>';
		}
		if( isset($_SESSION['user']) )
		{
			$user = unserialize($_SESSION['user']);
			if($user->getRang() > 1) // Comprovem el rang dels usuaris
			{
				echo '<a href="newMedia.php?albumId='.$id.'">
				<i class="fa fa-plus fa-5x addPhotos"></i> ';
				echo '<h2></h2></a>';
				echo '</br></br></br></br></br></br></br></br></br>';
			}
		}
		
	}
	
	public function navigation()
	{
		$this->user = new User(null, null, null);
		if ($_SESSION['session'] >= 2)
		{
			$this->user = unserialize($_SESSION['user']);
			echo ' <nav>	<!-- Navigation Start -->
	            <ul>
	            	<li><a href="index.php#top">HOME</a></li>
	                <li><a href="index.php#about">About</a></li>
	                <li><a href="index.php#work">Work</a></li>
	                <li><a href="index.php#footer">Contact</a></li>
	             	<li><a href="index.php"><b>'.$this->user->getName().'</b><a></li>
	             	<li><a href="admin.php"><b>Administr.</b></a></li>
	                <li><a href="login/logout.php">Logout</a></li>
	            </ul>
	        </nav>	<!-- Navigation End -->';
		} else {   
			echo ' <nav>	<!-- Navigation Start -->
	            <ul>
	            	<li><a href="index.php#top">HOME</a></li>
	                <li><a href="index.php#about">About</a></li>
	                <li><a href="index.php#work">Work</a></li>
	                <li><a href="index.php#footer">Contact</a></li>
	                <li><a href="formUser.php">Login</a></li>
	            </ul>
	        </nav>	<!-- Navigation End -->';
		}
	}

	
}

?>