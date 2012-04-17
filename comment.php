<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
$user->addComment($_GET['id'],$_POST['content']);
header("Location:".ABS_PATH."/talk.php?id=".$_GET['id']);
?>