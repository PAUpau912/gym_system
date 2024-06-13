<?php
include_once("connections/connection.php");
$conn = connection();

// Query to get total profit and profit data categorized by membership type and month
$sql = "SELECT 
            SUM(CASE WHEN membership.membership_type = 'Silver' THEN payments.amount ELSE 0 END) AS silver_profit,
            SUM(CASE WHEN membership.membership_type = 'Gold' THEN payments.amount ELSE 0 END) AS gold_profit,
            SUM(CASE WHEN membership.membership_type = 'Platinum' THEN payments.amount ELSE 0 END) AS platinum_profit,
            SUM(payments.amount) AS total_amount,
            MONTH(payments.payment_date) AS month
        FROM membership
        JOIN payments ON membership.id = payments.id
        GROUP BY MONTH(payments.payment_date)";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$profits = [];
$totalAmount = 0;
while ($row = $result->fetch_assoc()) {
    $totalAmount = $row['total_amount'];
    $profits[] = [
        'month' => $row['month'],
        'silver_profit' => $row['silver_profit'],
        'gold_profit' => $row['gold_profit'],
        'platinum_profit' => $row['platinum_profit']
    ];
}
?>
