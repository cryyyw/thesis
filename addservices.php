<?php

include "dbcon.php";
session_start();



$id = $_SESSION['id'];
$ser = $_POST['service'];
$price = $_POST['price'];
$for = $_POST['for'];




$sql2 = "INSERT INTO services(carwash, services, price, for_vehicle) VALUES ('$id','$ser','$price','$for')";


	if(mysqli_query($conn, $sql2)){
        $error_message = "You have successfully add new Services";
        header("Location: services.php?error_message=" . urlencode($error_message));
	}

?>