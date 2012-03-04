<?php
include ("classes/includes.php");
$login=new Login($_COOKIE['email'],$_COOKIE['pw'],1);
if($login->doLogin())
{
  if(isset($_GET['redTo']))
    header("Location:".$_GET['redTo']);
  else
    header("Location:".ABS_PATH."/");
}
?>