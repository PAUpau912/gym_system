<?php
session_start();

include_once("connections/connection.php");
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $first_name = $_POST['first_name']?? '';
    $last_name = $_POST['last_name']?? '';
    $gender = $_POST['gender']?? '';
    $birthday = $_POST['birthday']?? '';
    $height = $_POST['height']?? 0; 
    $weight = $_POST['weight']?? 0;
    $number = $_POST['phone'];
    $address = $_POST['full_address']?? '';
    $join = $_POST['joiningdate']?? '';
    
    $imagename = $_FILES['image']['name']?? '';
    $imageTemp = $_FILES['image']['tmp_name']?? '';

    $imageData = file_get_contents($imageTemp);

    $stmt = $conn->prepare("INSERT INTO member(user_id, FIRSTNAME,LASTNAME, GENDER,BIRTHDAY,HEIGHT,WEIGHT,CONTACT,ADDRESS,JOINING_DATE,IMAGE) 
    VALUES (?, ?, ?, ?, ?,?,?,?,?,?,?) ");
    $stmt->bind_param("issssiissss", $user_id, $first_name, $last_name, $gender,$birthday,$height,$weight,$number,$address,$join, $imageData);

    if ($stmt->execute()) {
        header("Location: payment.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="icon" href="images/apex.jpg" type="image/icon type">
    <link rel = "stylesheet" href = "css/registration.css">
<!--Bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <!--JQuery-->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1 class="regtt">REGISTRATION FORM</h1>
    <br>
    <form id="container" action="" method="post" enctype="multipart/form-data">
        <div class="info-container">
            <h4>PERSONAL INFORMATION:</h4>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <!-- Change col-md-4 to col-md-6 -->
                    <label for="exampleFormControlInput1" class="form-label">First Name</label>
                    <input type="text" name="first_name" placeholder="Input your first name here.."
                        class="phone form-control" required>
                    <!-- Change name attribute to "last_name" -->
                </div>

                <div class="col-sm-12 col-md-6">
                    <!-- Change col-md-4 to col-md-6 -->
                    <label for="exampleFormControlInput1" class="form-label">Last Name</label>
                    <input type="text" name="last_name" placeholder="Input your last name here.." class="form-control"
                        size="30" required>
                    <!-- Change name attribute to "first_name" -->
                </div>
            </div>

            <!-- <div class="row">
                <label for="exampleFormControlInput1" class="form-label">First Name:</label>
                <input type="text" name="first_name" placeholder="Input your first name here.."
                    class="phone form-control" required>
                <label for="exampleFormControlInput1" class="form-label">Last Name:</label>
                <input type="text" name="last_name" placeholder="Input your last name here.." class="form-control"
                    size="30" required><br>
            </div> -->
            <div class="row">
                <div class="col-sm-12 col-md-3">
                    <!-- Each column takes 3 units on medium and larger devices -->
                    <label for="exampleFormControlInput1" class="form-label">Gender</label>
                    <select name="gender" class="form-control-md" style="width: 200px;">
                        <option selected>Choose</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="col-sm-12 col-md-3">
                    <!-- Each column takes 3 units on medium and larger devices -->
                    <label for="exampleFormControlInput1" class="form-label">Birthday</label>
                    <input type="date" class="form-control-md" name="birthday" required>
                </div>

                <div class="col-sm-12 col-md-3">
                    <label for="exampleFormControlInput1" class="form-label">Height</label>
                    <input type="number" name="height" class="form-control-md" placeholder="cm" min="55" max="500"
                        required>
                </div>

                <div class="col-sm-12 col-md-3">
                    <label for="exampleFormControlInput1" class="form-label">Width</label>
                    <input type="number" name="weight" class="form-control-md" placeholder="in kg" min="44" max="150"
                        required>
                </div>
            </div>

            <!-- <label>Gender</label>
            <select name="gender" class="form-control-md" style="width: 200px;">
                <option selected>Choose</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select> -->
            <!-- <label>Birthday: </label>
            <input type="date" name="birthday" required>
            <label>Height: </label>
            <input type="number" name="height" placeholder="cm" min="55" max="500" required><br>
            <label>Weight</label>
            <input type="number" name="weight" placeholder="in kg" min="44" max="150" required> -->
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <!-- Change col-md-4 to col-md-6 -->
                    <label for="exampleFormControlInput1" class="form-label">Joining Date</label>

                    <input type="date" name="joiningdate" required>
                </div>

                <div class="col-sm-12 col-md-6">
                    <!-- Change col-md-4 to col-md-6 -->
                    <label for="exampleFormControlInput1" class="form-label">Contact Number:</label>
                    <input type="text" pattern="\d*" class="phone" name="phone" id="numberInput" placeholder="+639/09"
                        class="form-control-md" maxlength="11" required>
                    <!-- Change name attribute to "first_name" -->
                </div>
            </div><br>
            <!-- <label>Joining Date</label>
            <input type="date" name="joiningdate" required><br>
            <label>Contact Number:</label>
            <input type="text" pattern="\d*" class="phone" name="phone" id="numberInput" placeholder="+639/09"
                class="form-control-md" required><br>
            <br> -->
            <h4>ADDRESS:</h4>
            <div class="address-container">
                <label for="street-text" class="form-label">Street Name:</label>
                <input type="text" class="form-control-md" size="35" name="street_text" id="street-text">

                <label class="form-label">Region:</label>
                <select name="region" class="form-control-md" style="width: 300px;" id="region"></select><br>
                <input type="hidden" class="form-control-md" name="region_text" id="region-text" required>

                <label class="form-label">Province:</label>
                <select name="province" class=" form-control-md" id="province"></select>
                <input type="hidden" class=" form-control-md" name="province_text" id="province-text" required>

                <label class="form-label">City / Municipality *</label>
                <select name="city" class="form-control-md" id="city"></select>
                <input type="hidden" class="form-control-md" name="city_text" id="city-text" required><br>

                <label class="form-label">Barangay:</label>
                <select name="barangay" class="form-control-md" id="barangay"></select>
                <input type="hidden" class="form-control-md" name="barangay_text" id="barangay-text" required>
            </div>

            <label for="image">Select Image:</label>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <!-- Hidden input for the full address -->
            <input type="hidden" name="full_address" id="full-address">
            <input type="submit" name="submit" value="SUBMIT">
        </div>
    </form>
    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
</body>
<script src="js/ph-address-selector.js"></script>
<script>
        // Function to update the full address field before form submission
        function updateFullAddress() {
            const regionText = document.getElementById('region').selectedOptions[0].text;
            const provinceText = document.getElementById('province').selectedOptions[0].text;
            const cityText = document.getElementById('city').selectedOptions[0].text;
            const barangayText = document.getElementById('barangay').selectedOptions[0].text;
            const streetText = document.getElementById('street-text').value;

            const fullAddress = `${streetText}, ${barangayText}, ${cityText}, ${provinceText}, ${regionText}`;
            document.getElementById('full-address').value = fullAddress;
        }

        // Attach the updateFullAddress function to the form's submit event
        document.getElementById('container').addEventListener('submit', updateFullAddress);
    </script>
</html>