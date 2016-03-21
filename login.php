
<html>
<head>
	<meta name="viewport" content="width=desvice-width, initial-scale=1.0">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="css/login.css">
<script src="dist/sweetalert-dev.js"></script>
<link rel="stylesheet" href="dist/sweetalert.css">
</head>
<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    
            <center><img src="im/Thiantong.png"  height="100"></center>

    
  </div><!-- /.container-fluid -->
</nav>

<section class="login">
	<div class="titulo">Login</div>
	<form action="login.php" method="post" enctype="application/x-www-form-urlencoded">

    	<input type="text" required title="Username required" name="username" placeholder="Username" data-icon="U">
        <input type="password" required title="Password required" name="password" placeholder="Password" data-icon="x"><br><br>

    
        <input type="submit" name="submit" value="Login" class="enviar">
    </form>
</section>

<?php
if (isset($_POST['submit']))
        {
  session_start();
  include("connect.php");
  $db = "tiantongorchid";
  $result = mysql_select_db($db);
  if(!$result){
  die('Could not find database called unit_measure: '. mysql_error());
 }
   
  $password = sha1($_POST['password']);

  $strSQL = "SELECT * FROM employee WHERE username = '".mysql_real_escape_string($_POST['username'])."' 
  and password = '".mysql_real_escape_string($password)."'";

  $objQuery = mysql_query($strSQL);
  $objResult = mysql_fetch_array($objQuery);
  if(!$objResult)
  {
      echo "<script>
swal( {title: \"ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง\", type: \"warning\" },function(){
  location=\"login.php\";
})
</script>";
 exit;
  }
  else
  {
      $_SESSION["username"] = $objResult["username"];
      $_SESSION["user_manage"] = $objResult["user_manage"];

      session_write_close();
      
      if($objResult["user_manage"] == "admin")
      {
        header("location:index.php");
      }
      else
      {
        header("location:index.php");
      }
  }
  mysql_close();
}
?>

</body>
</html>