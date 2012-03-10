<?php
include ("classes/includes.php");
$login=new Login($_POST['email'],md5($_POST['pw']),$_POST['remember']);
if($login->doLogin())
{
  if(isset($_GET['redTo']))
    header("Location:".$_GET['redTo']);
  else
    header("Location:".ABS_PATH."/");
}
?>