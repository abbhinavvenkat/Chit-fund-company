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
function showcheque() {
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
  xmlhttp.open("GET","getcheque.php",true);
  xmlhttp.send();
}

</script>


</head>
<body onload="showcheque()">

<div id="container">  

  <header class="header-img">
      <a href="#"><h2>Chit Fund Company</h2></a>
  </header>

  <div id="content">
    <div  class="title-txt-cnt1">
      <h1>Update Cheque Retrival</h1>
    </div>
   
    <div class="nav-bar">
      <input class="btn btn-primary" style="margin-left:45%;" type="submit" value="Go Back" onclick="window.location='groups.php';" />

        <p>
<div id="selectall"><b></b></div>
</p>

<br>

<?php

  if ($_SERVER["REQUEST_METHOD"]=="POST"){
    
    $chq_no = $_POST['chq_no'];
    $pay_stat = $_POST['pay_stat'];
    $settle_date = $_POST['settle_date'];

    if(($pay_stat==1 || $pay_stat==3) && empty($settle_date)){
      echo '<div class="error-handle error-4">Enter Settlement Date</div>';
    }else{

      if(!empty($chq_no) && !empty($pay_stat)){

        if(empty($settle_date)){
          $settle_date=NULL;
        }

        $query = "update cheque_master set payment_status='$pay_stat', settle_date='$settle_date' where chq_no='$chq_no'";

        if($query_result = mysql_query($query)){
          
          if($pay_stat==1){
            $query = "select sub_id from cheque_master where chq_no='$chq_no'";
            $query_result = mysql_query($query);
            $sub_id = mysql_result($query_result, 0, 'sub_id');

            $query = "select * from receipt_payments where chq_no='$chq_no'";    
            $query_result = mysql_query($query);
            $grp_id = mysql_result($query_result, 0, 'grp_id');
            $amount = mysql_result($query_result, 0, 'amount');            

            $query = "UPDATE subscriber_group set amount_paid=amount_paid+'$amount' where sub_id='$sub_id' and grp_id='$grp_id'";
            $query_result = mysql_query($query);

            $query2 = "UPDATE account_master set balance=balance+'$amount' where acc_id='1'";
            $date = date("Y-m-d");
            $debit = 2;
            $acc_id = 1;

            $query1 = "INSERT INTO `account_ledger`(`trans_date`, `debit_credit`, `amount`, `acc_id`) VALUES ('$date', '$debit', '$amount', '$acc_id')";
        
            if($result1 = mysql_query($query1) && $result2 = mysql_query($query2) && $query_result = mysql_query($query)){
              echo '<div class="success-handle success-1">Successfully Updated!</div>';
            }else{
              echo '<div class="error-handle error-4">Error While Adding!</div>';
            }
          }else{
            echo '<div class="success-handle success-1">Successfully Updated</div>';
          }
        }else{
          echo '<div class="error-handle error-4">Unable to Update. Try Again!</div>';
        }

      }else{
        echo '<div class="error-handle error-3">Enter all Values</div>';
      }

    }

    
    
  }
?>

<form class="form-horizontal" style="padding-top:2em;" role="form" method="POST" action="<?php echo 'updchq.php'?> "> 
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Cheque Number</label>
    <div class="col-sm-4">
       <input name="chq_no" type="text" class="form-control" id="inputEmail3" placeholder="Cheque Number">
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Payment Status (1-Received, 2-Lodged 3-Returned)</label>
    <div class="col-sm-4">
      <select name="pay_stat" >
        <option value="2">2</option>
        <option value="1">1</option>
        <option value="3">3</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Settlement Date(YYYY-MM-DD)</label>
    <div class="col-sm-4">
       <input name="settle_date" type="text" class="form-control" id="inputEmail3" placeholder="Settlement Date(YYYY-MM-DD)">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <input type="submit" class="btn btn-info" value="Update Cheque">
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