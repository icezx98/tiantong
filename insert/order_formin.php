<!DOCTYPE html>
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
<html ng-app = "order">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet"/>
 <link rel="stylesheet" href="../css/table.css"/>
  <link rel="stylesheet" href="../css/css1.css"/>
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
 <script type="text/javascript" src="../angular.min.js"></script>
 <script type="text/javascript" src="../js/moment.js"></script>
  <script type="text/javascript" src="../js/order_formin.js"></script>

</head>
<body >

  <nav class="navbar navbar-inverse" ng-controller="getdateController">
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
    <a href="../order.php">รับคำสั่งซื้อ(เพิ่มข้อมูล)</a>
    
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
 die('Could not find database called orders: '. mysql_error());
 }

 $test_id = "select MAX(SUBSTRING(orders_id,5)) as num FROM orders";
 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
 $rows = mysql_fetch_array($tmp);
 if($rows){
  $num = $rows['num'];
    if($num==Null){
    $num = 0;
  }

    $test_id = $num+1;
    if($test_id < 10){
     $orders_id = "OR0000".$test_id;

        }
      elseif ($test_id < 100) {
        $orders_id = "OR000".$test_id;
      }
      elseif ($test_id < 1000) {
        $orders_id = "OR00".$test_id;
      }
      elseif ($test_id < 10000) {
        $orders_id = "OR0".$test_id;
      }
      elseif ($test_id < 100000) {
        $orders_id = "OR".$test_id;
      }

  }

?>

<div class="clearfix hidden-xs">
    <form method="post" action="order_in.php" ng-controller="orderController">
<table style="width:90%">
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
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ประเภทลูกค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td class ='radi'>

      &nbsp;&nbsp;<input class="i" type="radio" name="optradio" ng-click = "chnageCustomer('company')" checked value="1"> ลูกค้าบริษัท
      &nbsp;&nbsp;<input class="c" type="radio" name="optradio" ng-click = "chnageCustomer('market')" value="2"> ลูกค้าไม้ตลาด
      

</td>
</tr>
<tr></tr>
    <tr></tr>
    <tr id = "lo">
  <td style="width:200px"><div class="col-md-9 col-md-push-5"  ng-if ="isCompany">ลูกค้าบริษัท</div>
  <div class="col-md-9 col-md-push-5" ng-if ="!isCompany">ลูกค้าไม้ตลาด</div>
  <div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div>
  </td>
  <td>
    <select class="form-control" name="customer_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
    <option value="" ng-if ="isCompany">คลิกเลือกบริษัท</option>
    <option value="" ng-if ="!isCompany">คลิกเลือกไม้ตลาด</option>
    <option ng-repeat="repeat in showDropdown" value="{{repeat[0]}}">{{repeat[1]}}</option>
</select>
</td>
</tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อพนักงาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee_" readonly="readonly" style="width:200px" value="<?php echo $objResult["employee_name"];?>">
  <input type="hidden" name="employee_id" value= "<?php echo $employee_id;?>"
</div>

  </td>
    </tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">วันที่สั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <!-- <input type="date" text-align="center" class="form-control"  aria-describedby="sizing-addon2" name="dateInput" id="dateInput"  style="width:200px" placeholder="คลิก เลือกวันที่"  roninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required> -->
<input type="date" name="dateInput" ng-model="orderDate" ng-change="changOrderDate()" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">กำหนดส่ง</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <!-- <input type="text" text-align="center" class="form-control"  aria-describedby="sizing-addon2" name="dateInput1" id="dateInput1"  style="width:200px" placeholder="คลิก เลือกวันที่"  oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required> -->
  <input type="date" name="dateInput1" min="{{sendDate}}" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>
    
  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../order.php'"></td></div>
</div>

    
  </tr>
  </table>
  </form>
  </div>

<div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="order_in.php" ng-controller="orderController">
<table style="width:90%">
  <tr >
 <td> 
       <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสการรับคำสั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="orders_id" readonly="readonly" style="width:230px" value="<?php echo $orders_id;?>">
</div></div>
</td>
</tr>

    <tr>
 <td class ='radi'>
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">ประเภทลูกค้า<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
      &nbsp;&nbsp;<input class="i" type="radio" name="optradio" ng-click = "chnageCustomer('company')" checked value="1"> ลูกค้าบริษัท <br>
      &nbsp;&nbsp;<input class="c" type="radio" name="optradio" ng-click = "chnageCustomer('market')" value="2"> ลูกค้าไม้ตลาด
      </div></div>

</td>
</tr>
<tr></tr>
    <tr></tr>
    <tr id = "lo">

  <td>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5" ng-if ="isCompany">ลูกค้าบริษัท<b>*</b></div>
          <div class="col-md-9 col-md-push-5" ng-if ="!isCompany">ลูกค้าไม้ตลาด<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
    <select class="form-control" name="customer_id" style="width:230px"  oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
    <option value="" ng-if ="isCompany">คลิกเลือกบริษัท</option>
    <option value="" ng-if ="!isCompany">คลิกเลือกไม้ตลาด</option>
    <option ng-repeat="repeat in showDropdown" value="{{repeat[0]}}">{{repeat[1]}}</option>
</select>
 </div></div>
</td>
</tr>
    <tr>
  <td >
  <div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อพนักงาน<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee_" readonly="readonly" style="width:230px"  value="<?php echo $objResult["employee_name"];?>">
  <input type="hidden" name="employee_id" value= "<?php echo $employee_id;?>">
</div></div>

  </td>
    </tr>
    <tr>
 <td>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">วันที่สั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <!-- <input type="date" text-align="center" class="form-control"  aria-describedby="sizing-addon2" name="dateInput" id="dateInput"  style="width:200px" placeholder="คลิก เลือกวันที่"  roninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required> -->
<input type="date" name="dateInput" ng-model="orderDate" style="width:230px" ng-change="changOrderDate()" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required>
 </div></div>
  </td>
    </tr>
    <tr>
  <td >
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">กำหนดส่ง<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <!-- <input type="text" text-align="center" class="form-control"  aria-describedby="sizing-addon2" name="dateInput1" id="dateInput1"  style="width:200px" placeholder="คลิก เลือกวันที่"  oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required> -->
  <input type="date" name="dateInput1" min="{{sendDate}}" style="width:230px"  oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required>
</div></div>
  </td>
    </tr>
    
  <tr>
 
  <td >

  <center><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../order.php'"></td></center>
  
  </tr>
  </table>
  </form>
  </div>

</center>
<script type="text/javascript">

$(function(){
  $("#dateInput").datepicker({
    dateFormat: 'dd/mm/yy'
  });
});
</script>
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../im/BG.jpg", {speed: 100});
    </script>
</body>
</html>

<!-- <html > 
  <head>     
    <link rel="stylesheet" media="all" type="text/css" href="../css/jquery-ui.css" />
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
  </head> 
  <body> 

  <div style="padding-left:200px;padding-top:200px">
<div id="startDate">
<script type="text/javascript">
// $(function(){
//   $("#dateInput").datepicker({
//     dateFormat: 'yy/mm/dd'
//   });
// });

// $(function(){
//   $("#dateInput1").datepicker({
//     dateFormat: 'yy/mm/dd'
//   });
// });

    // $(function(){
    //       $("tr#log").show();
    // $('input.i').on( "click", function() {
    //       $( "tr#log" ).show();
    //       $("tr#lo").hide();
    //                                       });
              
    //       $("tr#lo").hide();
    //   $('input.c').on( "click", function() {
    //       $( "tr#lo" ).show();
    //       $("tr#log").hide();
    //                                       });
    //             });

    
  </script>
</div>
  </body> 
</html> -->
