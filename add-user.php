<?php
session_start();

// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Include database connection
include("db_connection.php");

// Initialize variables
$name = $email = $gender = $password = "";
$errors = array();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $membership_months = $_POST['membership_months'];

    $password = $_POST['password'];

    // Validate form data
    if (empty($name)) {
        array_push($errors, "Name is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($gender)) {
        array_push($errors, "Gender is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // If no errors, proceed to insert into database
    if (count($errors) == 0) {
        $password_hashed = md5($password); // You should use a more secure method for hashing passwords

        // Insert user into database
        $query = "INSERT INTO user_table (name, email, gender, password, membership_months) VALUES ('$name', '$email', '$gender', '$password_hashed', '$membership_months')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            // User added successfully
            header("Location: user-list.php");
            exit();
        } else {
            array_push($errors, "Failed to add user");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/form_view.css">

    <title>Add User - Library Management System</title>
    <!-- Add your stylesheets and other head elements here -->
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
                        <div class="container">
                            <h2>Add User</h2>

                            <!-- Display validation errors if any -->
                            <?php if (count($errors) > 0) : ?>
                            <div class="errors">
                                <?php foreach ($errors as $error) : ?>
                                <p><?php echo $error; ?></p>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <div class="form-container">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <div class="field">
                                        <label for="name">Name:</label>
                                        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br><br>
                                    </div>
                                    <div class="field">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email"
                                            value="<?php echo $email; ?>"><br><br>
                                    </div>
                                    <label for="gender">Gender:</label>
                                    <select id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select><br><br>


                                    <label for="membership_months">Membership:</label>
                                    <input type="number" id="membership_months" name="membership_months"
                                        value="<?php echo $user_name; ?>"><br><br>
                                    <label for="password">Password:</label>
                                    <input type="password" id="password" name="password"><br><br>

                                    <input type="submit" value="Add User">
                                </form>
                            </div>
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