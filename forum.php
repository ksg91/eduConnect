<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/forums.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$id=$_GET['id'];
$pg=(isset($_GET['pg'])?$_GET['pg']:1);
$html->putHead();
$forumSys=new ForumSys($user);
$forums=new Forum($id,$user);
$layout=new LayoutStruct($forums->getAddTopicForm().$forums->getFormattedTopics(($pg-1)*20));
$layout->addWidget($forumSys->getForumSysWidget());
$layout->putFrame();
?>