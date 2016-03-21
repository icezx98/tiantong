<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
 if (!isset($_SESSION['username']))
   // if($_SESSION['username'] == "")
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
  // if($objResult["password"] == $objResult["employee_tel"]){
  //   echo "<script>location='employee_formupdate_changepass.php';</script>";
  // }
$ll =  $objResult["employee_tel"];
$ll = sha1($ll);
  if($objResult["password"] == $ll ){
    echo "<script>location='employee_formupdate_changepass.php';</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
 <link rel="stylesheet" href="css/css1.css">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<title></title>
 <link rel="stylesheet" href="css/table.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
<!--<link rel="stylesheet" type="text/css" href="./css.css"> -->
  <title>Document</title>
  <link rel="stylesheet"  href="./css/jquery.gridster.min.css">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <script type="text/javascript" src="./js/jquery-1.11.3.min.js"></script>
  <script type="text/javascript" src="./js/jquery.collision.js"></script>
  <script type="text/javascript" src="./js/jquery.coords.js"></script>
  <script type="text/javascript" src="./js/jquery.draggable.js"></script>
  <script type="text/javascript" src="./js/jquery.gridster.with-extras.js"></script>
  <script type="text/javascript" src="./js/jquery.gridster.js"></script>
  <script type="text/javascript" src="./js/utils.js"></script>
  <script type="text/javascript">
    $(function(){ //DOM Ready

      // เรียกใช้ 
      $(".gridster ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140]
      });

    });
    
  </script>
<style type="text/css">

</style>


</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
            <img class="img" src="../tiantong/im/Thiantong.png"  >
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
              

            <li  class="dropdown">
            <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
            <li><a href="employee_formupdate_changepass.php">เปลี่ยนรหัสผ่าน</a></li>
            <li><a href="logout.php">ออกจากระบบ</a></li>
              </ul>
            </li>
            
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
 <div class="clearfix hidden-xs">
<div class="table-responsive">
  
<div class="gridster">
    <ul class="ice">
      <li data-row="1" data-col="1" data-sizex="1" data-sizey="1"><a href="order.php"><img src="im/ReceiveOrder_01.png"width="140" height="140"></a></li>
      <li data-row="2" data-col="1" data-sizex="1" data-sizey="1"><img src="im/SendProduct_01.png"width="140" height="140"></li>
      <li data-row="3" data-col="1" data-sizex="1" data-sizey="1"><a href="customer_data.php"><img src="im/Customer_01.png"width="140" height="140"></a></li>
    
      <li data-row="1" data-col="2" data-sizex="2" data-sizey="1"><center><a href="spread_order.php"><img src="im/ShareOrder_01.png"width="140" height="120"></a></center></li>
      <li data-row="2" data-col="2" data-sizex="2" data-sizey="2"><center><a href="product_data.php"><img src="im/product_01.png"width="300" height="300"></a></center></li>

      <li data-row="1" data-col="4" data-sizex="1" data-sizey="1"><a href="recive.php"><img src="im/ReceiveProduct_01.png"width="140" height="140"></a></li>
      <li data-row="2" data-col="4" data-sizex="2" data-sizey="1"><center><img src="im/PayMoney_01.png"width="140" height="120"></center></li>
      <li data-row="3" data-col="4" data-sizex="1" data-sizey="1"><img src="im/ReceiveMoney_01.png"width="140" height="140"></li>

      <li data-row="1" data-col="5" data-sizex="1" data-sizey="1"><img src="im/SelectGrade_01.png"width="140" height="140"></li>
      <li data-row="3" data-col="5" data-sizex="1" data-sizey="1"><img src="im/Report_01.png"width="140" height="140"></li>

      
      <li data-row="1" data-col="6" data-sizex="1" data-sizey="2"><a href="master_data.php"><img src="im/Main_01.png"width="140" height="300"></a></li>
      <li data-row="2" data-col="6" data-sizex="1" data-sizey="1"><img src="im/ChoiceGardens_01.png"width="140" height="120"></li>
    </ul>
  </div>

        
</div>
</div>
        

   <div class="clearfix visible-xs hidden-md hidden-lg">

        <section class="login">
  <div class="titulo"><pre>        M E N U   </pre></div>
  <form >
    <ul class="nav nav-pills nav-stacked">
      <li role="presentation"><a  href="order.php"><h3>การรับคำสั่งซื้อ</h3></a></li>
      <li role="presentation"><a href="customer_data.php"><h3>ข้อมูลลูกค้า</h3></a></li>
      <li role="presentation"><a href="product_data.php"><h3>ข้อมูลสินค้า</h3></a></li>
      <li role="presentation"><a href="master_data.php"><h3>ข้อมูลหลัก</h3></a></li>
      <li role="presentation"><a href="#"><h3>การส่งมอบสินค้า</h3></a></li>
      <li role="presentation"><a href="#"><h3>การกระจายคำสั่งซื้อ</h3></a></li>
      <li role="presentation"><a href="#"><h3>การรับสินค้าจากสวน</h3></a></li>
      <li role="presentation"><a href="#"><h3>การคัดแยกเกรด</h3></a></li>
      </ul>
     
    </form>
</section>

    </div>
  
    
    <script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>
