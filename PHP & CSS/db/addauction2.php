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
  xmlhttp.open("GET","subscriber_master.php",true);
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
    <div  class="title-txt-cnt1">
      <h1>Add Auction Details</h1>
    </div>
   
    <div class="nav-bar">
      <input type="submit"  class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='auction.php';" />
      <p>
<div id="selectall"><b></b></div>
</p>

      <?php


  if($_SERVER['REQUEST_METHOD']=='POST'){
  
    $amt = $_POST['amount'];
    $flag = $_POST['flag'];
    $mom = $_POST['mom'];
    $date = $_POST['date'];
    $sub_id = $_POST['sub_id'];
    $grp_id = $_SESSION['grp_id'];

    if(!empty($amt) && !empty($flag) && !empty($mom) ){
      if($flag == 'Y' || $flag == 'N'){
        $grp_id = $_SESSION['grp_id'];
        $query = "INSERT INTO `auction_master`(`grp_id`, `sub_id`, `date`, `amount`, `flag`, `minutes_of_meeting`) VALUES ('$grp_id','$sub_id','$date','$amt','$flag','$mom')";
        if($result = mysql_query($query)){
          $query = "select * from subscriber_group where grp_id='$grp_id'";
          $run = mysql_query($query);

          while($row = mysql_fetch_array($run)){
          $str = $row['sub_id'];
          $amount_paid = $row['amount_paid'];

          $query = "select * from group_master where grp_id='$grp_id'";
          $result = mysql_query($query);
          $sub_amount = mysql_result($result, 0, 'amount');

          if($amount_paid>=$sub_amount){
            $query = "update subscriber_group set amount_paid=amount_paid-'$sub_amount', sub_pay_status='Y' where sub_id='$str' and grp_id='$grp_id'";
            $result = mysql_query($query);
          }else{
            $query = "DELETE FROM `subscriber_group` WHERE grp_id='$grp_id' AND sub_id='$str'";
            $result = mysql_query($query);

            $query = "UPDATE group_master set no_of_subs=no_of_subs-1 where grp_id='$grp_id'";
            $result = mysql_query($query);

            $d = date("Y-m-d");

            $query = "UPDATE group_member set grp_date_closed='$d', grp_active='0', defaulted='1' where grp_id='$grp_id' and sub_id='$str'";
            $result = mysql_query($query);
          }
   
          }


          $query = "select * from subscriber_group where grp_id='$grp_id' and sub_id='$sub_id'";
          $result = mysql_query($query);
          
          if(mysql_num_rows($result)==0){
            echo '<div class="error-handle error-6">The Prized Subscriber has defaulted. Auction has to be reconducted!</div>';
          }else{

          $query = "select * from group_master where grp_id='$grp_id'";
          $result = mysql_query($query);
          $sub_amount = mysql_result($result, 0, 'amount');
          $no_of_subs = mysql_result($result, 0, 'no_of_subs');

          if($amt<$sub_amount/2){

          $query = "UPDATE account_master set balance=balance-'$amt' where acc_id='1'";
          $result = mysql_query($query);

          $query = "INSERT INTO `account_ledger`(`trans_date`, `debit_credit`, `amount`, `acc_id`) VALUES ('$date','1','$amt','1')";
          $result = mysql_query($query);

          $return = ($sub_amount*$no_of_subs)-$amt;
          $return = 0.95 * $return;
          if($return>0){
            $query = "UPDATE account_master set balance=balance-'$return' where acc_id='1'";
            $result = mysql_query($query);
            $query = "INSERT INTO `account_ledger`(`trans_date`, `debit_credit`, `amount`, `acc_id`) VALUES ('$date','1','$return','1')";
            $result = mysql_query($query);
            echo '<div class="success-handle success-1">Successfully Added Record!</div>';
          }
          
          }else{
            echo '<div class="error-handle error-6">Subscription Amount too high. Re-conduct Auction.</div>';
            $query = "DELETE from auction_master where grp_id='$grp_id' and sub_id='$sub_id' and date='$date'";
            $result = mysql_query($query);
          }

        }
        }

      }else{
        echo '<div class="error-handle error-4">Enter Valid Guarantee Flag Value</div>';
      }
    }else{
      echo '<div class="error-handle error-4">Please enter all details!</div>';
    }

  
  }


?>
    
<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'addauction2.php'?>" >   
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Prized Subscriber ID</label>
    <div class="col-sm-4">
   <select name='sub_id' id='sub_id'>

<?php
  $grp_id = $_SESSION['grp_id'];

  $query = "select sub_id from subscriber_group where grp_id='$grp_id'";
  $run = mysql_query($query);

  while($row = mysql_fetch_array($run)){
   $str = "<option>".$row['sub_id']."</option>";
   echo $str;
  }

  echo "</select>";

?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>
    <div class="col-sm-4">
      <input name="amount"  type="text" class="form-control" id="inputEmail3" placeholder="Amount">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Guarantee Provided (Y/N)</label>
    <div class="col-sm-4">
      <select name="flag" >
        <option value="Y">Y</option>
        <option value="N">N</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Minutes Of the Meeting</label>
    <div class="col-sm-4">
      <input name="mom" type="text" class="form-control" id="inputEmail3" placeholder="Minutes Of the Meeting">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Date(YYYY-MM-DD)</label>
    <div class="col-sm-4">
      <input name="date" type="text" class="form-control" id="inputEmail3" placeholder="Date">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add Auction">
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