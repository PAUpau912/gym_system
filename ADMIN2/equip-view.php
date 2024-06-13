<?php
if(isset($_SESSION)){
    session_start();
}
include_once("connections/connection.php");
$con = connection();

$search = '';
if (isset($_POST['search'])) {
    $search = $_POST['search'];
}


$sql = "SELECT * FROM equipment";
if ($search != '') {
    $sql .= " WHERE Name LIKE '%$search%' 
              OR EquipType LIKE '%$search%'";
}
$sql .= " ORDER BY EquipmentID ASC";

$equipment = $con->query($sql) or die($con->error);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment</title>
    <link rel="icon" href="images/Section 1.png" type="icon type">
    <link rel="stylesheet" href="css/equip-view.css">
    <style>
        #wtr p{
    position: fixed;
    right: 0;
    bottom: 0;
    text-align: right;
    color: white;
    opacity: 0.5;
    background-color: none;
}
    </style>
</head>

<body>
    <div class=" sidebar">
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
        <h1>VIEW EQUIPMENTS</h1>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Equipment Type</th>
                        <th>Condition Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $equipment->fetch_assoc()):?>
                    <tr>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['SerialNumber']; ?></td>
                        <td><?php echo $row['EquipType']; ?></td>
                        <td><?php echo $row['ConditionType']; ?></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="wtr">
    <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script>
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