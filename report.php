<?php

session_start();
include "dbcon.php";

$id = $_POST['id'];
$car = $_POST['car'];
$text = $_POST['text'];
$cid = $_SESSION['id'];
date_default_timezone_set('Asia/Manila');
$current = date("Y-m-d H:i:s");
$cancel = $_POST['cancel'];

$sql = "INSERT INTO report( customer, subject, details, car, datetimes,canceltime) VALUES ('$cid','Cancelation','$text','$car','$current','$cancel')";

$sql2 = "UPDATE request SET status='Reported' WHERE id = '$id'";


if (mysqli_query($conn, $sql)) {
			if (mysqli_query($conn, $sql2)) {
				$error_message = "You successfully sent your report";
	            $color = "p";
	            header("Location: customerrequesst.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
        	}
}else{
			$error_message = "Something wrong please try again!";
            $color = "r";
            header("Location: customerrequesst.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
}
?>