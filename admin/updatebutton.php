<?php
require "../db/db_connection.php";
$conn      = Connect();
$currentID = $conn->real_escape_string($_POST['id']);
$sees      = $conn->real_escape_string($_POST['sessionuser']);
$q         = "SELECT isPayed FROM userlist WHERE transactionID='$currentID'";
$resulted  = $conn->query($q);
$msg       = "";
//$logdate = date("l jS \of F Y h:i:s A");
$row = $resulted->fetch_assoc();
if ($row["isPayed"] == 0) {
  $q   = "UPDATE userlist SET isPayed='1' WHERE transactionID='$currentID'";
  $msg = "$currentID is changed from 0 to 1";
} else {
  $q   = "UPDATE userlist SET isPayed='0' WHERE transactionID='$currentID'";
  $msg = "$currentID is changed from 1 to 0";
}
$result2 = $conn->query($q);
$query   = "INSERT INTO adminlog (whologged, datelogged , adlog) VALUES('" . $sees . "', CURDATE() , '" . $msg . "')";
$success = $conn->query($query);

header("Refresh: 1; url='welcome.php'");
echo "State changed!<br>";

$conn->close();
?>
