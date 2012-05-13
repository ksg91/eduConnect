<?php
class Search {
  var $criteria,$results;
  function __construct($criteria)
  {
    $this->criteria=$criteria;
  }
  function getResults()
  {
    $id=mysql_query("SELECT id FROM users WHERE name LIKE '%".$this->criteria."%'");
    $result="<div class=\"talk\" style=\"min-height:10px;\"><div class=\"container\"><b>Search Result For </b>".$this->criteria."</div></div>";
    while($uid=mysql_fetch_array($id)){
      $user=new User($uid[0]);
      $result.='<div class="talk">';
      $result.='<div class="container">';
      $result.='<div class="proPic">';
      $result.='<a href="'.ABS_PATH.'/profile.php?id='.$user->id.'">';
      $result.='<img src="'.ABS_PATH.'/'.$user->proPic.'" alt="profile pic" />';
      $result.='</div>';
      $result.='<div class="name">'.$user->name.'</div></a>';
      $result.='</div>';
      $result.='<div class="container"><b>About Me:</b>';
      $result.=$user->abtMe;
      $result.='</div>';
      $result.='<div class="container"><b>College:</b>';
      $result.="LCIT";
      $result.='</div>';
      $result.='<div class="container" style="text-align:right">';
      $result.='<a href="sendPM.php?id='.$user->id.'">Send PM</a> |';
      $result.='<a href="profile.php?id='.$user->id.'"> View Profile</a>';
      $result.='</div>';
      $result.='</div>';
    }
    return $result;
  }
}
?>