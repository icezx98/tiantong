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
 die('Could not find database called product_garden: '. mysql_error());
 }
 $product_garden_id = $_POST["product_garden_id"];
 $produce_id = $_POST["produce_id"];
 $garden_id = $_POST["garden_id"];
 $price_unit = $_POST["price_unit"];
 $price_unit = number_format($price_unit, 2, '.', '');
 

 $test_name = "select detail_product_id from product_garden where detail_product_id like binary'".$produce_id."'
 				and garden_network_id like binary'".$garden_id."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"product_garden_formin.php\";
})
</script>";
 exit;
 
 }else{
 $sql = "insert into `tiantongorchid`.`product_garden` (`product_garden_id`, `detail_product_id`, `garden_network_id`, `price_unit`)
 values ('".$product_garden_id."', '".$produce_id."', '".$garden_id."', '".$price_unit."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
  }

?>
</h4></center>
<script>
location="../product_garden.php";
</script>

</body>
</html>