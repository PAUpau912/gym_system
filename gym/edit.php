<?php
include_once("connections/connection.php");
$con = connection();

$id = $_GET['ID'];
$sql = "SELECT * FROM member ORDER BY MemberID ASC LIMIT 1";
$result = $con->query($sql);
$row = $result->fetch_assoc();


if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $height = $_POST['height']; 
    $weight = $_POST['weight'];
    $phone = formatPhoneNumber($_POST['phone']);
    $address = $_POST['address'];
    $join = $_POST['joiningdate'];
    
    // Check if a new picture was uploaded
    if ($_FILES['image']['name']) {
        $picture = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($picture);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        // Update query with picture
        $sql = "UPDATE member SET FirstName='$fname',LastName='$lname', Gender='$gender', Birthday='$birthday',Height = '$height', Weight = '$weight',Contact = '$contact',Address = '$address',Joining_Date = '$join',image='$picture' WHERE MemberID='$id'";
    } else {
        // Update query without picture
        $sql = "UPDATE member SET FirstName='$fname',LastName='$lname', Gender='$gender', Birthday='$birthday',Height = '$height', Weight = '$weight',Contact = '$contact',Address = '$address',Joining_Date = '$join' WHERE MemberID='$id'";
    }

    if ($con->query($sql) === TRUE) {
        header("Location: client-dashboard.php?ID=" . $id);
        exit();
    } else {
        die("Error updating record: " . $con->error);
    }

    function formatPhoneNumber($phone) {
        // Remove non-numeric characters
        $numeric_number = preg_replace("/[^0-9]/", "", $phone);
    
        // Check if the number starts with "0" or "63" and format accordingly
        if (substr($numeric_number, 0, 1) === "0") {
            return substr_replace($numeric_number, "-", 4, 0);
        } elseif (substr($numeric_number, 0, 2) === "63") {
            return "+" . substr_replace($numeric_number, " ", 2, 0);
        } else {
            return $phone; // Return original number if format doesn't match
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="css/registration.css"> 
    <script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

</head>
<body>
    <div class="heading"><h1>UPDATE FORM</h1></div><br>
        <form id = "container" action="" method="post" enctype="multipart/form-data">
            
            <div class="upload">
                <div class="pic-container">
                    <img id="preview" class="profile-image" src="#" alt="Image">
                </div><br>
                <label for="image">Select Image:</label>
                <input type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">  
            </div>
            
            <div class="info-container">
                 <label>First Name</label>
                <input type = "text" name ="fname" placeholder = "First Name" size="65" required><br>
                <label>Last Name</label>
                <input type = "text" name ="lname" placeholder = "Last Name" size="65" required><br>

                <label>Gender</label>
                <select name = "gender">
                    <option selected>Choose....</option>
                    <option value = "Male">Male</option>
                    <option value = "Female">Female</option>
                </select>
                <label>Birthday</label>
                <input type = "date" name ="birthday" required>
                <label>Height</label>
                <input type = "number" name ="height" placeholder = "cm" min="55" max="500" required><br>
                <label>Weight</label>
                <input type = "number" name ="weight" placeholder = "in kg" min="44" max="150" required>
                <label>Joining Date</label>
                <input type = "date" name ="joiningdate" required><br>
                <label>Contact Number (09XX-XXXX-XXX or +63 9XX-XXXX-XXX)</label>
                <input type="text" class="phone" name="phone" id="phone" placeholder="09XX-XXXX-XXX or +63 9XX-XXXX-XXX" required size ="65"><br>

                <label>Address</label><br>
                <input type = "text" name ="address" placeholder = "Address" required size = "65"><br>

                <input type = "submit" name = "submit" value = "Submit">
            </div>
        </form>
        <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
        <script>
        // Function to format the contact number as the user types
        function formatPhoneNumber(input) {
            let value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
            let formattedValue = '';

            if (value.startsWith('0')) {
                formattedValue = value.replace(/(\d{4})(\d{3})(\d{3})/, '0$1-$2-$3'); // Format as 09XX-XXXX-XXX
            } else if (value.startsWith('63')) {
                formattedValue = value.replace(/(\d{2})(\d{3})(\d{3})(\d{3})/, '+$1 $2-$3-$4'); // Format as +63 9XX-XXXX-XXX
            } else {
                formattedValue = value; // If no match, keep the original value
            }

            input.value = formattedValue;
        }
    </script>
</body>
</html>