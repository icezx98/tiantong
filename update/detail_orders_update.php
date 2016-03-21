<!DOCTYPE html>
<html>
<head>
 <title>Table: unit_measure</title>
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
 die('Could not find database called produce: '. mysql_error());
 }
 $detail_orders_id = $_POST["detail_orders_id"];
$orders_id = $_POST["orders_id"];
 $produce_id = $_POST["produce_id"];
 $number_orders = $_POST["number_orders"];

  $companyId = $_GET["companyId"];
  $customerId = $_GET["customerId"];
if($number_orders <= 1){
		echo "<script>
swal( {title: \"จำนวนที่สั่งซื้อน้อยกว่า 0\", type: \"warning\" },function(){
	history.back();
})
</script>";
	exit;
}else{
$test_name = "select orders_id from detail_orders where detail_product_id ='".$produce_id."' 
			  and orders_id ='".$orders_id."' and detail_orders_id !='".$detail_orders_id."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
  echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	history.back();;
})
</script>";
 exit;

}else{
 $sql = "update `tiantongorchid`.`detail_orders` set `detail_product_id`='".$produce_id."',`number_orders`='".$number_orders."' where detail_orders_id='".$detail_orders_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
  }
}
echo "<script>
location='../detail_orders.php?id=$orders_id&companyId=$companyId&customerId=$customerId';
</script>";
}
?>
</h4></center>

</body>
</html>