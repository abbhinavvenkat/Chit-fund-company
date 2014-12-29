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
  xmlhttp.open("GET","getagent.php",true);
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
    <div  class="title-txt-cnt1">
      <h1>Update Agent Details</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='agent.php';" />
      
        <p>
<div id="selectall"><b></b></div>
</p>


<?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $agent_id = $_POST['agent_id'];
    $agent_status = $_POST['agent_status'];
    $date_inactive = $_POST['date_inactive'];

    if(!empty($agent_id) && !empty($agent_status)){
      if($agent_status==1){
        $date_inactive = NULL;
      }else if(empty($date_inactive)){
        $date_inactive = date("Y-m-d");
      }

      $query = "UPDATE agent_master set agent_active='$agent_status', date_inactive='$date_inactive' where agent_id='$agent_id'";
      if($result = mysql_query($query)){
        echo '<div class="success-handle success-1">Successfully Updated!</div>';
      }else{
        echo '<div class="error-handle error-5">Error!</div>';
      }

    }else{
      echo '<div class="error-handle error-5">Enter all Values</div>';
    }
  }
?>


<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'updagent.php'?> "> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Agent ID</label>
    <div class="col-sm-4">
      <select name='agent_id' id='agent_id'>
  <?php
  $query = "SELECT agent_id from agent_master";
  $run = mysql_query($query);

  while($row = mysql_fetch_array($run)){
   $str = "<option>".$row['agent_id']."</option>";
   echo $str;
  }

  echo "</select><br>";

?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Agent Active(1)/Inactive(2)</label>
    <div class="col-sm-4">
      <select name="agent_status" >
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Date Inactive</label>
    <div class="col-sm-4">
      <input name="date_inactive" type="text" class="form-control" id="inputEmail3" placeholder="Date Inactive">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Update Agent">
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