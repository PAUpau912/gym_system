<?php
include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * from coach ORDER BY CoachID ASC";
$coach = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach</title>
    <link rel="stylesheet" href="css/coach.css">
    <link rel="icon" href="images/Section 1.png" type="icon">
    <style>
        #wtr p{
        position: fixed;
        right: 0;
        bottom: 0;
        text-align: right;
        color: white;
        opacity: 0.2;
        background-color: none;
    }
    </style>
</head>

<body>
    <!--HEADING-->
    <!-- <div class = "heading">
            <span>Coach</span>
            <h1>Gym Management System</h1>
            <a href ="dashboard.php" class="Back" >Dashboard</a>
        </div> -->
    <!--CONTAINER PER MEMBER CLIENT-->
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
        <a class="sbt" id ="logout" href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>LIST OF COACH</h1>
        <div class="CONT">
            <?php while ($row = $coach->fetch_assoc()): ?>
            <div class="container">
                <div clas="cont">
                    <div class="picture-container">
                        <img class="profile-image"
                            src="data:image/jpeg;base64,<?php echo base64_encode($row['image']) ?>"
                            alt="Profile Image" />
                    </div>
                </div>
                <div class="info">
                    <label>Name:</label>
                    <span><?php echo $row['Name']; ?></span><br>
                    <label>Contact:</label>
                    <span><?php echo $row['phone']; ?></span><br>
                    <label>Email:</label>
                    <span><?php echo $row['email']; ?></span><br>
                    <label>Specialization:</label>
                    <span><?php echo $row['specialization']; ?></span><br>
                    <label>Gender:</label>
                    <span><?php echo $row['gender']; ?></span><br>
                    <label>Appplication Date:</label>
                    <span><?php echo $row['application_date']; ?></span><br>

                </div>
                <div class="Buttons">
                    <form action="editcoach.php" method="post">
                        <input type="hidden" name="ID" value="<?php echo $row['CoachID']; ?>">
                        <input type="submit" class="ID" value="Edit">
                    </form>
                    <form action="deletecoach.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['CoachID']; ?>">
                        <input class="delete" type="submit" name="delete" value="Delete">
                    </form>
                </div>
            </div>
        </div>
        <div id="wtr">
            <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
        </div>
        <?php endwhile; ?>
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