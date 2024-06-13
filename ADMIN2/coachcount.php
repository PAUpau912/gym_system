<?php
include_once("connections/connection.php");
$conn = connection();

// Count total coaches
$sql = "SELECT COUNT(*) AS totalCoaches FROM coach";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$totalCOACH = $row['totalCoaches'];
?>
