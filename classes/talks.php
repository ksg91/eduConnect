<?php
class Talk
{
  var $id,$content,$date,$by,$ups,$downs,$scope,$comments=0;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM talks WHERE id=".$id));
    $this->content=$row['content'];
    $this->date=$row['date'];
    $this->by=new User($row['by']);
    $this->ups=$row['ups'];
    $this->downs=$row['downs'];
    $this->scope=$row['scope'];
  }
  function getFormattedTalk()
  {
    $talk='<div class="talk">';
    $talk.='<div class="container">';
    $talk.='<div class="proPic">';
    $talk.='<img src="'.ABS_PATH.'/'.$this->by->proPic.'" alt="profile pic" />';
    $talk.='</div>';
    $talk.='<div class="name">'.$this->by->name.'</div>';
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
  function loadTalks()
  {
    if($this->target==NULL)
    {
      $talk_id=mysql_query("SELECT id FROM talks ORDER BY `date` DESC LIMIT ".$this->from.",20");
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
}
?>