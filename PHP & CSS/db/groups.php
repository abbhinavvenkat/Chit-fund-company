<!DOCTYPE html>
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
<script>
function show_sub() {
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
  xmlhttp.open("GET","getgroups.php",true);
  xmlhttp.send();
}

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
  xmlhttp.open("GET","get_subtrans.php",true);
  xmlhttp.send();
}

function show_default() {
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
  xmlhttp.open("GET","default_subs.php",true);
  xmlhttp.send();
}

function show_allsubs() {
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safaris
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("selectall").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","getsubdetails.php",true);
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
    <div  class="title-txt">
      <h1>Subscribers</h1>
    </div>
   
    <div class="nav-bar">
      
      <div class="function-board">
         
<input type="submit" class="btn btn-primary" value="Home" onclick="window.location='index.php';" />


      <div class="btn-group">
        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" style="padding-right:10px;"></span>View</button>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a value="View all Subscription Groups" onclick="show_sub()" >Subscription Groups</a></li>
          <li><a value="View Subscriber Transactions" onclick="show()" >Subscriber Transactions</a></li>
          <li><a value="View Defaulting Subscribers" onclick="show_default()" >Defaulting Subscribers</a></li>
          <li><a value="View Defaulting Subscribers" onclick="show_allsubs()" >Subscriber Details</a></li>
        </ul>
      </div>
      <div class="btn-group">
        <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus" style="padding-right:10px;"></span>Add</button>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
          <li><a value="Add new Subscription Group" onclick="window.location='add_subgroup.php';" >Subscription Group</a></li>
          <li><a value="Add Subscriber to New Group" onclick="window.location='addsubnewgrp.php';" >Subscriber to New Group</a></li>
          <li><a value="Add new Subscriber Transaction" onclick="window.location='addsubtrans.php';" >Subscriber Transaction</a></li>
        </ul>
      </div>

<input class="btn btn-primary" type="submit" value="Create New Subscriber" onclick="window.location='createsub.php';" />
<input class="btn btn-primary" type="submit" value="Update Cheque Retrival" onclick="window.location='updchq.php';" />
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