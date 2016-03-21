<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="content-type" content="text/html; charset=utf-8">
	 <link rel="stylesheet" href="css/css.css">
	 <script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
</head>
<body><center><h4>
<?php
 include("connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called garden_network: '. mysql_error());
 }
 $garden_network_id = $_POST["garden_network_id"];
 $garden_network_name = $_POST["garden_network_name"];
$garden_network_contacts = $_POST["garden_network_contacts"];
$garden_network_address = $_POST["garden_network_address"];
$garden_network_tal = $_POST["garden_network_tal"];

$test_name = "select garden_network_name from garden_network where garden_network_name like binary'".$garden_network_name."'
			or garden_network_name ='".$garden_network_name."' and garden_network_id !='".$garden_network_id."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"garden_network_formupdate.php?id=$garden_network_id\";
})
</script>";
 exit;

}else{
 $sql = "update `tiantongorchid`.`garden_network` set `garden_network_name`='".$garden_network_name."', `garden_network_contacts`='".$garden_network_contacts."',`garden_network_address`='".$garden_network_address."',`garden_network_tal`='".$garden_network_tal."'where garden_network_id='".$garden_network_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
 	}
 }
?>
</h4></center>
<script>
location="garden_network.php";
</script>
</body>
</html>