<?php
session_start();
include("connect.php");
$db = "tiantongorchid";
$result = mysql_select_db($db);
if (!$result) {
    die('Could not find database called : ' . mysql_error());
}
if (!isset($_SESSION['username'])) {
    echo "Please Login!";
    exit();
}

// if($_SESSION['user_manage'] != "user")
// {
//   echo "This page for Admin only!";
//   exit();
// }
$strSQL = "SELECT * FROM employee WHERE username = '" . $_SESSION['username'] . "' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
$orders_id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=desvice-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <title></title>
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/css1.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <img class="img" src="../tiantong/im/Thiantong.png">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php
                $_month_name = array("01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม",
                    "04" => "เมษายน", "05" => "พฤษภาคม", "06" => "มิถุนายน",
                    "07" => "กรกฎาคม", "08" => "สิงหาคม", "09" => "กันยายน",
                    "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม");

                $vardate = date('Y-m-d');
                $yy = date('Y');
                $mm = date('m');
                $dd = date('d');
                if ($dd < 10) {
                    $dd = substr($dd, 1, 2);
                }
                $date = $dd . " " . $_month_name[$mm] . "  " . $yy += 543;
                ?>
                <a align="RIGHT" class="navbar-brand"> <?php echo $date; ?>&nbsp;</a>
                <a class="navbar-brand"><span class="glyphicon glyphicon-user"
                                              aria-hidden="true"></span>&nbsp;<?php echo $objResult["employee_name"]; ?></span>
                </a>


                <li align="RIGHT" class="dropdown">
                    <a href="#" class="navbar-brand" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><span class="glyphicon glyphicon-list" aria-hidden="true"></span><span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="employee_formupdate_changepass.php">เปลี่ยนรหัสผ่าน</a></li>
                        <li><a href="#"></a></li>

                        <li><a href="logout.php">ออกจากระบบ</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<div class="row">
    <div class="col-md-2">

    </div>
    <div class="col-md-7" style="font-size:2em;">
        <a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>หน้าหลัก</a>
        /
        <a href="master_data.php">ข้อมูลหลัก</a>
        /
        <a href="employee.php">ข้อมูลพนักงาน(เพิ่มข้อมูล)</a>

    </div>
    <div class="col-md-3">


    </div>
</div>
<hr width="80%">

<?php
include("connect.php");
$db = "tiantongorchid";
$result = mysql_select_db($db);
if (!$result) {
    die('Could not find database called unit_measure: ' . mysql_error());
}

$test_id = "select MAX(SUBSTRING(employee_id,2)) as num from employee ";
$tmp = mysql_query($test_id) or die (mysql_error() . " Error Query [" . $test_id . "]");
$rows = mysql_fetch_array($tmp);
if ($rows) {
    $num = $rows['num'];
    if ($num == Null) {
        $num = 0;
    }
    $test_id = $num + 1;
    if ($test_id < 10) {
        $employee_id = "E0" . $test_id;

    } elseif ($test_id < 100) {
        $employee_id = "E" . $test_id;
    }
}


?>


<div class="clearfix hidden-xs">
    <form method="post" action="employee_in.php">
        <table>
            <tr>
                <td style="width:200px">
                    <div class="col-md-9 col-md-push-5">รหัสพนักงาน</div>
                    <div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div>
                </td>
                <td style="width:200px">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"></span>
                        <input type="text" class="form-control" placeholder="กรอกข้อมูล"
                               aria-describedby="sizing-addon2" name="employee_id" readonly="readonly"
                               style="width:200px" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')"
                               oninput="setCustomValidity('')" required value="<?php echo $employee_id; ?>">
                    </div>
                </td>
            </tr>

            <tr>
                <td style="width:200px">
                    <div class="col-md-9 col-md-push-5">ชื่อพนักงาน</div>
                    <div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div>
                </td>

                <td style="width:200px">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"></span>
                        <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล"
                               aria-describedby="sizing-addon2" name="employee_name" style="width:200px"
                               oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                               required>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="width:200px">
                    <div class="col-md-9 col-md-push-5">เบอร์โทรศัพท์</div>
                    <div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div>
                </td>

                <td style="width:200px">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"></span>
                        <input type="text" onKeyUp="if(this.value*1!=this.value) this.value='' ;" maxlength=10
                               class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"
                               name="employee_tel" style="width:200px" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')"
                               oninput="setCustomValidity('')" required>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="width:200px">
                    <div class="col-md-9 col-md-push-5">สิทธิ์การเข้าใช้งาน</div>
                    <div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div>
                </td>

                <td style="width:200px">
                    <div class="input-group">
                        <span class="input-group-addon" id="sizing-addon2"></span>
                        <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล"
                               aria-describedby="sizing-addon2" name="user_manage" style="width:200px"
                               oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                               required>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="width:200px">
                    <div class="col-md-9 col-md-push-5">ชื่อผู้ใช้งาน</div>
                    <div class="col-md-2 col-md-push-2"><b>&nbsp;&nbsp;&nbsp;*</b></div>
                </td>

                <td style="width:200px">
                    <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2"></span>
                        <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล"
                               aria-describedby="sizing-addon2" name="username" style="width:200px"
                               oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                               required>
                    </div>
                </td>
            </tr>


            <tr>
                <td></td>
                <td>


                    <div class="row">
                        <div class="col-xs-10 col-sm-4 col-md-6"></div>
                        <div class="col-xs-8 col-md-6"><input type="submit" value="เพิ่ม"
                                                              style="width:80px">&nbsp;<input type="button"
                                                                                              value="ยกเลิก"
                                                                                              style="width:80px"
                                                                                              ONCLICK="window.location.href='employee.php'">
                </td>
</div>
</div>


</tr>
</table>
</form>
</div>


<div class="clearfix visible-xs hidden-md hidden-lg">
    <form method="post" action="employee_in.php">
        <table>
            <tr>
                <td>
                    <div class="input-group">
                        <div class="col-md-9 col-md-push-5">รหัสพนักงาน<b>*</b></div>
                        <div class="col-md-9 col-md-push-5">
                            <input type="text" class="form-control" placeholder="กรอกข้อมูล"
                                   aria-describedby="sizing-addon2" name="employee_id" readonly="readonly"
                                   style="width:230px" oninvalid="setCustomValidity('กรุณากรอกข้อมูล')"
                                   oninput="setCustomValidity('')" required value="<?php echo $employee_id; ?>">
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="input-group">
                        <div class="col-md-9 col-md-push-5">ชื่อพนักงาน<b>*</b></div>
                        <div class="col-md-9 col-md-push-5">
                            <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล"
                                   aria-describedby="sizing-addon2" name="employee_name" style="width:230px"
                                   oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                                   required>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="input-group">
                        <div class="col-md-9 col-md-push-5">เบอร์โทรศัพท์<b>*</b></div>
                        <div class="col-md-9 col-md-push-5">
                            <input type="text" onKeyUp="if(this.value*1!=this.value) this.value='' ;" maxlength=10
                                   class="form-control" placeholder="กรอกข้อมูล" aria-describedby="sizing-addon2"
                                   name="employee_tel" style="width:230px"
                                   oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                                   required>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="input-group">
                        <div class="col-md-9 col-md-push-5">สิทธิ์การเข้าใช้งาน<b>*</b></div>
                        <div class="col-md-9 col-md-push-5">
                            <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล"
                                   aria-describedby="sizing-addon2" name="user_manage" style="width:230px"
                                   oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                                   required>
                        </div>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <div class="input-group">
                        <div class="col-md-9 col-md-push-5">ชื่อผู้ใช้งาน<b>*</b></div>
                        <div class="col-md-9 col-md-push-5">
                            <input type="text" text-align="center" class="form-control" placeholder="กรอกข้อมูล"
                                   aria-describedby="sizing-addon2" name="username" style="width:230px"
                                   oninvalid="setCustomValidity('กรุณากรอกข้อมูล')" oninput="setCustomValidity('')"
                                   required>
                        </div>
                    </div>
                </td>
            </tr>


            <tr>
                <td>
                    <center><input type="submit" value="เพิ่ม" style="width:80px">&nbsp;<input type="button"
                                                                                               value="ยกเลิก"
                                                                                               style="width:80px"
                                                                                               ONCLICK="window.location.href='employee.php'">
                </td>
                </center>


            </tr>
        </table>
    </form>
</div>


<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("im/BG.jpg", {speed: 100});
</script>
</body>
</html>