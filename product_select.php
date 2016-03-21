<?php
include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
       $sql = "select p.product_id,p.product_name FROM product p ,detail_product dp where dp.product_id = p.product_id GROUP BY `product_name`";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
       echo json_encode($data);
    ?>