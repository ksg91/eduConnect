<?php
class Group
{
  var $id, $name;
  function __construct($id)
  {
    $this->id=$id;
    $this->name=mysql_result(mysql_query("SELECT name FROM perm_group WHERE id=".$id),0);
  }
  function isMember($user)
  {
    $c=mysql_result(mysql_query("SELECT COUNT(*) FROM perm_member WHERE id=".$user->id." AND perm_id=".$this->id),0);
    if($c>0)
      return true;
    else
      return false;
  }
}
?>