<?php
include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  $result2 = json_decode($HTTP_RAW_POST_DATA,true);
  $choose_id = $result2[0]['choose_id'];
  $recive_id = $result2[0]['recive_id'];
  $choose_date = $result2[0]['orderDate'];
  $choose_garden = $result2[0]['cho'];
  $employee_id = $result2[0]['employee_id'];
  $status = "1";
  // var_dump('non');
  // var_dump($recive_id);
  
  $sql = "insert into `tiantongorchid`.`choose` (`choose_id`, `recive_id`, `choose_date`, `employee_id`)
  values ('".$choose_id."', '".$recive_id."', '".$choose_date."', '".$employee_id."')";
  $result = mysql_query($sql);
 if(!$result){
  die('Insert not success !!!: '. mysql_error());
 }
//  // echo "success";
  
  foreach ($result2[1] as $value) {
    foreach ($value[0] as $value2) {
      $test_id = "select MAX(SUBSTRING(detail_choose_id,7)) as num FROM detail_choose";
      $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
      $rows = mysql_fetch_array($tmp);
        if($rows){
          $num = $rows['num'];
            if($num==Null){
            $num = 0;
            }

    $test_id = $num+1;
    if($test_id < 10){
     $de_choose_id = "DCH0000".$test_id;

        }
      elseif ($test_id < 100) {
        $de_choose_id = "DCH000".$test_id;
      }
      elseif ($test_id < 1000) {
        $de_choose_id = "DCH00".$test_id;
      }
      elseif ($test_id < 10000) {
        $de_choose_id = "DCH0".$test_id;
      }
      elseif ($test_id < 100000) {
        $de_choose_id = "DCH".$test_id;
      }
    }
    // var_dump("$value2[product_garden_id]");
    $amount_remove = $value2['amount'] - $value2['qty'];
    $price = $value2['price_unit'] * $value2['qty'];
    $sql = "insert into `tiantongorchid`.`detail_choose` (`detail_choose_id`, `choose_id`, `product_garden_id`,`price_unit`, `amount_recive`, `amount_good`, `amount_remove`, `total_price_product`)
            values ('".$de_choose_id."', '".$choose_id."', '".$value2['product_garden_id']."', '".$value2['price_unit']."', '".$value2['amount']."', '".$value2['qty']."', '".$amount_remove."', '".$price."')";
    $result = mysql_query($sql);
    if(!$result){
    die('Insert not success !!!: '. mysql_error());
  }
    $sql = "update `tiantongorchid`.`recive` set `choose_status`='".$status."'where recive_id='".$recive_id."'";
    $result = mysql_query($sql);
    if(!$result){
    die('update not success !!!: '. mysql_error());
 }

    $sql = "select total_price from choose where choose_id='".$choose_id."'";
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $data = mysql_fetch_array($result);
      $price = $data[0]; 
      $num = (int)$price;
      $nic = $value2['total']+$num;

    $sql = "update `tiantongorchid`.`choose` set `total_price`='".$nic."'where choose_id='".$choose_id."'";
      $result = mysql_query($sql);
      if(!$result){
      die('update not success !!!: '. mysql_error());
      }
      // var_dump($value2['total']);
    }
   
}
  
  echo "insert success";


?>