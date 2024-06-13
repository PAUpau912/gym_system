<?php
include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $serial = $_POST['sn'];
    $type = $_POST['type'];
    $condition = $_POST['condition'];

    $sql = "INSERT INTO `equipment`(`Name`,`SerialNumber`,`EquipType`,`ConditionType`) 
    VALUES('$name','$serial','$type','$condition')";
    $con->query($sql) or die($con->error);
    echo header("equip-view.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment</title>
    <link rel="icon" href="images/Section 1.png" type="image/icon type">
    <link rel="stylesheet" href="css/equip.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #wtr p{
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
    <!-- <div class="head-container">
        <img src="images/Section 1.png">
        <h1>Equipment</h1>
        <a href="dashboard.php">Dashboard</a>
    </div> -->
    <div class=" sidebar">
    <div class="logo" >
        <img src="images/apex.jpg" class="d-block mx-auto" width="50px" alt="Centered Image">
        <h6>Apex Vitality Hub</h6>
    </div>
        <a href="dashboard.php">Dashboard</a>
        <a href="member.php">Member</a>
        <a href="#" onclick="toggleSubMenu('coach')">Coach</a>
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
        <h1 class="text-center">ADD EQUIPMENTS</h1>
        <div class="form_container">
            <form method="post" class="p-4 rounded">
                <div class="form-group">
                    <label class="text-white font-weight-bold">Equipment Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Equipment Name" size="40" required>
                </div>

                <div class="form-group">
                    <label class="text-white font-weight-bold">Serial Number</label>
                    <input type="text" name="sn" class="form-control" pattern="[A-Za-z]{2}-\d{4}" size="40"
                        placeholder="TM-1001">
                </div>

                <div class="form-group">
                    <label class="text-white font-weight-bold">Equipment Type</label>
                    <select name="type" class="form-control">
                        <option>Cardiovascular Equipment</option>
                        <option>Strength Training Equipment</option>
                        <option>Functional Training Equipment</option>
                        <option>Flexibility and Mobility Equipment</option>
                        <option>Accessories</option>
                        <option>Cardio Group Equipment</option>
                        <option>Recovery and Wellness Equipment</option>
                        <option>Specialized Equipment</option>
                    </select>
                </div>

                <label class="text-white font-weight-bold">Condition</label>
                <div class="form-group">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="condition" value="New">
                        <label class="form-check-label text-white">New</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="condition" value="Refurbished">
                        <label class="form-check-label text-white">Refurbished</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="condition" value="Used">
                        <label class="form-check-label text-white">Used (Good Condition)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="condition" value="Used">
                        <label class="form-check-label text-white">Used (Fair Condition)</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="condition" value="Defective">
                        <label class="form-check-label text-white">Defective</label>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-danger btn-block font-weight-bold">Submit</button>
            </form>

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
    <script src="js/payment.js"></script>
</body>

</html>