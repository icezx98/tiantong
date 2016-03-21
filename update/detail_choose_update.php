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
 $de_choose_id = $_POST["de_choose_id"];
 $choose_id = $_POST["choose_id"];
 $price_unit = $_POST["price_unit"];
 $price_recive = $_POST["price_recive"];
 $price_good = $_POST["price_good"];
 // $total_price = $_POST["total_price"];
 // var_dump($de_choose_id);
 // var_dump($price_unit);
 // var_dump($price_recive);
 // var_dump($price_good);
 // var_dump($total_price);


 // $test_name = "select amount_recive from detail_choose where detail_choose_id ='".$de_choose_id."'";
 // $tmp = mysql_query($test_name);
 // $row = mysql_num_rows($tmp);
 // $data = mysql_fetch_array($tmp)
 
 // var_dump($aaa);
//  if($price_good > $data){
// echo "<script>
// swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
// 	location=\"detail_recive_formupdate.php?detail_recive_id=$de_recive_id&recive_id=$recive_id\";
// })
// </script>";
//  exit;
 
 
// //  }else{
 	// $sql1 = "select total_price from recive where recive_id='".$recive_id."'";
  //  $result1 = mysql_query($sql1);
  //  $num_rows = mysql_num_rows($result1);
  //    $data1 = mysql_fetch_array($result1);

  //    $price1 = $data1[0]; 
  //    $num1 = (int)$price1;
     // var_dump($num1);

 $sql = "update `tiantongorchid`.`detail_choose` set `amount_good`='".$price_good."'
         where detail_choose_id='".$de_choose_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }

 $sql = "select detail_choose.amount_good, detail_choose.price_unit
         from detail_choose
         where detail_choose.detail_choose_id = '".$de_choose_id."'";  
    $result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
     $data2 = mysql_fetch_array($result);
     $good = $data2[0]; 
     $unit = $data2[1]; 
     // var_dump($good);
     // var_dump($unit);
     $total = (int)$good * (int)$unit;
     // var_dump($total);

  // $nic = $num1-$num2;
  // $nic += $amount * $price;

  $sql = "update `tiantongorchid`.`detail_choose` set `total_price_product`='".$total."'
          where detail_choose.detail_choose_id='".$de_choose_id."'";
  $result = mysql_query($sql);
  if(!$result){
    die('update not success !!!: '. mysql_error());
  }

  $sql = "select detail_choose.total_price_product
         from detail_choose
         where detail_choose.choose_id = '".$choose_id."'";  
    $result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
    $total_price = 0;
      for ($i=0; $i < $num_rows; $i++) { 
        $data2 = mysql_fetch_array($result);
        $total_price += $data2['total_price_product'];
      }
      // echo $total_price;
     
  $sql = "update `tiantongorchid`.`choose` set `total_price`='".$total_price."'
          where choose.choose_id ='".$choose_id."'";
  $result = mysql_query($sql);
  if(!$result){
    die('update not success !!!: '. mysql_error());
  }
// }
?>
</h4></center>
<?php
 echo "<script>
 location='../detail_choose.php?de_choose_id=$de_choose_id&choose_id=$choose_id';
 </script>";
?>
</body>
</html>