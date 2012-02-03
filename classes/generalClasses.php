<?php
class Login {
  private $email, $pw;
  var $remember;
  function __construct($email,$pw,$remember)
  {
    $this->email=mysql_real_string_escape($email);
    $this->pw=$pw;
    $this->remember=$remember;
  }
  function isValidLogin()
  {
    $rpw=mysql_result(mysql_query("SELECT pass FROM `users` WHERE `email`='".$this->email."'");
    if($rpw==$pw)
      return true;
    else 
      return false;
  }
  function doLogin()
  {
    if(this->isValidLogin())
    {
      if($this->remember)
        setLoginCookies();
      $_SESSION['loggedIn']=true;
      $_SESSION['email']=$this->email;
      $_SESSION['lastaction']=date();
      $_SESSION['sess_id']=session_id();
      $_SESSION['id']=UtilClass::getUidByEmail($this->email);
      return true;
    }
    else 
      return false;
  }
  function setLoginCookies()
  {
    setcookie("email",$this->email,time()+604800);
    setcookie("pw",$this->pw,time()+604800);
  }
}
class UtilClass
{
  public static getUidByEmail($email)
  {
    return mysql_result(mysql_query("SELECT id FROM users WHERE email='".$email."'"),0);    
  } 
  public static requireLogin($redTo)
  {
    if(!UtilFunctions::isLoggedIn())
    {
      if(isset($_COOKIE['email']&&isset($_COOKIE['pw'])))
        header("Location:".ABS_PATH."/autoLogin.php?redTo=".urlencode($redTo));
      else
        header("Location: ".ABS_PATH."login.php?redTo=".urlencode($redTo));
    }
  }
  public static isLoggedIn()
  {
    if($_SESSION['loggedIn'])
      return true;
    else
      return false;
  }
}
?>