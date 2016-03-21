<?php
  session_start();
  include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
  if(!isset($_SESSION['username']))
  {
    echo "Please Login!";
    exit();
  }

  // if($_SESSION['user_manage'] != "user")
  // {
  //   echo "This page for Admin only!";
  //   exit();
  // } 
  $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
  $employee_id = $objResult["employee_id"];

?>
<!DOCTYPE html>
<html ng-app='recive_select'>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<title></title>
 <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/css1.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
 <script type="text/javascript" src="../angular.min.js"></script>
 <script type="text/javascript" src="../js/ui-bootstrap-tpls-1.2.1.min.js"></script>
 <script type="text/javascript" src="../js/angular-animate.min.js"></script>
 <script type="text/javascript" src="../js/recive_popup.js"></script>
 <script type="text/javascript" src="../js/recive_formin_select.js"></script>
</head>
<body ng-controller='recive_selectcontroller'>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
            <img class="img" src="../im/Thiantong.png"  >
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">

        <?php  
          $_month_name = array("01"=>"มกราคม",  "02"=>"กุมภาพันธ์",  "03"=>"มีนาคม",    
          "04"=>"เมษายน",  "05"=>"พฤษภาคม",  "06"=>"มิถุนายน",    
          "07"=>"กรกฎาคม",  "08"=>"สิงหาคม",  "09"=>"กันยายน",    
          "10"=>"ตุลาคม", "11"=>"พฤศจิกายน",  "12"=>"ธันวาคม"); 
       
          $vardate=date('Y-m-d');
          $yy=date('Y');
          $mm =date('m');$dd=date('d'); 
          if ($dd<10){
          $dd=substr($dd,1,2);
          }
          $date=$dd ." ".$_month_name[$mm]."  ".$yy+= 543; 
        ?>
            <a align="RIGHT" class="navbar-brand"> <?php echo $date; ?>&nbsp;</a>
            <a class="navbar-brand" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $objResult["employee_name"];?></span></a>
              

            <li align="RIGHT" class="dropdown">
            <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
            <li><a href="../employee_formupdate_changepass.php">เปลี่ยนรหัสผ่าน</a></li>
            <li><a href="../logout.php">ออกจากระบบ</a></li>
              </ul>
            </li>
            
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="row">
  <div class="col-md-2">
    
  </div>
  <div class="col-md-7" style="font-size:2em;">
	  <a href="../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>หน้าหลัก</a>
   <!-- /
	  <a href="../master_data.php">ข้อมูลหลัก</a> -->
	 /
    <a href="../recive.php">รับสินค้า(เพิ่มข้อมูล)</a>
    
  </div>
  <div class="col-md-3">
	

  </div>
</div>
<hr width="80%">

<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called unit_measure: '. mysql_error());
 }

 $test_id = "select MAX(SUBSTRING(recive_id,4)) as num FROM recive";
 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
 $rows = mysql_fetch_array($tmp);
 if($rows){
  $num = $rows['num'];
    if($num==Null){
    $num = 0;
  }

    $test_id = $num+1;
    if($test_id < 10){
     $recive_id = "R000".$test_id;

        }
      elseif ($test_id < 100) {
        $recive_id = "R00".$test_id;
      }
      elseif ($test_id < 1000) {
        $recive_id = "R0".$test_id;
      }
      elseif ($test_id < 10000) {
        $recive_id = "R".$test_id;
      }
    }

?>


  <div class="clearfix hidden-xs">
    <!-- <form method="post" action="recive_in.php"> -->
    <!-- <form method="post" action=""> -->
<table >
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสการรับสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="recive_id" id='recive_id' readonly="readonly" style="width:200px" value="<?php echo $recive_id;?>">
</div>
</td>
</tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสวน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">
    <!-- <select ng-model="recive" ng-change="kuy()" class="form-control" name="garden_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required> -->
    <select ng-model="recive" ng-change="rec()" class="form-control" name="garden_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
  <?php
     $sql = "select detail_spread_order.garden_network_id, garden_network.garden_network_name
             from detail_spread_order, detail_spread_product, garden_network
             where detail_spread_order.garden_network_id = garden_network.garden_network_id
             and detail_spread_order.detail_spread_id = detail_spread_product.detail_spread_id
             and detail_spread_product.status = '0'
             group by garden_network.garden_network_name";
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     echo "<option value=''>คลิกเลือกสวน</option>";
     while($i<$num_rows){
     $data = mysql_fetch_array($result);

     for($j=1; $j<$num_fields; $j++){

    echo "<option value='$data[0]'>$data[$j]</option>";

     }

     $i++; 
    }
 ?>
</select>
</div>
  </td>
    </tr>

    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">วันที่รับสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <?php
     $date = date("Y-m-d");

    ?>
  <input type="date" name="dateInput" ng-model="orderDate" ng-change="changOrderDate()" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>

<!-- <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ราคารวม</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="total_price" style="width:200px" >
</div>
</td>
</tr> -->
  
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อพนักงาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee"  readonly="readonly" style="width:230px"  value="<?php echo $objResult["employee_name"];?>">
  <input type="hidden"  name="employee_id" id='employee' value= "<?php echo  $employee_id;?>">
</div> 

  </td>
    </tr>

  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="เพิ่ม" style="width:80px" ng-click="insert()">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../recive.php'"></td></div>
</div>
<!-- <div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><button ng-click="recive_formin_select.js"></button></div>
</div> -->

    
  </tr>
  </table>

  <table>
  <tr ng-repeat="ice in result track by $index"  >
      <td class='td' align="center"><label><input ng-model="box[$index]" type='checkbox' ng-change='check(ice[1])'></label></td>
      <td ng-click="cl(ice[1],$index)">{{ice[0]}}</td>
      <td ng-click="cl(ice[1],$index)">{{ice[1]}}</td>
      <td ng-click="cl(ice[1],$index)">{{ice[2]}}</td>
  </tr>
</table>
  </form>
  </div>


<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../im/BG.jpg", {speed: 100});
    </script>
</body>
</body>
</html>