<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $garden_id = $_GET['garden_id'];
       $sql = "select distinct detail_spread_order.detail_spread_id
               from detail_spread_order, detail_spread_product
               where detail_spread_order.garden_network_id = '".$garden_id."'
               and detail_spread_order.detail_spread_id = detail_spread_product.detail_spread_id
               and detail_spread_product.status = '0'";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
       echo json_encode($data);
    ?>