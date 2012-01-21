<?php
class DatabaseCon {
  private $un,$pw,$host,$database;
  var $con;
  function __construct($host="localhost",$un="root",$pw="",$database="educonnect")
  {
    $this->un=$un;
    $this->pw=$pw;
    $this->host=$host;
    $this->database=$database;
  } 
  function connect()
  {
    $this->con=mysql_connect($this->host,$this->un,$this->pw);
    if(!$this->con)
    {
      header("Location: tempdown.php");
    }
    mysql_select_db($this->database);
  } 
  function close()
  {
    mysql_close($this->con);
  }
}
?>
