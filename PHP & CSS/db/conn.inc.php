<?php

$host = "localhost";
$user = "root";
$pass = '';

$error_msg = "Sorry, Couldn't connect to MySQL DB";

$db = "chit_fund_company";

if (!@mysql_connect($host, $user, $pass) || !@mysql_select_db($db) ){
  die($error_msg);
}
  

?>


