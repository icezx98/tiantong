<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $garden_id = $_GET['garden_id'];
       $sql = "select distinct detail_spread_product.detail_spread_id, recive.recive_id, recive.recive_date 
              from recive, detail_recive, spread_order, detail_spread_order, detail_spread_product 
              where detail_spread_order.garden_network_id = '".$garden_id."'
              and detail_spread_order.spread_id = spread_order.spread_id
              and recive.garden_network_id = '".$garden_id."'
              and spread_order.recive_id = recive.recive_id
              and recive.recive_id = detail_recive.recive_id 
              and detail_recive.status = '0' 
              and detail_spread_order.detail_spread_id = detail_spread_product.detail_spread_id
              group by recive.recive_id";
             
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
       echo json_encode($data);
       // var_dump($data);
    ?>