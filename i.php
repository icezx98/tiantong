<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
  if(empty($_SESSION['username']))
  {
    // echo "Please Login!";
    // echo sweetAlert("Oops...", "Something went wrong!", "error");
    // echo "<script>weed('fff')</script>"
    // echo "<script> swal('5555','error') </script>";
    // echo "<script> swal('Please Login!'); </script>";
     echo "<script> location='login.php'; </script>";
    exit();
  }

  $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
   $employee_id = $objResult["employee_id"];
?>
<!DOCTYPE html>
<html ng-app="spreas">
  <head>
      <link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
      <link href="dist/simple-hint.css" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/css1.css">
      <link rel="stylesheet" href="css/table.css"> 
      <script src="js/bootstrap.min.js"></script>
         <script type="text/javascript" src="angular.min.js"></script>
         <script type="text/javascript" src="js/detail_spread_order.js"></script>
<!-- <script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css"> -->
      <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
</head>
<body ng-controller="spreascontroller">
        <table id="example">
              <thead>
      <tr>
        <th width="80"><pre>   </pre></th>
       <th width="100"><pre>รหัสการรับ<br>คำสั่งซื้อ</pre></th>
       <th width="350"><pre>    บริษัท    </pre></th>
       <th width="350"><pre>   ลูกค้าไม้ตลาด   </pre></th>
       <th width="340"><pre>     พนักงาน     </pre></th>
        <th width="130"><pre>วันที่สั่งซื้อ</pre></th>
        <th width="130"><pre>กำหนดส่ง</pre></th>
        <th width="50"><pre>สถานะ</pre></th>
       


       </tr></thead>
        <tr ng-repeat="row in data" align="center">
        
          <td><label><input type='checkbox' name='checkorder[]' value=''></label></td>
          <td>{{row[0]}}</td>
          <td>{{row[1]}}</td>
        </tr>

        </table>

        </center>
    <script type="text/javascript" src="js/dataTables.min.js"></script>
          <script type="text/javascript" charset="utf-8">
            jQuery(document).ready(function() {
              jQuery('#example').DataTable();
            } );
          </script>
          <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>