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
 die('Could not find database called unit_measure: '. mysql_error());
 }
 $unit_measure_id = $_POST["unit_measure_id"];
 $unit_measure_name = $_POST["unit_measure_name"];


 $test_name = "select unit_measure_name from unit_measure where unit_measure_name like binary'".$unit_measure_name."'
   or unit_measure_name ='".$unit_measure_name."' and unit_measure_id != '".$unit_measure_id."'";
 $tmp = mysql_query($test_name);
 $row = mysql_num_rows($tmp);
 if($row!=0){
 echo "<script>
swal( {title: \"หน่วยนับนี้มีอยู่ในระบบแล้ว\", type: \"warning\" },function(){
	location=\"unit_measure.php\";
})
</script>";
 exit;
 
 }else{
 $sql = "insert into `tiantongorchid`.`unit_measure` (`unit_measure_id`, `unit_measure_name`)
 values ('".$unit_measure_id."', '".$unit_measure_name."')";
$result = mysql_query($sql);
if(!$result){
 die('Insert not success !!!: '. mysql_error());

 }else{
 	echo "<script>location=\"unit_measure_index.php\";</script>";
 }
  }

?>
</h4></center>

</body>
</html> 