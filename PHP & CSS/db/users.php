<html>
<head>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/staff.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Julius+Sans+One">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster+Two">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie Flower">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz">
<style type="text/css">
.function-board-user{
  background: #A8AFC7;
  padding-left: 10em;
  padding-top: 20px;
  padding-bottom: 20px;
  width:70em;
  margin-left: auto;
  margin-right: auto;
  margin-top: 1em;
  border-radius: 5px;
  -webkit-box-shadow: -4px 2px 54px -18px rgba(0,0,0,0.75);
-moz-box-shadow: -4px 2px 54px -18px rgba(0,0,0,0.75);
box-shadow: -4px 2px 54px -18px rgba(0,0,0,0.75);
}

.title-txt-user h1{
  font-family: 'Yanone Kaffeesatz', serif;
  color: #2D67A3;
  font-weight: 900;
  padding-left: 6.5em;
  padding-top: 0.5em;
  font-size: 4em;
}
</style>
<?php
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
<body>

<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-user">
      <h1>System User Details</h1>
    </div>
   
    <div class="nav-bar">
      

    <div class="function-board-user">
    
    <input class="btn btn-primary" type="submit" value="Home" onclick="window.location='index.php';" />
    <input class="btn btn-primary" type="submit" value="View all Users" onclick="showusers()" />
   
    <input class="btn btn-primary" type="submit" value="Change User Access Level" onclick="window.location='updusers.php';" />
     <input class="btn btn-success" type="submit" value="Add New Users" onclick="window.location='addusers.php';" />
    <input class="btn btn-danger" type="submit" value="Delete Users" onclick="window.location='delusers.php';" />
    <a class="btn btn-info" href="logout.php">Logout </a>

    </div>
    <div id="selectall"><b></b></div>
    </div>
  </div>
</div>
  
<div id="footer"> 
  <h5>Created by Abbhinav Venkat & Vishal Thamizharasan</h5>
</div>




</body>

</html>