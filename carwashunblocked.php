<?php
session_start();
include "dbcon.php";
$id = $_POST['id'];
$did = $_SESSION['id'];


$sql  = "DELETE FROM block WHERE name ='$id' and car='$did'";
if (mysqli_query($conn, $sql)) {
		$error_message = "You successfully unblocked customer";
        $color = "p";
        header("Location: carblockuser.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
}else{

}

?>