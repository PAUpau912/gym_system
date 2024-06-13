<?php
session_start();
 if(isset($_POST["login"])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === 'admin' && $password === 'admin'){
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    }
    else{
        header("Location: admin.php?error=invalid");
        exit;
    }
} 

$invalidusername = isset($_GET['error']) && $_GET['error'] == 'invalid';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" href="images/apex.jpg" type="image/icon type">
    <link rel="stylesheet" href="css/admin.css">
    <style>
    .emailtaken {
        display: none;
        text-align: center;
        color: rgb(255, 0, 0);
        border-radius: 10px;
    }

    .emailtaken.show {
        display: block;
    }
    #wtr p{
    position: fixed;
    right: 0;
    bottom: 0;
    text-align: right;
    color: white;
    opacity: 0.1;
    background-color: none;
}
    </style>
</head>

<body>
    <!-- DEFAULT USERNAME AND PASSWORD IN TO ADMIN ONLY-->
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 500px; box-shadow: 5px 5px 7px grey; border-radius: 25px;">
            <form action="" method="post">
                <div class="text-center mb-4">
                    <img src="images/apex.jpg" class="mb-3" style="width: 125px;">
                </div>
                <div class="form-group text-center">
                    <label for="username">Username</label>
                    <input type="text" class="form-control mx-auto" id="username" name="username"
                        placeholder="Insert Username:" required style="width: 70%;">
                </div>
                <div class="form-group text-center">
                    <label for="password">Password</label>
                    <input type="password" class="form-control mx-auto" id="password" name="password"
                        placeholder="Insert Password:" required style="width: 70%;">
                </div>
                <span class="emailtaken <?php echo $invalidusername ? 'show' : ''; ?>">
                    Invalid username or password.
                </span>

                <div class="d-flex justify-content-center">
                    <button type="submit" name="login" class="btn btn-primary w-50">Login</button>
                </div>
            </form>
        </div>
    </div>
    <div id="wtr">
    <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>