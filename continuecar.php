<?php

include "dbcon.php";


$id = $_POST['id'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");

$sql = "UPDATE carwash SET status='Accepted', suspended = '' WHERE id = '$id'";

$sql2 = "INSERT INTO carwash_notif(car, date, message) VALUES ('$id','$current','You may now resume your carwash services. Thank you!')";

if (mysqli_query($conn, $sql)) {
	if(mysqli_query($conn, $sql2)){
        $error_message = "You have successfully resumed car wash services.";
        header("Location: carwash.php?error_message=" . urlencode($error_message));
	}
}
?>