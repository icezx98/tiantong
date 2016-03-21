<?php
  session_start();
  include("connect.php");
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
<link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
    <script type="text/javascript" src="js/dataTables.min.js"></script>
    <script type="text/javascript" charset="utf-8">
      $(document).ready(function() {
        $('#example').DataTable();
      } );
    </script>
<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
<link href="dist/simple-hint.css" rel="stylesheet">
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>สินค้าของสวนเครือข่าย</title>
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
  <a href="product_data.php">ข้อมูลสินค้า</a>
   / 
    <a href="product_garden.php">สินค้าของสวนเครือข่าย</a>
    
  </div>
  <div class="col-md-3">
  
  <ul class="blue">
<li><a class="current" title="home" href="insert/product_garden_formin.php"><i class="glyphicon glyphicon-plus"></i>เพิ่มข้อมูล</a></li>
</ul>
  </div>
</div>
<hr width="80%">

<div>

<center>
<form>
  <div class="table-responsive">
<table id="example">
        <thead>
 <tr>
  <th width="150"><pre> </pre></th>
 <th width="400"><pre>รหัสสินค้าของสวน<br>เครือข่าย</pre></th>
 <th width="250"><pre>ชื่อสินค้า</pre></th>
 <th width="190"><pre>สี</pre></th>
 <th width="150"><pre>ขนาด</pre></th>
 <th width="150"><pre>หน่วยนับ</pre></th>
 <th width="250"><pre>  ชื่อสวน  </pre></th>
 <th width="200"><pre>ราคา/หน่วย<br>(บาท)</pre></th>
 



 </tr></thead>
<?php
 $sql = "select pg.product_garden_id,p.product_name,c.color_name,z.size_name,u.unit_measure_name,g.garden_network_name,ROUND(pg.price_unit, 2)
from product_garden pg , detail_product dp ,product p, garden_network g , color c , size z ,unit_measure u
WHERE dp.detail_product_id = pg.detail_product_id and dp.product_id = p.product_id AND pg.garden_network_id = g.garden_network_id AND dp.color_id = c.color_id AND dp.size_id = z.size_id AND dp.unit_measure_id = u.unit_measure_id order by p.product_name asc";
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;

 while($i<$num_rows){
 $data = mysql_fetch_array($result);


 echo "<tr align=\"center\">";
 echo "<td class='td'><a href='update/product_garden_formupdate.php?id=".$data[0]."&productName=".$data[1]."&productcolor=".$data[2]."&productsize=".$data[3]."&productunit=".$data[4]." '><span data-hint='แก้ไข' class='hint-bottom-t-info'><span class='glyphicon glyphicon-edit' placeholder='Edit'></span></span></a></td>";

     echo "<td>$data[0]</td>";
     echo "<td align='left'>$data[1]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[2]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[3]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[4]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[5]</td>";
     echo "<td class='td' align='right'>$data[6]&nbsp;&nbsp;&nbsp;&nbsp;</td>";

 echo "</tr>";
 $i++;

 }
?>
</table>
</div>
</form>

<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>