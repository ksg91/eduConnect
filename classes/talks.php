<?php
class Talk
{
  var $id,$content,$date,$by,$ups,$downs,$scope;
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
  var $talks,$user,$scope,$from;
  function __construct($user,$scope,$from)
  {
    $this->user=$user;
    $this->scope=$scope;
    $this->from=$from;
    $this->loadTalks();
  }
  function loadTalks()
  {
    $talk_id=mysql_query("SELECT id FROM talks ORDER BY `date` DESC LIMIT ".$this->from.",20");
    $i=0;
    while (($talk=mysql_fetch_array($talk_id))) {
      $this->talks[$i]=new Talk($talk[0]);
      $i++;    	
    }    
  }
  function getTalkUpdateForm()
  {
    $form="<div class=\"talk\"><div class=\"container\">";
    $form.="<b>Update Status</b></div>";
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