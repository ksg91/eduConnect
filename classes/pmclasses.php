<?php
class PM
{
  var $id,$content,$date,$by,$to,$read;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM pms WHERE id=".$id));
    $this->content=$row['content'];
    $this->date=$row['date'];
    $this->by=new User($row['by']);
    $this->to=new User($row['to']);
    $this->read=$row['read'];
    $this->markRead();
  }
  function getFormattedPM()
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
    $talk.='<a href="sendPM.php?to='.$this->by->id.'">Reply</a>';
    $talk.='</div>';
    $talk.='</div>';
    if(!$this->read)
      $talk="<b>".$talk."</b>";
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
  function markRead()
  {
    if($this->read==0)
      mysql_query("UPDATE pms SET `read`=1 WHERE id=".$this->id);
  }
}
class PMs
{
  var $pms,$from,$to;
  function __construct($to,$from)
  {
    $this->to=$to;
    $this->loadPMs();
    echo mysql_error();
  }
  function loadPMs()
  {
    $pm_id=mysql_query("SELECT id FROM pms  WHERE `to`=".$this->to." ORDER BY `date` DESC ");
    $i=0;
    while (($pm=mysql_fetch_array($pm_id))) {
      $this->pms[$i]=new PM($pm[0]);
      $i++;    	
    }    
  }
  function getFormattedPMs()
  {
    $content="";
    foreach($this->pms as $value){
      $content.=$value->getFormattedPM();
    }
    return $content;
  }
  static function getSendPMForm($to)
  {
    $user=new User($to);
    $form="<div class=\"talk\"><div class=\"container\">";
    $form.="<b>Send PM to ".($user->name)."</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/sendPM.php?to=".$to."&amp;action=send\" method=\"post\">";
    $form.="<textarea name=\"content\"></textarea>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Send PM!\" />";
    $form.="</div></div>";
    return $form;
  }
}
?>