<div class="login">
	<?php
	// THIS FILE IS ADDED IN ROOT DIRECTORY ------------------------------------------------------
	// ------------------------------------------------------------------------------------------- 
	require_once ('dades.php');
	require_once ('user.php');
	ini_set("display_errors", "1"); // per mostrar els errors
	if( isset( $_SESSION['user'] ) )
	{
		$user = $_SESSION['user'];
		$user = unserialize( $user );
	} else $user = new User(null,null,null);
	//~ echo $_SESSION['session']; 
	echo '<form action="login/createUser.php" method="post" >';
	if ( $_SESSION['session'] <= 1) { ?>
	
		<h4> Name: </h4>
		<input type='text' name='name' id='Name' /> 
		<br/><br/>
			
		<h4> Lastname: </h4>
		<input type='text'   name='lastname' id='lastname'/>
		<br/><br/>
		
		<h4> Sex: </h4>
		<select name='sex' id='sex'>
			 <option value='male'>Male</option> 
   			 <option value='female'>Female</option> 
		</select>
		<br/><br/>
			
		<h4> Birthday: </h4>
		<input type='date'  max='2014-01-01' name='birthday' id='birthday'>
		<br/><br/>
	
		<h4> Mail: </h4>
		<input type='text' name='mail' id='mail' /> <br/>
			
		<h4> Password: </h4>
		<input type='password'   name='psw' id='psw'/>
		<br/><br/>
		<input class="button" type="submit" value="New User" name="boto">
		<div class="error">
		<?php if( $_SESSION['session'] == -5) echo "<br/>This user already exists";
		?>
		</div>
		<?php 
	} else {
		echo "<h3>User: </h3> " . $user->getMail(); 
		?>
		<br/>
		<input class="button" type="submit" value="Logout" name="boto">
		<?php
	}
	?>
	</form>
</div>
