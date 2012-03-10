<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/index.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$target=new User($_GET['id']);
$html->putHead();
$talks=new Talks("","",0,$_GET['id']);
$content=$talks->getFormattedTalks();
$layout=new LayoutStruct($content);
$layout->addWidget($target->getProfileWidget());
$layout->addWidget($target->getActionWidget());
$layout->putFrame();
?>