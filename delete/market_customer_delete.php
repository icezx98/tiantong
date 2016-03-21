
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called market_customer: '. mysql_error());
 }
$test_name = "select market_customer_id from orders where market_customer_id = '".$_POST["id"]."'" ;
    $tmp = mysql_query($test_name);
    $row = mysql_num_rows($tmp);
    
    if($row!=0){
    	$arr['message'] = 'fail';
	}else{
 $sql = "delete from `tiantongorchid`.`market_customer` where market_customer_id ='".$_POST["id"]."'" ;
 $result = mysql_query($sql);
 $arr['message'] = 'success';
}
 	echo json_encode($arr);
?>
