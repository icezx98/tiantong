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
<html ng-app="product">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
  <title></title>
 <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/css1.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
 <script type="text/javascript" src="../angular.min.js"></script>
 <script type="text/javascript" src="../js/moment.js"></script>
  <script type="text/javascript" src="../js/location.js"></script>

</head>
<body ng-controller='productController'>
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
  <a href="../product_data.php">ข้อมูลสินค้า</a>
   / 
    <a href="../product_company.php">สินค้าของบริษัท(เพิ่มข้อมูล)</a>
    
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
 die('Could not find database called product_company: '. mysql_error());
 }

 $test_id = "select MAX(SUBSTRING(product_company_id,3)) as num FROM product_company";
 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
 $rows = mysql_fetch_array($tmp);
 if($rows){
  $num = $rows['num'];
    if($num==Null){
    $num = 0;
  }

    $test_id = $num+1;
    if($test_id < 10){
     $product_company_id = "PC00".$test_id;

        }
      elseif ($test_id < 100) {
        $product_company_id = "PC0".$test_id;
      }
      elseif ($test_id < 1000) {
        $product_company_id = "PC".$test_id;
      }

  }

?>


 <div class="clearfix hidden-xs">
    <form method="post" action="product_company_in.php">
            <input type='hidden' name='produce_id' value='{{id}}'>

<table >
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-4">รหัสสินค้าของบริษัท</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="product_company_id" readonly="readonly" style="width:200px" value="<?php echo $product_company_id;?>">
</div>
</td>
</tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ชื่อสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td>

                        
                            <select  class="form-control" ng-model="productSelect" ng-change="getColor(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสินค้า</option>
                                <option value="{{$index}}" ng-model="productSelect" ng-repeat="data in product"> {{data[1]}} </option>
                            </select>
                        
              

  </td>
    </tr>
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">สี</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">

     <select  class="form-control" ng-model="colorSelect" ng-change="getSize(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสี</option>
                                <option value="{{$index}}" ng-model="colorSelect" ng-repeat="data in color"> {{data[1]}} </option>
                            </select>
</div>

  </td>
    </tr>

<tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ขนาด</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>
    <div class="row">
  <div class="col-xs-10 col-sm-3 col-md-5">

    <select  class="form-control" ng-model="sizeSelect" ng-change="getUnit(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกขนาด</option>
                                <option value="{{$index}}" ng-model="sizeSelect" ng-repeat="data in size"> {{data[1]}} </option>
                            </select>
  
</div>

  </td>
    </tr>



    <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">หน่วยนับ</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">

    <select  class="form-control" ng-model="unitSelect" ng-change="getId(true)" style="width:227px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="" selected>คลิกเลือกหน่วยนับ</option>
                                <option value="{{$index}}" ng-model="unitSelect" ng-repeat="data in unit"> {{data[1]}} </option>
                            </select>
  </td>
    </tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ชื่อบริษัท</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

  <td>

    <select class="form-control" name="company_id" style="width:227px">
    <?php
      $sql = "select company_id,company_name from company";
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;
        echo "<option>คลิกเลือกบริษัท</option>";

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
  <td style="width:200px"><div class="col-md-9 col-md-push-4">ราคา/หน่วย(บาท)</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>

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
  <input type="text" onKeyUp="var regExp = /^[0-9,'.']*$/;if(!regExp.test(this.value)){this.value = '';}"  style="text-align: right;width: 200px;" class="form-control" placeholder="0.00" aria-describedby="sizing-addon2" name="price_unit" style="width:200px" OnChange="JavaScript:chkNum(this)" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>
   
  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../product_company.php'"></td></div>
</div>

    
  </tr>
  </table>
    </form>
    </div>

  <div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="product_company_in.php">
            <input type='hidden' name='produce_id' value='{{id}}'>

<table style="width:90%">
  <tr >
  <td > 
      <div class="input-group">
  <div class="col-md-9 col-md-push-4">รหัสสินค้าของบริษัท<b>*</b></div>
  <div class="col-md-9 col-md-push-4">
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="product_company_id" readonly="readonly" style="width:230px" value="<?php echo $product_company_id;?>">
  </div></div>
</td>
</tr>

  <tr>
 <td>

                        <div class="input-group">
  <div class="col-md-9 col-md-push-4">ชื่อสินค้า<b>*</b></div>
  <div class="col-md-9 col-md-push-4">
                            <select  class="form-control" ng-model="productSelect" ng-change="getColor(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสินค้า</option>
                                <option value="{{$index}}" ng-model="productSelect" ng-repeat="data in product"> {{data[1]}} </option>
                            </select>
                        </div>
              

  </td>
    </tr>
  <tr>
  <td>
    <div class="input-group">
  <div class="col-md-9 col-md-push-4">สี<b>*</b></div>
  <div class="col-md-9 col-md-push-4">

     <select  class="form-control" ng-model="colorSelect" ng-change="getSize(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกสี</option>
                                <option value="{{$index}}" ng-model="colorSelect" ng-repeat="data in color"> {{data[1]}} </option>
                            </select>
</div>

  </td>
    </tr>

<tr>
  <td>
    <div class="input-group">
  <div class="col-md-9 col-md-push-4">ขนาด<b>*</b></div>
  <div class="col-md-9 col-md-push-4">

    <select  class="form-control" ng-model="sizeSelect" ng-change="getUnit(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="">คลิกเลือกขนาด</option>
                                <option value="{{$index}}" ng-model="sizeSelect" ng-repeat="data in size"> {{data[1]}} </option>
                            </select>
  
</div>

  </td>
    </tr>



    <tr>
  <td style="width:200px">
  <div class="input-group">
  <div class="col-md-9 col-md-push-4">หน่วยนับ<b>*</b></div>
  <div class="col-md-9 col-md-push-4">
    <select  class="form-control" ng-model="unitSelect" ng-change="getId(true)" style="width:230px" oninvalid="setCustomValidity('กรุณาเลือกข้อมูล')" oninput="setCustomValidity('')" required>
                                <option value="" selected>คลิกเลือกหน่วยนับ</option>
                                <option value="{{$index}}" ng-model="unitSelect" ng-repeat="data in unit"> {{data[1]}} </option>
                            </select>
      </div>
  </td>
    </tr>

  <tr>
  <td>
  <div class="input-group">
  <div class="col-md-9 col-md-push-4">ชื่อบริษัท<b>*</b></div>
  <div class="col-md-9 col-md-push-4">
    <select class="form-control" name="company_id" style="width:230px">
    <?php
      $sql = "select company_id,company_name from company";
      $result = mysql_query($sql);
      $num_rows = mysql_num_rows($result);
      $num_fields = mysql_num_fields($result);
        $i = 0;
        echo "<option>คลิกเลือกบริษัท</option>";

      while($i<$num_rows){
      $data = mysql_fetch_array($result);

      for($j=1; $j<$num_fields; $j++){

          echo "<option value='$data[0]'>$data[$j]</option>";


      }

          $i++; 
        }
 ?>
  

</select></div>
  </td>
    </tr>

<tr>
 <td >
    <div class="input-group">
  <div class="col-md-9 col-md-push-4">ราคา/หน่วย(บาท)<b>*</b></div>
  <div class="col-md-9 col-md-push-4">
  <script language="JavaScript">
      function chkNum(ele)
      {
        var num = parseFloat(ele.value);
        ele.value = num.toFixed(2); 
        }

</script>
  <input type="text" onKeyUp="var regExp = /^[0-9,'.']*$/;if(!regExp.test(this.value)){this.value = '';}"  style="text-align: right;width: 230px;" class="form-control" placeholder="0.00" aria-describedby="sizing-addon2" name="price_unit" style="width:200px" OnChange="JavaScript:chkNum(this)" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')" required>
</div>
  </td>
    </tr>
   
  <tr>

  <td >
  <center><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../product_company.php'"></td>
</center>

    
  </tr>
  </table>
    </form>
    </div>


<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
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

<div id="startDate">
<script type="text/javascript">

$(function(){
  $("#dateInput").datepicker({
    dateFormat: 'yy/mm/dd'
  });
});

</script>
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("../im/BG.jpg", {speed: 100});
    </script>

</div>
  </body> 
</html>
