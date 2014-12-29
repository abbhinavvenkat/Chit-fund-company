<style type="text/css">
.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  margin: auto;
  max-width: 60em;
  padding:5px;
  width: 120%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
  margin-top: 2em;
}
 
th {
  color:#fff;;
  background:#2D67A3;
  border-bottom:4px solid #B8B8C0;
  border-right: 1px solid #B8B8C0;
  font-size:23px;
  padding: 8px;
  font-weight: 100;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
  font-family: 'Yanone Kaffeesatz', serif;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #B8B8C0;
  border-bottom-: 1px solid #B8B8C0;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #B8B8C0;
  border-bottom: 1px solid #B8B8C0;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:5px;
  padding-left: 20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #B8B8C0;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}



</style>


<?php

  require 'conn.inc.php';
  require 'core.inc.php';

  if(!loggedin()){
    header('Location: index.php');
  }

  $query = "select * from group_member where defaulted='1'";
  $result = mysql_query($query);

  echo "<table class=table-fill >
  <thead>
  <tr>
  <th class=text-left >Subscriber ID</th>
  <th class=text-left >Name</th>
  <th class=text-left >Mobile</th>
  <th class=text-left >Address</th>
  <th class=text-left >Nominee Name</th>
  <th class=text-left >Group Join Date</th>
  <th class=text-left >Group Termination Date</th>
  </tr>
  </thead>";

  while($row = mysql_fetch_array($result)) {
    echo "<tbody class=table-hover>";
    echo "<tr>";
    echo "<td class=text-left >" . $row['sub_id'] . "</td>";
    $sub_id = $row['sub_id'];

    $r = mysql_query("SELECT * from subscriber_master where sub_id='$sub_id'");
    $name = mysql_result($r, 0, 'name');
    $nom_name = mysql_result($r, 0, 'nom_name');
    $mobile = mysql_result($r, 0, 'mobile');
    $address = mysql_result($r, 0, 'address');

    echo "<td class=text-left >" . $name . "</td>";
    echo "<td class=text-left >" . $mobile . "</td>";
    echo "<td class=text-left >" . $address . "</td>";
    echo "<td class=text-left >" . $nom_name . "</td>";
    echo "<td class=text-left >" . $row['grp_date_open'] . "</td>";
    echo "<td class=text-left >" . $row['grp_date_closed'] . "</td>";
    echo "</tr>";
    echo "</tbody>";
  }
echo "</table>";
?>