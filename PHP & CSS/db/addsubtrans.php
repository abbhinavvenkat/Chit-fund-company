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
</head>


<body>




<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-cnt">
      <h1>Add new Subscriber Transaction</h1>
    </div>
   
    <div class="nav-bar">
      <input class="btn btn-primary" style="margin-left:45%;" type="submit" value="Go Back" onclick="window.location='groups.php';" />
      
        <?php

  require 'conn.inc.php';

  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $sub_id = $_POST['sub_id'];
    $coll_id = $_POST['coll_id'];
    $t_date = $_POST['t_date'];
    $cash_cheque = $_POST['cash_cheque'];
    $amount = $_POST['amount'];
    $cheque_no = $_POST['cheque_no'];
    $grp_id = $_POST['grp_id'];

    if($cash_cheque == 2 && empty($cheque_no)){
      echo '<div class="error-handle error-4">Enter Cheque Number!</div>';
    }else{

    if(!empty($sub_id) && !empty($coll_id) && !empty($t_date) && !empty($cash_cheque) && !empty($amount) && !empty($grp_id) )
    {
      $query = "select agent_id from subscriber_master where sub_id='$sub_id'";
      $query_result = mysql_query($query);
      $agent_id = mysql_result($query_result, 0, 'agent_id');

      $q = "SELECT * from subscriber_group where sub_id='$sub_id' and grp_id='$grp_id'";
      $r = mysql_query($q);

      if(mysql_num_rows($r)==0){
        echo '<div class="error-handle error-4">Invalid Group</div>';
      }else{


      if($cash_cheque==1){
         $query = "INSERT INTO `receipt_payments`(`sub_id`, `coll_id`, `agent_id`, `trans_date`, `amount`, `rec_cash_cheque`, `grp_id`) VALUES ('$sub_id', '$coll_id', '$agent_id', '$t_date', '$amount','$cash_cheque', '$grp_id') ";
      }else{
         $query = "INSERT INTO `receipt_payments`(`sub_id`, `coll_id`, `agent_id`, `chq_no`, `trans_date`, `amount`, `rec_cash_cheque`, `grp_id`) VALUES ('$sub_id', '$coll_id', '$agent_id', '$cheque_no', '$t_date', '$amount','$cash_cheque', '$grp_id') ";
       }
     

      if($query_result = mysql_query($query)) {
        
        if($cash_cheque==2){
          $query = "INSERT INTO `cheque_master`(`chq_no`, `sub_id`, `trans_date`, `lodged_date`, `amount`, `payment_status`) VALUES ('$cheque_no','$sub_id', '$t_date','$t_date', '$amount','2' )";
          $mysql_result = mysql_query($query);

          $query = "select trans_id from receipt_payments where chq_no='$cheque_no";
          $query_result = mysql_query($query);
          $trans_id = mysql_result($query_result, 0, 'trans_id');
        }else{
          $query = "select trans_id from receipt_payments where sub_id='$sub_id' and grp_id='$grp_id' and trans_date='$t_date' and coll_id='$coll_id' and amount='$amount' and rec_cash_cheque='$cash_cheque'";
          $query_result = mysql_query($query);
          $trans_id = mysql_result($query_result, 0, 'trans_id'); 
        }

        $query = "INSERT INTO `subscriber_ledger`(`trans_id`, `sub_id`, `trans_date`, `amount`) VALUES ('$trans_id', '$sub_id', '$t_date', '$amount')";
        $query_result = mysql_query($query);


        if($cash_cheque!=2){
        $query = "UPDATE subscriber_group set amount_paid=amount_paid+'$amount' where sub_id='$sub_id' and grp_id='$grp_id'";
        $query2 = "UPDATE account_master set balance=balance+'$amount' where acc_id='1'";
        $date = date("Y-m-d");
        $debit = 2;
        $acc_id = 1;

        $query1 = "INSERT INTO `account_ledger`(`trans_date`, `debit_credit`, `amount`, `acc_id`) VALUES ('$date', '$debit', '$amount', '$acc_id')";
        
        if($result1 = mysql_query($query1) && $result2 = mysql_query($query2) && $query_result = mysql_query($query)){
           echo '<div class="success-handle success-1">Successfully Added Transaction!</div>';
        }else{
           echo '<div class="error-handle error-4">Error While Adding!</div>';
        }
        
        }else{
          echo '<div class="success-handle success-1">Added Successfully!</div>';
        }
      }
      else{
        echo '<div class="error-handle error-7">Error while adding Subscriber Transaction!</div>';
      }


    }

  }
    else{
      echo '<div class="error-handle error-7">Enter All necessary Values Please.</div>';
    }

  }

  }

?>

      

<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'addsubtrans.php'?> " > 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Subscriber ID</label>
    <div class="col-sm-4">
      <select name='sub_id' id='sub_id'>
      <?php 
      $query = "select sub_id from subscriber_master";
      $query_result = mysql_query($query);
      while($row = mysql_fetch_array($query_result)){
        $str = "<option>".$row['sub_id']."</option>";
        echo $str;
        }

      echo "</select><br>";
      ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Collector ID</label>
    <div class="col-sm-4">
      <select name='coll_id' id='coll_id'>
      <?php 
      $query = "select coll_id from collector_master";
      $query_result = mysql_query($query);
      while($row = mysql_fetch_array($query_result)){
        $str = "<option>".$row['coll_id']."</option>";
        echo $str;
        }

      echo "</select><br>";
      ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Group ID</label>
    <div class="col-sm-4">
      <select name='grp_id' id='grp_id'>
      <?php 
      $query = "select grp_id from group_master";
      $query_result = mysql_query($query);
      while($row = mysql_fetch_array($query_result)){
        $str = "<option>".$row['grp_id']."</option>";
        echo $str;
        }

      echo "</select><br>";
      ?>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Transaction date(YYYY-MM-DD)</label>
    <div class="col-sm-4">
      <input name="t_date" type="text" class="form-control" id="inputEmail3" placeholder="Transaction date">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Amount</label>
    <div class="col-sm-4">
        <input name="amount" type="text" class="form-control" id="inputEmail3" placeholder="Amount">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Cash/Cheque (1 - Cash, 2- Cheque)</label>
    <div class="col-sm-4">
      <select name="cash_cheque" >
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Cheque Number(if applicable)</label>
    <div class="col-sm-4">
       <input name="cheque_no" type="text" class="form-control" id="inputEmail3" placeholder="Cheque Number">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-info" value="Add Transaction">
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