<?php
require_once ('../template.php');
require_once ('../dades.php');
require_once ('../user.php');
ini_set("display_errors", "1"); // per mostrar els errors

$p = new photos();
$t = new Template();
$t -> checkRang();
$album = unserialize($_GET['album']);

$p->deleteAlbum($album);
?>