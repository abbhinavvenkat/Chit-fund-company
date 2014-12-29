<?php

require 'core.inc.php';
require 'conn.inc.php';

if(loggedin()){
  if(userlevel(1)){
    header('Location: user_home.php');
  }else if(userlevel(9)){
    header('Location: admin_home.php');
  }
}else{
  require 'login.php';
}

?>


