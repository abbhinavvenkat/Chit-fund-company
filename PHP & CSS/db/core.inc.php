<?php

ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_NAME'];

function loggedin(){
  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])){
    return True;
  }
  else{
    return False;
  }
}

function userlevel($exp){
  require 'conn.inc.php';
  $user = $_SESSION['user_id'];
  $query = "SELECT `user_level` FROM `user_master` WHERE `user_id`='$user'";
  if($query_result = mysql_query($query)){
    if(mysql_num_rows($query_result) == 1){
      $level = mysql_result($query_result, 0, 'user_level');
      if($level == $exp){
        //echo 'Yes';
        return True;

      }
      else{
        //echo 'No!';
        return False;
      }
    }
  }
}

?>