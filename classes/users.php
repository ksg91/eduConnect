<?php
class User
{
  var $id,$name,$email,$perm,$addr,$dob,$ph_no,$proPic,$gender,$abtMe,$colID,$lastseen;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id=".$this->id));
    $this->name=$row['name'];
    $this->email=$row['email'];
    $this->perm=$row['perm'];
    $this->addr=$row['address'];
    $this->dob=$row['dob'];
    $this->ph_no=$row['ph_no'];
    $this->proPic=$row['profile_pic'];
    $this->gender=$row['gender'];
    $this->abtMe=$row['about_me'];
    $this->colID=$row['college_id'];
    $this->lastseen=$row['lastseen'];
  }
  function addTalk($talk)
  {
    if($talk=="")
      return NULL;
    if(strlen($talk)>2000)
      return "LIMIT_EXCEED";
    $q=mysql_query("INSERT INTO talks SET content='".$talk."',`by`=".$this->id.",`date`=CURRENT_TIMESTAMP,scope=0");
    if(!$q)
      return "MYSQL_ERROR";
    return true;
  }
  function getProfileWidget()
  {
    $widget="<div id=\"proWid\"><img src=\"".ABS_PATH."/".$this->proPic."\" /><br />";
    $widget.="<h3><a href=\"".ABS_PATH."/users.php?id=".$this->id."\">".$this->name."</a></h3>";
    $widget.="</div>";
    return $widget;
  }
}
?>