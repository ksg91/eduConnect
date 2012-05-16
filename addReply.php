<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
$user->addReply($_GET['id'],$_POST['content']);
header("Location:".ABS_PATH."/topic.php?id=".$_GET['id']);
?>