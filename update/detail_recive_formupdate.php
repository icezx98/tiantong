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
  $employee_id = $objResult["employee_id"];
  $recive_id = $_GET['recive_id'];
  @$garden_id = $_SESSION["garden_id"];
  // $garden = $_SESSION['garden_id'];
  // var_dump($garden_id)
?>
<!DOCTYPE html>
<html ng-app='unit_select' >
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
	<title></title>
 <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/css1.css">
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
 <script type="text/javascript" src="../angular.min.js"></script>
  <script type="text/javascript" src="../js/unit_select.js"></script>

</head>
<body ng-controller='unit_selectcontroller'>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
            <img class="img" src="../im/Thiantong.png"  >
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
	  <a href="../recive.php">รับสินค้า</a>
	 /
    <?php
      echo "<a href=\"../detail_recive.php?recive_id=$recive_id\">รายละเอียดการรับสินค้า(แก้ไขข้อมูล)</a>"; 
    ?>
    
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
 die('Could not find database called unit_measure: '. mysql_error());
 }

 $sql = "select * from detail_recive where detail_recive_id = '".$_GET["recive_id"]."'" ;
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 $detail_recive_id="";
 $recive_id="";
 $product_id="";
 $amount="";
 $price_unit="";
 // $orders_due_date="";
 // $status="";


 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 $detail_recive_id=$data[0];
 $recive_id=$data[1];
 $product_id=$data[2];
 $amount=$data[3];
 $price_unit=$data[4];
 // $status=$data[6];
 $i++;
 }
 if ($detail_recive_id == "") {
   $detail_recive_id = $_GET["detail_recive_id"];
 }
 if ($recive_id == "") {
   $recive_id = $_GET["recive_id"];
 }
 // echo $garden_network_id;
?>



  <div class="clearfix hidden-xs">
    <form method="post" action="detail_recive_update.php">
<table >
  <tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสรายละเอียดการรับสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="de_recive_id" readonly="readonly" style="width:200px" value="<?php echo $detail_recive_id;?>">
</div>
</td>
</tr>

<tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">รหัสการรับสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="recive_id" readonly="readonly" style="width:200px" required value="<?php echo $recive_id;?>">
</div>
</td>
</tr>

  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ชื่อสินค้า</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  
  <td>
    <select ng-model="non" ng-change="fun()" class="form-control" name="product_id" style="width:227px" required> 
    <option value='{{datas.first[0][0]}}'>{{datas.first[0][1]}}</option>
    <option ng-repeat="data in datas.other" value='{{data[0]}}'>{{data[1]}}</option>
        
 <!--  <?php  
      $sql = "select product_garden.product_garden_id, product.product_name
            from product, detail_product, product_garden, detail_spread_product, detail_recive
            where detail_recive.detail_recive_id = '".$detail_recive_id."'
            and detail_recive.product_id = product_garden.product_garden_id
            and product_garden.product_garden_id = detail_spread_product.product_garden_id  
            and product_garden.detail_product_id = detail_product.detail_product_id 
            and detail_product.product_id = product.product_id
            group by product.product_name";  
     $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;
     while($i<$num_rows){

     $data = mysql_fetch_array($result);

    echo "<select ng-init = \"non = 'test'\" ng-model=\"non\" ng-change=\"fun()\" class=\"form-control\" name=\"product_id\" style=\"width:227px\" required> ";
      
      echo "<option value='$[0]'>$data[1]</option>";
      $i++;
     }
    

     $sql = "select product_garden.product_garden_id, product.product_name
            from product, detail_product, product_garden, detail_spread_product, detail_recive
            where detail_recive.detail_recive_id != '".$detail_recive_id."'
            and detail_recive.product_id = product_garden.product_garden_id
            and product_garden.product_garden_id = detail_spread_product.product_garden_id  
            and product_garden.detail_product_id = detail_product.detail_product_id 
            and detail_product.product_id = product.product_id
            group by product.product_name";  
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
 ?> -->
    </select>
  </td>
    </tr>

<tr >
  <td style="width:200px"><div class="col-md-9 col-md-push-5">จำนวน</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px"> 
      <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="amount" style="width:200px" value="<?php echo $amount;?>">
</div>
</td>
</tr>
  
  <tr>
  <td style="width:200px"><div class="col-md-9 col-md-push-5">ราคาต่อหน่วย</div><div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div></td>
  <td style="width:200px">
<div class="input-group">
  <span class="input-group-addon" id="sizing-addon2"></span>
  <input type="text" ng-model="result" class="form-control" placeholder="กรอกข้อมูล"  aria-describedby="sizing-addon2" name="price" readonly="readonly" style="width:200px" >

</div> 

  </td>
    </tr>

  <tr>
  <td></td>
  <td >
<div class="row">
  <div class="col-xs-10 col-sm-4 col-md-6"></div>
  <div class="col-xs-8 col-md-6"><input type="submit" value="แก้ไข" style="width:80px">&nbsp;<input type="reset" value="ยกเลิก" style="width:80px" ONCLICK="window.location.href='../detail_recive.php?recive_id=<?php echo $recive_id;?>'"></td></div>
</div>

    
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
</html>