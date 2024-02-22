<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION["admin_email"]) || $_SESSION["admin_email"] !== "admin@gmail.com") {
    header("Location: admin-login.php");
    exit();
}

include("db_connection.php");

// Function to get book categories from the database
function getBookCategories($conn)
{
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
$book_name = $book_code = $book_author = $available_books = $category = "";

// Add book to the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_name = $_POST["book_name"];
    $book_code = $_POST["book_code"];
    $book_author = $_POST["book_author"];
    $available_books = $_POST["available_books"];
    $category = $_POST["category"];

    // Prepared statement to prevent SQL injection
    $sql = "INSERT INTO books_table (book_name, book_code, book_author, available_books, category) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssds", $book_name, $book_code, $book_author, $available_books, $category);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Book added successfully!";
        } else {
            $message = "Error executing statement: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing statement: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="styles/form_style.css"> -->
    <link rel="stylesheet" href="styles/form_view.css">
    <title>Add Book - Library Management System</title>

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
                        <h2>Add Book</h2>

                        <?php
                            if (!empty($message)) {
                                echo "<p>{$message}</p>";
                            }
                            ?>
                        <div class="form-container">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="field">
                                    <label for="book_name">Book Name:</label>
                                    <input type="text" id="book_name" name="book_name" value="<?php echo $book_name; ?>"
                                        required>
                                </div>
                                <div class="field">
                                    <label for="book_code">Book Code:</label>
                                    <input type="text" id="book_code" name="book_code" value="<?php echo $book_code; ?>"
                                        required>
                                </div>

                                <div class="field">
                                    <label for="book_author">Book Author:</label>
                                    <input type="text" id="book_author" name="book_author"
                                        value="<?php echo $book_author; ?>" required>
                                </div>
                                <div class="field">
                                    <label for="available_books">Number of Books:</label>
                                    <input type="number" id="available_books" name="available_books"
                                        value="<?php echo $available_books; ?>" min="1" required>
                                </div>
                                <div class="field">
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
                                </div>
                                <br>
                                <div class="field">
                                    <input type="submit" value="Add Book">
                                </div>
                            </form>
                            <br>

                            <form action="add-book.php" method="get">
                                <input type="submit" value="Add More">
                            </form>

                        </div>

                        <a href="book-list.php">Go to Book List</a>
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