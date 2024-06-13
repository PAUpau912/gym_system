<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

include_once("connections/connection.php");
$conn = connection();


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id =$_SESSION['user_id'];
    $name = $_SESSION['Name']??'';
    $session = $_POST['session']??'';
    $coach = $_POST['coach']??'';
    $date = $_POST['date']??'';
    $time_in = $_POST['time_in']??'';
    $time_out = $_POST['time_out']??'';
    $status = 'PRESENT';

    $sql = $conn->prepare("INSERT INTO attendance (user_id, NAME, SESSIONNAME, COACHNAME, DATE, TIME_IN, TIME_OUT, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("isssssss", $user_id, $name, $session, $coach, $date, $time_in, $time_out, $status);

    if ($sql->execute()) {
        header("Location: client-dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql->error;
    }

    $sql->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="icon" href="images/Section 1.png" type="icon">
    <link rel="stylesheet" href="css/attendance.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="col-12 heading text-center">
        <h1>ATTENDANCE FORM</h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <form action="attendance.php" method="POST">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="fullName" name="Name" placeholder="Full Name"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="sessionSelect" class="form-label">Session</label>
                        <select class="form-select" id="sessionSelect" name="session" required>
                            <option selected>Choose...</option>
                            <option value="Cardio">Cardio</option>
                            <option value="Strength">Strength Training</option>
                            <option value="HIIT">High-Intensity Interval Training</option>
                            <option value="Functional">Functional Training</option>
                            <option value="Flex">Flexibility and Balance</option>
                            <option value="Personal">Personal Training</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="coachName" class="form-label">Coach</label>
                        <input type="text" class="form-control" id="coachName" name="coach" placeholder="Coach Name"
                            required>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="dateInput" class="form-label">Date</label>
                            <input type="date" class="form-control" id="dateInput" name="date" required>
                        </div>
                        <div class="col">
                            <label for="timeInInput" class="form-label">Time In</label>
                            <input type="time" class="form-control" id="timeInInput" name="time_in" required>
                        </div>
                        <div class="col">
                            <label for="timeOutInput" class="form-label">Time Out</label>
                            <input type="time" class="form-control" id="timeOutInput" name="time_out" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>