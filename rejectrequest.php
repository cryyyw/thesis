<?php

include "dbcon.php";
$id = $_POST['id'];

$custo = $_POST['custo'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");

$sql2 = "INSERT INTO custonotif( date, details,custo) VALUES ('$current','Carwash rejected your request please try again another time. Thank you!','$custo')";
$sql  = "UPDATE request SET status='Rejected' WHERE id ='$id'";
if (mysqli_query($conn, $sql)) {

	if(mysqli_query($conn,$sql2)){
		$error_message = "You successfully rejected customer request";
            $color = "p";
            header("Location: carpending.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
			
	}

}else{

}

?>