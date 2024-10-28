<?php

include "dbcon.php";
session_start();

// Get new password from POST request
$new = $_POST['new'];
// Get user ID from session
$id = $_SESSION['id'];

// Hash the new password before storing it
$new_hashed = password_hash($new, PASSWORD_BCRYPT);

// Prepare an SQL statement to prevent SQL injection
$sql = "UPDATE carwash SET password=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $new, $id);

// Execute the statement and check for errors
if ($stmt->execute()) {
    $error_message = "You Successfully Changed Password!";
    $color = "p";
    // Redirect with error message and color parameters
    header("Location: carprofile.php?error_message=" . urlencode($error_message) . "&color=" . urlencode($color));
} else {
    // Handle error if the query fails
    echo "Error: " . $stmt->error;
}

// Close the statement and the connection
$stmt->close();
$conn->close();
?>
