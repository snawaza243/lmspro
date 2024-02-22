<?php
// Include database connection and user authentication
session_start();
include("db_connection.php");

// Check if admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Check if user ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: user-list.php");
    exit();
}

// Fetch user details based on the provided ID
$user_id = $_GET['id'];
$user_query = "SELECT * FROM user_table WHERE user_id = $user_id";
$user_result = mysqli_query($connection, $user_query);

// Check if user exists
if (mysqli_num_rows($user_result) == 0) {
    echo "User not found.";
    exit();
}

// Get the user details
$user = mysqli_fetch_assoc($user_result);

// Update user details if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $membership_months = $_POST['membership_months'];

    // Update user details in the database
    $update_query = "UPDATE user_table SET name = '$name', email = '$email', gender = '$gender', membership_months = '$membership_months' WHERE user_id = $user_id";
    $update_result = mysqli_query($connection, $update_query);

    if ($update_result) {
        // Redirect to user list page
        header("Location: admin_user_list.php");
        exit();
    } else {
        echo "Error updating user details.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User - Library Management System</title>
    <link rel="stylesheet" href="styles/form_view.css">

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
                        <h2>Update User Details</h2>
                        <form method="post">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br><br>

                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br><br>

                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender" required>
                                <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male
                                </option>
                                <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>
                                    Female</option>
                            </select><br><br>

                            <label for="membership_months">Membership Months:</label>
                            <input type="number" id="membership_months" name="membership_months" value="<?php echo $user['membership_months']; ?>"><br><br>

                            <input type="submit" value="Update User">
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