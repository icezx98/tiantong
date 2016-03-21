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
  <script type="text/javascript" src="../js/order_formupdate.js"></script>

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
  <a href="../order.php">รับคำสั่งซื้อ(แก้ไขข้อมูล)</a>
    
  </div>
  <div class="col-md-3">
	

  </div>
</div>
<hr width="80%">

<?php 
include("../connect.php");
 $db = "tiantongorchid";
 $tb = "produce";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called produce: '. mysql_error());
 }
 $sql = "select * from orders where orders_id = '".$_GET["id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $orders_id="";
 $company_id="";
 $market_customer_id="";
 $employee_id="";
 $orders_date="";
 $orders_due_date="";
 $status="";


 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $orders_id=$data[0];
 $company_id=$data[3];
 $market_customer_id=$data[4];
 $employee_id=$data[5];
 $orders_due_date=$data[2];
 $status=$data[6];
 $i++;
 }
?>


 <div class="clearfix hidden-xs">
<!--   <input type="hidden" ng-init = "orderDate = '<?php echo $orders_date; ?>'" value = "<?php echo $orders_date; ?>">
  {{orderDate}} -->
    <form method="post" action="order_update.php" ng-controller="orderController">
<table >
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-4">รหัสการรับคำสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="orders_id" readonly="readonly" style="width:200px" value="<?php echo $orders_id ;?>">
</div>
</td>
</tr>

    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ประเภทลูกค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td class ='radi'>
      <?php
          if($company_id != ""){
               echo "&nbsp;&nbsp;<input class='i' type='radio' value=1 name='optradio' checked> ลูกค้าบริษัท";
               echo "&nbsp;&nbsp;<input class='c' type='radio' value=2 name='optradio' > ลูกค้าไม้ตลาด";
              
          }
          else if($market_customer_id != "") {
               echo "&nbsp;&nbsp;<input class='i' type='radio' value=1 name='optradio' > ลูกค้าบริษัท";
               echo "&nbsp;&nbsp;<input class='c' type='radio' value=2 name='optradio' checked> ลูกค้าไม้ตลาด";
          }
          
          
      ?>
     
      
</td>
</tr>
 <tr id = "log">
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ลูกค้าบริษัท</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td>
          <select class="form-control" name="company_id" style="width:227px" >
    <?php
       $sql = "select company_id,company_name from company where company_id = '".$company_id."'  ";  
       $result = mysql_query($sql);
       $num_rows = mysql_num_rows($result);
       $num_fields = mysql_num_fields($result);
       $i = 0;
       
       while($i<$num_rows){
       $data = mysql_fetch_array($result);
      echo "<option value='$data[0]'> $data[1]</option>";
       $i++; 
      }
      $sql = "select company_id,company_name from company where company_id != '".$company_id."'  ";  
       $result = mysql_query($sql);
       $num_rows = mysql_num_rows($result);
       $num_fields = mysql_num_fields($result);
       $i = 0;
       if($market_customer_id != ""){echo "<option value=''>เลือก ลูกค้าบริษัท</option>";
      };
       while($i<$num_rows){
       $data = mysql_fetch_array($result);
       for($j=1; $j<$num_fields; $j++){
      echo "<option value='$data[0]'> $data[$j]</option>";
       }

       $i++; 
      }
    ?>
    </select>
  
</td>
</tr>
    <tr></tr>
    <tr id = "lo">
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ลูกค้าไม้ตลาด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td>
    <select class="form-control" name="market_customer_id" style="width:227px" >
    <?php
      $sql = "select market_customer_id,market_customer_name from market_customer where market_customer_id = '".$market_customer_id."'  ";  
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;
        
      while($i<$num_rows){
      $data = mysql_fetch_array($result);        
          echo "<option value='$data[0]'>$data[1]</option>";
          $i++; 
        }
      $sql = "select market_customer_id,market_customer_name from market_customer where market_customer_id != '".$market_customer_id."'  ";  
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;
        if($company_id != ""){echo "<option value=''>เลือก ลูกค้าไม้ตลาด</option>";
      };
      while($i<$num_rows){
      $data = mysql_fetch_array($result);

      for($j=1; $j<$num_fields; $j++){
          
          echo "<option value='$data[0]'>$data[$j]</option>";


      }

          $i++; 
        }
 ?>
</select>
</td>
</tr>
  
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ชื่อพนักงาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
  <?php
      $sql = "select employee_id,employee_name from employee WHERE employee_id = '".$employee_id."'";
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;

      while($i<$num_rows){
      $data = mysql_fetch_array($result);
        $employee_id = $data[0];
        $employee_name = $data[1];
          $i++; 
        }
 ?>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee_name" readonly="readonly" style="width:200px" value= "<?php echo $employee_name;?>">
  <input type="hidden" name="employee_id" value= "<?php echo $employee_id;?>">
  </td>
    </tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">วันที่สั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="date" name="dateInput" ng-model="orderDate" ng-change="changOrderDate()" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" value = "<?php echo $orders_date; ?>" required>
</div>
  </td>
    </tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">กำหนดส่ง</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="date" name="dateInput1" min="{{sendDate}}" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" value = "<?php echo $orders_due_date; ?>" required>
</div>
  </td>
    </tr>
    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">สถานะ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td class ='radi'>
    &nbsp;&nbsp;<input type="radio" name="status" value="ใช้งาน" <?php echo ($status== 'ใช้งาน') ?  "checked" : "" ;  ?>/>ใช้งาน
    &nbsp;&nbsp;<input type="radio" name="status" value="ยกเลิก" <?php echo ($status== 'ยกเลิก') ?  "checked" : "" ;  ?>/>ยกเลิก
  </td>
    </tr>
  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="button" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../order.php'"></td></div>
</div>
  </tr>
  </table>
  </form>
  </div>


<div class="clearfix visible-xs hidden-md hidden-lg">
<!--   <input type="hidden" ng-init = "orderDate = '<?php echo $orders_date; ?>'" value = "<?php echo $orders_date; ?>">
  {{orderDate}} -->
    <form method="post" action="order_update.php" ng-controller="orderController">
<table style="width:90%"> 
  <tr >
  <td > 
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสการรับคำสั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="orders_id" readonly="readonly" style="width:230px" value="<?php echo $orders_id ;?>">
</div></div>
</td>
</tr>

    <tr>
  <td class ='radi'>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">ประเภทลูกค้า<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
      <?php
          if($company_id != ""){
               echo "&nbsp;&nbsp;<input class='i' type='radio' value=1 name='optradio' checked>ลูกค้าบริษัท<br>";
               echo "&nbsp;&nbsp;<input class='c' type='radio' value=2 name='optradio' >ลูกค้าไม้ตลาด";
              
          }
          else if($market_customer_id != "") {
               echo "&nbsp;&nbsp;<input class='i' type='radio' value=1 name='optradio' >ลูกค้าบริษัท<br>";
               echo "&nbsp;&nbsp;<input class='c' type='radio' value=2 name='optradio' checked>ลูกค้าไม้ตลาด";
          }
          
          
      ?>
     </div></div>
      
</td>
</tr>
 <tr id = "log">
  <td>
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">ลูกค้าบริษัท<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
          <select class="form-control" name="company_id" style="width:230px">
    <?php
       $sql = "select company_id,company_name from company where company_id = '".$company_id."'  ";  
       $result = mysql_query($sql);
       $num_rows = mysql_num_rows($result);
       $num_fields = mysql_num_fields($result);
       $i = 0;
       
       while($i<$num_rows){
       $data = mysql_fetch_array($result);
      echo "<option value='$data[0]'> $data[1]</option>";
       $i++; 
      }
      $sql = "select company_id,company_name from company where company_id != '".$company_id."'  ";  
       $result = mysql_query($sql);
       $num_rows = mysql_num_rows($result);
       $num_fields = mysql_num_fields($result);
       $i = 0;
       if($market_customer_id != ""){echo "<option value=''>เลือก ลูกค้าบริษัท</option>";
      };
       while($i<$num_rows){
       $data = mysql_fetch_array($result);
       for($j=1; $j<$num_fields; $j++){
      echo "<option value='$data[0]'> $data[$j]</option>";
       }

       $i++; 
      }
    ?>
    </select>
  </div></div>
</td>
</tr>
    <tr></tr>
    <tr id = "lo">
  <td>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">ลูกค้าไม้ตลาด<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
    <select class="form-control" name="market_customer_id" style="width:230px">
    <?php
      $sql = "select market_customer_id,market_customer_name from market_customer where market_customer_id = '".$market_customer_id."'  ";  
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;
        
      while($i<$num_rows){
      $data = mysql_fetch_array($result);        
          echo "<option value='$data[0]'>$data[1]</option>";
          $i++; 
        }
      $sql = "select market_customer_id,market_customer_name from market_customer where market_customer_id != '".$market_customer_id."'  ";  
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;
        if($company_id != ""){echo "<option value=''>เลือก ลูกค้าไม้ตลาด</option>";
      };
      while($i<$num_rows){
      $data = mysql_fetch_array($result);

      for($j=1; $j<$num_fields; $j++){
          
          echo "<option value='$data[0]'>$data[$j]</option>";


      }

          $i++; 
        }
 ?>
</select>
</div></div>
</td>
</tr>
  
    <tr>
  <td>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อพนักงาน<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee_name" readonly="readonly" style="width:230px"  value="<?php echo $employee_name ;?>">
  <input type="hidden" name="employee_id" value= "<?php echo $employee_id;?>">
</div></div>

  </td>
    </tr>
  
  <td >
  <div class="input-group">
          <div class="col-md-9 col-md-push-5">วันที่สั่งซื้อ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="date" name="dateInput" ng-model="orderDate" style="width:230px" ng-change="changOrderDate()" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" value = "<?php echo $orders_date; ?>" required>
</div></div>
  </td>
    </tr>
    <tr>
  <td >
   <div class="input-group">
          <div class="col-md-9 col-md-push-5">กำหนดส่ง<b>*</b></div>
          <div class="col-md-9 col-md-push-5">

  <input type="date" name="dateInput1" min="{{sendDate}}" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกวันที่')" oninput="setCustomValidity('')" value = "<?php echo $orders_due_date; ?>" required>
  </div></div>
  </td>
    </tr>
    <tr>
  <td class ='radi'>
    <div class="input-group">
          <div class="col-md-9 col-md-push-5">สถานะ<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
    &nbsp;&nbsp;<input type="radio" name="status" value="ใช้งาน" <?php echo ($status== 'ใช้งาน') ?  "checked" : "" ;  ?>/>ใช้งาน
    &nbsp;&nbsp;<input type="radio" name="status" value="ยกเลิก" <?php echo ($status== 'ยกเลิก') ?  "checked" : "" ;  ?>/>ยกเลิก
     </div></div>
  </td>
    </tr>
  <tr>
  <td>
  <center><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="button" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../order.php'"></td></center>
  </tr>
  </table>
  </form>
  </div>

<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../im/BG.jpg", {speed: 100});
    </script>
</body>
</html>

<html > 
  <head>  
    
    <link rel="stylesheet" media="all" type="text/css" href="../css/jquery-ui.css" />
    <link rel="stylesheet" media="all" type="text/css" href="../css/jquery-ui-timepicker-addon.css" />

    <script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="../js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-sliderAccess.js"></script>



  </head> 
  <body> 

  <div style="padding-left:200px;padding-top:200px">

<!-- <div id="startDate"> -->
<script type="text/javascript">

// $(function(){
//   $("#dateInput1").datepicker({
//     dateFormat: 'yy/mm/dd'
//   });
// });

    $(function(){
      var  company_id = '<?php echo $company_id; ?>'
          if(company_id != ""){
            $(".c").change(function() {
              swal("ประเภทลูกค้า!","เปลี่ยนเป็นลูกค้าไม้ตลาด!");
            });
          $("tr#log").show();
    $('input.i').on( "click", function() {
          $( "tr#log" ).show();
          $("tr#lo").hide();
                                          });
              
          $("tr#lo").hide();
      $('input.c').on( "click", function() {
          $( "tr#lo" ).show();
          $("tr#log").hide();
                                          });
                                }
            else{
              $(".i").change(function() {
              swal( "ประเภทลูกค้า!","เปลี่ยนเป็นลูกค้าบริษัท");
            });
            $("tr#log").hide();
    $('input.i').on( "click", function() {
          $( "tr#log" ).show();
          $("tr#lo").hide();
                                          });
              
          $("tr#lo").show();
      $('input.c').on( "click", function() {
          $( "tr#lo" ).show();
          $("tr#log").hide();
                                          });
            };
                });
  </script>

</body>
</html>
