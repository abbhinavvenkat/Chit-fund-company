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
    <div  class="title-txt-cnt">
      <h1>Add a new Subscription Group</h1>
    </div>
   
    <div class="nav-bar">
      <input class="btn btn-primary" style="margin-left:45%;" type="submit" value="Go Back" onclick="window.location='groups.php';" />
      <?php

  require 'conn.inc.php';


  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $amt = $_POST['amt'];
    $freq = $_POST['freq'];
    
    if(!empty($amt) && !empty($freq)){
      $no_of_subs = 0;
      $query = "INSERT INTO `group_master`(`no_of_subs`, `amount`, `frequency`) VALUES ('$no_of_subs', '$amt', '$freq')";
      if($query_result = mysql_query($query)){
        echo '<div class="success-handle success-1">Successfully Added!</div>';
      }
      else{
        echo '<div class="error-handle error-4">Error while adding Group!</div>';
      }
    }
    else{
      echo '<div class="error-handle error-4">Enter All Values Please.</div>';
    }
  }

?>

  
<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'add_subgroup.php'?> " >
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Amount of Subscription</label>
    <div class="col-sm-4">
      <input name="amt" type="text" class="form-control" id="inputEmail3" placeholder="Amount of Subscription">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Frequency of Meeting(M/W)</label>
    <div class="col-sm-4">
      <select name="freq" >
        <option value="M">M</option>
        <option value="W">W</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add Group">
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
