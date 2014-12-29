<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/P3.css">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Julius+Sans+One">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster+Two">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie Flower">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Josefin+Sans">
</head>
<body>



<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt">
      <h1>Sign in</h1>
    </div>
    <?php

require 'conn.inc.php';

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST['user_id']) && isset($_POST['pass']))
  {
    $user = $_POST['user_id'];
    $pass = $_POST['pass'];

    if(!empty($user) && !empty($pass))
    {
      $pass_hash = md5($pass);
      $query = "SELECT user_id, user_level FROM user_master WHERE user_id='$user' AND user_password='$pass_hash'" ;

      if($query_run = mysql_query($query))
      {
        $num = mysql_num_rows($query_run);
        if($num == 0)
        {
          echo '<div class="error-handle error-1">Invalid User ID & Password Combination</div>';
        }
        else if ($num == 1)
        {
          $user_id = mysql_result($query_run, 0, 'user_id');
          $user_level = mysql_result($query_run, 0, 'user_level');
          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_level'] = $user_level;
          header('Location: index.php');
        }
      }
      else{
        echo 'Query error!';
      }
    }
    else{
      echo '<div class="error-handle error-2">Do not leave User ID or Password unentered.</div>';
    }
  }
  else
  {
    echo '<div class="error-handle error-3">Log in please</div>';
  }
}

?>
    <div class="nav-bar">
      <form class="form-horizontal control1" role="form" method="POST" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
        <div class="form-group control">
          <label for="inputEmail3" class="col-sm-2 control-label label1">User ID</label>
          <div class="col-sm-4">
            <input name="user_id" class="form-control" id="inputEmail3" placeholder="User ID">
          </div>
        </div>
        <div class="form-group control">
          <label for="inputPassword3" class="col-sm-2 control-label label1">Password</label>
          <div class="col-sm-4">
            <input name="pass"type="password" class="form-control" id="inputPassword3" placeholder="Password">
          </div>
        </div>
        <div class="form-group control">
          <div class="col-sm-offset-2 col-sm-4">
            <input type="submit" class="btn btn-info"value="Log in">
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