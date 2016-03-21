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

 $product_id = $_POST["product_id"];
 $product_name = $_POST["product_name"];

 

 $test_name = "select product_id from product where product_name like binary'".$product_name."' 
 				or product_name ='".$product_name."' and product_id != '".$product_id."'";  
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"product_formin.php\";
})
</script>";
 exit;
 
 }else{
 $sql = "insert into `tiantongorchid`.`product` (`product_id`, `product_name`)
 values ('".$product_id."', '".$product_name."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
  }
echo "<script>
location='detail_product_formin.php?id=$product_id';
</script>";
?>
</h4></center>


</body>
</html>