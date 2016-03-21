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
              $checkorder = $_POST['checkorder'];
              $date = $_POST['date'];
              $values = array();
              $values1 = array();
              for($n = 0 ; $n<sizeof($checkorder);$n++){
                array_push($values,explode(',', $checkorder[$n]));
                array_push($values1,explode(',', $date[$n]));
              }
              $cookie_name = "values";
              
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
                $spread_due_date = join('-',array_reverse(explode('/',$values1[$i][0])));
                //var_dump($spread_date1);
              
                $nutyed = "insert into `tiantongorchid`.`spread_order` 
                (`spread_id`, `spread_date`, `spread_due_date`, `employee_id`, `orders_id`, `recive_id`) 
                values('".$spread_id."','".$spread_date."','".$spread_due_date."','".$employee_id."','".$values[$i][0]."','".$null."')";
                array_push($values[$i],$spread_id);
                $result = mysql_query($nutyed);

                if(!$result){
                 die('Insert not success !!!: '. mysql_error());
                }
              }
              $cookie_value =json_encode($values);
              setcookie($cookie_name, $cookie_value, time() + (86400 * 30)); // 86400 = 1 day  
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
<script type="text/javascript" src="angular-cookies.min.js"></script>
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

<table >
<div class="row">
  <div class="col-md-2">
    
  </div>
  <div class="col-md-7" style="font-size:2em;">
  <a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>หน้าหลัก</a>
 
  </div>
  <div class="col-md-3">
  <br><br><br><input type="submit" name="submit" value="เพิ่ม" style="width:80px" ng-click="submit()">
  <input type="submit" name="submit" value="ยกเลิก" style="width:80px" ng-click="submit()">

 
  </div>
</div>
<center><hr width="80%"></center>

<div>
<center>

  <div class="table-responsive">

        <thead>
 <tr>
  
 <th width="300"><pre>รหัสรายละเอียด<br>การรับคำสั่งซื้อ</pre></th>
 <th width="200"><pre>รหัสการรับ<br>คำสั่งซื้อ</pre></th>
 <th width="300"><pre>   ชื่อสินค้า   </pre></th>
 <th width="150"><pre>สี</pre></th>
 <th width="100"><pre>ขนาด</pre></th>
  <th width="100"><pre>หน่วยนับ</pre></th>
  <th width="150"><pre>จำนวนที่<br>สั่งซื้อ</pre></th>
  <th width="150"><pre>   </pre></th>
  <th width="150"><pre>   </pre></th>
 


 </tr></thead>
    <tr ng-repeat="row in data track by $index" align="center">
        
         
          <td class='td'>{{row.detail_orders_id}}</td>
          <td>{{row.orders_id}}</td>
          <td>{{row.product_name}}</td>
          <td>{{row.color_name}}</td>
          <td>{{row.size_name}}</td>
          <td>{{row.unit_measure_name}}</td>
          <td>{{row.number_orders}}</td>
          <td  ><input type='number' class='form-control' placeholder='จำนวน'  aria-describedby='sizing-addon2' style='width:100px' ng-model='qty[$index]' ng-change='checkQty(row.number_orders,$index)'>
          <td class='td'>
            <select class='form-control' name='garden_network[]' ng-model="gardenNetworkId[$index]" style='width:150px' oninvalid='setCustomValidity('กรุณากรอกข้อมูล')' oninput='setCustomValidity('')' required >
            <option value="">กรุณากรอกข้อมูล</option>
            <option ng-repeat="drop in row.dropdown" value="{{drop.garden_network_id}}">{{drop.garden_network_name}}</option>
          </select>
          </td>
          
        </tr>
</table>
</div>
 

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
</html>