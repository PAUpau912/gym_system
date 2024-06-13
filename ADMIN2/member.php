<?php
include_once("connections/connection.php");
$con = connection();

$sql = "SELECT *,membership.membership_type from member
JOIN membership ON member.user_id = membership.id ";
$member = $con->query($sql);
?>

<html>

<head>
    <meta charset="UTF-8">
    <Meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member Page</title>
    <link rel="stylesheet" href="css/member.css">
    <link rel="icon" href="images/Section 1.png" type="image/icon type">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    #watermark p{
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
            <span>Member</span>
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
        <a class="sbt" id="logout" href="logout.php">Logout</a>

    </div>
    <div class="content">
        <h1> MEMBERS LIST</h1>
        <div class="CONT overflow-auto">
            <?php while ($row = $member->fetch_assoc()): ?>
        <div class="container">
                <div class="picture">
                    <img class="profile-image" src="data:image/jpeg;base64,<?php echo base64_encode($row['IMAGE']) ?>"
                        alt="Profile Image" />
                </div>
                <div class="info">
                    <label>Name:</label>
                    <span><?php echo $row['FIRSTNAME']; ?></span>
                    <span><?php echo $row['LASTNAME']; ?></span> <br>
                    <label>Gender:</label>
                    <span><?php echo $row['GENDER']; ?></span><br>
                    <label>Birthday:</label>
                    <span><?php echo $row['BIRTHDAY']; ?></span><br>
                    <label>Height:</label>
                    <span><?php echo $row['HEIGHT']; ?></span><br>
                    <label>Weight:</label>
                    <span><?php echo $row['WEIGHT']; ?></span> <br>
                    <label>Contact:</label>
                    <span><?php echo $row['CONTACT']; ?></span><br>
                    <label>Address:</label>
                    <span><?php echo $row['ADDRESS']; ?></span><br>
                    <label>Membership Type:</label>
                    <span><?php echo $row['membership_type'];?></span>
                </div>
                <div class="Buttons text-center">
                    <div class="col-6 mx-auto">
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input class="delete btn btn-danger" type="submit" name="delete" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>



    </div>
    <div id="watermark">
    <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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