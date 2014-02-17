<?php
require_once ('../dades.php');
$_SESSION['session'] = -1;
session_destroy();
header('Location: ../index.php');
?>