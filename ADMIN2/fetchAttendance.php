<?php
include_once("connections/connection.php");

$conn = connection();
$attendanceData = [];

$sql = "SELECT attendance_date, COUNT(*) AS attendance_count FROM attendance GROUP BY attendance_date";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceData[$row['attendance_date']] = $row['attendance_count'];
    }
}

echo json_encode($attendanceData);
?>