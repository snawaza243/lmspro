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
    <link rel="stylesheet" href="admin-login.css">
<style>
    
</style>
    <!-- Add your stylesheets and other head elements here -->
</head>
<body>
<?php
    include 'back.php'
    ?>
    <h2>Library Management System - Admin Login</h2>

    <?php
    // Display error message if any
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form action="" method="post">
        <label for="admin_id">Admin ID:</label>
        <input type="text" name="admin_id" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
        <a href="index.php"><button type="button">Cancel</button></a>

    </form>

    <!-- Add your scripts and other body elements here -->

</body>
</html>
