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
      $menu.="<a href=\"".ABS_PATH."/addForum.php\"><div class=\"container\">";
      $menu.="<b>Add Forum</b>";
      $menu.='</div></a>';
      if($this->user->perm>1)
      {
        $menu.="<a href=\"".ABS_PATH."/addForumSec.php\"><div class=\"container\">";
        $menu.="<b>Add Forum Section</b>";
        $menu.='</div></a>';
      }
      $menu.='</div>';  
      $menu.='<div class="talk" style="min-height:0px;">';
      $menu.='<div class="container" style="background-color:#CACACA;">';
      $menu.='<div style="text-align:center;"><b>Group Management</b></div></a>';
      $menu.='</div>';      
      $menu.="<a href=\"".ABS_PATH."/addGroup.php\"><div class=\"container\">";
      $menu.="<b>Add Group</b>";
      $menu.='</div></a>';
      $menu.="<a href=\"".ABS_PATH."/addMember.php\"><div class=\"container\">";
      $menu.="<b>Add Group Member</b>";
      $menu.='</div></a>';
      $menu.="</div>";
      $menu.='<div class="talk" style="min-height:0px;">';
      $menu.='<div class="container" style="background-color:#CACACA;">';
      $menu.='<div style="text-align:center;"><b>Chatroom Management</b></div></a>';
      $menu.='</div>';      
      $menu.="<a href=\"".ABS_PATH."/addChatroom.php\"><div class=\"container\">";
      $menu.="<b>Add Chatroom</b>";
      $menu.='</div></a>';
      $menu.="</div>";
      if($this->user->perm>2)
      {
        $menu.='<div class="talk" style="min-height:0px;">';
        $menu.='<div class="container" style="background-color:#CACACA;">';
        $menu.='<div style="text-align:center;"><b>College Management</b></div></a>';
        $menu.='</div>';      
        $menu.="<a href=\"".ABS_PATH."/addUser.php\"><div class=\"container\">";
        $menu.="<b>Add User</b>";
        $menu.='</div></a>';
        if($this->user->perm>3)
        {
          $menu.="<a href=\"".ABS_PATH."/addCollege.php\"><div class=\"container\">";
          $menu.="<b>Add College</b>";
          $menu.='</div></a>';
        }
        $menu.='</div>';
      }
    }
    return $menu;
  }
  function getAddForumMenu()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<b>Add Forum</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addForum.php\" method=\"post\">";
    $form.="<b>Name:<br /></b><input type=\"text\" name=\"name\" size=110 /><br />";
    //$form.="<div class=\"container\">";
    $form.="<b>Forum Section:</b><br />";
    $form.="<select name=\"sec_id\">";
    $f=new ForumSys($this->user);
    foreach($f->forumSec as $value)
      $form.="<option value=".$value->id.">".$value->name."</option>";
    $form.="</select>";
    $form.="<br /><b>Permission Group:</b><br />";
    $form.="<select name=\"g_id\">";
    $form.="<option value=0>All</option>";
    $gr=mysql_query("SELECT id,name FROM perm_group");
    while($g=mysql_fetch_array($gr))
      $form.="<option value=".$g[0].">".$g[1]."</option>";
    $form.="</select>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</form></div></div>";
    return $form;
  }
  function getAddForumSecMenu()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<b>Add Forum Section</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addForumSec.php\" method=\"post\">";
    $form.="<b>Name:<br /></b><input type=\"text\" name=\"name\" size=110 /><br />";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</form></div></div>";
    return $form;
  }
  function getAddGroupForm()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<b>Add Group</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addGroup.php\" method=\"post\">";
    $form.="<b>Name:<br /></b><input type=\"text\" name=\"name\" size=110 /><br />";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</form></div></div>";
    return $form;
  }
  function getAddMemberForm()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<b>Add Member</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addMember.php\" method=\"post\">";
    $form.="<b>User:</b><br />";
    $form.="<select name=\"stu\">";
    $u=mysql_query("SELECT id,name FROM users");
    while($s=mysql_fetch_array($u))
      $form.="<option value=".$s[0].">".$s[1]."</option>";
    $form.="</select>";
    //$form.="<div class=\"container\">";
    $form.="<b>Group:</b><br />";
    $form.="<select name=\"g_id\">";
    $gr=mysql_query("SELECT id,name FROM perm_group");
    while($g=mysql_fetch_array($gr))
      $form.="<option value=".$g[0].">".$g[1]."</option>";
    $form.="</select>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</form></div></div>";
    return $form;
  }
  function getAddChatroomForm()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<b>Add Chatroom</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addChatroom.php\" method=\"post\">";
    $form.="<b>Name:<br /></b><input type=\"text\" name=\"name\" size=110 /><br />";
    //$form.="<div class=\"container\">";
    $form.="<br /><b>Permission Group:</b><br />";
    $form.="<select name=\"g_id\">";
    $form.="<option value=0>All</option>";
    $gr=mysql_query("SELECT id,name FROM perm_group");
    while($g=mysql_fetch_array($gr))
      $form.="<option value=".$g[0].">".$g[1]."</option>";
    $form.="</select>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</form></div></div>";
    return $form;
  }
}
?>