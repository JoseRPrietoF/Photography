<?php 
require_once ('dades.php');	
require_once ('photos.php');
ini_set("display_errors", "1"); // per mostrar els errors
$p = new photos();
$albumsArray = photos::getAlbumsObject(); // Get the albums by name
$thefirst = true;
?>			
<li id="page_Portfolio">
	<div class="box1">
		<div class="inner">
			<a href="#" class="close" data-type="close"><span></span></a>
			<div class="wrapper tabs">
				<div class="col1">
					<h2>Categories</h2>
					<ul class="nav">
						<?php 
						//~ if ( isset($user))
							//~ echo $user->getRang();
						foreach ($albumsArray as $album)
						{
							if($thefirst)
							{
								echo '<li class="selected"><a href="#album_'.$album->id.'"><span></span><strong>'.$album->name.'</strong></a></li>';
								$thefirst = false;
							}
							else
							{
								echo '<li><a href="#album_'.$album->id.'"><span></span><strong>'.$album->name.'</strong></a></li>';
							}
						}
						if ( $_SESSION['session'] > 1 && $user->getRang() > 1)
						{
							echo "<li><a href='#createAlbum'><span></span>Create</a></li>";
						}
						?>
					</ul>
				</div>
			
			<div class="col2 pad_left1">
				<?php  // Get the route of albums(already time)
				foreach ($albumsArray as $album) 
				{
					$photosArray = $p -> getPhotosAlbumObject($album->id);
					echo '<div class="tab-content" id="album_'.$album->id.'">';
					echo '<h2>'.$album->name.'</h2>';
					$side = true;
					foreach ($photosArray as $photo)
					{
						if( $side == true )
						{
							echo '<div class="wrapper">';
							
							echo '<figure class="left marg_right1"><a href="albums/album'.$album->id. '/' . $photo->name . '" class="lightbox-image" data-type="prettyPhoto[group2]">
							<span></span><img src="albums/album'.$album->id. '/' . $photo->name . '" width="202" height="128" alt="" ></a></figure>';
							if (  $_SESSION['session'] > 1 && $user->getRang() > 1 )
								echo '<a href="deletePhoto.php?photo='.urlencode(serialize($photo)).'" class="deletePhotoLink">
								<div class="deletePhoto left"><i class="fa fa-minus-square-o"></i> </div>
								</a>';
							
							$side = false;
						} else {
						
							echo '<figure class="left"><a href="albums/album'.$album->id. '/' . $photo->name . '" class="lightbox-image" data-type="prettyPhoto[group2]">
							<span></span><img src="albums/album'.$album->id. '/' . $photo->name . '" alt="" width="202" height="128"></a></figure>';
							if (  $_SESSION['session'] > 1 && $user->getRang() > 1 )
								echo '<a href="deletePhoto.php?photo='.urlencode(serialize($photo)).'" class="deletePhotoLink">
								<div class="deletePhoto right"> <i class="fa fa-minus-square-o"></i></div>
								</a>';
							
							echo '</div>';
							$side = true;
						}
						
					} 
					if($side == false)
					{
						if (  $_SESSION['session'] > 1 && $user->getRang() > 1 )
						{
							echo '<figure class="left">
							<a href="addPhotosGet.php?album='.urlencode(serialize($album)).'">
							<i class="fa fa-plus-square fa-4"> Add photos</i>
							</a></figure>';
						}
						
						echo '</div>';
						
					} else {
						echo '<div class="wrapper">';
						if (  $_SESSION['session'] > 1 && $user->getRang() > 1 )
						{
							echo '<figure class="left marg_right1">
							<a href="addPhotosGet.php?album='.urlencode(serialize($album)).'">
							<i class="fa fa-plus-square fa-4"> Add photos</i>
							</a></figure>';
						}
						
						echo '</div>';
					}
					///////////--------------------------------------------------- DELETE ALBUM
					if (  $_SESSION['session'] > 1 && $user->getRang() > 1 )
					{
						echo '</br></br></br></br>';
						echo '<div class="wrapper">';
						echo '
						<a href="deleteAlbum.php?album='.urlencode(serialize($album)).'">
						<i class="fa fa-minus-square"> Delete album</i>
						<div class="deleteAlbum"> </div></a>';
						echo '</div>';
					}
					///////////--------------------------------------------------- DELETE ALBUM
					
					echo '</div>'; // div album
				}
				
				?>
				
				<div class='tab-content' id='createAlbum'>
					<h2>Create a new Album</h2>
					<div class="wrapper">
						</br></br>
						<form action="forms.php" method="post" enctype="multipart/form-data" >
							<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
							<b><strong>New Album: </strong></b>
							<input type='text' name='album' id='album' /> <br/>
							</br></br>
							<b>Insert an Image: </b>
							<input name="photo0" type="file">
							</br></br>
							<b>Insert an Image: </b>
							<input name="photo1" type="file">
							</br></br>
							<b>Insert an Image: </b>
							<input name="photo2" type="file">
							</br></br></br></br>
							<input type="submit" value="Continue" name="continue">
						</form>
					</div>
				</div>
				

				
		</div>
	</div>
</div>
</div>
</li>

