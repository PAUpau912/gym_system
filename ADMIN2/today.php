<?php
include_once("connections/connection.php");
$conn = connection();

// Calculate today's sales
$sql = "SELECT SUM(amount) AS totalSalesToday FROM payments WHERE DATE(payment_date) = CURDATE()";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_sales_today = $row['totalSalesToday'];
?>