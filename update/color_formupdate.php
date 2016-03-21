<?php
  session_start();
  include("../connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called color: '. mysql_error());
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
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
  <title></title>
 <link rel="stylesheet" href="../css/table2.css">
  <link rel="stylesheet" href="../css/css1.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 

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
  <a href="../master_data.php">ข้อมูลหลัก</a>
  /
    <a href="../color_index.php">ข้อมูลสี(แก้ไขข้อมูล)</a>
    
  </div>
  <div class="col-md-3">
  

  </div>
</div>
<hr width="80%">
<?php
 include("../connect.php");
 $db = "tiantongorchid";
 $tb = "color";
 $result = mysql_select_db($db);
  if(!$result){
 die('Could not find database called color: '. mysql_error());
 }
 $sql = "select * from color where color_id = '".$_GET["id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $color_id="";
 $color_name="";
 

 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $color_id=$data[0];
 $color_name=$data[1];
 $i++;
 }
?>
 
<div class="clearfix hidden-xs">
 <form method="post" action="color_update.php">

<table>
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสสี</div><div class="col-md-1 col-md-push-1"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
	<td style="width:200px"> 
			<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" name="color_id" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"  style="width:200px" readonly="readonly" maxlength="10" value="<?php echo $color_id;?>" >
</div>
</tr>
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสี</div><div class="col-md-1 col-md-push-1"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
	<td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" name="color_name" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"  style="width:200px" maxlength="30"value="<?php echo $color_name;?>" >
</div>

	</td>
    </tr>
  <tr>
	<td></td>
	<td><div class="row">
  <div class="col-xs-10 col-sm-4 col-md-5"></div>
  <div class="col-xs-1 col-md-7"><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="button" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../color_index.php'"></td></div>
</div></td>
  </tr>
  </table>
 </form>
 </div>

   <div class="clearfix visible-xs hidden-md hidden-lg">
 <form method="post" action="color_update.php">
<table style="width:90%">
  <tr>
  <td> 
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสสี<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" name="color_id" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"  style="width:230px" readonly="readonly" maxlength="10" value="<?php echo $color_id;?>" >
</div></div>
</tr>
  <tr>
  <td > 
      <div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อสี<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" name="color_name" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"  style="width:230px" maxlength="30"value="<?php echo $color_name;?>" >
</div></div>

  </td>
    </tr>
  <tr>
  <td>
  <center><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="button" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../color_index.php'"></td></center>
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
</center>
</html>