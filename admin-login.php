<?php
session_start();

include("db_connection.php");

// Check if the admin is already logged in
if (isset($_SESSION["admin_id"])) {
    header("Location: admin-dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_id = $_POST["admin_id"];
    $password = $_POST["password"];

    // Validate inputs (you may want to add more validation)
    if (empty($admin_id) || empty($password)) {
        $error = "Please enter both Admin ID and Password.";
    } else {
        // Hash the password (you should use a stronger hashing algorithm in a production environment)
        $hashedPassword = md5($password);

        $query = "SELECT * FROM admin_table WHERE email = '$admin_id' AND password = '$hashedPassword'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $admin_data = mysqli_fetch_assoc($result);

                // Set admin session
                $_SESSION["admin_id"] = $admin_data["admin_id"];
                $_SESSION["admin_name"] = $admin_data["name"];
                $_SESSION["admin_email"] = $admin_data["email"];
                $_SESSION["admin_gender"] = $admin_data["gender"];

                // Redirect to admin dashboard
                header("Location: admin-dashboard.php");
                exit();
            } else {
                $error = "Invalid Admin ID or Password.";
            }
        } else {
            $error = "Database query error: " . mysqli_error($connection);
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Library Management System</title>
    <link rel="stylesheet" href="styles/form_style.css">
    <style>

    </style>
    <!-- Add your stylesheets and other head elements here -->
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
                    <?php
                    ?>
                    <div class="container">
                        <h2>Admin Login</h2>
                        <?php
                        // Display error message if any
                        if (isset($error)) {
                            echo "<p class='error-message'>$error</p>";
                        }
                        ?>

                        <form action="" method="post">
                            <div class="field">
                                <label for="admin_id">Email ID:</label>
                                <input type="text" name="admin_id" required>
                            </div>
                            <div class="field">
                                <label for="password">Password:</label>
                                <input type="password" name="password" required>
                            </div>
                            <div class="field">
                                <button type="submit">Login</button>
                            </div>
                            <div class="field">
                                <!-- <a href="index.php" class="ctm-btn">Cancel</a> -->
                            </div>
                        </form>
                    </div>
                </section>
            </main>
            <div class="footer">
                <?php
                include 'includes/footer.php';
                ?>
            </div>
        </div>
    </div>



</body>

</html>