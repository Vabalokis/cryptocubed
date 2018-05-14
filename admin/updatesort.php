<?php
session_start();
$_SESSION['usersorting'] = $_POST['rdb'];
header("Refresh: 0; url='welcome.php'");
echo "Sort changed!<br>";
 ?>
