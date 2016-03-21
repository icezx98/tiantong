
 

<?php
    header("content-type: text/html; charset=utf-8");
    header ("Expires: Wed, 21 Aug 2013 13:13:13 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

  include("../connect.php");
  $db = "tiantongorchid";
 $result = mysql_select_db($db);
 if(!$result){
 die('Could not find database called garden_network_id: '. mysql_error());
 }
    $data = $_GET['data'];
    $val = $_GET['val'];
   


// select p.produce_id,p.produce_name,c.color_name,s.size_name,u.unit_measure_name 
//           FROM color c,size s,unit_measure u,produce p 
//           WHERE p.color_id = c.color_id and p.size_id = s.size_id and p.unit_measure_id = u.unit_measure_id

         if ($data=='produce') { 
              echo "<select class='form-control' name='produce_id' placeholder='คลิ๊กเลือกข้อมูล' style='width:227px' onChange=\"dochange('color', this.value)\">";
              $sql = "select * FROM product ";
              $result = mysql_query($sql);
              $num_rows = mysql_num_rows($result);
              $i = 0;
            echo "<option>คลิกเลือกสินค้า</option>";

            while($i<$num_rows){
            $data = mysql_fetch_array($result);
            echo "<option value='$data[0]' >$data[1]</option>";
             $i++; 
          
              }
         } else if ($data =='color') {
          $sql = "select p.produce_name FROM produce p,color c WHERE p.produce_id = '$val' and p.color_id = c.color_id";
              $result = mysql_query($sql);
              $num_rows = mysql_num_rows($result);
              $i = 0;

            while($i<$num_rows){
            $data = mysql_fetch_array($result);
            $ii = $data[0];
             $i++; 
          
              }
          echo "<select name='color_id' class='form-control' style='width:227px' onChange=\"dochange('size','".$val."')\">";
             $result=mysql_query("select p.color_id,c.color_name FROM color c,produce p  WHERE p.produce_name = '$ii' and p.color_id = c.color_id ");
            echo "<option>คลิกเลือกสี</option>";
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[0]\" >$row[1]</option> " ;
              }
         
           }else if ($data =='size') {
        $sql = "select p.produce_name FROM produce p,size s WHERE p.produce_id = '$val' and p.size_id = s.size_id";
              $result = mysql_query($sql);
              $num_rows = mysql_num_rows($result);
              $i = 0;

            while($i<$num_rows){
            $data = mysql_fetch_array($result);
            $ii = $data[0];
             $i++; 
          
              }
          echo "<select name='size_id'class='form-control' style='width:227px'  onChange=\"dochange('unit_measure','".$val."')\">";
             $result=mysql_query("select p.size_id,s.size_name FROM size s,produce p  WHERE p.produce_name = '$ii' and p.size_id = s.size_id ");
            echo "<option>คลิกเลือกขนาด</option>";
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[0]\" >$row[1]</option> " ;
              }
         
           }
           else if ($data =='unit_measure') {
        $sql = "select p.produce_name FROM produce p,unit_measure u WHERE p.produce_id = '$val' and p.unit_measure_id = u.unit_measure_id";
              $result = mysql_query($sql);
              $num_rows = mysql_num_rows($result);
              $i = 0;

            while($i<$num_rows){
            $data = mysql_fetch_array($result);
            $ii = $data[0];
             $i++; 
          
              }
          echo "<select name='size_id'class='form-control' style='width:227px'>";
             $result=mysql_query("select p.unit_measure_id,u.unit_measure_name FROM unit_measure u,produce p  WHERE p.produce_name = '$ii' and p.unit_measure_id = u.unit_measure_id ");
            echo "<option>คลิกเลือกหน่วยนับ</option>";
              while($row = mysql_fetch_array($result)){
                   echo "<option value=\"$row[0]\" >$row[1]</option> " ;
              }
         
           }
          echo "</select>\n"; 
       
?>