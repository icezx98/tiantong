<?php
include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $values = $_GET['values'];
  $values = explode(',', $values);
  //echo $values[0];
  $data = array() ;
  for($i=0; $i < sizeof($values) ; $i++) { 
       $sql = "select d.detail_orders_id, d.orders_id, p.product_name, c.color_name, s.size_name, u.unit_measure_name,d.number_orders, p.product_id, c.color_id, s.size_id, u.unit_measure_id
     FROM detail_product dp,product p,color c, size s, unit_measure u, detail_orders d 
     WHERE d.detail_product_id = dp.detail_product_id  and dp.product_id = p.product_id 
     and dp.color_id = c.color_id and dp.size_id = s.size_id and dp.unit_measure_id = u.unit_measure_id 
     and d.orders_id = '".$values[$i]."'";

       // $result2 = mysql_query($sql);
       // $num_rows = mysql_num_rows($result2);
       // $num_fields = mysql_num_fields($result2);
       // $data = array();
       // for($n = 0 ;$n<$num_rows;$n++){
       //  $row = mysql_fetch_row($result2);
       // array_push($data,$row);
       // echo "$row";
      $result2 = mysql_query($sql);
      

      while($row = mysql_fetch_assoc($result2))
      {
        array_push($data,$row) ;
      }
      }
       echo json_encode($data);
    ?>