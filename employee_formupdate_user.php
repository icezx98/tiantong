<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
  if($_SESSION['username'] == "")
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
<link href="css/bootstrap.min.css" rel="stylesheet">
	<title></title>
 <link rel="stylesheet" href="css/table.css">
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
            <a align="RIGHT" class="navbar-brand"> <?php echo $date; ?>&nbsp;</a>
            <a class="navbar-brand" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $objResult["employee_name"];?></span></a>
              

            <li align="RIGHT" class="dropdown">
            <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
            <li ><a href="employee_formupdate_changepass.php" >เปลี่ยนรหัสผ่าน</a></li>
            <li><a href="#"></a></li>
           
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
	<a href="master_data.php">ข้อมูลหลัก</a>
	/ 
  <a href="employee.php">ข้อมูลพนักงาน</a>
    
  </div>
  <div class="col-md-3">
	

  </div>
</div>
<hr width="80%">

<?php
 include("connect.php");
 $db = "tiantongorchid";
  $tb = "employee";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called employee: '. mysql_error());
 }
 // echo $objResult["employee_name"];
$sql = "select * from employee where employee_id = '".$objResult["employee_id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $employee_id="";
 $employee_name="";
 $employee_tel="";
 $user_manage="";
 $username="";
 $password="";

 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $employee_id=$data[0];
 $employee_name=$data[1];
 $employee_tel=$data[2];
 $user_manage=$data[3];
 $username=$data[4];
 $password=$data[5];
 $i++;
 }
?>



<div class="clearfix hidden-xs">
    <form method="post" action="employee_update.php">
<center><table >
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสพนักงาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee_id" readonly="readonly" style="width:200px" value="<?php echo$employee_id;?>">
</div>
</td>
</tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อพนักงาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="employee_name" readonly="readonly" style="width:200px" value="<?php echo$employee_name;?>">
</div>
  </td>
    </tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">เบอร์โทรศัพท์</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="employee_tel" readonly="readonly" style="width:200px" value="<?php echo$employee_tel;?>">
</div>
  </td>
    </tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">สิทธิ์การเข้าใช้งาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" text-align="center" class="form-control" readonly="readonly" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="user_manage" style="width:200px" value="<?php echo$user_manage;?>">
</div>
  </td>
    </tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อผู้ใช้งาน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" text-align="center" class="form-control" readonly="readonly" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="username" style="width:200px" value="<?php echo$username;?>">
</div>
  </td>
    </tr>

<!-- <tr>
  <td style="width:200px">รหัสผ่าน</td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="password" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="password" style="width:200px" value="<?=$password?>">
</div>
  </td>
    </tr> -->

  <tr>
  <td></td>
  <td><div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" ONCLICK="window.location.href='master_data.php'" style="width:80px"></td></div>
</div></td>
  </tr>
  </table>
  
</center>
</form>
</div>


    <div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="employee_update.php">
<center><table >
  <tr >
  <td >
<div class="input-group">
          <div class="col-md-9 col-md-push-5">รหัสพนักงาน<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="employee_id" readonly="readonly" style="width:230px" value="<?php echo$employee_id;?>">
</div></div>
</td>
</tr>

  <tr>
 <td >
<div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อพนักงาน<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="employee_name" readonly="readonly" style="width:230px" value="<?php echo$employee_name;?>">
</div></div>
  </td>
    </tr>

  <tr>
  <td >
<div class="input-group">
          <div class="col-md-9 col-md-push-5">เบอร์โทรศัพท์<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="employee_tel" readonly="readonly" style="width:230px" value="<?php echo$employee_tel;?>">
</div></div>
  </td>
    </tr>

<tr>
  <td >
<div class="input-group">
          <div class="col-md-9 col-md-push-5">สิทธิ์การเข้าใช้งาน<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" text-align="center" class="form-control" readonly="readonly" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="user_manage" style="width:230px" value="<?php echo$user_manage;?>">
</div></div>
  </td>
    </tr>

<tr>
  <td >
<div class="input-group">
          <div class="col-md-9 col-md-push-5">ชื่อผู้ใช้งาน<b>*</b></div>
          <div class="col-md-9 col-md-push-5">
  <input type="text" text-align="center" class="form-control" readonly="readonly" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="username" style="width:230px" value="<?php echo$username;?>">
</div></div>
  </td>
    </tr>

<!-- <tr>
  <td style="width:200px">รหัสผ่าน</td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="password" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="password" style="width:200px" value="<?=$password?>">
</div>
  </td>
    </tr> -->

  <tr>
  <td>
  <center><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" ONCLICK="window.location.href='master_data.php'" style="width:80px"></td></center>
/td>
  </tr>
  </table>
  
</center>
</form>
</div>



	

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
 <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>