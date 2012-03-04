<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
$user->addTalk($_POST['content']);
header("Location:".ABS_PATH."/");
?>