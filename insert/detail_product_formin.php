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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<title></title>
 <link rel="stylesheet" href="../css/table.css">
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
            <a align="RIGHT" class="navbar-brand"> <?php echo $date; ?>&nbsp;</a>
            <a class="navbar-brand" ><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<?php echo $objResult["employee_name"];?></span></a>
              

            <li align="RIGHT" class="dropdown">
            <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span class="caret"></span></a>
              <ul class="dropdown-menu">
            <li><a href="../employee_formupdate_changepass.php">เปลี่ยนรหัสผ่าน</a></li>
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
  <a href="../product_data.php">ข้อมูลสินค้า</a>
   / 
   <a href="../product.php">สินค้า</a>
   / 
    <a href="../detail_product.php?id=<?php echo $_GET['id']?>">รายละเอียดสินค้า(เพิ่มข้อมูล)</a>
    
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
 die('Could not find database called produce: '. mysql_error());
 }

 $test_id = "select MAX(SUBSTRING(detail_product_id,4)) as num FROM detail_product";
 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
 $rows = mysql_fetch_array($tmp);
 if($rows){
  $num = $rows['num'];
    if($num==Null){
    $num = 0;
  }

    $test_id = $num+1;
    if($test_id < 10){
     $produce_id = "DP000".$test_id;

        }
      elseif ($test_id < 100) {
        $produce_id = "DP00".$test_id;
      }
      elseif ($test_id < 1000) {
        $produce_id = "DP0".$test_id;
      }
      elseif ($test_id < 10000) {
        $produce_id = "DP".$test_id;
      }

  }

?>


<div class="clearfix hidden-xs">
    <form method="post" action="detail_product_in.php">
      <div class="table-responsive">
<table >
  <tr >
  <td style="width:250px"><div class="col-md-9 col-md-push-5">รหัสสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="produce_id" readonly="readonly" style="width:200px" value="<?php echo $produce_id;?>">
</div>
</td>
</tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <?php
     $sql = "select product_id,product_name from product WHERE product_id = '".$_GET['id']."'";
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     while($i<$num_rows){
     $data = mysql_fetch_array($result);
       $product_id = $data[1];
       $product_name = $data[0];
    $i++;

    }
 ?>
  <input type='hidden' name='product_name' value="<?php echo $product_name;?>">
  <input type="text" text-align="center" readonly="readonly" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"  style="width:200px" value="<?php echo $product_id;?>">
</div>
  </td>
    </tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">สี</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">
    <select class="form-control" name="color_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
  <?php
     $sql = "select color_id,color_name from color ";
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     echo "<option value=''>คลิกเลือกสี</option>";
     while($i<$num_rows){
     $data = mysql_fetch_array($result);

     for($j=1; $j<$num_fields; $j++){

    echo "<option value='$data[0]'>$data[$j]</option>";

     }

     $i++; 
    }
 ?>
</select>
</div>
  <div class="col-xs-6 col-md-4">
<a class="current" href="color_formin2.php"><span class="glyphicon glyphicon-plus"></span>เพิ่มสี</a>
  </div>
  </td>
    </tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ขนาด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">
    <select class="form-control" name="size_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
  <?php
     $sql = "select size_id,size_name from size";
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     echo "<option value=''>คลิกเลือกขนาด</option>";
     while($i<$num_rows){
     $data = mysql_fetch_array($result);

     for($j=1; $j<$num_fields; $j++){

    echo "<option value='$data[0]'>$data[$j]</option>";

     }

     $i++; 
    }
 ?>
</select>
</div>
  <div class="col-xs-6 col-md-4">
<a class="current" href="size_formin2.php"><span class="glyphicon glyphicon-plus"></span>เพิ่มขนาด</a>
  </div>
  </td>
    </tr>



    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">หน่วยนับ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">

    <select class="form-control" name="unit_measure_id" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
    <?php
         $sql = "select unit_measure_id,unit_measure_name from unit_measure ";
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;
         echo "<option value=''>คลิกเลือกหน่วยนับ</option>";
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
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ราคา/หน่วย(บาท)</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <script language="JavaScript">
      function chkNum(ele)
      {
        var num = parseFloat(ele.value);
        ele.value = num.toFixed(2); 
        }
</script>
  <input type="text" style="text-align: right;width: 200px;" class="form-control" placeholder="0.00" OnChange="JavaScript:chkNum(this)" aria-describedby="sizing-addon2" name="price_unit"  onKeyUp="var regExp = /^[0-9,'.']*$/;if(!regExp.test(this.value)){this.value = '';}" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>

  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='detail_product_check.php?id=<?php echo $_GET['id']?>'"></td></div>
</div>

    
  </tr>
  </table>
  
</div>
</form>
</div>

    <div class="clearfix visible-xs hidden-md hidden-lg">
     <form method="post" action="detail_product_in.php">
          <div class="table-responsive">
    <table style="width:90%">
      <tr >
      <td > 
          <div class="input-group">
      <div class="col-md-9 col-md-push-5">รหัสสินค้า<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
      <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="produce_id" readonly="readonly" style="width:230px" value="<?php echo $produce_id;?>">
    </div></div>
    </td>
    </tr>

      <tr>
      <td >
    <div class="input-group">
      <div class="col-md-9 col-md-push-5">ชื่อสินค้า<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
      <?php
         $sql = "select product_id,product_name from product WHERE product_id = '".$_GET['id']."'";
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;
         while($i<$num_rows){
         $data = mysql_fetch_array($result);
           $product_id = $data[1];
           $product_name = $data[0];
        $i++;

        }
     ?>
      <input type='hidden' name='product_name' value="<?php echo $product_name;?>">
      <input type="text" text-align="center" readonly="readonly" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"  style="width:230px" value="<?php echo $product_id;?>">
    </div></div>
      </td>
        </tr>

      <tr>
      <td>
        <div class="input-group">
      <div class="col-md-9 col-md-push-5">สี<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
        <select class="form-control" name="color_id" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
      <?php
         $sql = "select color_id,color_name from color ";
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;
         echo "<option value=''>คลิกเลือกสี</option>";
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
      <div class="col-md-9 col-md-push-5">ขนาด<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
        <select class="form-control" name="size_id" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
      <?php
         $sql = "select size_id,size_name from size";
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;
         echo "<option value=''>คลิกเลือกขนาด</option>";
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
      <div class="col-md-9 col-md-push-5">หน่วยนับ<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
        <select class="form-control" name="unit_measure_id" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
        <?php
             $sql = "select unit_measure_id,unit_measure_name from unit_measure ";
             $result = mysql_query($sql);
             $num_rows = mysql_num_rows($result);
             $num_fields = mysql_num_fields($result);
             $i = 0;
             echo "<option value=''>คลิกเลือกหน่วยนับ</option>";
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
      <td >
     <div class="input-group">
      <div class="col-md-9 col-md-push-5">ราคา/หน่วย(บาท)<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
      <script language="JavaScript">
          function chkNum(ele)
          {
            var num = parseFloat(ele.value);
            ele.value = num.toFixed(2); 
            }
    </script>
      <input type="text" style="text-align: right;width: 230px;" class="form-control" placeholder="0.00" OnChange="JavaScript:chkNum(this)" aria-describedby="sizing-addon2" name="price_unit"  onKeyUp="var regExp = /^[0-9,'.']*$/;if(!regExp.test(this.value)){this.value = '';}" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required>
    </div></div>
      </td>
        </tr>

      <tr>
      <td >
      <center><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../detail_product.php?id=<?php echo $_GET['id']?>'"></td></center>
    

        
      </tr>
      </table>
      
    </div>
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