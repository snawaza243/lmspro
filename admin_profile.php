<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["admin_id"])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit; // Stop executing the rest of the code
}

// Get admin details from the session
$admin_id = isset($_SESSION["admin_id"]) ? $_SESSION["admin_id"] : "";
$admin_name = isset($_SESSION["admin_name"]) ? $_SESSION["admin_name"] : "";
$admin_email = isset($_SESSION["admin_email"]) ? $_SESSION["admin_email"] : "";
$admin_gender = isset($_SESSION["admin_gender"]) ? $_SESSION["admin_gender"] : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <!-- Add your CSS link here -->
    <link rel="stylesheet" href="styles/profile_view.css">
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'admin_nav.php';
            include 'back.php';
            ?>
            <main class="custom-main">
                <section>
                    <div class="container" style="min-height: 400px; margin-bottom: 200px;">
                        <h1>Admin Profile</h1>
                        <p>Welcome, <?php echo $admin_name; ?>!</p>
                        <ul>
                            <li>Admin ID: <?php echo $admin_id; ?></li>
                            <li>Email: <?php echo $admin_email; ?></li>
                            <li>Gender: <?php echo $admin_gender; ?></li>
                        </ul>
                        <a href="admin_profile_update.php">Update Profile</a>
                        <br>
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