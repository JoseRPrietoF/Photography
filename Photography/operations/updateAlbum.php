<?php
require_once ('../template.php');
require_once ('../dades.php');
require_once ('../user.php');
ini_set("display_errors", "1"); // per mostrar els errors

$p = new photos();
$t = new Template();
$t -> checkRang();
$album = unserialize($_SESSION['album']);
if (isset($_POST['nameAlbum']) && $_POST['nameAlbum'] != ""){
	$name = $_POST['nameAlbum'];
} else $name = $album -> getName();
if (isset($_POST['category']) && $_POST['category'] != ""){
	$category = $_POST['category'];
} else $category = $album -> getCategory();
if (isset($_POST['description']) && $_POST['description'] != ""){
	$description = $_POST['description'];
} else $description = $album -> getDescription();
if (isset($_FILES['item']['tmp_name']) && $_FILES['item']['tmp_name'] != ""){
	$item = $_FILES['item']['tmp_name'];
} else $item = false;


$p->updateAlbum($name, $category, $description, $item, $album);
//header('Location: ../index.php');
?>