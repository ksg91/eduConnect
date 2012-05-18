<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/adminMenu.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
$admin=new AdminPanel($user);
$content=$admin->getAdminMenu();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>