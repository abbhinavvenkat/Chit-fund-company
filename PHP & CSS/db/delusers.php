<html>
<head>
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
function showusers() {
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
  xmlhttp.open("GET","getusers.php",true);
  xmlhttp.send();
}

</script>



</head>
<body onload="showusers()">


<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt">
      <h1>Delete User</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='users.php';" />
      <p>
<div id="selectall"><b></b></div>
</p>

<h4 style="padding-left:2em;"> Enter the User ID to revoke system access</h4>



<?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_POST['user_id'];

    if(!empty($user_id)){
      $query = "select user_id from user_master where user_id='$user_id'";
      $result = mysql_query($query);
      if(mysql_num_rows($result)!=1){
        echo '<div class="error-handle error-5">Invalid User ID!</div>';
      }else if(mysql_num_rows($result)){
       $query = "delete from user_master where user_id='$user_id'";
       if($result = mysql_query($query)){
         echo '<div class="success-handle success-4">User Successfully Deleted!</div>';
       }
       else{
         echo '<div class="error-handle error-6">Error while attempting to delete user. Try Again!</div>';
       }
      }
    }else{
      echo '<div class="error-handle error-6">User couldn\'t be deleted! Enter valid details</div>';
    }
  }
?>



<form class="form-horizontal" style="padding-top:1em;" role="form" method="POST" action="<?php echo 'delusers.php'?> " >
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
    <div class="col-sm-4">
      <input name="user_id" type="text" class="form-control" id="inputEmail3" placeholder="User ID">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Delete User">
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