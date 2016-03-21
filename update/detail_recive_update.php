<!DOCTYPE html>
<html>
<head>
 <title></title>
 <link rel="stylesheet" href="../css/css.css">
 <meta http-equiv="content-type" content="../text/html; charset=utf-8">
 <script src="../dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../dist/sweetalert.css">
</head>
<body><center><h4>
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called detail_recive: '. mysql_error());
 }
 $de_recive_id = $_POST["de_recive_id"];
 $recive_id = $_POST["recive_id"];
 // var_dump($recive_id);
 $product_id = $_POST["product_id"];
 $amount = $_POST["amount"];
 $price = $_POST["price"];
 // var_dump($amount);
 // var_dump($price);

 $test_name = "select detail_recive_id from detail_recive where recive_id ='".
 				$recive_id."' and product_id ='".$product_id."' and amount ='".
 				$amount."' and price_unit = '".$price."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"detail_recive_formupdate.php?detail_recive_id=$de_recive_id&recive_id=$recive_id\";
})
</script>";
 exit;
 
 
 }else{
 	$sql1 = "select total_price from recive where recive_id='".$recive_id."'";
   $result1 = mysql_query($sql1);
   $num_rows = mysql_num_rows($result1);
     $data1 = mysql_fetch_array($result1);

     $price1 = $data1[0]; 
     $num1 = (int)$price1;
     // var_dump($num1);

 $sql = "select detail_recive.amount, detail_recive.price_unit 
 		 from detail_recive 
 		 where detail_recive.detail_recive_id ='".$de_recive_id."'";
   $result = mysql_query($sql);
   $num_rows = mysql_num_rows($result);
     $data2 = mysql_fetch_array($result);
     $price2 = $data2[0]; 
     $price3 = $data2[1]; 
     $num2 = (int)$price2 + (int)$price3;
     // var_dump($num2);

  $nic = $num1-$num2;
  $nic += $amount * $price;

  $sql = "update `tiantongorchid`.`recive` set `total_price`='".$nic."'where recive_id='".$recive_id."'";
  $result = mysql_query($sql);
  if(!$result){
    die('update not success !!!: '. mysql_error());
  }

 $sql = "update `tiantongorchid`.`detail_recive` set `product_id`='".$product_id."',
 		`amount`='".$amount."',`price_unit`='".$price."'
 		 where detail_recive_id='".$de_recive_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
}
?>
</h4></center>
<?php
 echo "<script>
 location='../detail_recive.php?recive_id=$recive_id';
 </script>";
?>
</body>
</html>