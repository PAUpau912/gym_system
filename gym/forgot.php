<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="icon" href="images/Section 1.png" type="icon">
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
                            <h1>Update</h1>
                            <h5>use your email for update.</h5>
                        </div>
                    </div>
                    <br>
                    <div class="user-box">
                        <input type="text" name="Name" id="Name" class="form-control"
                            placeholder="Insert your email:" required>
                    </div>
                    <div class="user-box">
                        <input type="email" name="Email" id="Email" class="form-control"
                            placeholder="Update your Username here.." required>
                    </div>
                    <div class="user-box">
                        <input type="password" name="Password" class="form-control" id="Password"
                            placeholder="Update your Password here.." required>
                    </div>
                    <!-- <button class="loginbt" type="submit" name="login">Login</button> -->
                    <input class="regbt" type="submit" name="register" value="Register">
                    <a class="noacc" href="join.php">Back</a>
                </form>
            </div>
        </div>
    </div>

</body>

</html>