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
    $q=mysql_query("SELECT id FROM topic WHERE f_id=".$this->id." ORDER BY id DESC LIMIT ".$from.",20");
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
      $content.=$value->getFormattedTopic();
    return $content;
  }
  function getAddTopicForm()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<a href=\"#\" onClick=\"toggle('addTopic');\"><b>Add Topic</b></a></div>";
    $form.="<div id=\"addTopic\" style=\"display:none;\">";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addTopic.php?id=".$this->id."\" method=\"post\">";
    $form.="<b>Title:<br /></b><input type=\"text\" name=\"title\" size=110 /><br />";
    $form.="<b>Content:</b><br /><textarea name=\"content\"></textarea>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
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
  function getReplies($from)
  {
    $q=mysql_query("SELECT id FROM replies WHERE t_id=".$this->id." LIMIT ".$from.",20");
    $i=0;
    $replies=NULL;
    while($r=mysql_fetch_array($q)){
      $replies[$i]=new Reply($r['id']);
      $i++;
    }
    return $replies;
  }
  function getTopicPost()
  {
    $talk='<div class="talk">';
    $talk.='<div class="container">';
    $talk.='<div class="proPic">';
    $talk.='<a href="'.ABS_PATH.'/profile.php?id='.$this->by->id.'">';
    $talk.='<img src="'.ABS_PATH.'/'.$this->by->proPic.'" alt="profile pic" />';
    $talk.='</div>';
    $talk.='<div class="name">'.$this->by->name.'</div></a>';
    $talk.='<div class="time">'.$this->getTime().'</div>';
    $talk.='</div>';
    $talk.='<div class="container">';
    $talk.="<b>".$this->title."</b>";
    $talk.='</div>';
    $talk.='<div class="container">';
    $talk.=$this->content;
    $talk.='</div>';
    $talk.='</div>';
    $talk.='<div class="container" style="background-color:#CACACA;">';
    $talk.='<div style="text-align:center;"><b>Replies</b></div></a>';
    $talk.='</div>';
    return $talk;
  }
  function getFormattedReplies($from)
  {
    $replies=$this->getReplies($from);
    $content="";
    foreach($replies as $value)
      $content.=$value->getFormattedReply();
    return $content;
  }
  function getAddReplyForm()
  {
    $form="<div class=\"talk\" style=\"min-height:0px\"><div class=\"container\">";
    $form.="<a href=\"#\" onClick=\"toggle('addReply');\"><b>Add Reply</b></a></div>";
    $form.="<div id=\"addReply\" style=\"display:none;\">";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/addReply.php?id=".$this->id."\" method=\"post\">";
    $form.="<b>Content:</b><br /><textarea name=\"content\"></textarea>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Add!\" />";
    $form.="</div></div></div>";
    return $form;
  }
  function getTime()
  {
    $pt=strtotime($this->date)-19800;
    $diff=time()-$pt;
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
class Reply
{
  var $id,$t_id,$content,$by,$date;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM replies WHERE id=".$id));
    $this->t_id=$row['t_id'];
    $this->content=$row['content'];
    $this->by=new User($row['by']);
    $this->date=$row['date'];
  }
  function getFormattedReply()
  {
    $content="";
    $content.='<div class="talk">';
    $content.="<div class=\"container\">";
    $content.='<div class="proPic">';
    $content.='<a href="'.ABS_PATH.'/profile.php?id='.$this->by->id.'">';
    $content.='<img src="'.ABS_PATH.'/'.$this->by->proPic.'" alt="profile pic" />';
    $content.="</div>";
    $content.='<div class="name">'.$this->by->name.'</div></a>';
    $content.='<div class="time">'.$this->getTime().'</div>';
    $content.='</div>';
    $content.="<div class=\"container\">";
    $content.=$this->content;
    $content.='</div>';
    $content.='</div>';
    return $content;
  }
  function getTime()
  {
    $pt=strtotime($this->date)-19800;
    $diff=time()-$pt;
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