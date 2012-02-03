<?php
include ("classes/includes.php");
$html=new HtmlHeads();
$html->putHead();
$layout=new LayoutStruct("This IS LEFT","THIS IS RIGHT");
$layout->putFrame();
?>