<?php
session_start();

include("db_connection.php");

// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Fetch book details
    $query = "SELECT * FROM books_table WHERE id = '$book_id'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $book_data = mysqli_fetch_assoc($result);
    } else {
        echo "Book not found.";
        exit();
    }
} else {
    echo "Book ID not provided.";
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_book_name = $_POST["book_name"];
    $new_book_code = $_POST["book_code"];
    $new_book_author = $_POST["book_author"];
    $new_category = $_POST["category"];
    $new_available_books = $_POST["available_books"];

    // Validate inputs (you may want to add more validation)
    if (empty($new_book_name) || empty($new_book_code) || empty($new_book_author) || empty($new_category) || !is_numeric($new_available_books)) {
        $error = "Please enter all details correctly.";
    } else {
        // Update the book details
        $update_query = "UPDATE books_table SET book_name = '$new_book_name', book_code = '$new_book_code', 
                        book_author = '$new_book_author', category = '$new_category', 
                        available_books = $new_available_books WHERE book_id = '$book_id'";
        $update_result = mysqli_query($connection, $update_query);

        if ($update_result) {
            header("Location: book-list.php");
            exit();
        } else {
            $error = "Database query error: " . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - Library Management System</title>
    <link rel="stylesheet" href="styles/edit-book.css">

    <!-- Add your stylesheets and other head elements here -->
</head>
<body>
<?php
    include 'back.php'
    ?>
    <h2>Edit Book</h2>

    <?php
    // Display error message if any
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <form action="" method="post">
        <label for="book_name">Book Name:</label>
        <input type="text" name="book_name" value="<?php echo $book_data['book_name']; ?>" required>

        <label for="book_code">Book Code:</label>
        <input type="text" name="book_code" value="<?php echo $book_data['book_code']; ?>" required>

        <label for="book_author">Book Author:</label>
        <input type="text" name="book_author" value="<?php echo $book_data['book_author']; ?>" required>

        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo $book_data['category']; ?>" required>

        <label for="available_books">Available Books:</label>
        <input type="number" name="available_books" value="<?php echo $book_data['available_books']; ?>" required>

        <input type="submit" value="Save Changes">
    </form>

    <!-- Add your scripts and other body elements here -->

</body>
</html>
