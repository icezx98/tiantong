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

 
 $test_name = "select color_name from color where color_name like binary'".$color_name."' or color_name = '".$color_name."' ";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"color_formin.php\";
})
</script>";
 exit;
 
 }else{
 $sql = "insert into `tiantongorchid`.`color` (`color_id`, `color_name`)
 values ('".$color_id."', '".$color_name."')";
$result = mysql_query($sql);
}


?>
</h4></center>
<script>
location="../color_index.php";
</script>

</body>
</html> 