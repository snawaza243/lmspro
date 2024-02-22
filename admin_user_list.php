<?php
// Include database connection and user authentication
session_start();
include("db_connection.php");

// Check if admin is logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Function to handle user deletion
function deleteUser($userId, $connection)
{
    $delete_query = "DELETE FROM user_table WHERE id = $userId";
    $delete_result = mysqli_query($connection, $delete_query);
    if ($delete_result) {
        echo "<script>alert('User deleted successfully.'); window.location.href='user-list.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting user. Please try again later.'); window.location.href='user-list.php';</script>";
        exit();
    }
}

// Check if user deletion requested
if (isset($_GET['delete']) && isset($_GET['id'])) {
    deleteUser($_GET['id'], $connection);
}

// Fetch user details from the database
$user_query = "SELECT * FROM user_table";
$user_result = mysqli_query($connection, $user_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/listing_table.css">


    <title>User List - Library Management System</title>

    <style>

    </style>
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
                        <h2>User List</h2>
                        <table>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Membership Months</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            // Loop through each user and display their details
                            while ($user = mysqli_fetch_assoc($user_result)) {
                                echo "<tr>";
                                echo "<td>" . $user['name'] . "</td>";
                                echo "<td>" . $user['email'] . "</td>";
                                echo "<td>" . $user['gender'] . "</td>";

                                // Check if membership months exist
                                if ($user['membership_months']) {
                                    echo "<td>" . $user['membership_months'] . "</td>";
                                } else {
                                    echo "<td>Not a member</td>";
                                }

                                echo "<td>";
                                echo "<a class='button' href='admin_user_update.php?id=" . $user['user_id'] . "'>Edit</a>";
                                echo " | <a class='button delete' href='?delete=true&id=" . $user['user_id'] . "' onclick=\"return confirm('Are you sure you want to delete this user?')\">Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
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