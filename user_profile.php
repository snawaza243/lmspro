<?php
// Start session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: user_login.php");
    exit();
}

// Include your database connection file
include_once "db_connection.php";

// Fetch user data from the database based on the logged-in user's ID
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `user_table` WHERE `user_id` = $user_id";
$result = mysqli_query($connection, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle the case where user data is not found
    echo "User data not found!";
    exit();
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form_view.css">
    <title>User Profile</title>
</head>

<body>
    <?php
    include 'user_nav.php';
    include 'back.php';
    ?>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        User Profile
                    </div>
                    <div class="card-body">
                        <p>Name: <?php echo $user['name']; ?></p>
                        <p>Email: <?php echo $user['email']; ?></p>
                        <p>Gender: <?php echo $user['gender']; ?></p>
                        <p>Membership Duration: <?php echo $user['membership_months']; ?> months</p>
                        <a href="user_profile_update.php" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>