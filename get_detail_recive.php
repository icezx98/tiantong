<?php
 include("connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called unit_measure: '. mysql_error());
 }
 $detail_recive_id = $_GET['detail_recive_id'];
 $sql = "select * from detail_recive where detail_recive_id = '".$detail_recive_id."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $detail_recive_id="";
 


 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $detail_recive_id=$data[0];

 $i++;
 }
 echo "$detail_recive_id";
 // echo $garden_network_id;
?>