<?php
class Login {
  private $email, $pw;
  var $remember;
  function __construct($email,$pw,$remember)
  {
    $this->email=trim($email);
    $this->pw=trim($pw);
    $this->remember=$remember;
  }
  function isValidLogin()
  {
    if(strlen($this->email)==0 || strlen($this->pw)==0){
      return false;
    }
    $rpw=mysql_result(mysql_query("SELECT pass FROM `users` WHERE `email`='".$this->email."'"),0);
    if($rpw==$this->pw)
      return true;
    else {
      return false;
    }
  }
  function doLogin()
  {
    if($this->isValidLogin())
    {
      if($this->remember)
        $this->setLoginCookies();
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
  public static function getUidByEmail($email)
  {
    return mysql_result(mysql_query("SELECT id FROM users WHERE email='".$email."'"),0);    
  } 
  public static function requireLogin($redTo)
  {
    if(!(UtilClass::isLoggedIn()))
    {
      if(isset($_COOKIE['email']) && isset($_COOKIE['pw']))
        header("Location:".ABS_PATH."/autoLogin.php?redTo=".urlencode($redTo));
      else
        header("Location: ".ABS_PATH."/login.php?redTo=".urlencode($redTo));
    }
  }
  public static function isLoggedIn()
  {
    if($_SESSION['loggedIn'])
      return true;
    else
      return false;
  }
}
?>
