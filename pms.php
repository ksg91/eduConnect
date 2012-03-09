<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/index.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
$pms=new PMs($_SESSION['id'],0);
$content=$pms->getFormattedPMs();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>