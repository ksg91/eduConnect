<?php
class Talk
{
  var $id,$content,$date,$by,$ups,$downs,$scope,$comments;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM talks WHERE id=".$this->id));
    $this->content=$row['content'];
    $this->date=$row['date'];
    $this->by=new User($row['by']);
    $this->ups=$row['ups'];
    $this->downs=$row['downs'];
    $this->scope=$row['scope'];
    $this->comments=$row['comments'];
  }
  function getFormattedTalk()
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
    $talk.=$this->content;
    $talk.='</div>';
    $talk.='<div class="container" style="text-align:right">';
    $talk.='<a href="comments.php?id='.$this->id.'">Comments ('.$this->comments.')</a>';
    $talk.=' | <a href="comments.php?id='.$this->id.'">Ups ('.$this->ups.')</a>';
    $talk.=' | <a href="comments.php?id='.$this->id.'">Downs ('.$this->downs.')</a>';
    $talk.='</div>';
    $talk.='</div>';
    return $talk;
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
class Talks
{
  var $talks,$user,$scope,$from,$target;
  function __construct($user,$scope,$from,$target=NULL)
  {
    $this->user=$user;
    $this->scope=$scope;
    $this->from=$from;
    $this->target=$target;
    $this->loadTalks();
  }
  function getSuitableQuery()
  {
    $groups=$this->user->getHisGroups();
    $perm="(0,";
    foreach($groups as $value)
      $perm.=$value->id.", ";
    $perm.="".$this->user->colID.")";  
    $query="SELECT id FROM talks WHERE scope=".$this->scope." AND scope IN ".$perm." ORDER BY `date` DESC LIMIT ".$this->from.",20";
    return $query;
  }
  function loadTalks()
  {
    if($this->target==NULL)
    {
      $talk_id=mysql_query($this->getSuitableQuery());
      $i=0;
      while (($talk=mysql_fetch_array($talk_id))) {
        $this->talks[$i]=new Talk($talk[0]);
        $i++;    	
      }
    }  
    else
    {
      $talk_id=mysql_query("SELECT id FROM talks WHERE `by`='".$this->target."' ORDER BY `date` DESC LIMIT ".$this->from.",20");
      $i=0;
      while (($talk=mysql_fetch_array($talk_id))) {
        $this->talks[$i]=new Talk($talk[0]);
        $i++;    	
      }
    }  
    //echo mysql_error();
  }
  function getTalkUpdateForm()
  {
    $form="<div class=\"talk\"><div class=\"container\">";
    $form.="<b>Let's Talk</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/updateTalk.php\" method=\"post\">";
    $form.="<textarea name=\"content\"></textarea>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Talk!\" />";
    $form.="</div></div>";
    return $form;
  }
  function getFormattedTalks()
  {
    $talks="";
    foreach($this->talks as $value){
      $talks.=$value->getFormattedTalk();
    }
    return $talks;
  }
  function getTalksScopeWidget()
  {
    $groups=$this->user->getHisGroups();
    $widget='<div>';
    $widget.='<ul style="list-style:none;">';
    foreach($groups as $value)
      $widget.='<li><a href="index.php?scope='.$value->id.'">'.$value->name.'</a></li>';
    $widget.='</ul>';
    $widget.='</div>';
    return $widget;
  }
}
?>