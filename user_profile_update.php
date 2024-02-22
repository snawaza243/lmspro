<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: user-login.php");
    exit();
}

// Include your database connection file
include 'db_connection.php';

// Fetch current user's details from the database
$user_id = $_SESSION["user_id"];
$query = "SELECT * FROM user_table WHERE user_id = '$user_id'";
$result = mysqli_query($connection, $query);

// Check if the query executed successfully
if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    $error = "Error: User data not found";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verify if the current password matches the password in the database
    // if (password_verify($current_password, $user['password'])) {
    // Check if the new password matches the confirm password
    // Verify if the current password matches the password in the database
    if (md5($current_password) === $user['password']) {
        // Hash the new password using MD5 before storing it in the database
        $hashed_password = md5($new_password);

        // Update user's profile details in the database
        $sql = "UPDATE user_table SET name='$name', email='$email', gender='$gender', password='$hashed_password' WHERE user_id='$user_id'";

        if (mysqli_query($connection, $sql)) {
            // Profile updated successfully
            $success_message = "Profile updated successfully";
        } else {
            // Error updating profile
            $error = "Error updating profile: " . mysqli_error($connection);
        }
    } else {
        // Current password is incorrect
        $error = "Current password is incorrect";
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
    <title>User Profile Update</title>
    <link rel="stylesheet" href="styles/form_style.css">
    <link rel="stylesheet" href="styles.css">
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
                    <div class="container">
                        <h2>User Profile Update</h2>
                        <?php if (isset($error)) { ?>
                        <div class="error"><?php echo $error; ?></div>
                        <?php } ?>
                        <?php if (isset($success_message)) { ?>
                        <div class="success"><?php echo $success_message; ?></div>
                        <?php } ?>
                        <form method="POST">
                            <div class="field">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name"
                                    value="<?php echo htmlspecialchars($user['name']); ?>" required>
                            </div>
                            <div class="field">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email"
                                    value="<?php echo htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="field">
                                <label for="gender">Gender:</label>
                                <select id="gender" name="gender" required>
                                    <option value="Male" <?php if ($user['gender'] === 'Male') echo 'selected'; ?>>Male
                                    </option>
                                    <option value="Female" <?php if ($user['gender'] === 'Female') echo 'selected'; ?>>
                                        Female</option>
                                    <option value="Other" <?php if ($user['gender'] === 'Other') echo 'selected'; ?>>
                                        Other</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="current_password">Current Password:</label>
                                <input type="password" id="current_password" name="current_password" required>
                            </div>
                            <div class="field">
                                <label for="new_password">New Password:</label>
                                <input type="password" id="new_password" name="new_password" required>
                            </div>
                            <div class="field">
                                <label for="confirm_password">Confirm Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="field">
                                <button type="submit">Update Profile</button>
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