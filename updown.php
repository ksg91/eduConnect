<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
$user->addUpDowns($_GET['action'],$_GET['talk'],$_GET['id']);
mysql_error();
header("Location:".ABS_PATH."/");
?>