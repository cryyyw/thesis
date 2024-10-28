<?php

session_start();
include "dbcon.php";
$id = $_SESSION['id'];
$ser = $_POST['selectedServiceIds'];
$total = $_POST['total'];
$date = $_POST['datee'];
$time = $_POST['target_time'];
$from = $_POST['from'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");

$sql = "INSERT INTO request(service, total, status, customer, sent_request, target_date, target_time,carwash) 
VALUES ('$ser','$total','Pending','$id','$current','$date','$time','$from')";



if (mysqli_query($conn, $sql)) {

	       $error_message = "You successfully sent your Request";
            $color = "p";
          
            header("Location: request.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
}else{
	echo "asdasd";
}
?>