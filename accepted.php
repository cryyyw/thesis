<?php

include "dbcon.php";


$id = $_GET['id'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");

$sql = "UPDATE carwash SET status='Accepted' WHERE id = '$id'";

$sql2 = "INSERT INTO carwash_notif(car, date, message) VALUES ('$id','$current','You may now serve services to your future customer. Welcome to CleanConnect!')";

if (mysqli_query($conn, $sql)) {
	if(mysqli_query($conn, $sql2)){
        $error_message = "You have successfully accepted car wash.";
        header("Location: carwash.php?error_message=" . urlencode($error_message));
	}
}
?>