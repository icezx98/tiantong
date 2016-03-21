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
  $orders_id = $_GET['i'];
    $companyId = $_GET['companyId'];
  $customerId = $_GET['customerId'];
?>
<!DOCTYPE html>
<html ng-app="product">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../css/style.css">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
  <title></title>
 <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/css1.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
 <script type="text/javascript" src="../angular.min.js"></script>
 <script type="text/javascript" src="../js/moment.js"></script>
  <script type="text/javascript" src="../js/location.js"></script>
</head>
<body ng-controller='productController'>
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
    <a href="../detail_orders.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">รายละเอียดการรับคำสั่งซื้อ(แก้ไขข้อมูล)</a>
  </div>
  <div class="col-md-3">
  

  </div>
</div>
<center><hr width="80%"></center>

<?php
 include("../connect.php");
 $db = "tiantongorchid";
  $tb = "produce";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called produce: '. mysql_error());
 }
$sql = "select * from detail_orders where detail_orders_id = '".$_GET["id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;

 $detail_orders_id="";
 $orders_id="";
 $produce_id="";
 
 $number_orders="";


 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $detail_orders_id=$data[0];
 $orders_id=$data[1];
 $produce_id=$data[2];
 
 $number_orders=$data[3];

 $i++;
 }

?>



<div class="clearfix hidden-xs">
    <form method="post" action="detail_orders_update.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">
      <input type='hidden' name='produce_id' value='{{id}}'>
<table>
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสรายละเอียดการรับคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="detail_orders_id" readonly="readonly" style="width:200px" value="<?php echo $detail_orders_id;?>">
</div>
</td>
</tr>
<tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสการรับคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="orders_id" readonly="readonly" style="width:200px" value="<?php echo $orders_id;?>">
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

    <select  class="form-control" ng-model="unitSelect" ng-change="getId()" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="" selected>คลิกเลือกหน่วยนับ</option>
                                <option value="{{$index}}" ng-model="unitSelect" ng-repeat="data in unit"> {{data[1]}} </option>
                            </select>
  </td>
    </tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">จำนวนที่สั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" onKeyUp="var regExp = /^[0-9]*$/;if(!regExp.test(this.value)){this.value = '';}" style="text-align: right;width: 200px;" class="form-control" placeholder="0" aria-describedby="sizing-addon2" name="number_orders" style="width:200px" value="<?php echo $number_orders;?>" >
</div>
  </td>
    </tr>

  <tr>
  <td></td>
  <td><div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../detail_orders.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>'"></td></div>
</div></td>
  </tr>
  </table>
</form>
</div>

  <div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="detail_orders_update.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">
      <input type='hidden' name='produce_id' value='{{id}}'>
<table style="width:90%">
  <tr >
  <td > 
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสรายละเอียดการรับคำสั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="detail_orders_id" readonly="readonly" style="width:235px" value="<?php echo $detail_orders_id;?>">
</div></div>
</td>
</tr>
<tr >
  <td> 
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสการรับคำสั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="orders_id" readonly="readonly" style="width:235px" value="<?php echo $orders_id;?>">
</div></div>
</td>
</tr>

 <tr>
  <td>
            <div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อสินค้า<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
                        
                            <select  class="form-control" ng-model="productSelect" ng-change="getColor(true)" style="width:235px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
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

     <select  class="form-control" ng-model="colorSelect" ng-change="getSize(true)" style="width:235px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
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

    <select  class="form-control" ng-model="sizeSelect" ng-change="getUnit(true)" style="width:235px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
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
    <select  class="form-control" ng-model="unitSelect" ng-change="getId()" style="width:235px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="" selected>คลิกเลือกหน่วยนับ</option>
                                <option value="{{$index}}" ng-model="unitSelect" ng-repeat="data in unit"> {{data[1]}} </option>
                            </select></div></div>
  </td>
    </tr>
    <tr>
  <td >
<div class="input-group">
          <div class="col-md-9 col-md-push-5">จำนวนที่สั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" onKeyUp="var regExp = /^[0-9]*$/;if(!regExp.test(this.value)){this.value = '';}" style="text-align: right;width: 235px;" class="form-control" placeholder="0" aria-describedby="sizing-addon2" name="number_orders" style="width:200px" value="<?php echo $number_orders;?>" >
</div></div>
  </td>
    </tr>

  <tr>
 
  <td>
  <center><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../detail_orders.php?id=<?php echo $orders_id?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>'"></td></center>
</td>
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