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
 $recive_id = $_POST["recive_id"];
 $dateInput = $_POST["dateInput"];
 $garden_id = $_POST["garden_id"];
 $total_price = $_POST["total_price"];
 $employee_id = $_POST["employee_id"];


 $test_name = "select recive_id from recive where  	recive_date ='".$dateInput."'
 				and garden_network_id ='".$garden_id."' and total_price = '".$total_price."'";  
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
 $sql = "update `tiantongorchid`.`recive` set `recive_date`='".$dateInput."', `garden_network_id`='".$garden_id."', `total_price`='".$total_price."'where recive_id='".$recive_id."'";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
}
 echo "<script>
location='../recive.php';
</script>"

?>
</h4></center>

</body>
</html>