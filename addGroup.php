<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/addForum.php");
$html=new HtmlHeads();
$hod=new HOD($_SESSION['id']);
$html->putHead();
$admin=new AdminPanel($hod);
if(isset($_POST['name']))
  $hod->addGroup($_POST['name']);
$content=$admin->getAddGroupForm();
$layout=new LayoutStruct($content);
$layout->addWidget($hod->getProfileWidget());
$layout->addWidget($hod->getStatusPaneWidget());
$layout->putFrame();
?>