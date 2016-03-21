<?php
$productName = $_GET['productName'];
$colorId = $_GET['colorId'];
$sizeId = $_GET['sizeId'];
$unitId = $_GET['unitId'];
include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $sql = "select detail_product_id FROM detail_product  WHERE product_id = '$productName' and color_id = '$colorId' and size_id = '$sizeId' and unit_measure_id = '$unitId' ";
       //$sql = "select color_id FROM produce WHERE produce_name = '".$productName. "'";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
       echo json_encode($data);
    ?>