
<?php
 include("connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called garden_network: '. mysql_error());
 }
 $test_name = "select garden_network_id from product_garden where garden_network_id = '".$_POST["id"]."'" ;
    $tmp = mysql_query($test_name);
    $row = mysql_num_rows($tmp);
    
    if($row!=0){
    	$arr['message'] = 'fail';
	}else{
 $sql = "delete from `tiantongorchid`.`garden_network` where garden_network_id = '".$_POST["id"]."'" ;
 $result = mysql_query($sql);
 $arr['message'] = 'success';
}
 	echo json_encode($arr);

?>
