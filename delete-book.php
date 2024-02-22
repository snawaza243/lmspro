<?php
session_start();

include("db_connection.php");

// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Check if book_id is provided and numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $book_id = $_GET['id'];

    // Query to fetch book details
    $query = "SELECT * FROM books_table WHERE id = $book_id";
    $result = mysqli_query($connection, $query);

    // Check if the book exists
    if (mysqli_num_rows($result) == 1) {
        $book = mysqli_fetch_assoc($result);
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "Invalid book ID.";
    exit();
}

// Handle book deletion
if (isset($_POST['delete'])) {
    $delete_query = "DELETE FROM books_table WHERE id = $book_id";
    if (mysqli_query($connection, $delete_query)) {
        header("Location: book-list.php");
        exit();
    } else {
        echo "Error deleting book: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Book - Library Management System</title>
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

                    <h2>Delete Book</h2>
                    <p>Are you sure you want to delete the book "<?php echo $book['book_name']; ?>"?</p>
                    <form method="post">
                        <input type="submit" name="delete" value="Delete this book">
                    </form>

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