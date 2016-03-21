
<!DOCTYPE html>
<html ng-app>
  <head>
    <meta charset="utf-8" />  
    <script type="text/javascript" src="angular.min.js"></script>
    <title>My Learn AngularJs 1</title> 
  </head>
  <body>
    <div>
      <label>Name:</label>
      <input type="text" ng-model="yourName" placeholder="Enter a name here">
      <hr>
      <h1>Hello {{yourName}}!</h1>
    </div>
    
  </body>

<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
<style type="text/css">
  .link:hover{
    cursor:pointer;
  }
</style>
<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
  if(empty($_SESSION['username']))
  {
    // echo "Please Login!";
    // echo sweetAlert("Oops...", "Something went wrong!", "error");
    // echo "<script>weed('fff')</script>"
    // echo "<script> swal('5555','error') </script>";
    // echo "<script> swal('Please Login!'); </script>";
     echo "<script> location='login.php'; </script>";
    exit();
  }

  $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
  $o = $_GET['id'];
   $employee_id = $objResult["employee_id"];
  $companyId = $_GET['companyId'];
  $customerId = $_GET['customerId'];
    if (isset($_POST['submit']))
           {
             
              $value = implode(' ', $_POST['checkorder']);
              $checkorder = $_POST['checkorder'];
              $values = array();
              for($n = 0 ; $n<sizeof($checkorder);$n++){
                array_push($values,explode(',', $checkorder[$n]));
                
              }
    
              for ($i=0; $i < sizeof($values) ; $i++) {

                 $test_id = "select MAX(SUBSTRING(spread_id,4)) as num FROM spread_order";
                 $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
                 $rows = mysql_fetch_array($tmp);
                 if($rows){
                  $num = $rows['num'];
                    if($num==Null){
                    $num = 0;
                  }

                    $test_id = $num+1;
                    if($test_id < 10){
                     $spread_id = "SP000".$test_id;

                        }
                      elseif ($test_id < 100) {
                        $spread_id = "SP00".$test_id;
                      }
                      elseif ($test_id < 1000) {
                        $spread_id = "SP0".$test_id;
                      }
                      elseif ($test_id < 10000) {
                        $spread_id = "PSP".$test_id;
                      }
                  
                }
                $null = "";
                $spread_date = date('Y-m-d', strtotime($values[$i][2]));
                $spread_due_date = join('-',array_reverse(explode('/',$values[$i][3])));
                //var_dump($spread_date1);
              
                $nutyed = "insert into `tiantongorchid`.`spread_order` 
                (`spread_id`, `spread_date`, `spread_due_date`, `employee_id`, `orders_id`, `recive_id`) 
                values('".$spread_id."','".$spread_date."','".$spread_due_date."','".$employee_id."','".$values[$i][0]."','".$null."')";
                $spread_idss[$i] = $spread_id;
                $result = mysql_query($nutyed);

                if(!$result){
                 die('Insert not success !!!: '. mysql_error());
                }
              }  
            }   
?>
<!DOCTYPE html>
<html ng-app="spreas">
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
<link href="dist/simple-hint.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/table.css"> 
<link rel="stylesheet" href="css/css1.css">
<script type="text/javascript" src="angular.min.js"></script>
         <script type="text/javascript" src="js/detail_spread_order.js"></script>

<!-- <script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css"> -->
 <meta http-equiv="content-type" content="text/html; charset=utf-8"> 
</head>
<body ng-controller="spreascontroller">
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
 
  </div>
  <div class="col-md-3">
  
 
  </div>
</div>
<center><hr width="80%"></center>

<div>

<center>

<form method="post" action="insert/detail_spread_order_formin.php" ng-controller="orderController">
  <div class="table-responsive">
<table id="example">
        <thead>
 <tr>
  <th width="150"><pre>   </pre></th>
 <th width="300"><pre>รหัสรายละเอียด<br>การรับคำสั่งซื้อ</pre></th>
 <th width="200"><pre>รหัสการรับ<br>คำสั่งซื้อ</pre></th>
 <th width="300"><pre>   ชื่อสินค้า   </pre></th>
 <th width="150"><pre>สี</pre></th>
 <th width="100"><pre>ขนาด</pre></th>
  <th width="100"><pre>หน่วยนับ</pre></th>
  <th width="150"><pre>จำนวนที่<br>สั่งซื้อ</pre></th>
  <th width="150"><pre>   </pre></th>
  <th width="150"><pre>   </pre></th>
  <th width="150"><pre>   </pre></th>
 


 </tr></thead>
<?php

           
 
      
    $checkorder = $_POST['checkorder'];
    $values = array();
    for($n = 0 ; $n<sizeof($checkorder);$n++){
      array_push($values,explode(',', $checkorder[$n]));
      
    }
    $counter = 0;
    for ($i=0; $i < sizeof($values) ; $i++) { 
      
     
    $sql = "select d.detail_orders_id, d.orders_id, p.product_name, c.color_name, s.size_name, u.unit_measure_name,d.number_orders, p.product_id, c.color_id, s.size_id, u.unit_measure_id
     FROM detail_product dp,product p,color c, size s, unit_measure u, detail_orders d 
     WHERE d.detail_product_id = dp.detail_product_id  and dp.product_id = p.product_id 
     and dp.color_id = c.color_id and dp.size_id = s.size_id and dp.unit_measure_id = u.unit_measure_id 
     and d.orders_id IN('".reset($values[$i])."')";

   $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $ii = 0;

 while($ii<$num_rows){
 $data = mysql_fetch_array($result);
 if($spread_ids[$data[1]] == null){
    $spread_ids[$data[1]] = array();
  }
 array_push($spread_ids[$data[1]], $spread_idss[$counter]);
 echo "<tr align=\"center\">";
 echo "<td class='td'></td>";
 
   echo "<td>$data[0]</td>";
     echo "<td >&nbsp;$data[1]</td>";
     echo "<td align='left'>&nbsp;$data[2]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[3]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[4]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[5]</td>";
     echo "<td class='td' align='right'>$data[6]&nbsp;&nbsp;&nbsp;&nbsp;</td>";
     echo "<td  ><input type='text' class='form-control' placeholder='จำนวน'  aria-describedby='sizing-addon2' name='number[]' style='width:100px' ng-model='qty[$ii]' ng-change='checkQty($data[6],qty[$ii])'></td>";
     echo "<td class='td'><select class='form-control' name='garden_network[]' style='width:150px' oninvalid='setCustomValidity('กรุณากรอกข้อมูล')' oninput='setCustomValidity('')' required >";
    
             $sql1 = "select garden_network.garden_network_id , garden_network.garden_network_name, product_garden.product_garden_id from product_garden , garden_network , detail_product WHERE detail_product.product_id = '$data[7]' AND detail_product.color_id = '$data[8]' and detail_product.size_id = '$data[9]' and detail_product.unit_measure_id = '$data[10]'
      and detail_product.detail_product_id = product_garden.detail_product_id and product_garden.garden_network_id = garden_network.garden_network_id";
             

             $result1 = mysql_query($sql1);
             $num_rows1 = mysql_num_rows($result1);
             $n = 0;
             echo "<option value=''>คลิกเลือกสวนเครือข่าย</option>";

             while($n<$num_rows1){
             $data1 = mysql_fetch_array($result1);
                 echo '<option value='.$data1[0].'>'.$data1[1].'</option>';
                 echo "<input type='hidden' name='p_g_id[]' value='$data1[2]'>";
                 echo "<input type='hidden' name='color_id[]' value='$data[8]'>";
                 echo "<input type='hidden' name='size_id[]' value='$data[9]'>";
                 echo "<input type='hidden' name='unit_id[]' value='$data[10]'>";
                 echo "<input type='hidden' name='amount[]' value='$data[6]'";
             $n++; 
            }

      echo  "</select> </td>";
       echo "<td class='td'><label><input type='checkbox' name='more' onclick='rowAdd(more)'></label></td>";
 echo "</tr>";
 $ii++;

  }
   $counter++;
 }
          $_SESSION['spread_ids'] = $spread_ids;
              //var_dump($spread_ids);

?>
</table>
</div>
 <input type="submit" name="submit" value="เพิ่ม" style="width:80px">

</form>

</center>
</div>
<script src="js/jquery-2.1.4.min.js"></script>

    <script type="text/javascript" src="js/dataTables.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      jQuery(document).ready(function() {
        jQuery('#example').DataTable();
      } );
    </script>
    <script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
    <script type="text/javascript">
    function rowAdd(param){
      console.log(param.value) 
    }
    </script>
</body>
>>>>>>> 06e63a269907ef34365f427e01ea7d17b406ac2a
</html>