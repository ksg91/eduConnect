<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
$user->addTopic($_GET['id'],$_POST['title'],$_POST['content']);
header("Location:".ABS_PATH."/forum.php?id=".$_GET['id']);
?>