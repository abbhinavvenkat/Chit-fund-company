<html>
<head>
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

<script>
function showstaff() {
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
  xmlhttp.open("GET","getstaff.php",true);
  xmlhttp.send();
}

</script>

<style type="text/css">

.title-txt-updtstaff h1{
  font-family: 'Yanone Kaffeesatz', serif;
  color: #2D67A3;
  font-weight: 900;
  padding-left: 6.5em;
  padding-top: 0.5em;
  font-size: 4em;
}
</style>

</head>
<body onload="showstaff()">




<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-updtstaff">
      <h1>Update Staff Details</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='staff.php';" />
     <p>
      <div id="selectall"><b></b></div>
     </p>

      



    <?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $sex = $_POST['sex'];
    $dept = $_POST['dept'];
    $flag=0;
    if(!empty($user_id)){
      $query = "select user_id from staff_master where user_id='$user_id'";
      $result = mysql_query($query);
      if(mysql_num_rows($result)!=1){
        echo '<div class="error-handle error-3">Invalid User ID!</div>';
      }else if(mysql_num_rows($result)){
        if(!empty($name)){
          $query = "update staff_master set staff_name='$name' where user_id='$user_id'";
          if($result = mysql_query($query)){
            $temp=0;
          }else{
            $flag=1;
          }
        }
        if(!empty($dob)){
          $query = "update staff_master set date_of_birth='$dob' where user_id='$user_id'";
          if($result = mysql_query($query)){
            $temp=0;
          }else{
            $flag=1;
          }
        }
        if(!empty($sex)){
          $query = "update staff_master set sex='$sex' where user_id='$user_id'";
          if($result = mysql_query($query)){
            $temp=0;
          }else{
            $flag=1;
          }
        }
        if(!empty($dept)){
          $query = "update staff_master set dept='$dept' where user_id='$user_id'";
          if($result = mysql_query($query)){
            $temp=0;
          }else{
            $flag=1;
          }
          $query = "select user_id from user_master where user_id='$user_id'";
          if($result = mysql_query($query)){
            if(mysql_num_rows($result)){
              $query = "update user_master set dept='$dept' where user_id='$user_id'";
              $result = mysql_query($query);
            }
          }else{

          }
        }
          if($flag==1){
            echo '<div class="error-handle error-1">Error while updating! Try Again!</div>';
          }else if($flag==0){
            echo '<div class="success-handle success-2">Successfully Updated Staff Member!</div>';
          }
      }

    }else{
      echo '<div class="error-handle error-2">Staff couldn\'t be updated! Enter valid details</div>';
    }
  }
?>




    <h4> Update Staff Details by keying in the below details </h4>
<form class="form-horizontal" role="form" method="POST" action="<?php echo 'updstaff.php'?> " >
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
    <div class="col-sm-4">
      <input name="user_id" type="text" class="form-control" id="inputEmail3" placeholder="User ID">
    </div>
  </div>
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
      <!--<input name="sex" type="text" class="form-control" id="inputEmail3" placeholder="Sex">-->
      <select name="sex" >
        <option value="M">M</option>
        <option value="F">F</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Department</label>
    <div class="col-sm-4">
      <!--<input name="dept" type="text" class="form-control" id="inputEmail3" placeholder="Department">-->
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
      <input type="submit" class="btn btn-info" value="Update Staff">
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