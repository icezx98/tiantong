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
?>
<!DOCTYPE html>
<html ng-app = "order">
<head>
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


</head>
<body >
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
   <a href="../spread_order.php">การกระจายคำสั่งซื้อ(แก้ไขข้อมูล)</a>
    
  </div>
  <div class="col-md-3">
  

  </div>
</div>
<hr width="80%">

<?php
   include("../connect.php");
   $db = "tiantongorchid";
    $tb = "spread_order";
   $result = mysql_select_db($db);
   if(!$result){
   die('Could not find database called produce: '. mysql_error());
   }
      $sql = "select * from spread_order where spread_id = '".$_GET["id"]."'" ;
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;
         $spread_id="";
         $spread_date="";
         $spread_due_date="";
         $employee_id="";
         $orders_id="";
         $recive_id="";
     while($i<$num_rows){
         $data = mysql_fetch_array($result);
         $spread_id=$data[0];
         $spread_date=$data[1];
         $spread_due_date=$data[2];
         $employee_id=$data[3];
         $orders_id=$data[4];
         $recive_id=$data[5];
      $i++;
   }

?>



    <div class="clearfix hidden-xs">
        <form method="post" action="#" ng-controller="orderController">
    <table style="width:90%">
      <tr>
        <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสการกระจายคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
        <td style="width:200px"> 
          <div class="input-group">
            <span class="input-group-addon" id="sizing-addon2"></span>
            <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="spread_id" readonly="readonly" style="width:200px" value="<?php echo $spread_id;?>">
          </div>
        </td>
      </tr>
        
      <tr>
        <td style="width:200px"><div class="col-md-9 col-md-push-5">การรับคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
        <td>
          <div class="row">
            <div class="col-xs-10 col-sm-3 col-md-5">
            <select class="form-control" name="orders_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
              <?php

                 $sql = "select o.orders_id , c.company_name from orders o,company c where  o.company_id = c.company_id  and o.status = 'ใช้งาน' and o.orders_id = '".$orders_id."'";
                 $result = mysql_query($sql);
                 $num_rows = mysql_num_rows($result);
                 $i = 0;
                 while($i<$num_rows){
                 $data = mysql_fetch_array($result);
                     echo "<option value='$data[0]'>$data[0] $data[1] </option>";
                 $i++; 
                }
                $sql = "select o.orders_id , m.market_customer_name from orders o,market_customer m where  o.market_customer_id = m.market_customer_id  and o.status = 'ใช้งาน' and o.orders_id = '".$orders_id."'";
                 $result = mysql_query($sql);
                 $num_rows = mysql_num_rows($result);
                 $i = 0;
                 while($i<$num_rows){
                 $data = mysql_fetch_array($result);
                     echo "<option value='$data[0]'>$data[0] $data[1] </option>";
                 $i++; 
                }

                $sql = "select o.orders_id , c.company_name from orders o,company c where  o.company_id = c.company_id  and o.status = 'ใช้งาน' and o.orders_id != '".$orders_id."'";
                 $result = mysql_query($sql);
                 $num_rows = mysql_num_rows($result);
                 $i = 0;
                 while($i<$num_rows){
                 $data = mysql_fetch_array($result);
                     echo "<option value='$data[0]'>$data[0] $data[1] </option>";
                 $i++; 
                }
                $sql = "select o.orders_id , m.market_customer_name from orders o,market_customer m where  o.market_customer_id = m.market_customer_id  and o.status = 'ใช้งาน' and o.orders_id != '".$orders_id."'";
                 $result = mysql_query($sql);
                 $num_rows = mysql_num_rows($result);
                 $i = 0;
                 while($i<$num_rows){
                 $data = mysql_fetch_array($result);
                     echo "<option value='$data[0]'>$data[0] $data[1] </option>";
                 $i++; 
                }

             ?>
            </select>
          </div>
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
    <input type="date" name="dateInput" ng-model="orderDate" ng-change="changOrderDate()" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required value="<?php echo $spread_date;?>">
    </div>
      </td>
        </tr>
        <tr>
      <td style="width:200px"><div class="col-md-9 col-md-push-5">กำหนดส่ง</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
      <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <!-- <input type="text" text-align="center" class="form-control"  aria-describedby="sizing-addon2" name="dateInput1" id="dateInput1"  style="width:200px" placeholder="คลิก เลือกวันที่"  oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required> -->
      <input type="date" name="dateInput1" min="{{sendDate}}" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" required value="<?php echo $spread_due_date;?>">
    </div>
      </td>
        </tr>
        
      <tr>
      <td></td>
      <td >
    <div class="row">
      <div class="col-xs-10 col-sm-4 col-md-6"></div>
      <div class="col-xs-8 col-md-6"><input type="submit" name="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../spread_order.php'"></td></div>
    </div>
      <?php
        if (isset($_POST['submit']))
                {
                   $spread_id = $_POST["spread_id"];
                   $orders_id = $_POST["orders_id"];
                   $employee_id = $_POST["employee_id"];
                   $spread_date = $_POST["dateInput"];
                   $spread_due_date = $_POST["dateInput1"];
                   $recive_id = "";
                  
                   $sql = "update `tiantongorchid`.`spread_order` set `spread_date`='".$spread_date."', `spread_due_date`='".$spread_due_date."',`employee_id`='".$employee_id."',`orders_id`='".$orders_id."',`recive_id`='".$recive_id."' where spread_id='".$spread_id."'";
                   $result = mysql_query($sql);
                   if(!$result){
                   die('Insert not success !!!: '. mysql_error());
                   }
                  echo "<script>location='../spread_order.php';</script>";
                }
      ?>
        
      </tr>
      </table>
      </form>
      </div>


  <div class="clearfix visible-xs hidden-md hidden-lg">
      
  </div>


<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../im/BG.jpg", {speed: 100});
    </script>
</body>
</html>