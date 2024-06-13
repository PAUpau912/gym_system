<?php
session_start();
include_once("connections/connection.php");
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Sanitize and validate inputs
    $name = filter_input(INPUT_POST, 'Name', FILTER_SANITIZE_STRING);
    $method = filter_input(INPUT_POST, 'PaymentMethod', FILTER_SANITIZE_STRING);
    $selected_plan = filter_input(INPUT_POST, 'MembershipType', FILTER_SANITIZE_STRING);
    
    // Check if selected plan is valid
    $plan_durations = [
        'Silver' => '+1 months',
        'Gold' => '+3 months',
        'Platinum' => '+6 months'
    ];
    
    if (!array_key_exists($selected_plan, $plan_durations)) {
        echo "Invalid membership plan selected.";
        exit();
    }

    // Calculate start and end dates based on selected plan duration
    $start_date = date('Y-m-d'); // Current date
    $end_date = date('Y-m-d', strtotime($plan_durations[$selected_plan])); // End date based on plan duration

    // Define price for each plan
    $prices = [
        'Silver' => 1000,
        'Gold' => 3000,
        'Platinum' => 5000
    ];
    $amount = $prices[$selected_plan];

    if (!$user_id) {
        echo "User ID not found.";
        exit();
    }

    // Use prepared statements to update membership and payment details
    $sql_membership = "UPDATE membership SET membership_type = ?, start_date = ?, end_date = ? WHERE user_id = ?";
    $sql_payment = "UPDATE payments SET amount = ? WHERE user_id = ?";

    $stmt_membership = $conn->prepare($sql_membership);
    $stmt_payment = $conn->prepare($sql_payment);

    if ($stmt_membership && $stmt_payment) {
        $stmt_membership->bind_param("sssi", $selected_plan, $start_date, $end_date, $user_id);
        $stmt_payment->bind_param("si", $method, $user_id);

        // Execute the prepared statements
        if ($stmt_membership->execute() && $stmt_payment->execute()) {
            echo "Membership and payment details updated successfully.";
            // Redirect to a confirmation page or dashboard
            header("Location: client-dashboard.php");
            exit();
        } else {
            echo "Error updating details.";
        }
    } else {
        echo "Error preparing statements.";
    }

    // Close prepared statements and database connection
    $stmt_membership->close();
    $stmt_payment->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" href="images/apex.jpg" type="image/icon type">
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-white shadow p-3 mb-5">
        <div></div>
        <h1 class="text-center">Membership Payment</h1>
        <div></div>
    </header>

    <div class="container">
        <form method="post">
            <div class="form-group">
                <h3 class="text-center">Payment Method</h3>
                <select class="form-control form-control-custom" name="PaymentMethod" id="PaymentMethod"
                    onchange="showPaymentFields()" required>
                    <option value="">Select Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Gcash">Gcash</option>
                    <option value="Maya">Maya</option>
                </select>
            </div>
            <div id="paymentFields"></div>

            <div class="text-center">
                <h2>Please select your Membership Plan:</h2><br>
                <div class="d-flex justify-content-center flex-wrap">
                    <div class="plan-card">
                        <img src="images/silver.webp" class="plan-img">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="silverPlan" name="MembershipType" value="Silver"
                                class="custom-control-input">
                            <label class="custom-control-label" for="silverPlan">Silver Plan</label>
                        </div>
                        <p>Php 1000 good for 1 month</p>
                    </div>
                    <div class="plan-card">
                        <img src="images/gold.webp" class="plan-img">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="goldPlan" name="MembershipType" value="Gold"
                                class="custom-control-input">
                            <label class="custom-control-label" for="goldPlan">Gold Plan</label>
                        </div>
                        <p>Php 3000 good for 3 months</p>
                    </div>
                    <div class="plan-card">
                        <img src="images/platinum.webp" class="plan-img">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="platinumPlan" name="MembershipType" value="Platinum"
                                class="custom-control-input">
                            <label class="custom-control-label" for="platinumPlan">Platinum Plan</label>
                        </div>
                        <p>Php 5000 good for 6 months</p>
                    </div>
                </div>
                <input class="bbt" type="submit" name="submit" value="Submit">
            </div>
        </form>
    </div>
    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <br>
    <script src="js/payment.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
