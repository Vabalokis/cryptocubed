<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $myusername = mysqli_real_escape_string($db, $_POST['username']);
    $mypassword = mysqli_real_escape_string($db, $_POST['password']);

    $sql    = "SELECT id FROM adminpanel WHERE username = '$myusername' and passcode = '$mypassword'";
    $result = mysqli_query($db, $sql);
    $row    = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $active = $row['active'];
    $count  = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['login_user'] = $myusername;
        $_SESSION['usersorting'] = 0;
        header("location: welcome.php");
    } else {
        $error = "Your Login Name or Password is invalid";
    }
}
?>
<html>

<head>
    <title>Admin login</title>

    <style type="text/css">
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            background-image: url('../img/back.jpg');
        }

        label {
            font-weight: bold;
            width: 100px;
            font-size: 14px;
        }

        .box {
            border: #666666 solid 1px;
        }
    </style>

</head>

<body bgcolor="#FFFFFF">

    <div align="center">
        <div style="width:300px; border: solid 1px #333333; background-color:white;" align="left">
            <div style="background-color:#333333; color:#FFFFFF; padding:3px;">
                <b></b>
            </div>

            <div style="margin:30px">

                <form action="" method="post">
                    <label>Username :</label>
                    <input type="text" name="username" class="box" />
                    <br />
                    <br />
                    <label>Password :</label>
                    <input type="password" name="password" class="box" />
                    <br/>
                    <br />
                    <input class="sub" type="submit" value=" Submit " />
                    <br />
                </form>

            </div>

        </div>

    </div>

</body>

</html>
