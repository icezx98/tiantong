<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $result2 = json_decode($HTTP_RAW_POST_DATA,true);
  $recive_id = $result2[0]['recive_id'];
  $recive_date = $result2[0]['orderDate'];
  $garden_id = $result2[0]['recive'];
  $employee_id = $result2[0]['employee_id'];
  $status = "1";
  // var_dump($employee_id);
  
  $sql = "insert into `tiantongorchid`.`recive` (`recive_id`, `recive_date`, `garden_network_id`, `employee_id`)
  values ('".$recive_id."', '".$recive_date."', '".$garden_id."', '".$employee_id."')";
  $result = mysql_query($sql);
 if(!$result){
  die('Insert not success !!!: '. mysql_error());
 }
  
  foreach ($result2[1] as $value) {
    foreach ($value[0] as $value2) {
      $test_id = "select MAX(SUBSTRING(detail_recive_id,5)) as num FROM detail_recive";
  $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
  $rows = mysql_fetch_array($tmp);
  if($rows){
    $num = $rows['num'];
      if($num==Null){
      $num = 0;
    }

    $test_id = $num+1;
    if($test_id < 10){
     $de_recive_id = "DR000".$test_id;

        }
      elseif ($test_id < 100) {
        $de_recive_id = "DR00".$test_id;
      }
      elseif ($test_id < 1000) {
        $de_recive_id = "DR0".$test_id;
      }
      elseif ($test_id < 10000) {
        $de_recive_id = "DR".$test_id;
      }
      // elseif ($test_id < 100000) {
      //   $recive_id = "DR".$test_id;
      // }
    }

    $sql = "insert into `tiantongorchid`.`detail_recive` (`detail_recive_id`, `recive_id`, `product_id`, `amount`, `price_unit`)
          values ('".$de_recive_id."', '".$recive_id."', '".$value2['product_garden_id']."', '".$value2['qty']."', '".$value2['price_unit']."')";
    $result = mysql_query($sql);
    if(!$result){
    die('Insert not success !!!: '. mysql_error());
  }
    $sql = "update `tiantongorchid`.`detail_spread_product` set `status`='".$status."'where product_garden_id='".$value2['product_garden_id']."'";
    $result = mysql_query($sql);
    if(!$result){
    die('update not success !!!: '. mysql_error());
 }

    $sql = "select total_price from recive where recive_id='".$recive_id."'";
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);

      $data = mysql_fetch_array($result);
      $price = $data[0]; 
      $num = (int)$price;
      $nic = $value2['total']+$num;

    $sql = "update `tiantongorchid`.`recive` set `total_price`='".$nic."'where recive_id='".$recive_id."'";
      $result = mysql_query($sql);
      if(!$result){
      die('update not success !!!: '. mysql_error());
      }
    }
   
}
  
  echo "insert success";

    ?>