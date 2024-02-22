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
    <link rel="stylesheet" href="styles/dash.css">
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'admin_nav.php';
            include 'back.php';
            ?>
            <main class="custom-main-view">
                <section>
                    <div class="container">
                        <div class="dashboard-container">
                            <header>
                                <h1>Admin Dashboard</h1>
                                <h2>Welcome, <?php echo $admin_name; ?>!</h2>
                            </header>

                            <ul id="admin-info">
                                <li>Admin ID: <?php echo $_SESSION["admin_id"]; ?></li>
                                <li>Email: <?php echo $admin_email; ?></li>
                                <li>Gender: <?php echo $admin_gender; ?></li>
                            </ul>

                            <div class="admin-buttons">
                                <ul>
                                    <li><a href="maintenance.php">Maintenance</a></li>
                                    <li><a href="admin_report.php">Reports</a></li>
                                    <li><a href="issued-books.php">Transactions/ Issued Books</a></li>
                                    <li><a href="book-list.php">Show Books</a></li>
                                </ul>
                            </div>

                            <form id="logout-form" action="logout.php" method="post">
                                <a href="index.php" class="home-link">Home</a>
                                <input type="submit" class="logout-button" value="Logout">
                            </form>
                        </div>

                    </div>
                </section>
            </main>
            <div class="footer">
                <?php
                // include 'book-list.php';
                include 'includes/footer.php';
                ?>
            </div>
        </div>
    </div>



</body>

</html>