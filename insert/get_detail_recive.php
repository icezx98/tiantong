<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $detail_recive_id = $_GET['detail_recive_id'];
       $sql = "select product_garden.product_garden_id, product.product_name
            from product, detail_product, product_garden, detail_spread_product, detail_recive
            where detail_recive.detail_recive_id = '".$detail_recive_id."'
            and detail_recive.product_id = product_garden.product_garden_id
            and product_garden.product_garden_id = detail_spread_product.product_garden_id  
            and product_garden.detail_product_id = detail_product.detail_product_id 
            and detail_product.product_id = product.product_id
            group by product.product_name";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
      $dataEcho['company'] = $data;
      $echoData["first"] = $data;
      $sql = "select product_garden.product_garden_id, product.product_name
            from product, detail_product, product_garden, detail_spread_product, detail_recive
            where detail_recive.detail_recive_id != '".$detail_recive_id."'
            and detail_recive.product_id = product_garden.product_garden_id
            and product_garden.product_garden_id = detail_spread_product.product_garden_id  
            and product_garden.detail_product_id = detail_product.detail_product_id 
            and detail_product.product_id = product.product_id
            group by product.product_name";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
      $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
      $echoData["other"] = $data;
       echo json_encode($echoData);
    ?>