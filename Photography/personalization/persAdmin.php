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
if (isset($_POST['about_me_title']) && $_POST['about_me_title'] != ""){
	$about_me_title = $_POST['about_me_title'];
	$tper -> about_me_title = $about_me_title;
}
if (isset($_POST['my_work_title']) && $_POST['my_work_title'] != ""){
	$my_work_title = $_POST['my_work_title'];
	$tper -> my_work_title = $my_work_title;
}
if (isset($_POST['my_work_text']) && $_POST['my_work_text'] != ""){
	$my_work_text = $_POST['my_work_text'];
	$tper -> my_work_text = $my_work_text;
}
if (isset($_POST['bottom']) && $_POST['bottom'] != ""){
	$bottom = $_POST['bottom'];
	$tper -> bottom = $bottom;
}
if (isset($_POST['googleP']) && $_POST['googleP'] != ""){
	$googleP = $_POST['googleP'];
	$tper -> googleP = $googleP;
}
if (isset($_POST['facebook']) && $_POST['facebook'] != ""){
	$facebook = $_POST['facebook'];
	$tper -> facebook = $facebook;
}
if (isset($_POST['twitter']) && $_POST['twitter'] != ""){
	$twitter = $_POST['twitter'];
	$tper -> twitter = $twitter;
}
if (isset($_POST['youtube']) && $_POST['youtube'] != ""){
	$youtube = $_POST['youtube'];
	$tper -> youtube = $youtube;
}

$tper -> modifyJson();

header('Location: ../admin.php');

?>