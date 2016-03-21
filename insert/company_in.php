<!DOCTYPE html>
<html>
<head>
	<title></title>
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
 die('Could not find database called company: '. mysql_error());
 }
 $company_id = $_POST["company_id"];
 $company_name = $_POST["company_name"];
 $company_contacts = $_POST["company_contacts"];
 $company_address = $_POST["company_address"];
 $company_tel = $_POST["company_tel"];
 

 $test_name = "select company_name from company where company_name like binary'".$company_name."' or company_name ='".$company_name."' ";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 echo "<script>
swal( {title: \"ข้อมูลนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"company_formin.php\";
})
</script>";
 exit;
 
 }else{
 $sql = "insert into `tiantongorchid`.`company` (`company_id`, `company_name`, `company_contacts`, `company_address`, `company_tel`)
 values ('".$company_id."', '".$company_name."', '".$company_contacts."', '".$company_address."', '".$company_tel."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());
 }
  }

?>
</h4></center>
<script>
location="../company.php";
</script>

</body>
</html>