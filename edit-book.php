<?php
session_start();

include("db_connection.php");

// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}



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

if (isset($_GET['id'])) {
    $book_id = $_GET['id']; // Corrected variable name
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
    // Escape user inputs for security to prevent SQL injection
    $new_book_name = mysqli_real_escape_string($connection, $_POST["book_name"]);
    $new_book_code = mysqli_real_escape_string($connection, $_POST["book_code"]);
    $new_book_author = mysqli_real_escape_string($connection, $_POST["book_author"]);
    $new_category = mysqli_real_escape_string($connection, $_POST["category"]);
    $new_available_books = intval($_POST["available_books"]); // Convert to integer for safety

    // Validate inputs (you may want to add more validation)
    if (empty($new_book_name) || empty($new_book_code) || empty($new_book_author) || empty($new_category) || !is_numeric($new_available_books)) {
        $error = "Please enter all details correctly.";
    } else {
        // Update the book details
        $update_query = "UPDATE books_table SET book_name = '$new_book_name', book_code = '$new_book_code', 
                        book_author = '$new_book_author', category = '$new_category', 
                        available_books = $new_available_books WHERE id = '$book_id'";
        $update_result = mysqli_query($connection, $update_query);

        if ($update_result) {
            // Redirect to the book list page after successful update
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
    <link rel="stylesheet" href="styles/form_view.css">

    <!-- Add your stylesheets and other head elements here -->
</head>

<body>
    <?php
    include 'back.php';
    ?>
    <h2>Edit Book</h2>

    <?php
    // Display error message if any
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>

    <div class="form-container">

        <form action="" method="post">
            <label for="book_name">Book Name:</label>
            <input type="text" name="book_name" value="<?php echo htmlspecialchars($book_data['book_name']); ?>" required>

            <label for="book_code">Book Code:</label>
            <input type="text" name="book_code" value="<?php echo htmlspecialchars($book_data['book_code']); ?>" required>

            <label for="book_author">Book Author:</label>
            <input type="text" name="book_author" value="<?php echo htmlspecialchars($book_data['book_author']); ?>" required>

            <label for="category">Category:</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($book_data['category']); ?>" required>

            <label for="available_books">Available Books:</label>
            <input type="number" name="available_books" value="<?php echo htmlspecialchars($book_data['available_books']); ?>" required>

            <input type="submit" value="Save Changes">
        </form>

        <label for="category">Valid Category List:</label>
        <select id="category" name="category" required>
            <?php
            // Populate dropdown with book categories
            $categories = getBookCategories($connection);
            foreach ($categories as $categoryOption) {
                echo "<option value='{$categoryOption}'";
                if ($categoryOption) {
                    echo " selected";
                }
                echo ">{$categoryOption}</option>";
            }
            ?>
        </select>

        <br><br>
    </div>

    <script>
        // JavaScript function to display alert message after successful edit
        window.onload = function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success') && urlParams.get('success') === '1') {
                alert('Book details updated successfully!');
            }
        };
    </script>
</body>

</html>