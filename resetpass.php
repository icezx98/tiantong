<?php
 	include("connect.php");
 	$db = "tiantongorchid";
 	$result = mysql_select_db($db);
 		if(!$result){
 			die('Could not find database called employee: '. mysql_error());
 		}
 			
 		

 		$sql = "select employee_tel from employee where employee_id = '".$_POST["id"]."'" ;
		 $result = mysql_query($sql);
		 $num_rows = mysql_num_rows($result);
		 $num_fields = mysql_num_fields($result);
		 $employee_tel ="";
		 $data = mysql_fetch_array($result);
		 $employee_tel=$data[0];

		 if($num_rows=0){
    	$arr['message'] = 'fail';
    	exit;
	}else{
		 $sql = "update `tiantongorchid`.`employee` set `password`='".sha1($employee_tel)."' where employee_id = '".$_POST["id"]."'" ;
		 $result = mysql_query($sql);
		 $arr['message'] = 'success';
	}	 	
echo json_encode($arr);
?>

