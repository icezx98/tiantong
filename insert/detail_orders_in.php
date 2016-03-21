<!DOCTYPE html>
<html>
<head>
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
 die('Could not find database called market_customer: '. mysql_error());
 }
 $detail_orders_id = $_POST["detail_orders_id"];
 $orders_id = $_POST["orders_id"];
 $produce_id = $_POST["produce_id"];
 $number_orders = $_POST["number_orders"];
 
 $companyId = $_GET['companyId'];
  $customerId = $_GET['customerId'];
if($number_orders <= 1){
		echo "<script>
swal( {title: \"จำนวนที่สั่งซื้อเป็น 0\", type: \"warning\" },function(){
	history.back();
})
</script>";
	exit;
	}else{
$test_name = "select orders_id from detail_orders where detail_product_id='".$produce_id."' 
			  and orders_id='".$orders_id."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
  echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"detail_orders_formin.php?id=$orders_id&companyId=$companyId&customerId=$customerId\";
})
</script>";
 exit;

}else{
$sql = "insert into `tiantongorchid`.`detail_orders` (`detail_orders_id`, `orders_id`,`detail_product_id`, `number_orders`)
 values ('".$detail_orders_id."', '".$orders_id."', '".$produce_id."' , '".$number_orders."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 	}
  }
echo "<script>
location='detail_orders_formin.php?id=$orders_id&companyId=$companyId&customerId=$customerId';
</script>";
}
?>
</h4></center>

</body>
</html>