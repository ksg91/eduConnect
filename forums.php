<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/forums.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
$forumSys=new ForumSys();
//$content=$chat->getFormattedChatroomList();
$layout=new LayoutStruct($forumSys->getForumSysContent());
$layout->addWidget($forumSys->getForumSysWidget());
$layout->putFrame();
?>