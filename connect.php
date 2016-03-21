
<?php
 $host = "localhost";
 $user = "root";
 $password = "mysql";
 $link = mysql_connect($host,$user,$password);
 if(!$link){
 die('Could not connect: '. mysql_error());
 }
 ?>