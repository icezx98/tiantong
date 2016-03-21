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
  $companyId = $_GET['companyId'];
  $customerId = $_GET['customerId'];

?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.min.css">
<link href="dist/simple-hint.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/table.css"> 
<link rel="stylesheet" href="css/css1.css">


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
  <a href="order.php">รับคำสั่งซื้อ</a>
  / 
  <a href="detail_orders.php?id=<?php echo $o?>&companyId=<?php echo $companyId ; ?>&customerId=<?php echo $customerId; ?>">รายละเอียดการรับคำสั่งซื้อ</a>
 
  </div>
  <div class="col-md-3">
  
  <ul class="blue">
<?php
 $i[0] = $_GET['id'];
echo "<li><a class='current' title='home' href='insert/detail_orders_formin.php?id=".$i[0]."&companyId=".$companyId."&customerId=".$customerId."'><i class='glyphicon glyphicon-plus'></i>เพิ่มข้อมูล</a></li>";
?>
</ul>
  </div>
</div>
<center><hr width="80%"></center>

<div>

<center>

<form>
  <div class="table-responsive">
<table id="example">
        <thead>
 <tr>
  <th width="150"><pre>   </pre></th>
 <th width="300"><pre>รหัสรายละเอียด<br>การรับคำสั่งซื้อ</pre></th>
 <th width="200"><pre>รหัสการรับ<br>คำสั่งซื้อ</pre></th>
 <th width="300"><pre>   ชื่อสินค้า   </pre></th>
 <th width="190"><pre>สี</pre></th>
 <th width="100"><pre>ขนาด</pre></th>
  <th width="150"><pre>หน่วยนับ</pre></th>
  <th width="100"><pre>ราคา/หน่วย(บาท)</pre></th>
  <th width="150"><pre>จำนวนที่<br>สั่งซื้อ</pre></th>
   <th width="150"><pre>ราคารวม(บาท)</pre></th>
 


 </tr></thead>
<?php
      if(!empty($companyId)){
     $sql = "select d.detail_orders_id, d.orders_id, p.product_name, c.color_name, s.size_name, u.unit_measure_name,ROUND(pc.price_unit, 2),d.number_orders
     FROM detail_product dp,product p,color c, size s, unit_measure u,product_company pc, detail_orders d 
     WHERE d.detail_product_id = dp.detail_product_id and d.detail_product_id = pc.detail_product_id and dp.product_id = p.product_id 
     and dp.color_id = c.color_id and dp.size_id = s.size_id and dp.unit_measure_id = u.unit_measure_id 
     and d.orders_id = '".$_GET["id"]."' and pc.company_id = '".$_GET["companyId"]."'" ;
   }else{
    $sql = "select d.detail_orders_id, d.orders_id, p.product_name, c.color_name, s.size_name, u.unit_measure_name,ROUND(dp.price_unit, 2),d.number_orders
     FROM detail_product dp,product p,color c, size s, unit_measure u, detail_orders d 
     WHERE d.detail_product_id = dp.detail_product_id  and dp.product_id = p.product_id 
     and dp.color_id = c.color_id and dp.size_id = s.size_id and dp.unit_measure_id = u.unit_measure_id 
     and d.orders_id ='".$_GET["id"]."'" ;

   }
   $result = mysql_query($sql);
     $num_rows = mysql_num_rows($result);
     $num_fields = mysql_num_fields($result);
     $i = 0;

 while($i<$num_rows){
 $data = mysql_fetch_array($result);

 echo "<tr onclick=\"javascript:location.href='http:./insert/spread_order_formin.php?id=".$_GET["id"]."&productName=".$data[2]."&productcolor=".$data[3]."&productsize=".$data[4]."&productunit=".$data[5]."&number_orders=".$data[7]."'\" align=\"center\" class=\"link\"  data-toggle=\"tooltip\" title=\"การกระจายคำสั่งซื้อ\">";
 echo "<td class='td'><a href='update/detail_orders_formupdate.php?id=".$data[0]."&companyId=".$companyId."&customerId=".$customerId."&i=".$data[1]."&productName=".$data[2]."&productcolor=".$data[3]."&productsize=".$data[4]."&productunit=".$data[5]." '><span data-hint='แก้ไข' class='hint-bottom-t-info'><span class='glyphicon glyphicon-edit' placeholder='Edit'></span></span></a>&nbsp;&nbsp;&nbsp;";
 echo "<a class='delete' href='delete/detail_orders_delete.php?id=".$data[0]."'><span data-hint='ลบ' class='hint-bottom-t-error'><span class='glyphicon glyphicon-trash'></span></span></a></td>";
 
   echo "<td>$data[0]</td>";
     echo "<td >&nbsp;$data[1]</td>";
     echo "<td align='left'>&nbsp;$data[2]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[3]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[4]</td>";
     echo "<td align='left'>&nbsp;&nbsp;$data[5]</td>";
     echo "<td class='td' align='right'>$data[6]&nbsp;&nbsp;&nbsp;&nbsp;</td>";
     echo "<td class='td' align='right'>$data[7]&nbsp;&nbsp;&nbsp;&nbsp;</td>";
     $total = $data[6] * $data[7];
     $total = number_format($total, 2, '.', ',');
     echo "<td class='td' align='right'>$total&nbsp;&nbsp;&nbsp;&nbsp;</td>";
 echo "</tr>";
 $i++;

 }
?>
</table>
</div>
</form>

</center>
</div>
<script src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" >
$(function() {

        $('a.delete').click(function(e) {
           
            var $this = $(this);
            var ahref = $this.attr('href');
            var url = 'delete/detail_orders_delete.php';
            var values = {};
            values['id'] = (ahref.split('='))[1];
            
            swal({
                title: "คุณต้องการลบ!!",
                text: "ข้อมูลนี้จะหายจากระบบ!",
                type: "warning",
                showCancelButton: true,   
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'ตกลง', cancelButtonText: "ยกเลิก",
                closeOnConfirm: false
              },
            function(){

             $.ajax(
                {
                    url : url,
                    type : "POST",
                    data : values,
                    dataType : "JSON",
                    success : function(data, textStatus, jqXHR)
                    {

                        if(data.message == 'success') {
                            
                            $($this).parent().parent().remove();
                            // swal("ลบข้อมูลเรียบร้อย", "คุณทำการลบข้อมูลนี้เรียบร้อยแล้ว!", "success");
                            swal({title: "ลบข้อมูลเรียบร้อย",   text: "คุณทำการลบข้อมูลนี้เรียบร้อยแล้ว!",   timer: 1000,   showConfirmButton: true });

                       }
                        //else console.log("มีข้อมูลถูกใช้งานอยู่");
                        else swal("ไม่สามารถลบได้!", "`ข้อมูลนี้ถูกใช้งานอยู่ในระบบ.", "error");

                        

                    },
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        console.log('Error from delete');
                        
                    }
                });

            } //function 
            ); //swal


            e.preventDefault();    

        }); //click
     
});

 jQuery.noConflict()(function($){
 });
</script>
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
</body>
</html>