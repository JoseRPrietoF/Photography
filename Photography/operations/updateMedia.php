<?php
require_once ('../template.php');
require_once ('../dades.php');
require_once ('../user.php');
ini_set("display_errors", "1"); // per mostrar els errors

$p = new photos();
$t = new Template();
$t -> checkRang();
$media = unserialize($_SESSION['media']);
if (isset($_POST['name']) && $_POST['name'] != ""){
	$name = $_POST['name'];
} else $name = $media -> getName();
if (isset($_POST['description']) && $_POST['description'] != ""){
	$description = $_POST['description'];
} else $description = $media -> getDescription();


$p->updateMedia($name, $description, $media);
header('Location: ../index.php');
?>