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
 <link rel="stylesheet" href="css/css.css">
   <script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8">
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
$passold = $_POST["passold"];
$passold = sha1($passold);
$passnew = $_POST["passnew"];
$passnew = sha1($passnew);
$passnew2 = $_POST["passnew2"];
$passnew2 = sha1($passnew2);


$test_pass = "select password from employee where employee_name='$i'";
 $tmp = mysql_query($test_pass);
 // $row = mysql_num_rows($tmp);
 while($rw = mysql_fetch_array($tmp,MYSQL_NUM))
 {
 	$result = $rw[0] ;
 }

 if($result!=$passold){
echo "<script>
swal( {title: \"รหัสผ่านไม่ถูกต้อง\", type: \"warning\" },function(){
location=\"employee_formupdate_changepass.php\";
 })
</script>";
  exit;
 exit;
 }
 elseif ($passnew == $passnew2) {
 	// echo "aaaaaa";
 	// exit;

 $sql = "update `tiantongorchid`.`employee` set `password`='".$passnew2."' where employee_name='".$i."'";
 $result = mysql_query($sql);
 ?> 
 <script>location="index.php";</script> 
 <?php
 if(!$result){
  die('Insert not success !!!: '. mysql_error());
    }
 
  }
else{
echo "รหัสผ่านไม่ตรงกัน";
}
?>
</h4></center>
<script>
// location="employee.php";
</script>
</body>
</html>