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
function show() {
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
  xmlhttp.open("GET","getacc.php",true);
  xmlhttp.send();
}

function showtrans() {
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
  xmlhttp.open("GET","trans_view.php",true);
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
    <div  class="title-txt-cnt1">
      <h1>Company Accounts</h1>
    </div>
   
    <div class="nav-bar">
      
      <div class="function-board">
        <input type="submit" class="btn btn-primary" value="Home" onclick="window.location='index.php';" />
         <input type="submit" class="btn btn-primary" value="View Transactions" onclick="showtrans()" />
<input type="submit" class="btn btn-primary" value="View Accounts" onclick="show()" />
 <input type="submit" class="btn btn-success" value="Add Account" onclick="window.location='int_add.php';" />
<input type="submit" class="btn btn-success" value="Add New Transaction" onclick="window.location='trans_add.php';" />

<input type="submit" class="btn btn-info" value="Logout" onclick="window.location='logout.php';" />

      </div>
        <div id="selectall" name="selectall"></div>
    </div>
  </div>
</div>
  
<div id="footer"> 
  <h5>Created by Abbhinav Venkat & Vishal Thamizharasan</h5>
</div>


</body>

</html>