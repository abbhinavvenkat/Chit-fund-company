<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../dist/css/adminhome.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Julius+Sans+One">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Lobster+Two">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Indie Flower">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz">
<?php
  require 'core.inc.php';
  
  if(!loggedin()){
    header('Location: index.php');
  }

?>
</head>

<body>
<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt">
      <h1>User Home</h1>
    </div>
   
    <div class="nav-bar">
      
      <div class="function-board" style="padding-left:20em;">
      		<input  class="btn btn-primary" type="submit" value="Auction" onclick="window.location='auction.php';" />
<input  class="btn btn-primary" type="submit" value="Subscriptions" onclick="window.location='groups.php';" />
<input  class="btn btn-primary" type="submit" value="Collector" onclick="window.location='collector.php';" />
<input  class="btn btn-primary" type="submit" value="Agents" onclick="window.location='agent.php';" />
		<a class="btn btn-info" href="logout.php">Logout </a>
      </div>
    
    </div>
  </div>
</div>
  
<div id="footer"> 
	<h5>Created by Abbhinav Venkat & Vishal Thamizharasan</h5>
</div>


</body>
</html>
