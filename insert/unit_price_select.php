<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $pg_id = $_GET['pg_id'];
       $sql = "select price_unit FROM product_garden where product_garden_id = '".$pg_id."'";
       $result2 = mysql_query($sql);
       $num_rows = mysql_num_rows($result2);
       $num_fields = mysql_num_fields($result2);
       $data = array();
       for($i = 0 ;$i<$num_rows;$i++){
       array_push($data,mysql_fetch_row($result2));
      }
       echo json_encode($data);
    ?>