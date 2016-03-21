<!DOCTYPE html>
<html>
<head>
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
				 die('Could not find database called market_customer: '. mysql_error());
				 }
				
				 $orders_id = $_GET["id"];
				  $o[0] =  $orders_id;
				$companyId = $_GET['companyId'];
  				$customerId = $_GET['customerId'];
			$test_name = "select orders_id from detail_orders where orders_id = '".$orders_id."'";
			      $tmp = mysql_query($test_name);
			      $row = mysql_num_rows($tmp);
			      if($row!=0){
				echo "<script>location='../detail_orders.php?id=$orders_id&companyId=$companyId&customerId=$customerId';</script>";
			     exit;
  				}else{
				echo "<script>swal( {title: \"ข้อมูลการรับคำสั่งนี้จะถูกลบ\", type: \"warning\" ,showCancelButton: true,confirmButtonText: 'ตกลง', cancelButtonText: 'ยกเลิก',closeOnConfirm: false,
						closeOnCancel: false},function(isConfirm){
							if(isConfirm){
								location=\"detail_orders_delete.php?id=$orders_id\";
							}else{
								location=\"detail_orders_formin.php?id=$orders_id&companyId=$companyId&customerId=$customerId\";
								exit;

							}
						})</script>";
						
				}
		?>
</h4></center>
</body>
</html>