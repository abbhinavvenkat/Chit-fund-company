<html>
<head>
<?php

  require 'conn.inc.php';
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
function showtable() {
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
  xmlhttp.open("GET","addauction_ajax.php",true);
  xmlhttp.send();
}

</script>
</head>
<body onload="showtable()">

<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt">
      <h1>Add Auction</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" value="Go Back" class="btn btn-primary" style="margin-left:45%;" onclick="window.location='auction.php';" />
      <p>
      <div id="selectall"><b></b></div>
      </p>

<?php
  $query = "select grp_id from group_master";
  $run = mysql_query($query);

  echo "<h4>Select the group for which the auction was conducted</h4>";
?>

<form style="margin-left:15em;" method='POST' action="<?php echo 'redirect.php'?>">

<?php

  echo "<label>Group ID</label> <select name='grp_id' id='grp_id'> ";

  while($row = mysql_fetch_array($run)){
   $str = "<option>".$row['grp_id']."</option>";
   echo $str;
  }
  echo "</select><br><br><input class=\"btn btn-info\" style=\"margin-left:4.5em;\"type=\"submit\" value=\"Add Further Details\"></form>";

?>

    </div>
  </div>
</div>
  
<div id="footer"> 
  <h5>Created by Abbhinav Venkat & Vishal Thamizharasan</h5>
</div>

</body>
</html>