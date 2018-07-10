<?php
require 'db_connection.php';
$conn = Connect();
$id = $conn->real_escape_string($_POST['id']);
$email = $conn->real_escape_string($_POST['email']);
$plantype = $conn->real_escape_string($_POST['plan']);
$ispayed = 0;
$captcha = $_POST['g-recaptcha-response'];
$plantlength = 0;
if ($plantype == 1) {
    $plantlength = 1;
} else if ($plantype == 2) {
    $plantlength = 12;
} else {
    $plantlength = 1200;
}
if (!$captcha) {
    echo '<h2>Please check the the captcha form.</h2>';
    exit;
}
$secretKey = "6Ldv1EAUAAAAACjxSXHaJLNw54lszOlu_mWpZZ0j";
$ip = $_SERVER['REMOTE_ADDR'];
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
$responseKeys = json_decode($response, true);
if (intval($responseKeys["success"]) !== 1) {
    header("Refresh: 3; url='../index.php'");
    echo '<h2>You are spammer ! Get the @$%K out</h2>';
} else {
    $query = "INSERT INTO userlist (transactionID, email , planType , isPayed , datecur , datesubscribed) VALUES('" . $id . "','" . $email . "','" . $plantype . "','" . $ispayed . "', CURDATE() , (CURDATE() + INTERVAL '" . $plantlength . "' MONTH))";
    $success = $conn->query($query);
    if (!$success) {
        die("Couldn't enter data: " . $conn->error);

    }
    header("Refresh: 3; url='../index.php'");
    echo "Thank You For Subscribing <br>";
}
$conn->close();

?>
