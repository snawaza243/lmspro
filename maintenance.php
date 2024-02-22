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
    <!-- <link rel="stylesheet" href="maintenance.css"> -->
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
                        <div class="maintenance-container">
                            <div class="section">
                                <h3>Book Management</h3>
                                <button onclick="location.href='add-book.php'">Add Book</button>
                                <button onclick="location.href='book-list.php'">See All Books</button>
                                <button onclick="location.href='issued-books.php'">See Issued Books</button>
                            </div>

                            <div class="section">
                                <h3>Librarian Management</h3>
                                <button onclick="location.href='see-librarian.php'">See All Librarians</button>
                                <button onclick="location.href='add-librarian.php'">Add Librarian</button>

                                <button onclick="location.href='edit-librarian.php'">Edit Librarian</button>
                            </div>

                            <div class="section">
                                <h3>User Management</h3>
                                <button onclick="location.href='add-user.php'">Add User</button>
                                <button onclick="location.href='admin_user_list.php'">See all users</button>

                            </div>

                            <a href="admin-dashboard.php">Go back to Dashboard</a>
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