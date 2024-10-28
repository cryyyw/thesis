<?php

include "dbcon.php";
$id = $_POST['id'];





$sql  = "DELETE FROM `car_reports` WHERE id = '$id'";
if (mysqli_query($conn, $sql)) {

		$error_message = "You successfully remove a report";
            $color = "p";
            header("Location: carreports.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
			
	

}

?>