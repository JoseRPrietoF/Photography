<div class="login">
	<?php
	require_once ('dades.php');
	require_once ('user.php');
	ini_set("display_errors", "1"); // per mostrar els errors
	if( isset( $_SESSION['user'] ) )
	{
		$user = $_SESSION['user'];
		$user = unserialize( $user );
	} else $user = new User(null,null,null);
	//echo $_SESSION['session']; 
	echo '<form action="login/login.php" method="post" >';
	if ( $_SESSION['session'] <= 1) { ?>
		<h4> Mail: </h4>
		<input type='text' name='mail' id='mail' /> <br/>
			
		<h4> Password: </h4>
		<input type='password'   name='psw' id='psw'/>
		<br/>
		<br/>
		<input class="button" type="submit" value="Login" name="boto">
		
		<?php if( $_SESSION['session'] == 0) echo '<div class="error"><br/>Incorrect user or password</div>';
				else if( $_SESSION['session'] == -5) echo '<div class="error"><br/>This user already exists</div>';
	
	} else {
		echo "<h3>User: </h3> " . $user->getMail(); 
		?>
		<br/>
		<input class="button" type="submit" value="Logout" name="boto">
		<?php
	}
	?></form>
</div>

<?php
	
	
?>
