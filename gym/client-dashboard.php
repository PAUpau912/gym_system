<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: join.php");
    exit();
}

include_once("connections/connection.php");
$conn = connection();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT *, a.username, a.email, m.FIRSTNAME, m.LASTNAME, m.BIRTHDAY, m.ADDRESS 
        FROM account a 
        JOIN member m ON a.acct_ID = m.user_id 
        WHERE a.acct_ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$sql = "SELECT membership_type, start_date, end_date FROM membership WHERE user_id='$user_id'";
$result = $conn->query($sql);
$membership = $result->fetch_assoc();

$sql = "SELECT *,date,status FROM attendance WHERE user_id='$user_id'";
$attendance_result = $conn->query($sql);
$attendance_records = [];
while ($row = $attendance_result->fetch_assoc()) {
    $attendance_records[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="images/apex.jpg" type="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/client.css">
</head>

<body>

    <!--HEADING-->
    <header class="d-flex justify-content-between align-items-center p-2 bg-light shadow">
        <img src="images/apex.jpg" alt="image" class="img-fluid" style="width: 50px; border-radius:50%;">
        <h1 class="mb-0">Dashboard</h1>
        <a class="logout text-decoration-none font-weight-bold h4" href="logout.php">Logout</a>
    </header>

    <!--CONTENT SECTIONS-->
    <div id="main-content" class="container mt-4">
        <div class="row">
            <!-- Profile Info -->
            <div class="col-md-6">
                <div class="profile-info p-2 border border-black bgprof">
                    <h2 class="profilett">Profile Info:</h2>
                    <?php if($user): ?>
                    <h3 class="wel text-center">Welcome, <?php echo htmlspecialchars($user['username']); ?></h3>
                    <?php endif;?>
                    <div class="prof-cont row">
                        <div class="col-md-4 text-center">
                            <div class="profile-image mx-auto my-2">
                                <img class="profile-pic rounded-circle border border-secondary shadow"
                                    src="data:image/jpeg;base64,<?php echo base64_encode($user['IMAGE']); ?>"
                                    alt="Profile Image" />
                            </div>
                            <div class="update">
                                <a href="update.php"><button class="btn btn-primary btn-block mt-2">UPDATE
                                        PROFILE</button></a>
                            </div>
                        </div>
                        <?php if ($user): ?>
                        <div class="col-md-8 member-info">
                            <p>First Name: <?php echo htmlspecialchars(ucwords(strtolower($user['FIRSTNAME'])));?></p>
                            <p>Last Name: <?php echo htmlspecialchars(ucwords(strtolower($user['LASTNAME']))); ?></p>
                            <p>Gender: <?php echo htmlspecialchars(ucwords(strtolower($user['GENDER'])));?></p>
                            <p>Birthday:
                                <?php
                                    $birthday = new DateTime($user['BIRTHDAY']);
                                    echo $birthday->format('F j, Y'); 
                                ?>
                            </p>
                            <p>Contact:
                                <?php
                                    $contacts = explode(',', $user['CONTACT']);
                                    foreach ($contacts as $contact) {
                                        echo htmlspecialchars(trim($contact)) . '<br>';
                                    }
                                ?>
                            </p>
                            <p>Address: <?php echo htmlspecialchars($user['ADDRESS']); ?></p>
                            <p>Joining Date:
                                <?php
                                    $join = new DateTime($user['JOINING_DATE']);
                                    echo $join->format('F j, Y'); 
                                ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Financial Overview -->
            <div class="col-md-6"><br>
                <div class="payment-info p-3 border border-white bgprof">
                    <h1 class="wel text-center">Financial Overview</h1>
                    <?php if ($membership): ?>
                    <div class="current bg-light text-dark p-3 rounded">
                        <label>Current Membership:</label>
                        <p>Membership Type: <?php echo htmlspecialchars($membership['membership_type']); ?></p>
                        <p>Start Date:
                            <?php
                                $join = new DateTime($membership['start_date']);
                                echo $join->format('F j, Y'); 
                            ?>
                        </p>
                        <p>End Date:
                            <?php
                                $join = new DateTime($membership['end_date']);
                                echo $join->format('F j, Y'); 
                            ?>
                        </p>
                            <div class="update">
                                <a href="update-membership.php"><button class="btn btn-primary btn-block mt-2">UPDATE
                                        MEMBERSHIP</button></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="session-info text-center">
                            <a class="recatt btn btn-primary btn-lg" href="attendance.php">Record Attendance</a>
                        </div>
                    </div>
                </div>
            </div>
                <!-- Class/Session Section -->
            <div class="col-12 mt-4">
                <div class="d-flex justify-content-center">
                    <div class="payment-info p-3 border border-white bgprof">
                        <div class="session-info text-center">
                            <h1 class="wel mt-3">Class/Session</h1>
                         <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Session Name</th>
                                        <th>Coach Name</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($attendance_records as $record): ?>
                                    <tr>
                                        <td><?php $date = new DateTime($record['date']);
                                            echo $date->format('F j, Y');  ?></td>
                                        <td><?php echo htmlspecialchars($record['SESSIONNAME']); ?></td>
                                        <td><?php echo htmlspecialchars($record['COACHNAME']); ?></td>
                                        <td><?php $time_in = new DateTime($record['TIME_IN']);
                                            echo $time_in->format('h:i A');?></td>
                                        <td><?php $time_out = new DateTime($record['TIME_OUT']);
                                                echo $time_out->format('h:i A');?></td>
                                        <td><?php echo htmlspecialchars($record['status']); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="watermark">
        <p>APEX VITALITY HUB, GROUP 4-LASTG</p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>


</html>