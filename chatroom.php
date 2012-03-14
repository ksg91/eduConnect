<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/chatroom.php?id=".$_GET['id']);
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
$id=$_GET['id'];
$chatroom=new Chatroom($id);
$content=$chatroom->getChatPostForm();
$content.=$chatroom->getFormattedChatPosts();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>