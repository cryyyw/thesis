<?php
session_start();
include('dbcon.php'); // Include your DB connection

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    
    // Update notifications as read
    $sql = "UPDATE carwash_notif SET readd='y' WHERE car='$id' AND readd=''";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo "Notifications updated";
    } else {
        echo "Error updating notifications: " . mysqli_error($conn);
    }
}
?>
