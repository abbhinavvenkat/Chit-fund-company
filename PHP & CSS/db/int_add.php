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
    <div  class="title-txt-cnt1">
      <h1>Add Internal Account</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='internals.php';" />
        <?php
  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $acc_name = $_POST['acc_name'];
    $acc_no = $_POST['acc_no'];

    if(!empty($acc_name) && !empty($acc_no)){
      $query = "SELECT acc_id from account_master where acc_id='$acc_no'";
      $result = mysql_query($query);

      if(!mysql_num_rows($result))
      {  
        $query = "INSERT INTO `account_master`(`acc_id`, `acc_name`) VALUES ('$acc_no', '$acc_name')";
        if($result = mysql_query($query)){
          echo '<div class="success-handle success-4">Successfully added account!</div>';
        }else{
          echo '<div class="error-handle error-4">Error while adding account!</div>';
       }
      }else{
        echo '<div class="error-handle error-4">Account Already Exists!</div>';
      }
    }else{
      echo '<div class="error-handle error-7">Enter New Account\'s Name please.</div>';
    }
    
    
  }


?>

<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'int_add.php'?> " > 
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Account Name & Details</label>
    <div class="col-sm-4">
      <input name="acc_name" type="text" class="form-control" id="inputEmail3" placeholder="Account Name & Details">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Account Number</label>
    <div class="col-sm-4">
        <input  name="acc_no"  type="text" class="form-control" id="inputEmail3" placeholder="Account Number">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add New Company Account">
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