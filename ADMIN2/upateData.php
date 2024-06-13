<?php
include_once("connections/connection.php");
include("total.php");
include("count.php");
include("coachcount.php");
include("today.php");

$data = [
    'totalProfit' => $totalAmount,
    'totalMembers' => $total_members,
    'totalCoaches' => $totalCOACH,
    'todaySales' => $total_sales_today
];

echo json_encode($data);
?>
