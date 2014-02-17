<?php
require_once ('../template.php');
require_once ('../dades.php');
require_once ('../user.php');
ini_set("display_errors", "1"); // per mostrar els errors
$p = new photos();
$t = new Template();
$t -> checkRang();
$nameAlbum = $_POST['nameAlbum'];
$category = $_POST['category'];
$description = $_POST['Description'];
$item = $_FILES['item']['tmp_name'];

$p -> createAlbum($nameAlbum, $category, $description, $item);
?>