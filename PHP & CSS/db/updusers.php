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
      <h1 style="margin-left:-1em;">Update User Level</h1>
    </div>
   
    <div class="nav-bar">
         <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='users.php';" />
        <p>
<div id="selectall"><b></b></div>
</p>

<h4 style="padding-left:5.5em;"> Update User Access Level</h4>



<?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $user_id = $_POST['user_id'];
    $user_level = $_POST['user_level'];

    if(!empty($user_id) && !empty($user_level)){
      $query = "select user_id from user_master where user_id='$user_id'";
      if($result = mysql_query($query)){
        if(mysql_num_rows($result)!=1){
          echo '<div class="error-handle error-5">Invalid User ID</div>';
        }
        else{
          if(!($user_level==1 || $user_level==9)){
            echo '<div class="error-handle error-5">Invalid User Level</div>';
          }
          else{
            $query = "update user_master set user_level='$user_level' where user_id='$user_id'";
            if($result = mysql_query($query)){
              echo '<div class="success-handle success-2">Successfully Updated Access level!</div>';
            }
            else{
              echo '<div class="error-handle error-6">Error while trying to Update. Try Again!</div>';  
            }
          }
        }
      }
      else{
        echo '<div class="error-handle error-5">Unable to Update! Try Again!</div>';
      }
      }else{
        echo '<div class="error-handle error-6">Please enter valid User ID & Access Level</div>';
      }
  }
?>


<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'updusers.php'?> " >
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
    <div class="col-sm-4">
      <input name="user_id" type="text" class="form-control" id="inputEmail3" placeholder="User ID">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Access Level (1 or 9)</label>
    <div class="col-sm-4">
      <select name="user_level" >
        <option value="1">1</option>
        <option value="9">9</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Update User Level">
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