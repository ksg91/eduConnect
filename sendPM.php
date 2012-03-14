<?php
include ("classes/includes.php");
UtilClass::requireLogin(ABS_PATH."/index.php");
$html=new HtmlHeads();
$user=new User($_SESSION['id']);
$html->putHead();
if(isset($_GET['action']))
{
  if($_GET['action']=="send")
  {
    if($user->sendPM($_GET['to'],$_POST['content']))
      $content="<div class=\"talks container\">PM sent successfully.</div>";
  }
}
$content.=PMs::getSendPMForm($_GET['to']);
$layout=new LayoutStruct($content);
$layout->addWidget($user->getProfileWidget());
$layout->addWidget($user->getStatusPaneWidget());
$layout->putFrame();
?>