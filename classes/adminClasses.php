<?php
class AdminPanel{
  var $user;
  function __construct($u)
  {
    $this->user=$u;
  }
  function getAdminMenu()
  {
    $menu="";
    if($this->user->perm>0)
    {
      $menu.='<div class="talk" style="min-height:0px;">';
      $menu.='<div class="container" style="background-color:#CACACA;">';
      $menu.='<div style="text-align:center;"><b>Forum Management</b></div></a>';
      $menu.='</div>';      
      $menu.="<a href=\"".ABS_PATH."/admin/addForum.php\"><div class=\"container\">";
      $menu.="<b>Add Forum</b>";
      $menu.='</div></a>';
      if($this->user->perm>1)
      {
        $menu.="<a href=\"".ABS_PATH."/admin/addForumSec.php\"><div class=\"container\">";
        $menu.="<b>Add Forum Section</b>";
        $menu.='</div></a>';
      }
      $menu.='</div>';  
      $menu.='<div class="talk" style="min-height:0px;">';
      $menu.='<div class="container" style="background-color:#CACACA;">';
      $menu.='<div style="text-align:center;"><b>Group Management</b></div></a>';
      $menu.='</div>';      
      $menu.="<a href=\"".ABS_PATH."/admin/addGroup.php\"><div class=\"container\">";
      $menu.="<b>Add Group</b>";
      $menu.='</div></a>';
      $menu.="<a href=\"".ABS_PATH."/admin/addGroupMem.php\"><div class=\"container\">";
      $menu.="<b>Add Group Member</b>";
      $menu.='</div></a>';
      $menu.="</div>";
      $menu.='<div class="talk" style="min-height:0px;">';
      $menu.='<div class="container" style="background-color:#CACACA;">';
      $menu.='<div style="text-align:center;"><b>Chatroom Management</b></div></a>';
      $menu.='</div>';      
      $menu.="<a href=\"".ABS_PATH."/admin/addChatroom.php\"><div class=\"container\">";
      $menu.="<b>Add Chatroom</b>";
      $menu.='</div></a>';
      $menu.="</div>";
      if($this->user->perm>2)
      {
        $menu.='<div class="talk" style="min-height:0px;">';
        $menu.='<div class="container" style="background-color:#CACACA;">';
        $menu.='<div style="text-align:center;"><b>College Management</b></div></a>';
        $menu.='</div>';      
        $menu.="<a href=\"".ABS_PATH."/admin/addStudent.php\"><div class=\"container\">";
        $menu.="<b>Add Student</b>";
        $menu.='</div></a>';
        if($this->user->perm>3)
        {
          $menu.="<a href=\"".ABS_PATH."/admin/addCollege.php\"><div class=\"container\">";
          $menu.="<b>Add College</b>";
          $menu.='</div></a>';
        }
        $menu.='</div>';
      }
    }
    return $menu;
  }
  function getForumManageMenu()
  {
  }
  function getGroupManageMenu()
  {
  }
  function getColManageMenu()
  {
  }
  function getStudentManageMenu()
  {
  }
}
?>