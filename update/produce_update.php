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
$produce_id = $_POST["produce_id"];
 $produce_name = $_POST["product_name"];
 $color_id = $_POST["i"];
 $size_id = $_POST["size_id"];
 $unit_measure_id = $_POST["unit_measure_id"];
 $price_unit = $_POST["price_unit"];
$o = "1";

 $test_name = "select product_id from detail_product where  product_id like binary '".$produce_name."'
 				and color_id like binary'".$color_id."' and size_id like binary'".$size_id."' 
 				and unit_measure_id like binary'".$unit_measure_id."' and detail_product_id != '".$produce_id."'";  
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
 $sql = "update `tiantongorchid`.`detail_product` set `product_id`='".$produce_name."', `color_id`='".$color_id."',`size_id`='".$size_id."',`unit_measure_id`='".$unit_measure_id."',`price_unit`='".$price_unit."' where detail_product_id='".$produce_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
  }
 
}
 echo "<script>
location='../detail_product.php?id=$produce_name';
</script>"
?>
</h4></center>

</body>
</html>