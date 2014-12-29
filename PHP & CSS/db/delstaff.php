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
</head>
<body onload="showstaff()">

<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt">
      <h1>Delete Staff</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='staff.php';" />
      <p>
<div id="selectall"><b></b></div>
</p>


  <?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_POST['user_id'];

    if(!empty($user_id)){
      $query = "select user_id from staff_master where user_id='$user_id'";
      $result = mysql_query($query);
      if(mysql_num_rows($result)!=1){
        echo '<div class="error-handle error-5">Invalid User ID!</div>';
      }else if(mysql_num_rows($result)){
       $query = "delete from staff_master where user_id='$user_id'";
       if($result = mysql_query($query)){
         echo '<div class="success-handle success-4">Staff Successfully Deleted!</div>';
       }
       else{
         echo '<div class="error-handle error-2">Error while attempting to delete staff. Try Again!</div>';
       }
      }
    }else{
      echo '<div class="error-handle error-6">Staff couldn\'t be deleted! Enter valid details</div>';
    }
  }
?>

<form class="form-horizontal" role="form" method="POST" action="<?php echo 'delstaff.php'?> " >
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
    <div class="col-sm-4">
      <input name="user_id" type="text" class="form-control" id="inputEmail3" placeholder="User ID">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Delete Staff">
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