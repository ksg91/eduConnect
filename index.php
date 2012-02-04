<?php
include ("classes/includes.php");
$html=new HtmlHeads();
$html->putHead();
$layout=new LayoutStruct("This is contents");
$layout->addWidget("<h2>How are you</h2>This is a widget");
$layout->addWidget("<h2>How are you</h2>This is second widget + widget");
$layout->putFrame();
?>