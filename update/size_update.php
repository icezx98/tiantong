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
 $size_id = $_POST["size_id"];
 $size_name = $_POST["size_name"];

 $test_name = "select size_name from size where size_name  like binary'".$size_name."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 	 echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"size_formupdate.php?id=$size_id\";
})
</script>";
 exit;
 }else{
 $sql = "update `tiantongorchid`.`size` set `size_name`='".$size_name."' where size_id='".$size_id."'";
 $result = mysql_query($sql);
 if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }}
?>
</h4></center>
<script>
location="../size_index.php";
</script>
</body>
</html>