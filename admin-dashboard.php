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
    <link rel="stylesheet" href="/styles/dashboard.css">

    <!-- Add your stylesheets and other head elements here -->
</head>

<body>

    <h2>Admin Dashboard</h2>

    <p>Welcome, <?php echo $admin_name; ?>!</p>

    <ul>
        <li>Admin ID: <?php echo $_SESSION["admin_id"]; ?></li>
        <li>Email: <?php echo $admin_email; ?></li>
        <li>Gender: <?php echo $admin_gender; ?></li>
    </ul>

    <!-- Add other redirection buttons here -->
    <ul>
        <li><a href="maintenance.php">Maintenance</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="transactions.php">Transactions</a></li>
    </ul>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <?php

    include 'book-list.php'

    ?>
    <!-- Add your scripts and other body elements here -->

</body>

</html>