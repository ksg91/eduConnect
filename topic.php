<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/topic.php?id=".$_GET['id']);
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$id=$_GET['id'];
$pg=(isset($_GET['pg'])?$_GET['pg']:1);
$html->putHead();
$forumSys=new ForumSys($user);
$topic=new Topic($_GET['id']);
$layout=new LayoutStruct($topic->getTopicPost().$topic->getFormattedReplies(($pg-1)*20).$topic->getAddReplyForm());
$layout->addWidget($forumSys->getForumSysWidget());
$layout->putFrame();
?>