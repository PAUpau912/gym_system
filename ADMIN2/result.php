<?php
if(!isset($_SESSION)){
    session_start();
}
include_once("connections/connection.php");

$connection = connection();
$search = $_GET['search'];

$sql = "SELECT * from members WHERE FirstName LIKE '%$search%' || LastName LIKE '%$search%' ORDER BY MemberID ASC";
$member = $connection->query($sql) or die($connection->error);
$row = $member->fetch_assoc();
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset = "UTF-8">
    <Meta name ="viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content ="ie=edge">
    <title>Result Page</title>
    <link rel = "stylesheet" href = "css/member.css">
    <link rel="icon" href="pics/Section 1.png" type="image/icon type">
    </head>
    <body>
        <form action ="result.php" method = "get">
            <input type = "text" name ="search" id = "search" size = "50" placeholder="Search">
            <button type = "submit" class="search" >Search</button>
            <a href = "add.php" class ="Add">Add Member</a>
        </form>
        <div class = "heading">
            <h1>Member</h1>
            <a href ="dashboard.php" class="Back" >Dashboard</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>MemberID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birthday</th>
                    <th>Gender</th>
                    <th>Coach/Mentor</th>
                    <th>Phone</th>
                    <th>Joining Date</th>
                </tr>
            </thead>
            <tbody>
                <?php do{?>
                <tr>
                <td><?php echo $row['MemberID']; ?></td>
                    <td><?php echo $row['FirstName']; ?></td>
                    <td><?php echo $row['LastName']; ?></td>
                    <td><?php echo $row['Gender']; ?></td>
                    <td><?php echo $row['Birthday']; ?></td>
                    <td><?php echo $row['Coach'];?></td>
                    <td><?php echo $row['Phone'];?></td>
                    <td><?php echo $row['JoiningDate'];?></td>

                    <form action="edit.php" method = "post">
                        <input  type ="hidden" name ="Id" value ="<?php echo $row['MemberID']?>">
                        <td><a href = "edit.php?id=<?php echo $row["MemberID"];?>" class ="edit">Update</td>
                    </form>

                    <form action="delete.php" method = "post">
                        <input type ="hidden" name ="id" value ="<?php echo $row['MemberID']?>">
                        <th><input class ="delete" type ="submit" name = "delete" class = "btn-danger" value = "Delete"></th>
                    </form>
                </tr>
                <?php }while ($row = $member->fetch_assoc())?>
            </tbody>
        </table>
    </body>
</html>