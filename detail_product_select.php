<?php 
 include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
					$companyId = $_GET['companyId'];
  					$customerId = $_GET['customerId'];
							if(!empty($companyId)){
                                   $sql = "select p.product_id,p.product_name from product_company pc,product p,detail_product dp WHERE  dp.detail_product_id = pc.detail_product_id and pc.company_id = '".$companyId."' and dp.product_id = p.product_id GROUP BY `product_name`";
                                   $result = mysql_query($sql);
                                   $num_rows = mysql_num_rows($result);
                                   $num_fields = mysql_num_fields($result);
                                   $data = array();
                                   for($i = 0 ;$i<$num_rows;$i++){
								       array_push($data,mysql_fetch_row($result));
								      }
                                  	echo json_encode($data);
                              }
              else{
                                    $sql = "select p.product_id,p.product_name from product_garden pg,product p,detail_product dp WHERE dp.product_id = p.product_id GROUP BY `product_name`";
                                   $result = mysql_query($sql);
                                   $num_rows = mysql_num_rows($result);
                                   $num_fields = mysql_num_fields($result);
                                  $data = array();
                                    for($i = 0 ;$i<$num_rows;$i++){
								       array_push($data,mysql_fetch_row($result));
								      }
                                  echo json_encode($data);
                                  }
?>