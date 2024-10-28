<?php

include "dbcon.php";
session_start();



$id = $_POST['id'];
$ser = $_POST['service'];
$price = $_POST['price'];
$for = $_POST['for'];




$sql2 = "UPDATE services SET services='$ser',price='$price',for_vehicle='$for' WHERE id = '$id'";


	if(mysqli_query($conn, $sql2)){
        $error_message = "You have successfully save changes";
        header("Location: services.php?error_message=" . urlencode($error_message));
	}

?>