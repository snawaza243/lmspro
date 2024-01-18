<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_email"]) || $_SESSION["admin_email"] !== "admin@gmail.com") {
    header("Location: admin-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance - Library Management System</title>
    <!-- Add your stylesheets and other head elements here -->
    <link rel="stylesheet" href="maintenance.css">
</head>
<body>

<?php
    include 'back.php'
    ?>

    <div class="container">
        <h2>Maintenance</h2>

        <div class="section">
            <h3>Librarian Management</h3>
            <button onclick="location.href='see-librarian.php'">See All Librarians</button>
            <button onclick="location.href='add-librarian.php'">Add Librarian</button>
            <button onclick="location.href='remove-librarian.php'">Remove Librarian</button>
            <button onclick="location.href='edit-librarian.php'">Edit Librarian</button>
        </div>

        <div class="section">
            <h3>User Management</h3>
            <button onclick="location.href='add-user.php'">Add User</button>
            <button onclick="location.href='remove-user.php'">Remove User</button>
            <button onclick="location.href='edit-user.php'">Edit User</button>
        </div>

        <div class="section">
            <h3>Book Management</h3>
            <button onclick="location.href='book-list.php'">See All Books</button>
            <button onclick="location.href='add-book.php'">Add Book</button>
            <button onclick="location.href='remove-book.php'">Remove Book</button>
            <button onclick="location.href='edit-book.php'">Edit Book</button>
        </div>

        <a href="admin-dashboard.php">Go back to Dashboard</a>
    </div>

    <!-- Add your scripts and other body elements here -->

</body>
</html>
