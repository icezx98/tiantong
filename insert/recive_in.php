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
session_start();
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called company: '. mysql_error());
 }
 $recive_id = $_POST["recive_id"];
 $dateInput = $_POST["dateInput"];
 $garden_id = $_POST["garden_id"];
 // $total_price = $_POST["total_price"];
 $employee_id = $_POST["employee_id"];
 $_SESSION['garden_id'] = $garden_id;
 // $_SESSION['garden_id'];
 // $company_tel = $_POST["company_tel"];
 // echo $recive_id;
 //  echo $dateInput;
   // echo $total_price;
    // echo $employee_id;
    // exit;

//  $test_name = "select recive_id from recive where recive_id ='".$recive_id."";
//  $tmp = mysql_query($test_name);
//  $row = mysql_num_rows($tmp);
//  if($row!=0){
//  echo "<script>
// swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
// 	location=\"recive_formin.php\";
// })
// </script>";
//  exit;
 
 // }else{
 $sql = "insert into `tiantongorchid`.`recive` (`recive_id`, `recive_date`, `garden_network_id`, `employee_id`)
 values ('".$recive_id."', '".$dateInput."', '".$garden_id."', '".$employee_id."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
 echo "<script>location='../insert/detail_recive_formin.php?recive_id=$recive_id&garden_id=$garden_id';</script>";
  // }

?>
</h4></center>
// <script>
// location="../recive.php";
// </script>
  



</body>
</html>