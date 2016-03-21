
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called detail_product: '. mysql_error());
 }
   $test_name = "select detail_product_id from product_garden where detail_product_id = '".$_POST["id"]."'" ;
    $tmp = mysql_query($test_name);
    $row = mysql_num_rows($tmp);
    if($row!=0){
    	$arr['message'] = 'fail';
	}else{
   $test_name = "select detail_product_id from product_company where detail_product_id = '".$_POST["id"]."'" ;
    $tmp = mysql_query($test_name);
    $row = mysql_num_rows($tmp);
    if($row!=0){
    	$arr['message'] = 'fail';
	}else{
   $sql = "delete from `tiantongorchid`.`detail_product` where detail_product_id= '".$_POST["id"]."'" ;
   $result = mysql_query($sql);
   $arr['message'] = 'success';
}}
 echo json_encode($arr);
?>



