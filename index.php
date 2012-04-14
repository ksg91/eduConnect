<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/index.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$scope=(isset($_GET['scope']))?$_GET['scope']:"0";
$html->putHead();
$talks=new Talks($user,$scope,0);
$content=$talks->getTalkUpdateForm();
$content.=$talks->getFormattedTalks();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->addWidget($talks->getTalksScopeWidget());
$layout->putFrame();
?>