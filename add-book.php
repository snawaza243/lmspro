<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_email"]) || $_SESSION["admin_email"] !== "admin@gmail.com") {
    header("Location: admin-login.php");
    exit();
}

include("db_connection.php");

// Function to get book categories from the database
function getBookCategories($conn) {
    $categories = array();
    $sql = "SELECT category_name FROM book_categories";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['category_name'];
    }

    return $categories;
}

// Initialize variables
$message = "";
$book_name = $book_code = $book_author = $num_of_books = $category = "";

// Add book to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST["book_name"];
    $book_code = $_POST["book_code"];
    $book_author = $_POST["book_author"];
    $num_of_books = $_POST["num_of_books"];
    $category = $_POST["category"];

    // Perform database insertion
    $sql = "INSERT INTO books (book_name, book_code, book_author, available_books, category) VALUES ('$book_name', '$book_code', '$book_author', $available_books, '$category')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $message = "Book added successfully!";
    } else {
        $message = "Error adding book. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book - Library Management System</title>
    <link rel="stylesheet" href="add-book.css">

    <!-- Add your stylesheets and other head elements here -->
</head>
<body>
<?php
    include 'back.php'
    ?>
    <div class="container">
        <h2>Add Book</h2>

        <?php
        if (!empty($message)) {
            echo "<p>{$message}</p>";
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="book_name">Book Name:</label>
            <input type="text" id="book_name" name="book_name" value="<?php echo $book_name; ?>" required>

            <label for="book_code">Book Code:</label>
            <input type="text" id="book_code" name="book_code" value="<?php echo $book_code; ?>" required>

            <label for="book_author">Book Author:</label>
            <input type="text" id="book_author" name="book_author" value="<?php echo $book_author; ?>" required>

            <label for="num_of_books">Number of Books:</label>
            <input type="number" id="num_of_books" name="num_of_books" value="<?php echo $available_books; ?>" min="1" required>

            <label for="category">Book Category:</label>
            <select id="category" name="category" required>
                <?php
                // Populate dropdown with book categories
                $categories = getBookCategories($connection);
                foreach ($categories as $categoryOption) {
                    echo "<option value='{$categoryOption}'";
                    if ($category === $categoryOption) {
                        echo " selected";
                    }
                    echo ">{$categoryOption}</option>";
                }
                ?>
            </select>

            <input type="submit" value="Add Book">
        </form>

        <form action="add-book.php" method="get">
            <input type="submit" value="Add More">
        </form>

        <a href="book-list.php">Go to Book List</a>
    </div>

    <!-- Add your scripts and other body elements here -->

</body>
</html>
