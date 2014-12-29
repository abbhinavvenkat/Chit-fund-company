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
      document.getElementById("selectallstaff").innerHTML=xmlhttp.responseText;
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
      <h1>Add User</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='users.php';" />
        <div id="selectallstaff"><b></b></div>



    <h4>  Select A Staff Member from above to give access to the software </h4>

<?php

  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $user_id = $_POST['user_id'];
    $user_level = $_POST['user_level'];
    $password = $_POST['password'];

    if(!empty($user_id) && !empty($user_level) && !empty($password)){
      $q = "select * from user_master where user_id='$user_id'";
      if($run=mysql_query($q)){
        if(mysql_num_rows($run)){
          echo '<div class="error-handle error-3">User Already Exists!</div>';
        }
        else if(!mysql_num_rows($run)){
          $query = "select * from staff_master where user_id='$user_id'";
          if($result=mysql_query($query)){
            if(mysql_num_rows($result)!=1){
              echo '<div class="error-handle error-3">Invalid User ID</div>';
            }
            else{
              $pass_hash = md5($password);
              if(!($user_level==1 || $user_level==9)){
                echo 'Invalid User Access Level. Try Again!';
              }
              else{
                $name = mysql_result($result, 0, 'staff_name');
                $dept = mysql_result($result, 0, 'dept');
                $query = "INSERT INTO `user_master`(`user_id`, `user_password`, `user_level`, `name`, `dept`) VALUES ('$user_id','$pass_hash','$user_level','$name','$dept')";
                if($result=mysql_query($query)){
                  echo '<div class="success-handle success-4">User Added Successfully!</div>';
                }
                else{
                  echo '<div class="error-handle error-4">Error While Adding User. Try Again!</div>';
                }
              }
            }
          }
          else
          {
            echo '<div class="error-handle error-4">Unable to Add User</div>';
          }
        }
      }
    }
    else{
      echo '<div class="error-handle error-4">Enter Valid Values Please.</div>';
      }
  }


?>

<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'addusers.php'?> " >
 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">User ID</label>
    <div class="col-sm-4">
      <input name="user_id" type="text" class="form-control" id="inputEmail3" placeholder="User ID">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Password</label>
    <div class="col-sm-4">
      <input name="password" type="password" class="form-control" id="inputEmail3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">User Access Level(1/9)</label>
    <div class="col-sm-4">
      <select name="user_level" >
        <option value="1">1</option>
        <option value="9">9</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add User">
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