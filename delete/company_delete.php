
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called company: '. mysql_error());
 }
 	 $test = "select company_id from product_company where company_id = '".$_POST["id"]."'" ;
 	 $tmp = mysql_query($test);
     $rows = mysql_num_rows($tmp);
     
     if($rows!= 0){
		$arr['message'] = 'fail';
	}else{
 	
 	$sql = "delete from `tiantongorchid`.`company` where company_id ='".$_POST["id"]."'" ;
 	$result = mysql_query($sql);
 	$arr['message'] = 'success';
 }
 	echo json_encode($arr);

?>
