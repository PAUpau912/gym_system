<?php
include_once("connections/connection.php");
$conn = connection();

// Count total members
$sql = "SELECT COUNT(*) AS totalMembers FROM membership";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_members = $row['totalMembers'];
?>