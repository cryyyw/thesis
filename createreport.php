<?php

session_start();
include "dbcon.php";
$id = $_SESSION['id'];

$ser = $_POST['selectedServiceIds'];
$sta = $_POST['startdate'];
$end = $_POST['enddate'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d");

$sql ="INSERT INTO car_reports(service, startdate, enddate, car, createdate) 
VALUES ('$ser','$sta','$end','$id','$current')";


if (mysqli_query($conn, $sql)) {

	       $error_message = "You successfully generate a report";
            $color = "p";
          
            header("Location:  carreports.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
}else{
	echo "asdasd";
}
?>