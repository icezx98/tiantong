
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called produce_id: '. mysql_error());
 }
     $detail_orders_id = $_POST["id"];

   
   $sql = "delete from `tiantongorchid`.`detail_orders` where detail_orders_id='".$detail_orders_id."'";
   $result = mysql_query($sql);
   $arr['message'] = 'success';
   $i = 0;
 $produce_id="";

 
 echo json_encode($arr);
?>



