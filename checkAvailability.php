<?php
include "dbcon.php";

$date = $_POST['date'];

$query = "SELECT target_time FROM request WHERE target_date = ? AND status = 'Accepted'";
$stmt = $conn->prepare($query);
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    echo json_encode([]);
    exit;
}
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$bookedTimes = [];
while ($row = $result->fetch_assoc()) {
    $bookedTimes[] = substr($row['target_time'], 0, 5); // Format to 'HH:MM'
}

echo json_encode($bookedTimes);
?>
