<?php
include "dbcon.php";

// Retrieve and sanitize the service category and id from GET parameters
$service = isset($_GET['service']) ? $_GET['service'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;  // Sanitize input to prevent SQL injection

// Verify that $id is valid
if ($id > 0) {
    // SQL query based on the service type
    if ($service === 'All') {
        $sql = "SELECT `id`, `carwash`, `services`, `price`, `for_vehicle` FROM `services` WHERE `id` = $id";
    } elseif ($service === 'Motor') {
        $sql = "SELECT `id`, `carwash`, `services`, `price`, `for_vehicle` FROM `services` WHERE `id` = $id AND `for_vehicle` = 'Motor'";
    } else {
        $sql = "SELECT `id`, `carwash`, `services`, `price`, `for_vehicle` FROM `services` WHERE `id` = $id AND `for_vehicle` = '$service'";
    }

    $result = $conn->query($sql);

    // Output checkboxes for the filtered services
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div><input type="checkbox" name="services[]" value="' . htmlspecialchars($row['id']) . '"> ' . htmlspecialchars($row['services']) . ' - ' . htmlspecialchars($row['price']) . '</div>';
        }
    } else {
        echo "No services available";
    }

    // Free result set
    $result->free();
} else {
    echo "Invalid ID provided";
}

$conn->close();
?>
