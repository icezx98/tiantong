<?php
 include("../connect.php");
			 $db = "tiantongorchid";
			 $result = mysql_select_db($db);
				 if(!$result){
				 die('Could not find database called market_customer: '. mysql_error());
				 }

				 $sql = "delete from `tiantongorchid`.`product` where product_id= '".$_GET["id"]."'" ;
						$result = mysql_query($sql);	
?>
<script>
location='../product.php';
</script>