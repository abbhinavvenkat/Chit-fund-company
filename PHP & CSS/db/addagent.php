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
  xmlhttp.open("GET","getstaff.php",true);
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
      <h1>Add Agent</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='agent.php';" />
      
        <p>
<div id="selectall"><b></b></div>
</p>
    

<?php

  if($_SERVER['REQUEST_METHOD']=='POST'){

    $id = $_POST['name'];
    $addr = $_POST['addr'];
    
    if(!empty($id) && !empty($addr)){

      $query = "SELECT * from staff_master where user_id='$id'";
      $result = mysql_query($query);
      $name = mysql_result($result, 0, 'staff_name'); 
      $dob = mysql_result($result, 0, 'date_of_birth'); 
      $sex = mysql_result($result, 0, 'sex'); 

      $query = "SELECT * from agent_master where name='$name' and address='$addr' and date_of_birth='$dob'";
      $result = mysql_query($query);

      if(mysql_num_rows($result)>=1){
        echo '<div class="error-handle error-5">Agent Already Exists</div>';
      }else{

      $query = "INSERT INTO `agent_master`( `name`, `address`, `sex`, `date_of_birth`, `agent_active`) VALUES ('$name', '$addr', '$sex', '$dob', '1')";
      if($result = mysql_query($query)){
        echo '<div class="success-handle success-4">Successfully Added Agent!</div>';
      }else{
        echo '<div class="error-handle error-5">Error while adding!</div>';
      }

      }

    }else{
      echo '<div class="error-handle error-5">Enter all Values</div>';
    }
  
}

?>


<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'addagent.php'?>"> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Staff ID</label>
    <div class="col-sm-4">
      <select name='name' id='name'>
<?php
  $query = "SELECT user_id from staff_master where dept='agent' ";
  $run = mysql_query($query);

  while($row = mysql_fetch_array($run)){
   $str = "<option>".$row['user_id']."</option>";
   echo $str;
  }

  echo "</select><br>";

?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Address</label>
    <div class="col-sm-4">
      <input name="addr" type="text" class="form-control" id="inputEmail3" placeholder="Address">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add Agent">
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