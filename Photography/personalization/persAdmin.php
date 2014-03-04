<?php
require_once ('../template.php');
require_once ('../dades.php');
require_once ('../user.php');
require_once ('Template_Personalization.php');
ini_set("display_errors", "1"); // per mostrar els errors

$p = new photos();
$t = new Template();
$t -> checkRang();
$tper = new T_Personalization();

if (isset($_POST['title_page']) && $_POST['title_page'] != ""){
	$title_page = $_POST['title_page'];
	$tper -> title_page = $title_page;
}
if (isset($_POST['header1']) && $_POST['header1'] != ""){
	$header1 = $_POST['header1'];
	$tper -> header1 = $header1;
}
if (isset($_POST['header2']) && $_POST['header2'] != ""){
	$header2 = $_POST['header2'];
	$tper -> header2 = $header2;
}

$tper -> modifyJson();

header('Location: ../admin.php');

?>