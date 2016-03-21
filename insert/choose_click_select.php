<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $garden_id = $_GET['garden_id'];
  $de_spread_id = $_GET['de_spread_id'];
  $de_spread_id = explode(",",$_GET["de_spread_id"]);
  for($i=0;$i<sizeof($de_spread_id);$i++){
    $sql = "select distinct product_garden.product_garden_id, product.product_name, color.color_id, 
                  color.color_name, size.size_id,size.size_name, product_garden.price_unit,detail_recive.amount
            from recive,detail_recive, detail_spread_order, detail_spread_product, product_garden, 
                 detail_product, product, color, size
            where detail_spread_order.garden_network_id = '".$garden_id."'
              and detail_spread_product.detail_spread_id = '".$de_spread_id[$i]."'
              and recive.garden_network_id = '".$garden_id."'
              and recive.recive_id = detail_recive.recive_id
              and detail_recive.status = '0'
              and detail_spread_order.detail_spread_id = detail_spread_product.detail_spread_id
              and detail_spread_product.product_garden_id = product_garden.product_garden_id
              and product_garden.detail_product_id = detail_product.detail_product_id
              and detail_product.product_id = product.product_id
              and detail_spread_product.color_id = color.color_id
              and detail_spread_product.size_id = size.size_id";

       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
      //  for($i = 0 ;$i<$num_rows;$i++){
      //  array_push($data,mysql_fetch_assoc($result2));
      // }
      while($row = mysql_fetch_assoc($result2))
      {
        array_push($data, $row);
        // array_push($data,$row);
      }
        $data2[$de_spread_id[$i]]=array();
         array_push($data2[$de_spread_id[$i]],$data);
 }
        echo json_encode($data2);      
    ?>
    