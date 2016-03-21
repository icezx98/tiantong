<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
?>
<?php
 $sql = " select recive.recive_id, DATE_FORMAT(recive.recive_date,'%d/%m/%Y'),
          garden_network.garden_network_name,ROUND(recive.total_price, 2), employee.employee_name,garden_network.garden_network_id

          from recive , employee , garden_network

          where recive.employee_id = employee.employee_id and recive.garden_network_id = garden_network.garden_network_id ";
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $data = array();
 while($i<$num_rows){

  
 array_push($data, mysql_fetch_assoc($result));
 
    
            
 $i++;

 }
 echo json_encode($data);
?>