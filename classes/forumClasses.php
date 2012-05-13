<?php
class ForumSys {
  var $forumSec;
  function __construct()
  {
    $q=mysql_query("SELECT id FROM forum_sec");
    $this->loadForumSec($q);
  }
  function loadForumSec($q)
  {
    $i=0;
    while($fs=mysql_fetch_array($q)){
      $this->forumSec[$i]=new ForumSec($fs['id']);
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
  var $id,$forums,$name;
  function __construct($id)
  {
    $this->id=$id;
    $this->name=mysql_result(mysql_query("SELECT name FROM forum_sec WHERE id=".$id),0);
    $q=mysql_query("SELECT id FROM forum WHERE sec_id=".$id);
    $i=0;
    while($f=mysql_fetch_array($q)){
    //echo $f['id'];
      $this->forums[$i]=new Forum($f['id']);
      $i++;
    }
  }
}
class Forum{
  var $id,$name,$count;
  function __construct($id)
  {
    $this->id=$id;
    $q=mysql_query("SELECT * FROM forum WHERE id=".$id);
    $a=mysql_fetch_array($q);
    $this->name=$a['name'];
    $this->count=mysql_result(mysql_query("SELECT COUNT(*) FROM topic WHERE f_id=".$this->id),0);
  }
  function getTopics($from)
  {
    $q=mysql_query("SELECT id FROM topics WHERE f_id=".$this->id);
    $i=0;
    while($topic=mysql_fetch_array($q)){
      $topics[$i]=new Topic($topic['id']);
      $i++;
    }
    return $topics;
  }
  function getFormattedTopics($from)
  {
    $topics=$this->getTopics($from);
  }
}
class Topic {
  var $id,$title,$by,$date,$count;
  function __construct($id)
  {
    $this->id;
    $q=mysql_fetch_array(mysql_query("SELECT * topic WHERE id=".$this->id));
    $this->title=$q['title'];
    $this->by=new User($q['by']);
    $date->date=$q['date'];
    $count=mysql_result(mysql_query("SELECT COUNT(*) FROM replies WHERE t_id=".$this->id),0);
  }
}
?>