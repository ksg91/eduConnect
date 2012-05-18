<?php
class User
{
  var $id,$name,$email,$perm,$addr,$dob,$ph_no,$proPic,$gender,$abtMe,$colID,$lastseen;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id=".$id));
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
  function addTalk($talk,$scope)
  {
    if($talk=="")
      return NULL;
    if(strlen($talk)>2000)
      return "LIMIT_EXCEED";
    $q=mysql_query("INSERT INTO talks SET content='".$talk."',`by`=".$this->id.",`date`=CURRENT_TIMESTAMP,scope=".$scope);
    if(!$q)
      return "MYSQL_ERROR";
    return true;
  }
  function addComment($talk_id,$content)
  {
    if($content=="")
      return NULL;
    if(strlen($content)>2000)
      return "LIMIT_EXCEED";
    $q=mysql_query("INSERT INTO comments SET talk_id=".$talk_id.",content='".$content."',`by`=".$this->id.",`date`=CURRENT_TIMESTAMP");
    $c=mysql_result(mysql_query("SELECT comments FROM talks WHERE id=".$talk_id),0);
    $y=mysql_query("UPDATE talks SET comments=".++$c." WHERE id=".$talk_id);
    if(!$q || !$c || !$y)
      return "MYSQL_ERROR";
    return true;
  }
  function  addUpDowns($action,$type,$c_id)
  { 
    $c=mysql_result(mysql_query("SELECT COUNT(*) FROM updown WHERE `c_id`=".$c_id." AND talk=".$type." AND u_id=".$this->id),0);
    if($action=="up")
      $t=1;
    else
      $t=0;
    if($c>0)
    {
      $up=mysql_result(mysql_query("SELECT up FROM updown WHERE c_id=".$c_id." AND talk=".$type),0);
      if($up==$t)
        return;
      if($t==1){  
        mysql_query("UPDATE updown SET up=".$t." WHERE c_id=".$c_id." AND talk=".$type." AND u_id=".$this->id);
        echo mysql_error();
        if($type){
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM talks WHERE id=".$c_id));
          mysql_query("UPDATE talks SET ups=".($updown[0]+1).",downs=".($updown[1]-1)." WHERE id=".$c_id);
        }
        else{
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM comments WHERE id=".$c_id));
          mysql_query("UPDATE comments SET ups=".($updown[0]+1).",downs=".($updown[1]-1)." WHERE id=".$c_id);
        }
      }
      else if($t==0){
      mysql_query("UPDATE updown SET up=".$t." WHERE c_id=".$c_id." AND talk=".$type." AND u_id=".$this->id);  
        if($type){
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM talks WHERE id=".$c_id));
          mysql_query("UPDATE talks SET ups=".($updown[0]-1).",downs=".($updown[1]+1)." WHERE id=".$c_id);
        }
        else{
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM comments WHERE id=".$c_id));
          mysql_query("UPDATE comments SET ups=".($updown[0]-1).",downs=".($updown[1]+1)." WHERE id=".$c_id);
        }
      }
    }
    else
    {
      mysql_query("INSERT INTO updown SET up=".$t.", c_id=".$c_id.",talk=".$type.",u_id=".$this->id);
      if($t==1){  
        mysql_query("UPDATE updown SET up=".$t.", c_id=".$c_id.",u_id=".$this->id." WHERE id=".$c_id." AND talk=".$type);
        if($type){
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM talks WHERE id=".$c_id));
          mysql_query("UPDATE talks SET ups=".($updown[0]+1)." WHERE id=".$c_id);
        }
        else{
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM comments WHERE id=".$c_id));
          mysql_query("UPDATE comments SET ups=".($updown[0]+1)." WHERE id=".$c_id);
        }
      }
      else if($t==0){  
        if($type){
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM talks WHERE id=".$c_id));
          mysql_query("UPDATE talks SET downs=".($updown[1]+1)." WHERE id=".$c_id);
        }
        else{
          $updown=mysql_fetch_array(mysql_query("SELECT ups,downs FROM comments WHERE id=".$c_id));
          mysql_query("UPDATE comments SET downs=".($updown[1]+1)." WHERE id=".$c_id);
        }
      }
    }
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
  function addTopic($f_id,$title,$content)
  {
    if($content=="")
      return NULL;
    if(strlen($content)>2000)
      return "LIMIT_EXCEED";
    $q=mysql_query("INSERT INTO topic SET title='".$title."',content='".$content."',`by`=".$this->id.",`date`=CURRENT_TIMESTAMP,f_id=".$f_id);
    if(!$q)
      return "MYSQL_ERROR:";
    return true;
  }
  function addReply($t_id,$content)
  {
    if($content=="")
      return NULL;
    if(strlen($content)>2000)
      return "LIMIT_EXCEED";
    $q=mysql_query("INSERT INTO replies SET content='".$content."',`by`=".$this->id.",`date`=CURRENT_TIMESTAMP,t_id=".$t_id);
    if(!$q)
      return "MYSQL_ERROR:";
    return true;
  }
  function getHisGroups()
  {
    $q=mysql_query("SELECT DISTINCT perm_id FROM perm_member WHERE u_id=".$this->id." ");
    $i=0;
    while($gid=mysql_fetch_array($q)){
      $groups[$i]=new Group($gid[0]);
      $i++;
    }
    return $groups;
  }
  function getProfileWidget()
  {
    $widget="<div id=\"proWid\"><a href=\"".ABS_PATH."/profile.php?id=".$this->id."\"><img src=\"".ABS_PATH."/".$this->proPic."\" /><br />";
    $widget.="<h3>".$this->name."</h3></a>";
    $widget.="</div>";
    return $widget;
  }
  function getStatusPaneWidget()
  {
    $widget='<div>';
    $widget.='<ul style="list-style:none;">';
    $widget.='<li><a href="pms.php">Private Messages('.$this->getUnreadPMCount().'/'.$this->getTotalPMCount().')</a></li>';
    $widget.='</ul>';
    $widget.='</div>';
    return $widget;
  }
  function getActionWidget()
  {
    $widget='<div>';
    $widget.='<ul style="list-style:none;">';
    $widget.='<li><a href="sendPM.php?to='.$this->id.'">Send PM</a></li>';
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
class HOD extends User{
  var $id;
  function __construct($id)
  {
    parent::__construct($id);
    $this->id=$id;
  }
  function addForum($name,$perm,$sec_id)
  {
    $q=mysql_query("INSERT INTO forum SET name='".$name."',perm_g=".$perm.",sec_id=".$sec_id);
    if($q)
      return true;
    else 
      return false;
  }
  function addGroup($name)
  {
    $q=mysql_query("INSERT INTO perm_group SET name='".$name."',created_by=".$this->id);
    if($q)
      return true;
    else 
      return false;
  }
  function addMember($g_id,$u_id)
  {
    $q=mysql_query("INSERT INTO perm_member SET perm_id='".$g_id."',u_id=".$u_id.",mem_since=SYSDATE(),accepted=1");
    if($q)
      return true;
    else 
      return false;
  }
  function addChatroom($name,$g_id)
  {
    $q=mysql_query("INSERT INTO chatrooms SET perm='".$g_id."',name='".$name."'");
    if($q)
      return true;
    else 
      return false;
  }
}
class Principal extends HOD {
  var $id;
  function __construct($id)
  {
    parent::__construct($id);
    $this->id=$id;
  }
  function addForumSection($name)
  {
    $q=mysql_query("INSERT INTO forum_sec SET name='".$name."'");
    if($q)
      return true;
    else 
      return false;
  } 
}
class ColAdmin extends Principal {
  var $id;
  function __construct($id)
  {
    parent::__construct($id);
    $this->id=$id;
  }
  function addStudent($name)
  {
  } 
}
class UniHead extends ColAdmin {
  var $id;
  function __construct($id)
  {
    parent::__construct($id);
    $this->id=$id;
  }
}
?>