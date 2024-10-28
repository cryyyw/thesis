<?php

include "dbcon.php";


$id = $_POST['id'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");

$sql = "UPDATE customer SET status='Accepted' WHERE id = '$id'";

// $sql2 = "INSERT INTO carwash_notif(car, date, message) VALUES ('$id','$current','Your carwash is now suspended Please contact the admin to fix the Problem. Thankyou!')";

if (mysqli_query($conn, $sql)) {
	// if(mysqli_query($conn, $sql2)){
        $error_message = "You Successfully Unblocked a Customer";
        header("Location: blockuser.php?error_message=" . urlencode($error_message));
	// }
}
?>