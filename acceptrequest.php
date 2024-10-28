<?php

include "dbcon.php";
$id = $_POST['id'];

$custo = $_POST['custo'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");

$sql2 = "INSERT INTO custonotif( date, details,custo) VALUES ('$current','Congrats carwash Accepted your request','$custo')";
$sql  = "UPDATE request SET status='Accepted' WHERE id ='$id'";
if (mysqli_query($conn, $sql)) {

	if(mysqli_query($conn,$sql2)){
		$error_message = "You successfully accepted customer request";
            $color = "p";
            header("Location: carpending.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
			
	}

}else{

}

?>