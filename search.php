<?php
include ("classes/includes.php");
//UtilClass::requireLogin(ABS_PATH."/search.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
$search=new Search($_POST['criteria']);
$content=$search->getResults();
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>