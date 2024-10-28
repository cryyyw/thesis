<?php

include "dbcon.php";
session_start();



$id = $_POST['id'];





$sql2 = "DELETE FROM services WHERE id = '$id'";


	if(mysqli_query($conn, $sql2)){
        $error_message = "You have successfully remove a services";
        header("Location: services.php?error_message=" . urlencode($error_message));
	}

?>