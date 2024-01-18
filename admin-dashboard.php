<?php
session_start();
// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

include("db_connection.php");

// Fetch admin profile data
$admin_name = $_SESSION["admin_name"];
$admin_email = $_SESSION["admin_email"];
$admin_gender = $_SESSION["admin_gender"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Library Management System</title>
    <link rel="stylesheet" href="admin-dashboard.css">
</head>

<body>
<?php
    include 'back.php'
    ?>
    <center class="admin-box">
        <header>
            <h1 id="dashboard-title">Admin Dashboard</h1>
            <h2 id="welcome-message">Welcome, <?php echo $admin_name; ?>!</h2>
        </header>

        <ul id="admin-info">
            <li>Admin ID: <?php echo $_SESSION["admin_id"]; ?></li>
            <li>Email: <?php echo $admin_email; ?></li>
            <li>Gender: <?php echo $admin_gender; ?></li>
        </ul>

        <!-- Add other redirection buttons here -->
        <ul id="admin-buttons">
            <li><a href="maintenance.php" class="button-link">Maintenance</a></li>
            <li><a href="reports.php" class="button-link">Reports</a></li>
            <li><a href="transactions.php" class="button-link">Transactions</a></li>
        </ul>

        <form id="logout-form" action="logout.php" method="post">
            <a href="index.php" class="home-link">Home</a>
            

            <input type="submit" class="logout-link" value="Logout">

        </form>

    </center>

    <?php

    // include 'book-list.php'

    ?>
    <!-- Add your scripts and other body elements here -->

</body>

</html>