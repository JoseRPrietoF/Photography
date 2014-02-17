<?php 
require_once ('../dades.php');
require_once ('../user.php');
require_once ('logUser.php');
ini_set("display_errors", "1"); // per mostrar els errors

$lu = new logUser();
$mail = $_POST['mail'];
if (!isset($mail))
	header('Location: ../formUser.php');
$password = $_POST['psw'];
if (!isset($password))
	header('Location: ../formUser.php');
$name = $_POST['name'];
if (!isset($name))
	header('Location: ../formUser.php');
$lastname = $_POST['lastname'];
if (!isset($lastname))
	$lastname = '';
$sex = $_POST['sex'];
$birthday = $_POST['birthday'];

if($lu -> createFullUser($mail, $password, $name, $lastname, $sex, $birthday))
{
	$_SESSION['session'] = 2;
	$user = $lu->createUserObject($mail);
	$_SESSION['user'] = serialize($user); // Logged in
	header('Location: ../index.php');
}
else {
	$_SESSION['session'] = -5;
	//echo "User already exists";
	header('Location: ../formUser.php');
}

?>