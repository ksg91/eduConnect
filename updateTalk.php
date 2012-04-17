<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
$user->addTalk($_POST['content'],$_POST['scope']);
header("Location:".ABS_PATH."/");
?>