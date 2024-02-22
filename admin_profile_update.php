<?php
session_start();
// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Include your database connection file
include 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $admin_id = $_POST['admin_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];

    // Hash the password before storing it in the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Update admin's profile details in the database
    $sql = "UPDATE admin_table SET name='$name', email='$email', gender='$gender', password='$hashed_password' WHERE admin_id='$admin_id'";

    if (mysqli_query($connection, $sql)) {
        // Profile updated successfully
        echo "Profile updated successfully";
    } else {
        // Error updating profile
        echo "Error updating profile: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form_style.css">

    <title>Admin Profile</title>
    <link rel="stylesheet" href="styles.css">
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
                    <div class="container">
                        <h2>Admin Profile</h2>
                        <form method="POST">
                            <div class="field">
                                <label for="admin_id">Admin ID:</label>
                                <input type="text" id="admin_id" name="admin_id" value="101" disabled>
                            </div>
                            <div class="field">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" placeholder="New Name">
                            </div>
                            <div class="field">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="admin@example.com">
                            </div>
                            <div class="field">
                                <label for="gender">Gender:</label>
                                <select id="gender" name="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" placeholder="Enter new password">
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
                // include 'book-list.php';
                include 'includes/footer.php';
                ?>
            </div>
        </div>
    </div>



</body>


</html>