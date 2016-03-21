<?php
		
 include("connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 	die('Could not find database called employee: '. mysql_error());
 }
if($_POST["userid"] != $_POST["id"]){
 	$test_name = "select employee_id from orders where employee_id = '".$_POST["id"]."'" ;
    $tmp = mysql_query($test_name);
    $row = mysql_num_rows($tmp);
    
    if($row!=0){
    	$arr['message'] = 'fail';
	}else{
  		
     		$sql = "delete from `tiantongorchid`.`employee` where employee_id = '".$_POST["id"]."'" ;
     		$result = mysql_query($sql);
    	  $arr['message'] = 'success';
		}
	}else{
    $arr['message'] = 'fail';
  }
echo json_encode($arr);
?>