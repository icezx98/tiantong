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
 $product_id = $_POST["produce_id"];
 $product_name = $_POST["produce_name"];


 $test_name = "select product_id from product where  product_name like binary '".$product_name."'
 				or product_name ='".$product_name."' and product_id != '".$product_id."'";  
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
 $sql = "update `tiantongorchid`.`product` set `product_name`='".$product_name."'where product_id='".$product_id."'";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
}
 echo "<script>
location='../product.php';
</script>"

?>
</h4></center>

</body>
</html>