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
</head>
<body>



<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-cnt1">
      <h1>Add Account Transaction</h1>
    </div>
   
    <div class="nav-bar">
            <input type="submit" class="btn btn-primary" style="margin-left:45%;" value="Go Back" onclick="window.location='internals.php';" />

          <?php

  if ($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $date = $_POST['date'];
    $debit = $_POST['deb_cre'];
    $amount = $_POST['amt'];
    $acc_name = $_POST['acc_name'];

    if(!empty($date) && !empty($acc_name) && !empty($debit) && !empty($amount)){
      $query = "SELECT acc_id from account_master where acc_name='$acc_name'";
      $result = mysql_query($query);
      $acc_id = mysql_result($result, 0, 'acc_id');
      
      if($debit==1){
          $query = "SELECT balance from account_master where acc_id='$acc_id'";
          $result = mysql_query($query);
          $balance = mysql_result($result, 0, 'balance');

          if($balance-$amount >= 0){
            $query1 = "INSERT INTO `account_ledger`(`trans_date`, `debit_credit`, `amount`, `acc_id`) VALUES ('$date', '$debit', '$amount', '$acc_id')";
            $query2 = "UPDATE account_master set balance=balance-'$amount' where acc_id='$acc_id'";
            

            if($result1 = mysql_query($query1) && $result2 = mysql_query($query2)){
              echo '<div class="success-handle success-4">Successfully Added Transaction!</div>';
            }else{
              echo '<div class="error-handle error-5">Error While Adding!</div>';
            }
          }else{
            echo '<div class="error-handle error-5">Insufficient Balance!</div>';
          }
          
        }else if($debit==2){
          $query2 = "UPDATE account_master set balance=balance+'$amount' where acc_id='$acc_id'";
          $query1 = "INSERT INTO `account_ledger`(`trans_date`, `debit_credit`, `amount`, `acc_id`) VALUES ('$date', '$debit', '$amount', '$acc_id')";
          
          if($result1 = mysql_query($query1) && $result2 = mysql_query($query2)){
              echo '<div class="success-handle success-4">Successfully Added Transaction!</div>';
            }else{
              echo '<div class="error-handle error-5">Error While Adding!</div>';
            }
        }

      
    }else{
      echo '<div class="error-handle error-5">Enter all Fields!</div>';
    }
    
    
  }


?>
    
<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'trans_add.php'?> " > 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Transaction Date (YYYY-MM-DD)</label>
    <div class="col-sm-4">
      <input name="date" type="text" class="form-control" id="inputEmail3" placeholder="Transaction Date">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Debit(1)/Credit(2)</label>
    <div class="col-sm-4">
      <select name="deb_cre" >
        <option value="1">1</option>
        <option value="2">2</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Amount</label>
    <div class="col-sm-4">
      <input name="amt" type="text" class="form-control" id="inputEmail3" placeholder="Amount">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Account Name</label>
    <div class="col-sm-4">
        <?php
      $query = "SELECT acc_name from account_master";
      $run = mysql_query($query);

      echo "<select name='acc_name' id='acc_name'> ";

      while($row = mysql_fetch_array($run)){
        $str = "<option>".$row['acc_name']."</option>";
        echo $str;
        }
        echo "</select><br><br>";

      ?>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
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