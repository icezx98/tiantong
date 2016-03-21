<?php
 include("../connect.php");
			 $db = "tiantongorchid";
			 $result = mysql_select_db($db);
				 if(!$result){
				 die('Could not find database called market_customer: '. mysql_error());
				 }
				
				 $orders_id = $_GET["id"];
				 $sql = "delete from `tiantongorchid`.`orders` where orders_id='".$orders_id."'";
						$result = mysql_query($sql);	
?>
<script>
location='../order.php';
</script>