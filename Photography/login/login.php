<?php
require_once ('../dades.php');
require_once ('../user.php');
require_once ('logUser.php');
ini_set("display_errors", "1"); // per mostrar els errors
$lu = new logUser();
$boto = $_POST['boto'];
$mail = $_POST['mail'];
$password = $_POST['psw'];
$lu -> formSession($boto, $mail, $password);
?>