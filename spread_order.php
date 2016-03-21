<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
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
   $employee_id = $objResult["employee_id"];
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
<link href="dist/simple-hint.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/css1.css">
<link rel="stylesheet" href="css/table.css"> 
<script src="js/bootstrap.min.js"></script>
<!-- <script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css"> -->
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
    <a href="spread_order.php">การกระจายคำสั่งซื้อ</a>
 
  </div>
  <div class="col-md-3">

  <ul ALIGN = "RIGHT" class="blue">
<li ><a class="current" title="home" name="submit"><i class="glyphicon glyphicon-plus"></i>เพิ่มข้อมูล</a></li>
</ul>
  </div>
</div>
<hr width="80%">


<center>
  <form method="post" action="detail_spread_order.php?id=1" ng-controller="orderController">
  <div class="table-responsive">
      <table id="example">
              <thead>
      <tr>
        <th width="80"><pre>   </pre></th>
       <th width="100"><pre>รหัสการรับ<br>คำสั่งซื้อ</pre></th>
       <th width="350"><pre>    บริษัท    </pre></th>
       <th width="350"><pre>   ลูกค้าไม้ตลาด   </pre></th>
       <th width="340"><pre>     พนักงาน     </pre></th>
        <th width="130"><pre>วันที่สั่งซื้อ</pre></th>
        <th width="130"><pre>กำหนดส่ง</pre></th>
        <th width="50"><pre>สถานะ</pre></th>
       


       </tr></thead>
      <?php
       $sql = "select orders.orders_id ,company.company_name ,market_customer.market_customer_name ,employee.employee_name ,DATE_FORMAT(orders.orders_date,'%d/%m/%Y'),DATE_FORMAT(orders.orders_due_date,'%d/%m/%Y'),orders.status ,company.company_id ,market_customer.market_customer_id
              from orders LEFT JOIN company ON (orders.company_id = company.company_id) LEFT JOIN market_customer ON (orders.market_customer_id = market_customer.market_customer_id) LEFT JOIN employee ON (orders.employee_id = employee.employee_id) where status = 'ใช้งาน' ORDER BY orders.orders_id DESC";
       $result = mysql_query($sql);
       $num_rows = mysql_num_rows($result);
       $num_fields = mysql_num_fields($result);
       $i = 0;


       while($i<$num_rows){
       $data = mysql_fetch_array($result);

       echo "<tr align=\"center\">";
       echo "<td class='td'><label><input type='checkbox' name='checkorder[]' value='$data[0],$data[3],$data[4],$data[5],$data[6]'></label></td>";

          echo "<td>$data[0]</td>";
          echo "<td align='left'>$data[1]</td>";
          echo "<td align='left'>&nbsp;$data[2]</td>";
          echo "<td align='left'>$data[3]</td>";
          echo "<td>$data[4]</td>";
          echo "<td>$data[5]</td>";
          echo "<td class='td'>$data[6]</td>";
       echo "</tr>";
       $i++;

       }

      ?>
      <input type="submit" name="submit" value="เพิ่ม" style="width:80px">

      </table>
</div>
      <?php
        // if (isset($_POST['submit']))
        //    {
        //       $check[] =  $_POST['checkorder'];
        //       $value = implode(' ', $_POST['checkorder']);
        //       $checkorder = $_POST['checkorder'];
        //       $values = array();
        //       for($n = 0 ; $n<sizeof($checkorder);$n++){
        //         array_push($values,explode(',', $checkorder[$n]));
                
        //       }
    
        //       for ($i=0; $i < sizeof($values) ; $i++) {

        //          $test_id = "select MAX(SUBSTRING(spread_id,4)) as num FROM spread_order";
        //          $tmp = mysql_query($test_id) or die (mysql_error()." Error Query [".$test_id."]");
        //          $rows = mysql_fetch_array($tmp);
        //          if($rows){
        //           $num = $rows['num'];
        //             if($num==Null){
        //             $num = 0;
        //           }

        //             $test_id = $num+1;
        //             if($test_id < 10){
        //              $spread_id = "SP000".$test_id;

        //                 }
        //               elseif ($test_id < 100) {
        //                 $spread_id = "SP00".$test_id;
        //               }
        //               elseif ($test_id < 1000) {
        //                 $spread_id = "SP0".$test_id;
        //               }
        //               elseif ($test_id < 10000) {
        //                 $spread_id = "PSP".$test_id;
        //               }
                  
        //         }
        //         $null = "";
        //         $spread_date = date('Y-m-d', strtotime($values[$i][2]));
        //         $spread_due_date = join('-',array_reverse(explode('/',$values[$i][3])));
        //         var_dump($spread_date1);
        //         $nutyed = "insert into `tiantongorchid`.`spread_order` 
        //         (`spread_id`, `spread_date`, `spread_due_date`, `employee_id`, `orders_id`, `recive_id`) 
        //         values('".$spread_id."','".$spread_date."','".$spread_due_date."','".$employee_id."','".$values[$i][0]."','".$null."')";


        //         $result = mysql_query($nutyed);

        //         if(!$result){
        //          die('Insert not success !!!: '. mysql_error());
        //         }
        //           echo "<script>location='detail_spread_order.php?id=1'</script>";
      
        //     }   
        //    }  
      ?>
</center>
<script type="text/javascript" src="js/dataTables.min.js"></script>
          <script type="text/javascript" charset="utf-8">
            jQuery(document).ready(function() {
              jQuery('#example').DataTable();
            } );
          </script>
          <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>