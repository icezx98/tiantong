<?php
$productName = $_GET['productName'];
$colorId = $_GET['colorId'];
include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $sql = "select p.size_id,s.size_name FROM size s,detail_product p  WHERE p.product_id =  '$productName' and p.color_id = '$colorId' and p.size_id = s.size_id GROUP BY `size_name`";
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