<?php
class ForumSys {
  var $forumSec,$user;
  function __construct($user)
  {
    $this->user=$user;
    $q=mysql_query("SELECT id FROM forum_sec");
    $this->loadForumSec($q);
  }
  function loadForumSec($q)
  {
    $i=0;
    while($fs=mysql_fetch_array($q)){
      $this->forumSec[$i]=new ForumSec($fs['id'],$this->user);
      $i++;
    }
  }
  function getForumSysWidget()
  {
    $widget="";
    foreach($this->forumSec as $value){
      $widget.="<div style=\"width:100%;border-bottom:2px solid #AAAAAA;border-top:2px solid #AAAAAA;\">$value->name</div>";
      $widget.="<ul style=\"font-size:small;\">";
      foreach($value->forums as $f)
        $widget.="<a href=\"".ABS_PATH."/forum.php?id=".$f->id."\"><li>$f->name</li></a>";
      $widget.="</ul><br />";
    }
    return $widget;
  }
  function getForumSysContent()
  {
    $content="";
    foreach($this->forumSec as $value){
      $content.='<div class="talk">';
      $content.='<div class="container" style="background-color:#CACACA;">';
      $content.='<div style="text-align:center;"><b>'.$value->name.'</b></div></a>';
      $content.='</div>';
      foreach($value->forums as $f) {
        $content.="<a href=\"".ABS_PATH."/forum.php?id=".$f->id."\"><div class=\"container\">";
        $content.="<b>$f->name</b>";
        $content.="<br />Total Topics:".$f->count;
        $content.='</div></a>';
      }
      $content.='</div>';
    }
    return $content;
    
  }
}
class ForumSec {
  var $id,$forums,$name,$user;
  function __construct($id,$user)
  {
    $this->id=$id;
    $this->user=$user;
    $this->name=mysql_result(mysql_query("SELECT name FROM forum_sec WHERE id=".$id),0);
    $this->loadForumSec();
  }
  function getSuitableQuery()
  {
    $groups=$this->user->getHisGroups();
    $perm="(0";
    foreach($groups as $value)
      $perm.=",".$value->id;
    $perm.=")";  
    $query="SELECT id FROM forum WHERE perm_g IN ".$perm." AND sec_id=".$this->id;
    return $query;
  }
  function loadForumSec()
  {
    $q=mysql_query($this->getSuitableQuery());
    if(!$q)
      echo "Eror:".mysql_error();
    $i=0;
    while($f=mysql_fetch_array($q)){
    //echo $f['id'];
      $this->forums[$i]=new Forum($f['id'],$this->user);
      $i++;
    }
  }
}
class Forum{
  var $id,$name,$count,$user;
  function __construct($id,$user)
  {
    $this->id=$id;
    $q=mysql_query("SELECT * FROM forum WHERE id=".$id);
    $a=mysql_fetch_array($q);
    $this->name=$a['name'];
    $this->count=mysql_result(mysql_query("SELECT COUNT(*) FROM topic WHERE f_id=".$this->id),0);
    $this->user=$user;
  }
  function getTopics($from)
  {
    $q=mysql_query("SELECT id FROM topic WHERE f_id=".$this->id." LIMIT ".$from.",20");
    $i=0;
    $topics=NULL;
    while($topic=mysql_fetch_array($q)){
      $topics[$i]=new Topic($topic['id']);
      $i++;
    }
    return $topics;
  }
  function getFormattedTopics($from)
  {
    $topics=$this->getTopics($from);
    $content="";
    foreach($topics as $value)
      $content=$value->getFormattedTopic();
    return $content;
  }
  function getAddTopicForm()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<a href=\"#\" onClick=\"toggle('addTopic');\"><b>Add Topic</b></div>";
    $form.="<div id=\"addTopic\" style=\"display:none;\">";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addTopic.php\" method=\"post\">";
    $form.="<b>Title:</b><input type=\"text\" name=\"title\" size=110 /><br />";
    $form.="<b>Content:</b><textarea name=\"content\"></textarea>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<b>Scope:</b><select name=\"scope\">";
    $form.="<option value=0>All</option>";
    $perms=$this->user->getHisGroups();
    foreach($perms as $value){
      $form.="<option value=".$value->id.">".$value->name."</option>";
    }
    $form.="</select>";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</div></div></div>";
    return $form;
  }
}
class Topic {
  var $id,$title,$content,$by,$date,$count,$latestReply;
  function __construct($id)
  {
    $this->id=$id;
    $q=mysql_fetch_array(mysql_query("SELECT * FROM topic WHERE id=".$this->id));
    $this->title=$q['title'];
    $this->by=new User($q['by']);
    $this->content=$q['content'];
    $this->date=$q['date'];
    $this->count=mysql_result(mysql_query("SELECT COUNT(*) FROM replies WHERE t_id=".$this->id),0);
  }
  function getFormattedTopic()
  {
    $content="<a href=\"".ABS_PATH."/topic.php?id=".$this->id."\">";
    $content.='<div class="talk">';
    $content.='<div class="container" style="background-color:#CACACA;">';
    $content.='<div style="text-align:center;"><b>'.$this->title.'</b></div></a>';
    $content.='</div>';
    $content.="<div class=\"container\">";
    $content.=substr($this->content,0,150)." ...";
    $content.='</div>';
    $content.="<div class=\"container\">";
    $content.="<b>Created By: </b>".$this->by->name;
    $content.='<div class="time">'.$this->getTime().'</div>';
    $content.='</div>';
    $content.="<div class=\"container\">";
    $content.="<b>Total Replies: </b>".$this->count;
    $content.='</div>';
    $content.='</div>';
    return $content;
  }
  function getReplies()
  {
  }
  function getTime()
  {
    $pt=strtotime($this->date);
    $diff=time()-$pt;
    $diff;
    if($diff<(24*60*60))
    {
      if($diff<(60*60))
      {
        if($diff<(60))
          return "just now";
        return Date("i",time()-$pt)." minutes ago";
      }
      return Date("G",time()-$pt)." hours ago";
    }
    return $this->date;
  }
}
?>