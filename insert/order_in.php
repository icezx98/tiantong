<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <meta http-equiv="content-type" content="text/html; charset=utf-8">
	 <link rel="stylesheet" href="../css/css.css">
	 <script src="../dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../dist/sweetalert.css">
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
 // $company_id = $_POST["company_id"];
 $customer_id = $_POST["customer_id"];
 $employee_id = $_POST["employee_id"];
 $orders_date = $_POST["dateInput"];
 $orders_due_date = $_POST["dateInput1"];
 $status = "ใช้งาน";
 $radio = $_POST["optradio"];


$test_name = "select orders_id from orders where company_id ='".$customer_id."' and orders_date='".$orders_date."'
 				and orders_due_date='".$orders_due_date."' or market_customer_id ='".$customer_id."'
				and orders_date='".$orders_date."' and orders_due_date='".$orders_due_date."'";
  $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
echo "<script>swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
								location=\"../order.php\";
								})</script>";
 exit;
 
 }else{
 	if ($radio == "1") {
 		$sql = "insert into `tiantongorchid`.`orders` (`orders_id`, `company_id`, `employee_id`,`orders_date`,`orders_due_date`,`status`)
 		values ('".$orders_id."', '".$customer_id."', '".$employee_id."', '".$orders_date."', '".$orders_due_date."', '".$status."')";
 		 $companyId = $customer_id;
 		 $customerId = "";
 	}
 	else{
 		$sql = "insert into `tiantongorchid`.`orders` (`orders_id`, `market_customer_id`, `employee_id`,`orders_date`,`orders_due_date`,`status`)
		 values ('".$orders_id."', '".$customer_id."', '".$employee_id."', '".$orders_date."', '".$orders_due_date."', '".$status."')";
 		$companyId = "";
 		$customerId = $customer_id;
 	}
 
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
  }
echo "<script>location='detail_orders_formin.php?id=$orders_id&companyId=$companyId&customerId=$customerId';</script>";
?>
</h4></center>

</body>
</html>