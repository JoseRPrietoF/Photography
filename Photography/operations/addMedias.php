<?php
require_once ('../template.php');
require_once ('../dades.php');
require_once ('../user.php');
ini_set("display_errors", "1"); // per mostrar els errors

$p = new photos();
$t = new Template();
$t -> checkRang();
$album = unserialize($_SESSION['album']);
$name = $_POST['name'];
$description = $_POST['description'];
$media = $_FILES['media']['tmp_name'];




// $photoArray = array();
// $photos[] = $photo;

///// INSERT PHOTO 
$p->insertMedias($album,$media,$name,$description);
?>