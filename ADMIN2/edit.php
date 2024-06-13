<?php

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * from members ORDER BY MemberID ASC";
$member = $con->query($sql) or die($con->error);
$row = $member->fetch_assoc();

if(isset($_POST["submit"])){
    $id = $_GET['ID'];

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $birthday = $_POST['birthday']; 
    $gender = $_POST['gender']; 
    $coach = $_POST['coach']; 
    $phone = $_POST['phone'];
    $join = $_POST['join'];

    $sql = "UPDATE members SET FirstName = '$fname',LastName = '$lname',Birthday = '$birthday',Gender = '$gender',Coach = '$coach',Phone= '$phone',JoiningDate = '$join '
    WHERE MemberID = '$id'";
    $con->query($sql) or die($con->error);
    echo header("Location: member.php?id =".$id);
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "UTF-8">
    <Meta name ="viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content ="ie=edge">
    <title>Update Page</title>
    <link rel = "stylesheet" href = "css/add.css">
    <link rel="icon" href="pics/Section 1.png" type="image/icon type">
    </head>
    <body>
        <!-- HEADING -->
        <div class = "heading">
            <img src ="img/pics/Section 1.png">
            <span class=" title">Gym Management System</span>
            <a href ="dashboard.php" class="Back" >Dashboard</a>
        </div>
        <div class="form-container">
            <form method = "post">
                <div class="content">
                    <label>First Name</label>
                    <input type="text" placeholder="First Name" name = "fname"size="55" required><br>
                    <label>Last Name</label>
                    <input type="text" placeholder="Last Name" name = "lname"size="55" required><br>
                    <label>Address</label>
                    <input type="text" placeholder="1234 E. Corner st..." name = "address" size="55" required><br>
                    <label>Contact Number</label>
                    <input type="tel" placeholder="09XX-XXX-XXXX" name = "phone" pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" size="55" required><br>
                    <label>Birthday</label>
                    <input type = "date" name = "birthday" required><br>
                    <label>Gender</label>
                    <select name="gender">
                        <option selected>Choose...</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <label>Height (in cm)</label>
                    <input type="number" name="height" min="160" max="300">
                    <label>Weight (in kg)</label>
                    <input type="number" name="weight" min="45" max="700">
                    <input type="submit" value="Submit" name="submit">

                </div>
            </form>
        </div>
    </body>
</html>