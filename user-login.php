<?php
// Start session
session_start();

// Include your database connection file
include("db_connection.php");

// Check if the user is already logged in
if (isset($_SESSION["user_id"])) {
    header("Location: user-dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $userId = $_POST["userId"];
    $password = $_POST["password"];

    // Validate inputs (you may want to add more validation)
    if (empty($userId) || empty($password)) {
        $error = "Please enter both User ID and Password.";
    } else {
        // Hash the password (you should use a stronger hashing algorithm in a production environment)
        $hashedPassword = md5($password);

        // Check user credentials against the database
        $query = "SELECT * FROM user_table WHERE email = '$userId' AND password = '$hashedPassword'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            // Check if a matching record is found
            if (mysqli_num_rows($result) == 1) {
                // Authentication successful, create a session
                $user = mysqli_fetch_assoc($result);
                $_SESSION["user_id"] = $user["user_id"];
                $_SESSION["user_name"] = $user["name"];
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_gender"] = $user["gender"];
                $_SESSION["user_member"] = $user["membership_months"];

                // Redirect to the user dashboard
                header("Location: user-dashboard.php");
                exit();
            } else {
                $error = "Invalid User ID or Password.";
            }
        } else {
            $error = "Database query error: " . mysqli_error($connection);
        }
    }
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Library Management System</title>
    <link rel="stylesheet" href="styles/form_style.css">


    <!-- Add your stylesheets and other head elements here -->
</head>

<body>

    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'user_nav.php';
            include 'back.php';
            ?>
            <main class="custom-main">
                <section>
                    <?php
                    ?>
                    <div class="container">
                        <h2>User Login</h2>
                        <?php
                        // Display error message if any
                        if (isset($error)) {
                            echo "<p style='color: red;'>$error</p>";
                        }
                        ?>
                        <form action="" method="post">
                            <label for="userId">User ID:</label>
                            <input type="text" name="userId" required>
                            <label for="password">Password:</label>
                            <input type="password" name="password" required>
                            <div class="field">
                                <button type="submit">Login</button>
                            </div>
                            <!-- Cancel button that redirects to the home page -->
                            <!-- <a href="index.php"><button type="button">Cancel</button></a> -->
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