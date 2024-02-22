<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["admin_id"])) {
    // Redirect the user to the login page or display an error message
    header("Location: login.php");
    exit; // Stop executing the rest of the code
}

// Include database connection
include("db_connection.php");

// Fetch books information
$books_query = "SELECT COUNT(*) AS total_books FROM books_table";
$books_result = mysqli_query($connection, $books_query);

// Fetch issued books information
$issued_books_query = "SELECT COUNT(*) AS total_issued_books FROM issuance_table";
$issued_books_result = mysqli_query($connection, $issued_books_query);

// Check if queries executed successfully
if ($books_result && $issued_books_result) {
    $books_data = mysqli_fetch_assoc($books_result);
    $issued_books_data = mysqli_fetch_assoc($issued_books_result);

    // Close result sets
    mysqli_free_result($books_result);
    mysqli_free_result($issued_books_result);
} else {
    echo "Error fetching data from the database: " . mysqli_error($connection);
}

// Close database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Reports</title>
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
                    <h2>Library Management System - Reports</h2>
                    <h3>Books Information</h3>
                    <p>Total Books:
                        <?php echo isset($books_data['total_books']) ? $books_data['total_books'] : 'N/A'; ?></p>
                    <h3>Issued Books Information</h3>
                    <p>Total Issued Books:
                        <?php echo isset($issued_books_data['total_issued_books']) ? $issued_books_data['total_issued_books'] : 'N/A'; ?>
                    </p>

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