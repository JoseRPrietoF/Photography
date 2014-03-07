<?php 
require_once ('dades.php');
require_once ('album.php');
require_once ('Media.php');
ini_set("display_errors", "1"); // per mostrar els errors
class photos
{
	private $con;
	
	function __construct()
	{
		global $con;
		$this->con = $con;
	}
	
	function getAlbums()
	{
		$query = "SELECT nameAlbum FROM album";
		$result = $this->con->prepare($query);
		$result->execute();
		$result->bind_result($valor);
		$result->fetch();
		$row = array();
		$i = 0;
		do
		{
			$row[$i] = $valor;
			$i++;
		} while ($result->fetch());
		
		return $row; // return the array of albums
	}
	
	public static function getAlbumsObject()
	{
		global $con; // Fa la variable global de l'arxiu dades importat, la fa global
		$query = "SELECT * FROM album";
		$result = $con->query($query);
		$albums = array();
				
		while ( $row = $result->fetch_assoc() )
		{
			$album = new Album();
			$album->setId($row['IdAlbum']);
			$album->setName($row['nameAlbum']);
			$album->setRoute('albums/album' . $row['IdAlbum']);
			$album->setCategory($row['category']);
			$album->setDescription($row['Description']);
			$album->setImgMin('albums/album' . $row['IdAlbum'] . '/item.png');
			$albums[] = $album; // insert the object in the albums
		} 
		
		return $albums; // return the array of albums
	}
	
	public static function getAlbumObjectId($id)
	{
		global $con; // Fa la variable global de l'arxiu dades importat, la fa global
		$query = "SELECT * FROM album WHERE idAlbum=$id";
		$result = $con->query($query);
		$albums = array();
	
		while ( $row = $result->fetch_assoc() )
		{
			$album = new Album();
			$album->setId($row['IdAlbum']);
			$album->setName($row['nameAlbum']);
			$album->setRoute('albums/album' . $row['IdAlbum']);
			$album->setCategory($row['category']);
			$album->setDescription($row['Description']);
			$album->setImgMin('albums/album' . $row['IdAlbum'] . '/item.png');
		}
	
		return $album; // return the array of albums
	}

	
	function getAlbumID($nameAlbum) // Get the id of an album from his name
	{
		$nameAlbum = $this->con->real_escape_string($nameAlbum);
		$query = "SELECT idAlbum FROM album WHERE nameAlbum = '$nameAlbum' LIMIT 1";
		$result = $this->con->query($query);
		$id = $result->fetch_row();
		return $id[0];
	}
	
	function getMediaName($idMedia) // Get the id of an album from his name
	{
		$query = "SELECT nameMedia FROM media WHERE idMedia = '$idMedia' LIMIT 1";
		$result = $this->con->query($query);
		$id = $result->fetch_row();
		return $id[0];
	}
	
	function getAlbumIDfromRoute($route) // Get the id of an album from his name
	{
		$id = 0;
		$query = "SELECT idAlbum FROM album WHERE route = '$route'";
		$result = $this->con->prepare($query);
		$result->execute();
		$result->bind_result($id);
		$result->fetch();
		
		return $id;
		
	}
	
	function getMediasAlbum($albumName)
	{
		$albumID = $this->getAlbumID($albumName); // Get the id of album
		$query = "SELECT nameMedia FROM media WHERE idAlbum = $albumID";
		$names = array();
		
		if($result = $this->con->query($query))
		{
			while ( $row = $result -> fetch_assoc() )
			{
				$names[] = $row['nameMedia'];
			}
		}
		return $names; // return the array of photos
	}
	
	
	
	function getMediasAlbumObject($albumID)
	{
		global $con; // Fa la variable global de l'arxiu dades importat, la fa global
		$query = "SELECT * FROM media WHERE idAlbum = $albumID";
		$result = $con->query($query);
		$photos = array();
		while ( $row = $result->fetch_assoc() )
		{
			$photo = new Media();
			$photo->setId( $row['idMedia']);
			$photo->setName($row['nameMedia']);
			$photo->setIdAlbum($albumID);
			$photo->setDescription($row['description']);
			$photo->route(); 
			$photos[] = $photo; // insert the object in the photos array
		} 
		
		return $photos; // return the array of albums
	}
	
	function getMediaobject($mediaID)
	{
		global $con; // Fa la variable global de l'arxiu dades importat, la fa global
		$query = "SELECT * FROM media WHERE idMedia = $mediaID";
		$result = $con->query($query);
		while ( $row = $result->fetch_assoc() )
		{
			$media = new Media();
			$media->setId( $row['idMedia']);
			$media->setName($row['nameMedia']);
			$media->setIdAlbum($albumID);
			$media->setDescription($row['description']);
			$media->route();
		}
		return $media; // return the array of albums
	}
	
	function getMediasRoute($albumRoute)
	{
		$albumID = $this->getAlbumIDfromRoute($albumRoute); // Get the id of album
		$query = "SELECT nameMedia FROM media WHERE idAlbum = $albumID";
		$result = $this->con->prepare($query);
		$result->execute();
		$result->bind_result($valor);
		$result->fetch();
		$row = array();
		$i = 0;
		do
		{
			$row[$i] = $valor;
			$i++;
		} while ($result->fetch());

		return $row; // return the array of photos
	}
	
	public function redim($ancho, $alto, $ruta)
	{
		//Ruta de la imagen original
		$rutaImagenOriginal= $ruta;
		
		//Creamos una variable imagen a partir de la imagen original
		$img_original = imagecreatefromjpeg($rutaImagenOriginal);
		
		//Se define el maximo ancho y alto que tendra la imagen final
		$max_ancho = $ancho;
		$max_alto = $alto;
		
		//Ancho y alto de la imagen original
		list($ancho,$alto)=getimagesize($rutaImagenOriginal);
		
		//Se calcula ancho y alto de la imagen final
		$x_ratio = $max_ancho / $ancho;
		$y_ratio = $max_alto / $alto;
		

		//Si el ancho y el alto de la imagen no superan los maximos,
		//ancho final y alto final son los que tiene actualmente
		if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){//Si ancho
			$ancho_final = $ancho;
			$alto_final = $alto;
		}
		/*
		 * si proporcion horizontal*alto mayor que el alto maximo,
		* alto final es alto por la proporcion horizontal
		* es decir, le quitamos al ancho, la misma proporcion que
		* le quitamos al alto
		*
		*/
		elseif (($x_ratio * $alto) < $max_alto){
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
		}
		/*
		 * Igual que antes pero a la inversa
		*/
		else{
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
		}
		// Rediomensionamos la imagen proporcionalmente

		//Creamos una imagen en blanco de tamaño $ancho_final  por $alto_final .
		$tmp=imagecreatetruecolor($ancho_final,$alto_final);
		
		//Copiamos $img_original sobre la imagen que acabamos de crear en blanco ($tmp)
		imagecopyresampled($tmp,$img_original,0,0,0,0,$ancho_final, $alto_final,$ancho,$alto);
		
		//Se destruye variable $img_original para liberar memoria
		imagedestroy($img_original);
		
		// Guardamos
		
		//Definimos la calidad de la imagen final
		$calidad=95;
		//Se crea la imagen final en el directorio indicado
		imagejpeg($tmp,$ruta,$calidad);
		
		header('Location: ../index.php');
	}
	
	function insertItem($item,$album)
	{
		$idAlbum = $this->getAlbumID($album);
		$dst = '../albums/album' . $idAlbum . '/item.png'; // name
		if ( is_uploaded_file($item) ) {
			move_uploaded_file($item, $dst);
			$this -> redim(400,300,$dst);
		} else {
			echo "Posible problema en la subida de la imagen item.png. Fichero: " . $item ."<br>";
		}
	}

	
	function createAlbum($albumName, $category, $description, $item)
	{
		$albumName = $this->con->real_escape_string($albumName);
		$query = "INSERT INTO album (nameAlbum, category, Description) 
		VALUES ('$albumName','$category','$description')";
		
		if ($this->con->query($query) )
		{
			
			$route = '../albums/album'.$this->con->insert_id; // La ultima id que ha creat la BD
			if ( $this -> createDirectory($route) )
			{
				if( $this -> insertItem($item,$albumName))
					return true;
			}
				
		} else{
			echo '<script>alert("Este album ya existe");</script>'; // don't jump
			// not use this, is for the future ----------------------------------------------------------------------------
			return false;
		}
	}
	
	private function createDirectory($dir) 
	{ 

		if (! is_dir($dir) ) // If the dir not exists
		{
			if ( ! is_writable('.') ) {
				echo "No tengo permisos para escribir en el directorio actual.<br>
				Crea un directorio llamado ".$dir." en el directorio actual con permisos de escritura , ej mkdir ".$dir."; chmod 0777 ".$dir." <br>";
			}
			else 
			{
				if ( ! mkdir ($dir,0777) ) {
					echo "No he podido crear el directorio...<br>Saliendo";
					die("CRACK!");
				} else return true;
			} // writable
		} else // already exists
		{
			return false;
		}
	}
	
	function createAlbumAndMedias($album,$photos,$length)
	{
		//print_r($photos);
		$photoArray = array();
		if ( $this -> createAlbum($album) )
		{
			for($i=0; $i < $length; $i++)
			{
				$photoArray[0] = $photos['photo'.$i][0]; // tmp_name
				$photoArray[1] = $photos['photo'.$i][1]; // name
				print_r($photoArray);
				$this -> insertMedias($album,$photoArray); // CRIDAT A LA FUNCIO DE AVALL
				unset($photoArray);
			}
			
			header('Location: index.php');
		} return false;
	}
	
	function insertMedias($album,$mediaName,$name,$description,$realName) // Realname para coger la extension solo
	{
		$idAlbum = $album->getId();
		$name .= '.' . $this -> obtenerExtensionFichero($realName); // añadimos extension
		$dst = '../albums/album' . $idAlbum . '/' . $name; // name
		echo $dst;
		if ( is_uploaded_file($mediaName) ) {
			move_uploaded_file($mediaName, $dst);
			if ($this -> insertMediasDB ( $idAlbum, $name, $description )){
				header('Location: ../index.php');
			}//album and name
				else echo "Posible problema en la subida a la BD. Fichero: " . $name."<br>";
		} else {
			echo "Posible problema en la subida. Fichero: " . $name."<br>";
		}
	}
	
	function obtenerExtensionFichero($str)
	{
		return end(explode(".", $str));
	}
	
	
	private function insertMediasDB($idAlbum,$photoName, $description)
	{
		$query = "INSERT INTO media (nameMedia, idAlbum, description) VALUES ('$photoName', '$idAlbum', '$description')";
		if ( $this->con->query($query) )return true;
		return false;
	}
	
	function deleteMedia($Media)
	{
		$this -> deleteRealMedia($Media);
		$this -> deleteMediaDB($Media);
	}
	
	private function deleteMediaDB($Media) 
	{
		$query = "DELETE FROM media WHERE idMedia = ".$Media->getId();
		if ($this->con->query($query) )
		{
			return true;	
		} else{
			echo '<script>alert("Error al borrar la foto en la DB");</script>'; // 
			return false;
		}
	}
	
	private function deleteRealMedia($Media) 
	{
		echo $Media->getRoute();
		if ( unlink( '../'.$Media->getRoute() ))
		{
			return true;	
		} else{
			echo '<script>alert("Error al borrar la foto");</script>'; // 
			return false;
		}
		
	}
	function deleteAlbum($album)
	{
		if ($this -> deleteRealAlbum($album) && $this -> deleteAlbumDB($album)){
			header('Location: ../index.php');
		}
			
	}
	
	private function deleteAlbumDB($album) 
	{
		$query = "DELETE FROM album WHERE idAlbum = ".$album->getId();
		if ($this->con->query($query) )
		{
			$query = "DELETE FROM media WHERE idAlbum = ".$album->getId();
			if ( $this->con->query($query) )
				return true;
			else
				echo '<script>alert("Error al borrar las fotos en la DB");</script>'; // 
		} else{
			echo '<script>alert("Error al borrar el album en la DB");</script>'; // 
			return false;
		}
	}
	
	private function deleteRealAlbum($album) 
	{
		if ( $this->eliminarDir($album) )
		{
			return true;	
		} else{
			echo '<script>alert("Error al borrar el album");</script>'; // 
			return false;
		}
		
	}
	
	function eliminarDir($album)
	{
		$carpeta = '../' . $album -> getRoute();
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
			echo $archivos_carpeta;
			 
			if (is_dir($archivos_carpeta))
				$this -> eliminarDir($archivos_carpeta);
			else
				unlink($archivos_carpeta);
		}
		if( rmdir($carpeta) )
			return true;
		return false;
	}
	
	function updateMedia($name, $description, $media){
		$query = 'UPDATE media SET name = "'.$name.'", description = "'.$description.'"
				WHERE idMedia = '.$media->getId();
		if ($this->con->query($query) )
		{
			if ( $this->con->query($query) )
				return true;
			else
				echo '<script>alert("Error al modificar las fotos en la DB");</script>'; //
		} else{
		echo '<script>alert("Error al modificar el album en la DB");</script>'; //
		return false;
		}
	}
	
}
?>
