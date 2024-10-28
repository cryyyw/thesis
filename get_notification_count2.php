<?php
session_start();
include('dbcon.php'); // Include your DB connection

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    // Query to get unread notifications count
    $sql = "SELECT count(id) as count FROM carwash_notif WHERE car = '$id' AND readd=''";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Return the count as JSON
    echo json_encode($row['count']);
}
?>
