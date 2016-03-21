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
 die('Could not find database called company: '. mysql_error());
 }
 $de_recive_id = $_POST["de_recive_id"];
 $recive_id = $_POST["recive_id"];
 $product_id = $_POST["product_id"];
 $amount = $_POST["amount"];
 $price = $_POST["price"];
 $status = "1";
 $old = "0";
 $nic = $amount*$price;
 // var_dump($nic);

 // echo $_SESSION['garden_id'];
  // $garden_id = $_POST["$_SESSION['garden_id']"];

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
 $sql = "insert into `tiantongorchid`.`detail_recive` (`detail_recive_id`, `recive_id`, `product_id`,`amount`,`price_unit`)
		 values ('".$de_recive_id."', '".$recive_id."', '".$product_id."', '".$amount."', '".$price."')";
  $result = mysql_query($sql);
  if(!$result){
    die('Insert not success !!!: '. mysql_error());
 }
 // echo "<script>location='../detail_recive.php?id=$recive_id&garden_id=$garden_id';</script>";
  $sql = "update `tiantongorchid`.`detail_spread_product` set `status`='".$status."'where product_garden_id='".$product_id."'";
  $result = mysql_query($sql);
  if(!$result){
    die('update not success !!!: '. mysql_error());
 }

  $sql = "select total_price from recive where recive_id='".$recive_id."'";
   $result = mysql_query($sql);
   $num_rows = mysql_num_rows($result);

     $data = mysql_fetch_array($result);
     $price = $data[0]; 
     $num = (int)$price;
     $nic = $nic+$num;

  $sql = "update `tiantongorchid`.`recive` set `total_price`='".$nic."'where recive_id='".$recive_id."'";
  $result = mysql_query($sql);
  if(!$result){
    die('update not success !!!: '. mysql_error());
  }


 echo "<script>location='./detail_recive_formin.php?recive_id=$recive_id&garden_id=$garden_id';</script>";
  // }
  // }

?>
</h4></center>
 <script>
// location="../recive.php";
 </script>
  



</body>
</html>