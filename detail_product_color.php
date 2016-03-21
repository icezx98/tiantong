<?php 
 include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
            $productName = $_GET['productName'];
					  $companyId = $_GET['companyId'];
  					$customerId = $_GET['customerId'];
							if(!empty($companyId)){
                                   $sql = "select p.color_id,c.color_name FROM product_company pc,color c,detail_product p  WHERE pc.detail_product_id = p.detail_product_id and pc.company_id = '".$companyId."' and p.product_id = '$productName' and p.color_id = c.color_id GROUP BY `color_name`";
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
                                    $sql = "select p.color_id,c.color_name FROM product_garden pc,color c,detail_product p  WHERE  p.product_id = '$productName' and p.color_id = c.color_id GROUP BY `color_name`";
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