<?php
class HtmlHeads
{
  var $title;
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
    echo "<link rel=\"stylesheet\" href=\"style/main.css\" />";
    echo "</head>";
  }
}
?>