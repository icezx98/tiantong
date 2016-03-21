<?php
  include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $values = $_GET['value'];
  $values = explode(',', $values);
  $data = array() ;
   $sql = "select garden_network.garden_network_id , garden_network.garden_network_name, product_garden.product_garden_id from product_garden , garden_network , detail_product WHERE detail_product.product_id = '$values[0]' AND detail_product.color_id = '$values[1]' and detail_product.size_id = '$values[2]' and detail_product.unit_measure_id = '$values[3]'
  and detail_product.detail_product_id = product_garden.detail_product_id and product_garden.garden_network_id = garden_network.garden_network_id";
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
  echo json_encode($data);
?>