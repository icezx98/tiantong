<?php
  session_start();
  include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called : '. mysql_error());
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
  $orders_id = $_GET['id'];
  $companyId = $_GET['companyId'];
  $customerId = $_GET['customerId'];
?>
<!DOCTYPE html>
<html ng-app="order">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<title></title>
 <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/css1.css">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
<script src="../dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="../dist/sweetalert.css">
<script type="text/javascript" src="../angular.min.js"></script>
 <script type="text/javascript" src="../js/moment.js"></script>
  <script type="text/javascript" src="../js/order_location.js"></script>
</head>
<body ng-controller='orderController'>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
            <img class="img" src="../../tiantong/im/Thiantong.png"  >
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
            <a class="navbar-brand"> <?php echo $date; ?>&nbsp;</a>
            <a class="navbar-brand" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $objResult["employee_name"];?></span></a>
            <li ALIGN = "RIGHT" class="dropdown">
            <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
            <li><a href="../employee_formupdate_changepass.php">เปลี่ยนรหัสผ่าน</a></li>
            <li><a href="#"></a></li>
           
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
   /
  <a href="../order.php">รับคำสั่งซื้อ</a>
   /
    <a href="../detail_orders.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">รายละเอียดการรับคำสั่งซื้อ(เพิ่มข้อมูล)</a>
    
  </div>
  <div class="col-md-3">
	

  </div>
</div>

    <center><hr width="80%"></center>

<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called detail_orders_id: '. mysql_error());
 }

 $test_id = "select MAX(SUBSTRING(detail_orders_id,6)) as num FROM detail_orders";
 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
 $rows = mysql_fetch_array($tmp);
 if($rows){
  $num = $rows['num'];
    if($num==Null){
    $num = 0;
  }

    $test_id = $num+1;
    if($test_id < 10){
     $detail_orders_id = "DOR00000".$test_id;

        }
      elseif ($test_id < 100) {
        $detail_orders_id = "DOR0000".$test_id;
      }
      elseif ($test_id < 1000) {
        $detail_orders_id = "DOR000".$test_id;
      }
      elseif ($test_id < 10000) {
        $detail_orders_id = "DOR00".$test_id;
      }
      elseif ($test_id < 100000) {
        $detail_orders_id = "DOR0".$test_id;
      }
      elseif ($test_id < 1000000) {
        $detail_orders_id = "DOR".$test_id;
      }
      

  }

?>


<div class="clearfix hidden-xs">
    <form method="post" action="detail_orders_in.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">
      <input type='hidden' name='produce_id' value='{{id}}'>
<table >
  <tr >
  <td style="width:250px"><div class="col-md-9 col-md-push-5">รหัสรายละเอียดการรับคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="detail_orders_id" readonly="readonly" style="width:200px" value="<?php echo $detail_orders_id;?>">
</div>
</td>
</tr>
 <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสการรับคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" readonly="readonly" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="orders_id" style="width:200px" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required value="<?php echo $orders_id;?>">
</div>
  </td>
    </tr>
  
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td>

                        
                             <select  class="form-control" ng-model="productSelect" ng-change="getColor(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสินค้า</option>
                                <option value="{{$index}}" ng-model="productSelect" ng-repeat="data in product"> {{data[1]}} </option>
                            </select>
                        
              

  </td>
    </tr>
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">สี</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">

     <select  class="form-control" ng-model="colorSelect" ng-change="getSize(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสี</option>
                                <option value="{{$index}}" ng-model="colorSelect" ng-repeat="data in color"> {{data[1]}} </option>
                            </select>
</div>

  </td>
    </tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ขนาด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">

    <select  class="form-control" ng-model="sizeSelect" ng-change="getUnit(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกขนาด</option>
                                <option value="{{$index}}" ng-model="sizeSelect" ng-repeat="data in size"> {{data[1]}} </option>
                            </select>
  
</div>
    </td>
    </tr>



    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">หน่วยนับ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">

    <select  class="form-control" ng-model="unitSelect" ng-change="getId(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="" selected>เลือกหน่วยนับ</option>
                                <option value="{{$index}}" ng-model="unitSelect" ng-repeat="data in unit"> {{data[1]}} </option>
                            </select>
  </td>
    </tr>
 

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">จำนวนที่สั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" onKeyUp="var regExp = /^[0-9]*$/;if(!regExp.test(this.value)){this.value = '';}" style="text-align: right;width: 200px;" class="form-control" placeholder="0" aria-describedby="sizing-addon2" name="number_orders"  oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>

  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6">
    <input type="submit" value="เพิ่ม" style="width:80px">&nbsp;
    <input ONCLICK="window.location.href='detail_orders_check.php?id=<?php echo $orders_id; ?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>'" type="reset" value="ยกเลิก" style="width:80px"></td></div>
</div>

    
  </tr>
  </table>
  </form>
  </div>

  <div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="detail_orders_in.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">
      <input type='hidden' name='produce_id' value='{{id}}'>
<table style="width:90%">
  <tr >
      <td > 
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสรายละเอียดการรับคำสั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="detail_orders_id" readonly="readonly" style="width:230px" value="<?php echo $detail_orders_id;?>">
      </div></div>
      </td>
  </tr>
 <tr>
  <td >
  <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสการรับคำสั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" readonly="readonly" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="orders_id" style="width:230px" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required value="<?php echo $orders_id;?>">
</div></div>
  </td>
    </tr>
  
  <tr>
  <td>
        <div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อสินค้า<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
                             <select  class="form-control" ng-model="productSelect" ng-change="getColor(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสินค้า</option>
                                <option value="{{$index}}" ng-model="productSelect" ng-repeat="data in product"> {{data[1]}} </option>
                            </select>
                        
              </div></div>

  </td>
    </tr>
  <tr>
  <td>
  
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">สี<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
     <select  class="form-control" ng-model="colorSelect" ng-change="getSize(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสี</option>
                                <option value="{{$index}}" ng-model="colorSelect" ng-repeat="data in color"> {{data[1]}} </option>
                            </select>
  </div></div>

  </td>
    </tr>

<tr>
  <td>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">ขนาด<b>*</b></div>
          <div class="col-md-9 col-md-push-5">

    <select  class="form-control" ng-model="sizeSelect" ng-change="getUnit(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกขนาด</option>
                                <option value="{{$index}}" ng-model="sizeSelect" ng-repeat="data in size"> {{data[1]}} </option>
                            </select>
  
    </div></div>
    </td>
    </tr>



    <tr>
 <td >
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">หน่วยนับ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
    <select  class="form-control" ng-model="unitSelect" ng-change="getId(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="" selected>เลือกหน่วยนับ</option>
                                <option value="{{$index}}" ng-model="unitSelect" ng-repeat="data in unit"> {{data[1]}} </option>
                            </select>
     </div></div>
  </td>
    </tr>
 

  <tr>
  <td >
  <div class="input-group">
          <div class="col-md-9 col-md-push-5">จำนวนที่สั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" onKeyUp="var regExp = /^[0-9]*$/;if(!regExp.test(this.value)){this.value = '';}" style="text-align: right;width: 230px;" class="form-control" placeholder="0" aria-describedby="sizing-addon2" name="number_orders"  oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required>
  </div></div>
  </td>
    </tr>

  <tr>
  <td >
    
    <center><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;
    <input ONCLICK="window.location.href='detail_orders_check.php?id=<?php echo $orders_id; ?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>'" type="reset" value="ยกเลิก" style="width:80px"></td></div>
    </center>

    
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
</html>