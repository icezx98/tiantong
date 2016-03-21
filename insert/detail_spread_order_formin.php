<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called orders: '. mysql_error());
 }
 session_start();
$data = json_decode($HTTP_RAW_POST_DATA,true);
$counter = 0;
foreach ($data as $key => $value) {
    $test_id = "select MAX(SUBSTRING(detail_spread_id,4)) as num FROM detail_spread_order";
     $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
     $rows = mysql_fetch_array($tmp);
     if($rows){
      $num = $rows['num'];
        if($num==Null){
        $num = 0;
      }

        $test_id = $num+1;
        if($test_id < 10){
         $detail_spread_id = "DSP000".$test_id;

            }
          elseif ($test_id < 100) {
            $detail_spread_id = "DSP00".$test_id;
          }
          elseif ($test_id < 1000) {
            $detail_spread_id = "DSP0".$test_id;
          }
          elseif ($test_id < 10000) {
            $detail_spread_id = "DSP".$test_id;
          }
      }

      $test_id = "select MAX(SUBSTRING(spread_product_id,5)) as num FROM detail_spread_product";
     $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
     $rows = mysql_fetch_array($tmp);
     if($rows){
      $num = $rows['num'];
        if($num==Null){
        $num = 0;
      }

        $test_id = $num+1;
        if($test_id < 10){
         $spread_product_id = "PSP0000".$test_id;

            }
          elseif ($test_id < 100) {
            $spread_product_id = "PSP000".$test_id;
          }
          elseif ($test_id < 1000) {
            $spread_product_id = "PSP00".$test_id;
          }
          elseif ($test_id < 10000) {
            $spread_product_id = "PSP0".$test_id;
          }
          elseif ($test_id < 100000) {
            $spread_product_id = "PSP".$test_id;
          }
      }
    $status = 0;
    $sql = "insert into `tiantongorchid`.`detail_spread_order` values('$detail_spread_id','".$value['gardenNetworkId']."','".$value['spreadId']."')";
     $result = mysql_query($sql);
     if(!$result){
       die('Insert not success !!!: '. mysql_error());
      }
                $sqls = "select product_garden.product_garden_id  from detail_product,product_garden WHERE detail_product.detail_product_id = product_garden.detail_product_id and detail_product.product_id = '".$value['product_id']."' and detail_product.color_id = '".$value['color_id']."' and detail_product.size_id = '".$value['size_id']."' and detail_product.unit_measure_id = '".$value['unit_measure_id']."' and product_garden.garden_network_id = '".$value['gardenNetworkId']."'";
             $results = mysql_query($sqls);
             $num_rowss = mysql_num_rows($results);
             $num_fieldss = mysql_num_fields($results);
             $i = 0;
                 while($i<$num_rowss){
                 $datas = mysql_fetch_array($results);
                   $detail_product_id = $datas[0];
                $i++;
                }
     $sql1 = "insert into `tiantongorchid`.`detail_spread_product` values('$spread_product_id','".$detail_product_id."','".$value['color_id']."','".$value['size_id']."','".$value['unit_measure_id']."','".$value['qty']."','$detail_spread_id','$status')";
     $result = mysql_query($sql1);
     if(!$result){
       die('Insert not success !!!: '. mysql_error());
      }
    $counter++;
}
  


?>
