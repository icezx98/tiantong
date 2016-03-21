<?php
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
  if (!isset($_SESSION['username']))
  {
    echo "Please Login!";
    exit();
  }

  $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
  $total_price = $_SESSION['total']
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
<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
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
  <!-- /
	<a href="master_data.php">ข้อมูลหลัก</a> -->
	 / 
    <a href="recive.php">รับสินค้า</a>
    
  </div>
  <div class="col-md-3">
	
	<ul class="blue">
<li><a class="current" title="home" href="./insert/recive_formin.php"><i class="glyphicon glyphicon-plus"></i>เพิ่มข้อมูล</a></li>
</ul>
  </div>
</div>
<hr width="80%">



<center>
<form>
  <div class="table-responsive">
<table id="example">
        <thead>
 <tr>
  <th width="10"><pre>   </pre></th>
 <th width="50"><pre>รหัสการรับสินค้า</pre></th>
 <th width="150"><pre>วันที่รับสินค้า</pre></th>
 <th width="80"><pre>ชื่อสวน</pre></th>
 <th width="100"><pre>ราคารวม</pre></th>
 <th width="200"><pre>พนักงาน</pre></th>
 


 </tr></thead>
<?php
 $sql = " select recive.recive_id, DATE_FORMAT(recive.recive_date,'%d/%m/%Y'),
          garden_network.garden_network_name,ROUND(recive.total_price, 2), employee.employee_name,garden_network.garden_network_id

          from recive , employee , garden_network

          where recive.employee_id = employee.employee_id and recive.garden_network_id = garden_network.garden_network_id ";
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;
 while($i<$num_rows){
 $data = mysql_fetch_array($result);
 echo "<tr align=\"center\">";
 echo "<td class='td'><a href='detail_recive.php?recive_id=".$data[0]."&garden_id=".$data[5]."'><span data-hint='รายการ' class='hint-bottom-t-info'><span class='glyphicon glyphicon-list-alt' placeholder='Edit'></span></span></a>";
 // echo "<a href='update/recive_formupdate.php?id=".$data[0]."'><span data-hint='แก้ไข' class='hint-bottom-t-info'><span class='glyphicon glyphicon-edit' placeholder='Edit'></span></span></a></td>";
     echo "<td>$data[0]</td>";
    echo "<td >&nbsp;$data[1]</td>";
    echo "<td align='left'>&nbsp;$data[2]&nbsp;&nbsp;</td>";
    $sql1 = "select amount, price_unit from detail_recive where recive_id = '".$data[0]."'";
             $result1 = mysql_query($sql1);
             $num_rows1 = mysql_num_rows($result1);
             $num_fields1 = mysql_num_fields($result1);
             $i1 = 0;
             $total = 0;
             while($i1<$num_rows1){
             $data1 = mysql_fetch_array($result1);
             $total +=  $data1[0] * $data1[1];
             $i1++;
           }
    echo "<td align='right'>$total</td>";
    echo "<td>$data[4]</td>";
            
 echo "</tr>";
 $i++;

 }
?>
</table>
</div>
</form>

</center>

<script src="js/jquery-2.1.4.min.js"></script>

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
</body>
</html>