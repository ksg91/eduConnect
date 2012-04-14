<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/chats.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
$chat=new Chat($user);
$content=$chat->getFormattedChatroomList();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>