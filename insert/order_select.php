<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
       $sql = "select company_id,company_name from company ORDER BY company_name";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
      $dataEcho['company'] = $data;
      $echoData["company"] = $data;
      $sql = "select market_customer_id,market_customer_name from market_customer ORDER BY market_customer_name";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
      $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
      $echoData["market"] = $data;
       echo json_encode($echoData);
    ?>