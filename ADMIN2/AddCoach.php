<?php
include_once("connections/connection.php");
$conn = connection();

if(isset($_POST["submit"])){
    $name = $_POST['name'];
    $contact = $_POST['phone'];
    $email = $_POST['Email']; 
    $specialization = $_POST['Specialization'];
    $gender = $_POST['gender'];
    $app = $_POST['Date_Applied'];
    
    $imagename = $_FILES['image']['name'] ?? '';
    $imageTemp = $_FILES['image']['tmp_name'] ?? '';

    if($imageTemp){
        $imageData = file_get_contents($imageTemp);
    } else {
        $imageData = null;
    }

    $sql = $conn->prepare("INSERT INTO coach (Name, phone, email, specialization, gender, application_date, image) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssssss", $name, $contact, $email, $specialization, $gender, $app, $imageData);

    if ($sql->execute()) {
        header("Location: coach.php");
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Coach Member</title>
    <link rel="stylesheet" href="css/addcoach.css">
    <link rel="icon" href="images/Section 1.png" type="icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #wtr p{
    position: fixed;
    right: 0;
    top: 0;
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
        <a class="sbt" href="logout.php">Logout</a>
    </div>
    <div class="content">
        <form id="container" action="" method="post" enctype="multipart/form-data">
            <div class="upload">
                <div class="pic-container">
                    <img id="preview" class="profile-image" src="#" alt="Image" style="display:none;">
                </div><br>
                <label for="image">Select Image:</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="container mt-5">
                <div class="form-group">
                    <label for="fname">Name</label>
                    <input type="text" class="form-control" id="fname" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Contact Number (09XX-XXXX-XXX or +63 9XX-XXXX-XXX)</label>
                    <input type="text" class="form-control" id="phone" name="phone" pattern="[0-9]{4}-[0-9]{4}-[0-9]{3}" placeholder="09XX-XXXX-XXX or +63 9XX-XXXX-XXX" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="Email" placeholder="abc@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option selected>Choose...</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Date_Applied">Application Date</label>
                    <input type="date" class="form-control" id="Date_Applied" name="Date_Applied" required>
                </div>
                <div class="form-group">
                    <label for="special">Specialization</label>
                    <input type="text" class="form-control" id="special" name="Specialization" placeholder="Specialization" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
            </div>
        </form>
    </div>
    <div id="wtr">
    <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
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
