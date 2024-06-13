<?php
include_once("connections/connection.php");
include("count.php");
include("coachcount.php");
include("total.php");
include("today.php");

$conn = connection();

// Prepare data for charts
$profits = json_encode($profits);

$attendanceChartData = json_encode([
    'Monday' => 50,
    'Tuesday' => 60,
    'Wednesday' => 40,
    'Thursday' => 70,
    'Friday' => 90,
    'Saturday' => 30,
    'Sunday' => 20
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="images/apex.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, rgb(226, 226, 226), rgb(201, 214, 255));
        }

        .sidebar {
            height: 100vh;
            width: 180px;
            background-color: rgba(90, 178, 255, 0.822);
            padding: 10px;
            position: fixed;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #000000;
            display: block;
            text-transform: uppercase;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sub-menu {
            display: none;
            background-color: rgb(226, 226, 226);
        }

        .sub-menu a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            color: rgb(0, 0, 0);
        }

        .sub-menu a:hover {
            color: rgba(90, 178, 255, 0.822);
        }

        .content {
            margin-left: 200px;
            padding: 20px;
        }

        .card {
            margin: 20px;
        }

        .chart-container {
            height: 400px;
        }
        .logo img {
    width: 50px; /* Set image width */
    margin: auto;
}
#watermark p{
    position: fixed;
    right: 0;
    bottom: 0;
    text-align: right;
    color: white;
    opacity: 0.1;
    background-color: none;
}

    </style>
</head>
<body>
    <div class="sidebar">
    <div class="logo">
        <img src="images/apex.jpg" class="d-block mx-auto" alt="Centered Image">
        <h6>Apex Vitality Hub</h6>
    </div>
        <a class="sbt" href="dashboard.php">Dashboard</a>
        <a class="sbt" href="member.php">Member</a>
        <a href="#" onclick="toggleSubMenu('coach')">Coach</a>
        <div id="coachSubMenu" class="sub-menu">
            <a href="coach.php">List</a>
            <a href="AddCoach.php">New Member</a>
        </div>
        <a href="billing.php">Billing</a>
        <a href="#" onclick="toggleSubMenu('equipment')">Equipment</a>
        <div id="equipmentSubMenu" class="sub-menu">
            <a href="equip-view.php">List</a>
            <a href="equipment.php">Add Equipment</a>
        </div>
        <a class="sbt" id="logout" href="logout.php">Logout</a>
    </div>
    <div class="content">
        <div class="container-fluid">
            <h1 class="text-center">Dashboard</h1>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">Total Profit</h5>
                            <p class="card-text">Php <?php echo number_format($totalAmount, 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center bg-info">
                        <div class="card-body">
                            <h5 class="card-title">Total Members</h5>
                            <p class="card-text"><?php echo $total_members; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center bg-success">
                        <div class="card-body">
                            <h5 class="card-title">Total Coaches</h5>
                            <p class="card-text"><?php echo $totalCOACH; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card text-center bg-danger">
                        <div class="card-body">
                            <h5 class="card-title">Today's Sales</h5>
                            <p class="card-text">Php <?php echo number_format($total_sales_today, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6 chart-container">
                    <canvas id="profitChart"></canvas>
                </div>
                <div class="col-lg-6 chart-container">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div id="watermark">
    <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleSubMenu(menuId) {
            var subMenu = document.getElementById(menuId + 'SubMenu');
            subMenu.style.display = subMenu.style.display === 'block' ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', function () {
            var profits = <?php echo $profits; ?>;
            var months = profits.map(function(profit) { return new Date(0, profit.month - 1).toLocaleString('default', { month: 'long' }); });
            var silverProfits = profits.map(function(profit) { return profit.silver_profit; });
            var goldProfits = profits.map(function(profit) { return profit.gold_profit; });
            var platinumProfits = profits.map(function(profit) { return profit.platinum_profit; });

            var ctx = document.getElementById('profitChart').getContext('2d');
            var profitChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Silver',
                            data: silverProfits,
                            backgroundColor: 'rgba(192, 192, 192, 0.5)',
                            borderColor: 'rgba(192, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Gold',
                            data: goldProfits,
                            backgroundColor: 'rgba(255, 215, 0, 0.5)',
                            borderColor: 'rgba(255, 215, 0, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Platinum',
                            data: platinumProfits,
                            backgroundColor: 'rgba(229, 228, 226, 0.5)',
                            borderColor: 'rgba(229, 228, 226, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var attendanceChartData = <?php echo $attendanceChartData; ?>;
            var ctxAttendance = document.getElementById('attendanceChart').getContext('2d');
            var attendanceChart = new Chart(ctxAttendance, {
                type: 'line',
                data: {
                    labels: Object.keys(attendanceChartData),
                    datasets: [{
                        label: 'Attendance',
                        data: Object.values(attendanceChartData),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        function updateDashboardData() {
            fetch('updateData.php')
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.card-text.totalProfit').innerText = `Php ${parseFloat(data.totalProfit).toFixed(2)}`;
                    document.querySelector('.card-text.totalMembers').innerText = data.totalMembers;
                    document.querySelector('.card-text.totalCoaches').innerText = data.totalCoaches;
                    document.querySelector('.card-text.todaySales').innerText = `Php ${parseFloat(data.todaySales).toFixed(2)}`;
                    
                    // Update charts if necessary
                    profitChart.data.datasets[0].data = data.silverProfits;
                    profitChart.data.datasets[1].data = data.goldProfits;
                    profitChart.data.datasets[2].data = data.platinumProfits;
                    profitChart.update();

                    // Add logic to update other charts if necessary
                })
                .catch(error => console.error('Error updating dashboard data:', error));
        }

        // Call the update function on page load or at regular intervals
        document.addEventListener('DOMContentLoaded', updateDashboardData);
        setInterval(updateDashboardData, 60000); // Update every 60 seconds
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
