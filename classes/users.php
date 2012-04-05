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
  function postToChat($chatpost,$roomID)
  {
    if($chatpost=="")
      return NULL;
    if(strlen($chatpost)>2000)
      return "LIMIT_EXCEED";
    $q=mysql_query("INSERT INTO chatposts SET content='".$chatpost."',`by`=".$this->id.",`time`=CURRENT_TIMESTAMP,room_id=".$roomID);
    if(!$q)
      return "MYSQL_ERROR";
    return true;
  }
  function getProfileWidget()
  {
    $widget="<div id=\"proWid\"><img src=\"".ABS_PATH."/".$this->proPic."\" /><br />";
    $widget.="<h3><a href=\"".ABS_PATH."/profile.php?id=".$this->id."\">".$this->name."</a></h3>";
    $widget.="</div>";
    return $widget;
  }
  function getStatusPaneWidget()
  {
    $widget='<div>';
    $widget.='<ul style="list-style:none;">';
    $widget.='<li><a href="pms.php">Private Messages('.$this->getUnreadPMCount().'/'.$this->getTotalPMCount().')</a></li>';
    $widget.='<li><a href="friends.php">Friends(3)</a></li>';
    $widget.='<li><a href="pms.php">Notification(1)</a></li>';
    $widget.='</ul>';
    $widget.='</div>';
    return $widget;
  }
  function getActionWidget()
  {
    $widget='<div>';
    $widget.='<ul style="list-style:none;">';
    $widget.='<li><a href="sendPM.php?to='.$this->id.'">Send PM</a></li>';
    $widget.='<li><a href="addFriend.php">Add As A Friend</a></li>';
    $widget.='</ul>';
    $widget.='</div>';
    return $widget;
  }
  function sendPM($to,$content)
  {
    if($content=="NULL")
      return NULL;
    $q=mysql_query("INSERT INTO pms SET content='".$content."',`by`=".$this->id.",`date`=CURRENT_TIMESTAMP,`to`=".$to);
    if(!$q)
      return "MYSQL_ERROR";
    return true; 
  }
  function getTotalPMCount()
  {
    $c=mysql_result(mysql_query("SELECT COUNT(*) FROM pms WHERE `to`=".$this->id),0);
    return $c;
  }
  function getUnreadPMCount()
  {
    return mysql_result(mysql_query("SELECT COUNT(*) FROM pms WHERE `read`=0 AND `to`=".$this->id),0);
  }
}
?>