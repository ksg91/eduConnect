<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/index.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$id=(isset($_GET['id']))?$_GET['id']:"0";
$html->putHead();
$talk=new Talk($id);
$content=$talk->getFormattedTalk();
$content.=$talk->getCommentForm();
$content.=$talk->getFormattedComments();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>