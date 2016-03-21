<?php
  session_start();
  include("connect.php");
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
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
	<title></title>

  <link rel="stylesheet" href="css/css1.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 

</head>
<body >
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
            <a class="navbar-brand"> <?php echo $date; ?>&nbsp;</a>
            <a class="navbar-brand" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $objResult["employee_name"];?></span></a>
            <li align="RIGHT" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
            <li><a href="employee_formupdate_changepass.php">เปลี่ยนรหัสผ่าน</a></li>
           
            <li><a href="logout.php">ออกจากระบบ</a></li>
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
	<a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>หน้าหลัก</a>
  /
  <a href="product_data.php">ข้อมูลสินค้า</a>
   
  </div>
</div>
<center><hr width="80%" ></center>
<div class="clearfix hidden-xs">
<div class="row">
  <div class="col-md-2">
    
  </div>
  <div class="col-md-7" style="font-size:2em;">
  
  <nav>
  <ul class="pager">
    <li><a href="product.php">สินค้า</a></li>
    <li><a href="product_company.php">สินค้าของบริษัท</a></li>
    <li><a href="product_garden.php">สินค้าของสวนเครือข่าย</a></li>
  </ul>
</nav>
<nav>

 
  </div>
</div>
	</div> 
  <div class="clearfix visible-xs hidden-md hidden-lg">

        <section class="login">
  <div class="titulo"><pre>       ข้อมูลสินค้า   </pre></div>
  <form >
    <ul class="nav nav-pills nav-stacked">
      <li role="presentation"><a href="product.php"><FONT COLOR='#23527c'><h3>สินค้า</h3></FONT></a></li>
      <li role="presentation"><a href="product_company.php"><FONT COLOR='#23527c'><h3>สินค้าบริษัท</h3></FONT></a></li>
      <li role="presentation"><a href="product_garden.php"><FONT COLOR='#23527c'><h3>สินค้าสวนเครือข่าย</h3></FONT></a></li>

      </ul>
     
    </form>
</section>

    </div>

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>