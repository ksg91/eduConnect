<?php
class HtmlHeads
{
  var $title,$header;
  function __construct($title="eduConnect")
  {
    $this->title=$title;
  }
  function putHead()
  {
    echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo "<head>";
    echo "<title>".$this->title."</title>";
    echo "<link rel=\"stylesheet\" href=\"resource/main.css\" />";
    echo "</head>";
  }
  function setTitle($title)
  {
    $this->title=$title;
  }
  function addToHeader($header)
  {
    $this->header=($this->header).($header);
  }
  function putFooter()
  {
    
    echo "<div id=\"footer\">";
    echo "<h3 style=\"color: #CCCCCC;text-align:center;\">&copy; eduConnect Team</span>";
    echo "</div>";
    echo "</body>";
  }
}
?>