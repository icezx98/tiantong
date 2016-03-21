<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $tb = "produce";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called produce: '. mysql_error());
 }
 $sql = "select * from orders where orders_id = '".$_GET["id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $orders_id="";
 $company_id="";
 $market_customer_id="";
 $employee_id="";
 $orders_date="";
 $orders_due_date="";
 $status="";


 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $orders_id=$data[0];
 $company_id=$data[3];
 $market_customer_id=$data[4];
 $employee_id=$data[5];
 $orders_date=$data[1];
 $orders_due_date=$data[2];
 $status=$data[6];
 $i++;
 }
 // $data['orders_id'] = $orders_id ;   
 // $data['company_id'] = $company_id ;
 // $data['market_customer_id'] = $market_customer_id ;
 // $data['employee_id'] = $employee_id ;
 // $data['orders_date'] = $orders_date ;
 // $data['orders_due_date'] = $orders_due_date ;
 // $data['status'] = $status ;
 $data =array('orders_id'=>$orders_id,'company_id'=>$company_id,'market_customer_id'=>$market_customer_id,'employee_id'=>$employee_id,'orders_date'=>$orders_date,'orders_due_date'=>$orders_due_date,'status'=>$status);
 echo json_encode($data);
?>