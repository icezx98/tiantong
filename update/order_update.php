<!DOCTYPE html>
<html>
<head>
 <title>Table: unit_measure</title>
 <link rel="stylesheet" href="../css/css.css">
 <meta http-equiv="content-type" content="../text/html; charset=utf-8">
</head>
<body><center><h4>
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called orders: '. mysql_error());
 }

 $orders_id = $_POST["orders_id"];
 $company_id = $_POST["company_id"];
 $market_customer_id = $_POST["market_customer_id"];
 $employee_id = $_POST["employee_id"];
 $orders_due_date = $_POST["dateInput1"];
 $orders_date = $_POST["dateInput"];
 $status = $_POST["status"];
 $optradio = $_POST["optradio"];

//  $test_name = "select orders_id from orders where company_id ='".$customer_id."' and orders_date='".$orders_date."'
//  				and orders_due_date='".$orders_due_date."' or market_customer_id ='".$customer_id."'
// 				and orders_date='".$orders_date."' and orders_due_date='".$orders_due_date."'";
//   $tmp = mysql_query($test_name);
//  $row = mysql_num_rows($tmp);
//  if($row!=0){
// echo "<script>swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
// 								location=\"../order.php\";
// 								})</script>";
//  exit;
 
//  }else{

 	if ($company_id != "" && $optradio == "1") {
 		$market_customer_id = '';
			 $sql = "update `tiantongorchid`.`orders` set `orders_date`='".$orders_date."', `orders_due_date`='".$orders_due_date."',`company_id`='".$company_id."',`market_customer_id`='".$market_customer_id."',`employee_id`='".$employee_id."',`status`='".$status."'where orders_id='".$orders_id."'";
			 $result = mysql_query($sql);
			 if(!$result){
			 die('Insert not success !!!: '. mysql_error());
			 }
	}elseif ($market_customer_id != "" && $optradio == "2") {
		 $company_id = '';
		 $sql = "update `tiantongorchid`.`orders` set `orders_date`='".$orders_date."', `orders_due_date`='".$orders_due_date."',`company_id`='".$company_id."',`market_customer_id`='".$market_customer_id."',`employee_id`='".$employee_id."',`status`='".$status."'where orders_id='".$orders_id."'";
			 $result = mysql_query($sql);
			 if(!$result){
			 die('Insert not success !!!: '. mysql_error());
			 }
	}
// }
?>
</h4></center>
<script>
location="../order.php";
</script>
</body>
</html>