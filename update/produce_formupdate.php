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

<?php
 include("../connect.php");
 $db = "tiantongorchid";
  $tb = "produce";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called produce: '. mysql_error());
 }
$sql = "select * from detail_product where detail_product_id = '".$_GET["id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $produce_id="";
 $product_id="";
 $color_id="";
 $size_id="";
 $unit_measure_id="";
 $produce_unit="";


 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $produce_id=$data[0];
 $product_id=$data[1];
 $color_id=$data[2];
 $size_id=$data[3];
 $unit_measure_id=$data[4];
 $produce_unit=$data[5];

 $i++;
 }

?>

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
    <a href="../detail_product.php?id=<?php echo $product_id ?>">รายละเอียดสินค้า(แก้ไขข้อมูล)</a>
    
  </div>
  <div class="col-md-3">
  

  </div>
</div>
<hr width="80%">




<div class="clearfix hidden-xs">
    <form method="post" action="produce_update.php">
  
<center><table>
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="produce_id" readonly="readonly" style="width:200px" value="<?php echo $produce_id;?>">
</div>
</td>
</tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
<?php
     $sql = "select product_id,product_name from product WHERE product_id = '".$product_id."'";
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     while($i<$num_rows){
     $data = mysql_fetch_array($result);
       $product = $data[1];
       $product_name = $data[0];
    $i++;

    }
 ?>
  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
   <input type='hidden' name='product_name' value="<?php echo $product_name;?>">
  <input type="text" readonly="readonly" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="product" style="width:200px" value="<?php echo$product;?>">
</div>
  </td>
    </tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">สี</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    
        <select class="form-control" name="i" style="width:227px" required> 
  <?php  
      $sql = "select color_id,color_name from color where color_id = '".$color_id."'  ";  
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     while($i<$num_rows){
     $data = mysql_fetch_array($result);
    
      echo "<option value='$data[0]'>$data[1]</option>";
      $i++;
     }
    

     $sql = "select color_id,color_name from color where color_id != '".$color_id."'  ";  
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
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
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ขนาด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">

    <select class="form-control" name="size_id" style="width:227px">
    <?php
         $sqls = "select size_id,size_name from size where size_id = '".$size_id."'  ";  
         $result = mysql_query($sqls);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

         while($i<$num_rows){
         $data = mysql_fetch_array($result);

        echo "<option value='$data[0]'>$data[1]</option>";

        $i++; 
        }

         $sql = "select size_id,size_name from size where size_id != '".$size_id."'  ";  
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

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
  <td style="width:200px"><div class="col-md-9 col-md-push-5">หน่วยนับ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">
   
    <select class="form-control" name="unit_measure_id" style="width:227px" value="<?=$unit_measure_id?>">
    <?php
         $sql = "select unit_measure_id,unit_measure_name from unit_measure where unit_measure_id = '".$unit_measure_id."'  "; 
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

         while($i<$num_rows){
         $data = mysql_fetch_array($result);
         echo "<option value='$data[0]'>$data[1]</option>";

        $i++; 
        }

         $sql = "select unit_measure_id,unit_measure_name from unit_measure where unit_measure_id != '".$unit_measure_id."'  "; 
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

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
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ราคา/หน่วย(บาท)</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

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
  <input type="text"  style="text-align: right;width: 200px;" class="form-control"  OnChange="JavaScript:chkNum(this)" aria-describedby="sizing-addon2" name="price_unit" style="width:200px" onKeyUp="var regExp = /^[0-9,'.']*$/;if(!regExp.test(this.value)){this.value = '';}" value="<?php echo number_format($produce_unit, 2, '.', ',');?>" >
</div>
  </td>
    </tr>

  <tr>
  <td></td>
  <td><div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../detail_product.php?id=<?php echo $product_id ?>'"></td></div>
</div></td>
  </tr>
  </table>
  
</center>
</form>
</div>


    <div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="produce_update.php">
  <table style="width:90%">
      <tr >
      <td > 
          <div class="input-group">
      <div class="col-md-9 col-md-push-5">รหัสสินค้า<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="produce_id" readonly="readonly" style="width:230px" value="<?php echo $produce_id;?>">
          </div>
      </div>
      </td>
      </tr>

  <tr>
 <?php
     $sql = "select product_id,product_name from product WHERE product_id = '".$product_id."'";
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     while($i<$num_rows){
     $data = mysql_fetch_array($result);
       $product = $data[1];
       $product_name = $data[0];
    $i++;

    }
 ?>
  <td>
  <div class="input-group">
      <div class="col-md-9 col-md-push-5">ชื่อสินค้า<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
   <input type='hidden' name='product_name' value="<?php echo $product_name;?>">
  <input type="text" readonly="readonly" text-align="center" class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2" name="product" style="width:230px" value="<?php echo$product;?>">
  </div></div>
  </td>
    </tr>

  <tr>
  <td>
    <div class="input-group">
      <div class="col-md-9 col-md-push-5">สี<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
        <select class="form-control" name="i" style="width:230px" required> 
  <?php  
      $sql = "select color_id,color_name from color where color_id = '".$color_id."'  ";  
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     while($i<$num_rows){
     $data = mysql_fetch_array($result);
    
      echo "<option value='$data[0]'>$data[1]</option>";
      $i++;
     }
    

     $sql = "select color_id,color_name from color where color_id != '".$color_id."'  ";  
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
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
      <div class="col-md-9 col-md-push-5">ขนาด<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
    <select class="form-control" name="size_id" style="width:230px">
    <?php
         $sqls = "select size_id,size_name from size where size_id = '".$size_id."'  ";  
         $result = mysql_query($sqls);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

         while($i<$num_rows){
         $data = mysql_fetch_array($result);

        echo "<option value='$data[0]'>$data[1]</option>";

        $i++; 
        }

         $sql = "select size_id,size_name from size where size_id != '".$size_id."'  ";  
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

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
      <div class="col-md-9 col-md-push-5">หน่วยนับ<b>*</b></div>
      <div class="col-md-9 col-md-push-5">
    <select class="form-control" name="unit_measure_id" style="width:230px" value="<?=$unit_measure_id?>">
    <?php
         $sql = "select unit_measure_id,unit_measure_name from unit_measure where unit_measure_id = '".$unit_measure_id."'  "; 
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

         while($i<$num_rows){
         $data = mysql_fetch_array($result);
         echo "<option value='$data[0]'>$data[1]</option>";

        $i++; 
        }

         $sql = "select unit_measure_id,unit_measure_name from unit_measure where unit_measure_id != '".$unit_measure_id."'  "; 
         $result = mysql_query($sql);
         $num_rows = mysql_num_rows($result);
         $num_fields = mysql_num_fields($result);
         $i = 0;

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
  <input type="text"  style="text-align: right;width: 230px;" class="form-control"  OnChange="JavaScript:chkNum(this)" aria-describedby="sizing-addon2" name="price_unit" style="width:200px" onKeyUp="var regExp = /^[0-9,'.']*$/;if(!regExp.test(this.value)){this.value = '';}" value="<?php echo number_format($produce_unit, 2, '.', ',');?>" >
</div></div>
  </td>
    </tr>

  <tr>

  <td>
  <center><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../detail_product.php?id=<?php echo $product_id ?>'"></td></center>
</td>
  </tr>
  </table>
  
</center>
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