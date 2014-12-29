<html>
<head>
   <?php
  require 'core.inc.php';

  if(!loggedin()){
    header('Location: index.php');
  }

?>

<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/updstaff.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Julius+Sans+One">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster+Two">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie Flower">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz">

<script>
function show_sub() {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("selectall").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getgroups.php",true);
  xmlhttp.send();
}

</script>
</head>
<body onload="show_sub()">


<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-cnt">
      <h1>Add a Subscriber to New Group</h1>
    </div>
   
    <div class="nav-bar">
      <input class="btn btn-primary" style="margin-left:45%;" type="submit" value="Go Back" onclick="window.location='groups.php';" />

<div id="selectall"><b></b></div>


<?php

  require 'conn.inc.php';
 

  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $sub_id = $_POST['sub_id'];
    $grp_id = $_POST['grp_id'];
    

    if(!empty($sub_id) && !empty($grp_id))
    {
      $dat = date("Y-m-d");

      $query = "select * from group_member where grp_id='$grp_id' and sub_id='$sub_id' and grp_active='1'";
      $query_result = mysql_query($query);

      if(mysql_num_rows($query_result)==0){

      $query = " INSERT INTO `group_member`(`grp_id`, `sub_id`, `grp_active`, `grp_date_open`, `grp_date_closed`) VALUES ('$grp_id','$sub_id', '1', '$dat', 'NULL')";

      if($query_result = mysql_query($query)){
        echo '<div class="success-handle success-1">Successfully Added!</div>';
        
        $query = "INSERT INTO `subscriber_group`(`sub_id`, `grp_id`, `sub_pay_status`) VALUES ('$sub_id', '$grp_id', 'Y')";
        $query_result = mysql_query($query);

        $query = "UPDATE group_master set no_of_subs=no_of_subs+1 where grp_id='$grp_id'";
        $query_result = mysql_query($query);

      }
      else{
        echo '<div class="error-handle error-4">Error while adding Subscriber!</div>';
      }

    }
    else{
      echo '<div class="error-handle error-6">Member already exists and is active</div>';
    }

    }
    else{
      echo '<div class="error-handle error-4">Enter All necessary Values Please.</div>';
    }
  }

?>


     
    <form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'addsubnewgrp.php'?> " >
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Subscriber</label>
    <div class="col-sm-4">
        <select name='sub_id' id='sub_id'>
      <?php 
      $query = "select sub_id from subscriber_master";
      $query_result = mysql_query($query);
      while($row = mysql_fetch_array($query_result)){
        $str = "<option>".$row['sub_id']."</option>";
        echo $str;
        }

      echo "</select>";
      ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Subscription Group</label>
    <div class="col-sm-4">
        <select name='grp_id' id='grp_id'>
      <?php 
      $query = "select grp_id from group_master";
      $query_result = mysql_query($query);
      while($row = mysql_fetch_array($query_result)){
        $str = "<option>".$row['grp_id']."</option>";
        echo $str;
        }

      echo "</select>";
      ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add Subscriber to Group">
    </div>
  </div>
</form>

    
    </div>
  </div>
</div>
  
<div id="footer"> 
  <h5>Created by Abbhinav Venkat & Vishal Thamizharasan</h5>
</div>

</body> 
</html>