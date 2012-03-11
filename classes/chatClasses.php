<?php
class Chat
{
  var $chatrooms;
  function __construct()
  {
    $this->loadChatrooms();
  }
  private function loadChatrooms()
  {
    $rooms=mysql_query("SELECT id FROM chatrooms");
    $i=0;
    while($room==mysql_fetch_array($rooms)){
      $this->chatrooms[$i]=new Chatroom($room);
      $i++;
    }
  }
}
class Chatroom
{
  var $id,$name,$perm,$users,$chatposts;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM chatrooms WHERE id=".$this->id));
    $this->name=$row['name'];
    $this->perm=$row['perm'];
    $this->users=$row['users'];
  }
  function getFormattedChatPosts()
  {
    $content="";
    foreach($this->chatposts as $value){
      $content.=$value->getFormattedChatPost();
    }
    return $content;
  }
  private function loadChatPosts()
  {
    if(!$this->chatposts==NULL)
      return ;
    $q=mysql_query("SELECT id FROM chatposts WHERE room_id=".$this->id." ORDER BY `time` LIMIT 0,30");
    $i=0;
    while($post==mysql_fetch_array($q)){
      $this->chatposts[$i]=new Chatroom($post);
      $i++;
    }
  }
}
class ChatPost
{
  function getFormattedChatPost()
  {
    $this->loadChatPosts();
    $chats='<div class="talks">';
    $chats.='<div class="container">';
    $chats.='<div class="proPic">';
    $chats.='<a href="'.ABS_PATH.'/profile.php?id='.$this->by->id.'">';
    $chats.='<img src="'.ABS_PATH.'/'.$this->by->proPic.'" alt="profile pic" />';
    $chats.='</div>';
    $chats.='<div class="name">'.$this->by->name.'</div></a>';
    $chats.='<div class="time">'.$this->getTime().'</div>';
    $chats.='</div>';
    $chats.='<div class="container">';
    $chats.=$this->content;
    $chats.='</div>';
    $chats.='<div class="container" style="text-align:right">';
    $chats.='<a href="sendPM.php?to='.$this->by->id.'">Reply</a>';
    $chats.='</div>';
    $chats.='</div>';
    return $chats;
  }
  function getTime()
  {
    $pt=strtotime($this->time);
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
    return $this->time;
  }
}
?>
