<?php
session_start();
include "dbcon.php";
$id = $_POST['id'];
$did = $_SESSION['id'];


$sql  = "INSERT INTO block(name, block, car) VALUES ('$id','y','$did')";
if (mysqli_query($conn, $sql)) {
		$error_message = "You successfully blocked customer";
        $color = "p";
        header("Location: carblockuser.php?error_message=" . $error_message . "&color=" . $color."&id=".$from);
}else{

}

?>