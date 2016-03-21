<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
  if($_SESSION['username'] == "")
  {
    echo "Please Login!";
    exit();
  }

  $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
?>
<!DOCTYPE html>
<html>
<head>
 <title>Table: unit_measure</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
   <link rel="stylesheet" href="css/css.css">
   <script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
</head>
<body><center><h4>
<?php $i = $objResult["employee_name"];?>
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
$passold = $_POST["passold"];
$passnew = $_POST["passnew"];
$passnew2 = $_POST["passnew2"];

    $test_name = "select username from employee where username like binary'".$username."'
    and employee_id != '".$employee_id."'";
     $tmp = mysql_query($test_name);
     $row = mysql_num_rows($tmp);
     if($row!=0){
    echo "<script>swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
          location=\"employee_formupdate.php?id=$employee_id\";
         })
         </script>";
     exit;
     }else{
 $sql = "update `tiantongorchid`.`employee` set `employee_name`='".$employee_name."', `employee_tel`='".$employee_tel."',`user_manage`='".$user_manage."',`username`='".$username."',`password`='".sha1($password)."' where employee_id='".$employee_id."'";
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