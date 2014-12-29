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
</head>
<body>


<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-cnt1">
      <h1>Create New Subscriber</h1>
    </div>
   
    <div class="nav-bar">
            <input class="btn btn-primary" style="margin-left:45%;" type="submit" value="Go Back" onclick="window.location='groups.php';" />

        <?php

  require 'conn.inc.php';
 
  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $name = $_POST['name'];
    $addr = $_POST['addr'];
    $sex = $_POST['sex'];
    $agent_id = $_POST['agent_id'];
    $occu = $_POST['occu'];
    $dob = $_POST['dob'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $nom_addr = $_POST['nom_addr'];
    $nom_name = $_POST['nom_name'];
    $grp_id = $_POST['grp_id'];

    if(!empty($name) && !empty($addr) && !empty($sex) && !empty($agent_id) && !empty($dob) && !empty($nom_name) && !empty($nom_addr) && !empty($mob) && !empty($grp_id) && !empty($occu) && !empty($email))
    {
      $query = "INSERT INTO `subscriber_master`(`name`, `sex`, `address`, `date_of_birth`, `agent_id`, `occupation`, `mobile`, `email`, `nom_name`, `nom_addr`) VALUES ('$name','$sex','$addr','$dob','$agent_id','$occu','$mob','$email','$nom_name','$nom_addr')";
      if($query_result = mysql_query($query)){
        echo '<div class="success-handle success-1">Successfully Added!</div>';
        
        $dat = date("Y-m-d");
        
        $q = "select sub_id from subscriber_master where email='$email'";
        $r = mysql_query($q);
        $sub_id = mysql_result($r, 0, 'sub_id');
        
        $query = " INSERT INTO `group_member`(`grp_id`, `sub_id`, `grp_active`, `grp_date_open`, `grp_date_closed`) VALUES ('$grp_id','$sub_id', '1', '$dat', 'NULL')";

        $query_result = mysql_query($query);

        $amount_paid = 0;
        $query = "INSERT INTO `subscriber_group`(`sub_id`, `grp_id`, `sub_pay_status`, `amount_paid`) VALUES ('$sub_id', '$grp_id', 'N', '$amount_paid')";
        $query_result = mysql_query($query);

        $query = "UPDATE group_master set no_of_subs=no_of_subs+1 where grp_id='$grp_id'";
        $query_result = mysql_query($query);

      }
      else{
        echo '<div class="error-handle error-4">Error while adding Subscriber!</div>';
      }


    }
    else{
      echo '<div class="error-handle error-7">Enter All necessary Values Please.</div>';
    }
  }

?>


<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'createsub.php'?> "> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-4">
      <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Sex</label>
    <div class="col-sm-4">
      <select name="sex" >
        <option value="M">M</option>
        <option value="F">F</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
    <div class="col-sm-4">
        <input name="addr" type="text" class="form-control" id="inputEmail3" placeholder="Address">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">DOB</label>
    <div class="col-sm-4">
       <input name="dob" type="text" class="form-control" id="inputEmail3" placeholder="date of birth">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Agent</label>
    <div class="col-sm-4">
      <select name='agent_id' id='agent_id'>
      <?php 
      $query = "select agent_id, name from agent_master";
      $query_result = mysql_query($query);
      while($row = mysql_fetch_array($query_result)){
        $str = "<option>".$row['agent_id']."</option>";
        echo $str;
        }

      echo "</select><br>";
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

      echo "</select><br>";
      ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Occupation</label>
    <div class="col-sm-4">
       <input name="occu" type="text" class="form-control" id="inputEmail3" placeholder="Occupation">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Mobile</label>
    <div class="col-sm-4">
       <input name="mob" type="text" class="form-control" id="inputEmail3" placeholder="Mobile">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
    <div class="col-sm-4">
       <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Nominee Name</label>
    <div class="col-sm-4">
       <input name="nom_name" type="text" class="form-control" id="inputEmail3" placeholder="Nominee Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Nominee Address</label>
    <div class="col-sm-4">
       <input name="nom_addr" type="text" class="form-control" id="inputEmail3" placeholder="Nominee Address">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Create Subscriber">
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