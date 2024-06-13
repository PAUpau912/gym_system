<?php

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT COUNT(*) AS total_members FROM member";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // Fetch the count
    $row = $result->fetch_assoc();
    $total_members = $row["total_members"];
} else {
    $total_members = 0;
}

// Close the connection
$con->close();
?>