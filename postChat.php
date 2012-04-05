<?php
include ("classes/includes.php");
$user=new User($_SESSION['id']);
echo $user->postToChat($_POST['content'],$_GET['id']);
//echo mysql_error();
header("Location:".ABS_PATH."/chatroom.php?id=".$_GET['id']);
?>