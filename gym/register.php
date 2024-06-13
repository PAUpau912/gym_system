<?php
session_start();

include_once("connections/connection.php");
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is for logging in or registering
    if (isset($_POST['login'])) {
        // Handle login form submission
        $username = $_POST['Name'];
        $password = $_POST['Password'];

        $sql = "SELECT acct_ID, password FROM account WHERE username='$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['acct_ID'];
                header("Location: client-dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }
    } elseif (isset($_POST['register'])) {
        // Handle registration form submission
        $username = $_POST['Name'];
        $password = password_hash($_POST['Password'], PASSWORD_BCRYPT);
        $email = $_POST['Email'];

        $sql = "INSERT INTO account (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            $user_id = $conn->insert_id;
            $_SESSION['user_id'] = $user_id;
            header("Location: registration.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="icon" href="images/apex.jpg" type="icon">
    <link rel="stylesheet" href="./css/join.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- css <source> here -->
    <!-- https://codepen.io/soufiane-khalfaoui-hassani/pen/LYpPWda -->
    <div class="container">
        <div class="login-box">
            <div>
                <form action="join.php" method="post">
                    <div class="flex2">
                        <img class="joinlogo" src="images/join.png" alt="joinlogo">
                        <div>
                            <h1>Register</h1>
                            <h5>use your email for registration.</h5>
                        </div>
                    </div>
                    <br>
                    <div class="user-box">
                        <input type="text" name="Name" id="Name" class="form-control"
                            placeholder="Insert your username:" required>
                    </div>
                    <div class="user-box">
                        <input type="email" name="Email" id="Email" class="form-control"
                            placeholder="Insert your Email here.." required>
                    </div>
                    <div class="user-box">
                        <input type="password" name="Password" class="form-control" id="Password"
                            placeholder="Insert your Password here.." required>
                    </div>
                    <!-- <button class="loginbt" type="submit" name="login">Login</button> -->
                    <input class="regbt" type="submit" name="register" value="Register">
                    <a class="noacc" href="join.php">Back</a>
                </form>
            </div>
        </div>
    </div>

    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
</body>

</html>