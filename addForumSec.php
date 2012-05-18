<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/addForum.php");
$html=new HtmlHeads();
$principal=new Principal($_SESSION['id']);
$html->putHead();
$admin=new AdminPanel($principal);
if(isset($_POST['name']))
  $principal->addForumSection($_POST['name']);
$content=$admin->getAddForumSecMenu();
$layout=new LayoutStruct($content);
$layout->addWidget($principal->getProfileWidget());
$layout->addWidget($principal->getStatusPaneWidget());
$layout->putFrame();
?>