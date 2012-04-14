<?php
class Chat
{
  var $chatrooms,$user;
  function __construct($user)
  {
    $this->user=$user;
    $this->loadChatrooms();    
  }
  private function loadChatrooms()
  {
    $rooms=mysql_query($this->getSuitableQuery());
    $i=0;
    while($room=mysql_fetch_array($rooms)){
      $this->chatrooms[$i]=new Chatroom($room[0]);
      $i++;
    }
  }
  function getSuitableQuery()
  {
    $groups=$this->user->getHisGroups();
    $perm="(0,";
    foreach($groups as $value)
      $perm.=$value->id.", ";
    $perm.="".$this->user->colID.")";  
    $query="SELECT id FROM chatrooms WHERE perm IN ".$perm." ";
    return $query;
  }
  function getFormattedChatroomList()
  {
    $content="<div class=\"talk\">";
    foreach($this->chatrooms as $value){
      $content.="<div class=\"container\">";
      $content.="<a href=\"chatroom.php?id=".$value->id."\">";
      $content.=$value->name."(".$value->users.")";
      $content.="</a></div>";
    }
    $content.="</div>";
    return $content;
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
    $this->users=$this->getUsers();
    $this->loadChatPosts();
  }
  function getFormattedChatPosts()
  {
    $content="";
    foreach($this->chatposts as $value){
      $content.=$value->getFormattedChatPost();
    }
    return $content;
  }
  function getChatPostForm()
  {
    $form="<div class=\"talk\"><div class=\"container\">";
    $form.="<b>Let's Chat</b></div>";
    $form.="<div class=\"container\">";
    $form.="<form action=\"".ABS_PATH."/postChat.php?id=".$this->id."\" method=\"post\">";
    $form.="<textarea name=\"content\"></textarea>";
    $form.="</div><div class=\"container\" style=\"text-align:right;\">";
    $form.="<input type=\"submit\" value=\"Chat!\" />";
    $form.="</div></div>";
    return $form;
  }
  private function loadChatPosts()
  {
    if(!$this->chatposts==NULL)
      return ;
    $q=mysql_query("SELECT id FROM chatposts WHERE room_id=".$this->id." ORDER BY `time` DESC LIMIT 0,30");
    $i=0;
    while($post=mysql_fetch_array($q)){
      $this->chatposts[$i]=new ChatPost($post[0]);
      $i++;
    }
  }
  private function getUsers()
  {
    $c=mysql_result(mysql_query("SELECT COUNT( DISTINCT `by`) FROM chatposts WHERE `time`+0>SYSDATE()-600 AND room_id=".$this->id),0);
    return $c;
  }
}
class ChatPost
{
  var $id,$by,$content,$time;
  function __construct($id)
  {
    $this->id=$id;
    $row=mysql_fetch_array(mysql_query("SELECT * FROM chatposts WHERE id=".$this->id));
    $this->by=new User($row['by']);
    $this->content=$row['content'];
    $this->time=$row['time'];
  }
  function getFormattedChatPost()
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
    $talk.='</div>';
    return $talk;
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
