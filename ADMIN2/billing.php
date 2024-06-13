<?php
include_once("connections/connection.php");
$con = connection();

$sql = "SELECT payments.id, payments.amount,
 membership.membership_type,
payments.payment_date,
account.username
 FROM payments
 INNER JOIN membership ON payments.id = membership.id
 INNER JOIN account ON account.acct_ID = payments.id";
$member = $con->query($sql) or die($con->error);
$row = $member->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
    <link rel="icon" href="images/Section 1.png" type="icon">
    <link rel="stylesheet" href="css/bill.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="sidebar">
    <div class="logo">
        <img src="images/apex.jpg" class="d-block mx-auto" alt="Centered Image">
        <h6>Apex Vitality Hub</h6>
    </div>
        <a class="sbt" href="dashboard.php">Dashboard</a>
        <a class="sbt" href="member.php">Member</a>
        <a href="#" onclick="toggleSubMenu('couch')">Coach</a>
        <div id="couchSubMenu" class="sub-menu">
            <a href="coach.php">List</a>
            <a href="AddCoach.php">New Member</a>
        </div>
        <a href="billing.php">Billing</a>
        <a href="#" onclick="toggleSubMenu('equipment')">Equipment</a>
        <div id="equipmentSubMenu" class="sub-menu">
            <a href="equip-view.php">List</a>
            <a href="equipment.php">Add Equipment</a>
        </div>
        <a class="sbt" href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>VIEW BILLING</h1>
        <div class="text-right">
            <button class="buttonpr btn btn-primary print-btn" onclick="printPage()">Print</button>
        </div>
        
        <div class="printableTable table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Name</th>
                        <th>Membership Type</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $member->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['membership_type']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td>
                            <?php
                            $date = new DateTime($row['payment_date']);
                            echo $date->format('F j, Y');
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="watermark">
    <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script>
    function printPage() {
        window.print();
    }

    function toggleSubMenu(menuId) {
        var subMenu = document.getElementById(menuId + 'SubMenu');
        if (subMenu.style.display === 'block') {
            subMenu.style.display = 'none';
        } else {
            subMenu.style.display = 'block';
        }
    }
    </script>
</body>

</html>
