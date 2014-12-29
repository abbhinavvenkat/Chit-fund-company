<?php
 require 'core.inc.php';
 $grp_id = $_POST['grp_id'];
 $_SESSION['grp_id']=$grp_id;
 header('Location: addauction2.php');
?>