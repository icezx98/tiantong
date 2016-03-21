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
  $detail_spread_id = $_GET['id'];
  $order = $_GET['order'];
  $productName = $_GET['productName'];
  $productcolor = $_GET['productcolor'];
  $productsize = $_GET['productsize'];
  $productunit = $_GET['productunit'];
  $number_orders = $_GET['number_orders'];
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
   <a href="../spread_order.php">การกระจายคำสั่งซื้อ</a>
   / 
   <a href="../detail_spread_order.php?id=<?php echo $_GET['id']?>">รายละเอียดการกระจายคำสั่งซื้อ(เพิ่มข้อมูล)</a>
 
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

 $test_id = "select MAX(SUBSTRING(spread_product_id,5)) as num FROM detail_spread_product";
 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
 $rows = mysql_fetch_array($tmp);
 if($rows){
  $num = $rows['num'];
    if($num==Null){
    $num = 0;
  }

    $test_id = $num+1;
    if($test_id < 10){
     $spread_product_id = "PSP0000".$test_id;

        }
      elseif ($test_id < 100) {
        $spread_product_id = "PSP000".$test_id;
      }
      elseif ($test_id < 1000) {
        $spread_product_id = "PSP00".$test_id;
      }
      elseif ($test_id < 10000) {
        $spread_product_id = "PSP0".$test_id;
      }
      elseif ($test_id < 100000) {
        $spread_product_id = "PSP".$test_id;
      }

  }

?>

<div class="clearfix hidden-xs">
    <form method="post" action="#" ng-controller="orderController">
<table style="width:90%">
  <tr>
    <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสรายละเอียดการกระจายสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
    <td style="width:200px"> 
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2"></span>
        <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="spread_product_id" readonly="readonly" style="width:200px" value="<?php echo $spread_product_id;?>">
      </div>
    </td>
  </tr>
  


<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสรายละเอียดการกระจายคําสั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="detail_spread_id" readonly="readonly" style="width:200px" value="<?php echo $detail_spread_id;?>">
    </div>
  </td>
</tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="productName" readonly="readonly" style="width:200px" value="<?php echo $productName;?>">
      <?php
      $sql = "select product_id from product WHERE product_name = '$productName'";
      $result = mysql_query($sql);
     
       $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
 
      $data = mysql_fetch_array($result);
      $product_id = $data[0];

 ?>
    <input type='hidden' name='produce_id' value='<?php echo $product_id;?>'>
    </div>
  </td>
</tr>
<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">สี</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="spread_id" readonly="readonly" style="width:200px" value="<?php echo $productcolor;?>">
      <?php
            $sql = "select color_id from color WHERE color_name = '$productcolor'";
            $result = mysql_query($sql);
            
             $num_rows = mysql_num_rows($result);
            $num_fields = mysql_num_fields($result);
       
            $data = mysql_fetch_array($result);
            $color_id = $data[0];

       ?>
    <input type='hidden' name='color_id' value='<?php echo $color_id;?>'>
    </div>
  </td>
</tr>
<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ขนาด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="spread_id" readonly="readonly" style="width:200px" value="<?php echo $productsize;?>">
      <?php
            $sql = "select size_id from size WHERE size_name = '$productsize'";
            $result = mysql_query($sql);
            
             $num_rows = mysql_num_rows($result);
            $num_fields = mysql_num_fields($result);
       
            $data = mysql_fetch_array($result);
            $size_id = $data[0];

       ?>
    <input type='hidden' name='size_id' value='<?php echo $size_id;?>'>
    </div>
  </td>
</tr>
<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">หน่วยนับ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="spread_id" readonly="readonly" style="width:200px" value="<?php echo $productunit;?>">
      <?php
            $sql = "select unit_measure_id from unit_measure WHERE unit_measure_name = '$productunit'";
            $result = mysql_query($sql);
            
             $num_rows = mysql_num_rows($result);
            $num_fields = mysql_num_fields($result);
       
            $data = mysql_fetch_array($result);
            $unit_measure_id = $data[0];

       ?>
    <input type='hidden' name='unit_measure_id' value='<?php echo $unit_measure_id;?>'>
    </div>
  </td>
</tr>
<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">จำนวนที่สั่งซื้อ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="spread_id" readonly="readonly" style="width:200px" value="<?php echo $number_orders;?>">
    </div>
  </td>
</tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">จำนวนที่สั่งตัด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2"></span>
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="amount" style="width:200px">
    </div>
  </td>
</tr>  
    
    <tr>
    <td></td>
    <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" name="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../order.php'"></td></div>
</div>
  <?php
    if (isset($_POST['submit']))
            {
               $spread_product_id = $_POST["spread_product_id"];
               $detail_spread_id = $_POST["detail_spread_id"];
               $produce_id = $_POST["produce_id"];
               $color_id = $_POST["color_id"];
               $size_id = $_POST["size_id"];
               $unit_measure_id = $_POST["unit_measure_id"];
               $amount = $_POST["amount"];

               $sql = "insert into `tiantongorchid`.`detail_spread_product` (`spread_product_id`, `product_id`, `color_id`, `size_id`, `unit_measure_id`, `amount`, `detail_spread_id`)
               values ('".$spread_product_id."','".$product_id."','".$color_id."','".$size_id."','".$unit_measure_id."','".$amount."','".$detail_spread_id."')";
              $result = mysql_query($sql);
              if(!$result){
               die('Insert not success !!!: '. mysql_error());
              }
              echo "<script>location='../detail_orders.php?id=$order';</script>";
            }
  ?>
    
  </tr>
  </table>
  </form>
  </div>
  
    <div class="clearfix visible-xs hidden-md hidden-lg">
    
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