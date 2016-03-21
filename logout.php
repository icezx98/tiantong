<?php
 //  session_start();
 //  include("connect.php");
 //  $db = "tiantongorchid";
 //  $result = mysql_select_db($db);
 //  if(!$result){
 //  die('Could not find database called unit_measure: '. mysql_error());
 // }
     session_start();
     session_unset();
    // session_destroy();

    // ($_SESSION['username'] == "")
  // {
  //   echo "Please Login!";
  //   exit();
  // }

  // if($_SESSION['user_manage'] != "user")
  // {
  //   echo "This page for Admin only!";
  //   exit();
  // } 
  // $strSQL = "SELECT * FROM employee WHERE username = '".$_SESSION['username']."' ";
  // $objQuery = mysql_query($strSQL);
  // $objResult = mysql_fetch_array($objQuery);
?>
<script type="text/javascript">location="login.php";</script>