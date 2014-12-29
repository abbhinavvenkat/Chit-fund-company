<html>
<head>
<?php

  require 'conn.inc.php';
  require 'core.inc.php';

  if(!loggedin()){
    header('Location: index.php');
  }

  if(!userlevel(9)){
    header('Location: access_denied.php');
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
    <div  class="title-txt">
      <h1>Add Staff</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='staff.php';" />
     
<?php
  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $dept = $_POST['dept'];

    if(!empty($name) && !empty($dob) && !empty($sex)){
      $query = "INSERT INTO `staff_master`(`staff_name`, `date_of_birth`, `sex`, `dept`) VALUES ('$name', '$dob', '$sex', '$dept')";
      if($query_result = mysql_query($query)){
        echo '<div class="success-handle success-1">Successfully Added!</div>';
      }
      else{
        echo '<div class="error-handle error-4">Error while adding Staff!</div>';
      }
    }
    else{
      echo '<div class="error-handle error-4">Enter Valid Values Please.</div>';
    }
  }

?>

<form class="form-horizontal" style="padding-top:5em;" role="form" method="POST" action="<?php echo 'addstaff.php'?> " >
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
    <div class="col-sm-4">
      <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">DOB(yyyy-mm-dd)</label>
    <div class="col-sm-4">
      <input name="dob" type="text" class="form-control" id="inputEmail3" placeholder="Date of Birth">
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
    <label for="inputEmail3" class="col-sm-3 control-label">Department</label>
    <div class="col-sm-4">
      <select name="dept" >
        <option value="Agent">Agent</option>
        <option value="Collector">Collector</option>
        <option value="Staff">Staff</option>
        <option value="Auction">Auction</option>
        <option value="CS">CS</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add Staff">
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