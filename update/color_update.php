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
 die('Could not find database called color: '. mysql_error());
 }
 $color_id = $_POST["color_id"];
 $color_name = $_POST["color_name"];

 $test_name = "select color_name from color where color_name like binary'".$color_name."'
 				or color_name ='".$color_name."' and color_id !='".$color_id."' ";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 echo "<script>
	swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"color_formupdate.php?id=$color_id\";
})
</script>";
 exit;
 }else{
 $sql = "update `tiantongorchid`.`color` set `color_name`='".$color_name."' where color_id='".$color_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }}
?>
</h4></center>
<script>
location="../color_index.php";
</script>
</body>
</html>