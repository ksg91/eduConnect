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
    //echo $pt." == ".time()."<br />diff=".(time()-$pt);
    if((time()-$pt)<(24*60*60))
    {
      if((time()-$pt)<(60*60))
      {
        if((time()-$pt)<(60))
          return "just now";
        return Date("i",time()-$pt)." minutes ago";
      }
      return Date("G",time()-$pt)." hours ago";
    }
    return $this->date;
  }
}
?>