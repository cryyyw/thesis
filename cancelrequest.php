<?php

include "dbcon.php";

$id = $_POST['id'];
$car = $_POST['car'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");




$sql = "UPDATE request SET status='Cancel',cancelationtime='$current' WHERE id = '$id'";
$sql2 = "INSERT INTO carwash_notif(car, date, message) VALUES ('$car','$current','Customer Cancel their request')";


if (mysqli_query($conn, $sql)) {
			if (mysqli_query($conn, $sql2)) {
			$error_message = "You successfully cancel your Request";
            $color = "p";
            header("Location: customerrequesst.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
			}
	       
}else{
			$error_message = "Something wrong please try again!";
            $color = "r";
            header("Location: customerrequesst.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
}
?>