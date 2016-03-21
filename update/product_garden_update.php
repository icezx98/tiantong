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
 die('Could not find database called product_garden: '. mysql_error());
 }
 $product_garden_id = $_POST["product_garden_id"];
 $produce_id = $_POST["produce_id"];
 $garden_id = $_POST["garden_id"];
 $price_unit = $_POST["price_unit"];
 $o="1";
$test_name = "select product_garden_id from product_garden where detail_product_id like binary'".$produce_id."' 
 				and garden_network_id like binary'".$garden_id."'and product_garden_id !='".$product_garden_id."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
  echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	history.back();
})
</script>";
 exit;
 
 }else{

 $sql = "update `tiantongorchid`.`product_garden` set `detail_product_id`='".$produce_id."', `garden_network_id`='".$garden_id."',`price_unit`='".$price_unit."'where product_garden_id='".$product_garden_id."'";
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