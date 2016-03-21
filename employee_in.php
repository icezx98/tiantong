<!DOCTYPE html>
<html>
<head>
	<title></title>
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
 die('Could not find database called employee: '. mysql_error());
 }
 $employee_id = $_POST["employee_id"];
 $employee_name = $_POST["employee_name"];
 $employee_tel = $_POST["employee_tel"];
 $user_manage = $_POST["user_manage"];
 $username = $_POST["username"];

 $password =  $employee_tel;
 

 $test_name = "select username from employee where username like binary'".$username."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
  location=\"employee_formin.php?id=$employee_id\";
})
</script>";
 exit;
 }
 else{
 $sql = "insert into `tiantongorchid`.`employee` (`employee_id`, `employee_name`, `employee_tel`, `user_manage`, `username`, `password`)
 values ('".$employee_id."', '".$employee_name."', '".$employee_tel."', '".strtoupper($user_manage)."', '".$username."', '".sha1($password)."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
  }

?>
</h4></center>
<script>
location="employee.php";
</script>

</body>
</html>