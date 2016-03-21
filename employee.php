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

  if($_SESSION['user_manage'] != "ADMIN")
  {
    ?> 
      <script type="text/javascript">location="employee_formupdate_user.php";</script>
    <?php 
    exit();
  } 
  
  $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
  $ll =  $objResult["employee_tel"];
$ll = sha1($ll);
  if($objResult["password"] == $ll ){
    echo "<script>location='employee_formupdate_changepass.php';</script>";
  }
?>
<!DOCTYPE html>
<html>
<head>
<link href="dist/simple-hint.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/css1.css">
<link rel="stylesheet" href="css/table.css"> 
<script src="js/jquery-1.11.3.min.js"></script>
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
            <li><a href="#"></a></li>
           
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
	<a href="master_data.php">ข้อมูลหลัก</a>
	 / 
    <a href="employee.php">ข้อมูลพนักงาน</a>
    
  </div>
  <div class="col-md-3">
	
	<ul class="blue">
<li><a class="current" title="home" href="employee_formin.php"><i class="glyphicon glyphicon-plus"></i>เพิ่มข้อมูล</a></li>
</ul>
  </div>
</div>
<hr width="80%">

<div>

<center>
<form>
  <div class="table-responsive">
<table >
 <tr>
  <th width="150"><pre>   </pre></th>
 <th width="200"><pre>รหัสพนักงาน</pre></th>
 <th width="350"><pre>ชื่อ-นามสกุล</pre></th>
 <th width="200">เบอร์โทร</th>
 <th width="400"><pre>สิทธิการเข้าใช้งาน</pre></th>
 <th width="200"><pre>ชื่อผู้ใช้</pre></th>


 </tr>
<?php
 $sql = "select employee_id,employee_name,employee_tel,user_manage,username from employee order by employee_name asc";
 $result = mysql_query($sql);
 $num_rows = mysql_num_rows($result);
 $num_fields = mysql_num_fields($result);
 $i = 0;


 while($i<$num_rows){
 $data = mysql_fetch_array($result);

 echo "<tr align=\"center\">";
 echo "<td ><a href='employee_formupdate.php?id=".$data[0]."'><span data-hint='แก้ไข' class='hint-bottom-t-info'><span class='glyphicon glyphicon-edit' placeholder='Edit'></span></span></a>&nbsp;&nbsp;&nbsp;";
 echo "<a class='delete' href='employee_delete.php?id=".$data[0]."'><span data-hint='ลบ' class='hint-bottom-t-error'><span class='glyphicon glyphicon-trash'></span></span></a></td>";
       echo "<td>$data[0]</td>";
     echo "<td align='left'>&nbsp;$data[1]</td>";
     echo "<td >$data[2]</td>";
     echo "<td align='left'>&nbsp;&nbsp;&nbsp;$data[3]</td>";
     echo "<td align='left'>&nbsp;&nbsp;&nbsp;$data[4]</td>";

 echo "</tr>";
 $i++;

 }
?>

</table>
</div>
<input type='hidden' name="ice" value="<?php echo $objResult['employee_id'];?>">
</form>

</center>
</div>


	<script type="text/javascript" >
$(function() {

        $('a.delete').click(function(e) {
           
            var $this = $(this);
            var ahref = $this.attr('href');
            var url = 'employee_delete.php';
            var values = {};
            values['id'] = (ahref.split('='))[1];
            values['userid']= $('input[name=ice]').val();

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
                      console.log(data.message);
                        if(data.message == 'success') {
                            
                            $($this).parent().parent().remove();
                            // swal("ลบข้อมูลเรียบร้อย", "คุณทำการลบข้อมูลนี้เรียบร้อยแล้ว!", "success");
                            swal({title: "ลบข้อมูลเรียบร้อย",   text: "คุณทำการลบข้อมูลนี้เรียบร้อยแล้ว!",   timer: 2000,   showConfirmButton: true });

                       }
                        //else console.log("มีข้อมูลถูกใช้งานอยู่");
                        else swal("ไม่สามารถลบได้!", "ข้อมูลนี้ถูกใช้งานอยู่ในระบบ.", "error");

                        

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


</script> 
 <script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
 <script>
        $.backstretch("im/BG.jpg", {speed: 100});
    </script>
</body>
</html>