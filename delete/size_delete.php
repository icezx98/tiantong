
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 	die('Could not find database called size: '. mysql_error());
 }
 	$test_name = "select size_id from detail_product where size_id = '".$_POST["id"]."'" ;
    $tmp = mysql_query($test_name);
    $row = mysql_num_rows($tmp);
    
    if($row!=0){
    	$arr['message'] = 'fail';
	}else{
 		$sql = "delete from `tiantongorchid`.`size` where size_id= '".$_POST["id"]."'" ;
 		$result = mysql_query($sql);
	    $arr['message'] = 'success';
		
	}
echo json_encode($arr);
?>