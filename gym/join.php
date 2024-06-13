<?php
session_start();

include_once("connections/connection.php");
$conn = connection();

$invalidpass = false;
$nouserfound = false;
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
                $invalidpass = true;
            }
        } else {
            $nouserfound = true;
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
    <style>
    .papup-span {
        position: fixed;
        top: 67%;
        left: 50%;
        transform: translate(-50%, -200%);
        opacity: 0;
        z-index: 9999;
        transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .papup-span.show {
        transform: translate(-50%, -50%);
        opacity: 1;
    }
    </style>
</head>

<body onload="showPopupSpan()">

    <div class="container">

        <div class="login-box">
            <div>

                <form action="join.php" method="post">

                    <div class="flex2">
                        <img class="joinlogo" src="images/join.png" alt="joinlogo">
                        <div>
                            <h1>Login</h1>
                            <h5>Welcome gym member.</h5>
                        </div>
                    </div>
                    <br>
                    <div class="user-box">
                        <input type="text" name="Name" id="Name" class="form-control" placeholder="Username:" required>
                    </div>
                    
                    <span class="emailtaken"
                        style="<?php echo $nouserfound ? 'text-align: center; display:block; color:red;' : 'display:none;'; ?>">
                        no user found.
                    </span>
                    
                    <div class="user-box">
                        <input type="password" name="Password" class="form-control" id="Password"
                            placeholder="Password:" required>
                    </div>
                    
                    <span class="emailtaken"
                        style="<?php echo $invalidpass ? 'text-align: center; display:block; color:red;' : 'display:none;'; ?>">
                        wrong password.
                    </span>
                    <div class="forgot-container">
                        <a class="forgot" href="forgot.php">Forgot password?</a><br>
                    </div>

                    <div class="papup-span">
                    </div>
                    <button class="loginbt" type="submit" name="login">Login</button>
                    <!-- <input class="regbt" type="submit" name="register" value="Register"> -->
                    <a class="noacc" href="register.php">Don't have account?</a>
                </form>

            </div>

        </div>

    </div> 
    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
</body>
<script>
function showPopupSpan() {
    var popupSpan = document.querySelector(".papup-span");
    if (popupSpan) {
        popupSpan.classList.add("show");
        setTimeout(function() {
            popupSpan.classList.remove("show");
        }, 3000); // 3000 milliseconds = 3 seconds
    }
}
showPopupSpan();
</script>

</html>