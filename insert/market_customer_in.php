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
 die('Could not find database called market_customer: '. mysql_error());
 }
 $market_customer_id = $_POST["market_customer_id"];
 $market_customer_name = $_POST["market_customer_name"];
 $market_customer_tel = $_POST["market_customer_tel"];


 $test_name = "select market_customer_id from market_customer where market_customer_name ='".$market_customer_name."' and market_customer_tel ='".$market_customer_tel."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"market_customer_formin.php?id=$market_customer_id\";
})
</script>";
 exit;
 
 }else{
 $sql = "insert into `tiantongorchid`.`market_customer` (`market_customer_id`, `market_customer_name`, `market_customer_tel`)
 values ('".$market_customer_id."', '".$market_customer_name."', '".$market_customer_tel."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
  }

?>
</h4></center>
<script>
location="../market_customer.php";
</script>

</body>
</html>