<?php
session_start();

include("db_connection.php");

// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = $_POST['student_name'];
    $student_id = $_POST['user_id'];
    $book_id = $_POST['book_id'];

    // Insert issuance details into the database
    $insert_query = "INSERT INTO issuance_table (student_name, student_id, book_id, issue_date) VALUES ('$student_name', '$student_id', '$book_id', NOW())";
    $insert_result = mysqli_query($connection, $insert_query);

    if ($insert_result) {
        // Update the number of available books
        $update_query = "UPDATE books_table SET available_books = available_books - 1 WHERE id = $book_id";
        $update_result = mysqli_query($connection, $update_query);

        if ($update_result) {
            // Issuance successful
            echo "<script>alert('Book issued successfully.'); window.location.href='book-list.php';</script>";
            exit();
        } else {
            // Error updating available books
            echo "<script>alert('Error updating available books. Please try again.'); window.location.href='issue-book.php';</script>";
        }
    } else {
        // Error inserting issuance details
        echo "<script>alert('Error issuing book. Please try again.'); window.location.href='issue-book.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Book - Library Management System</title>
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
                        <h2>Issue Book</h2>

                        <div class="form-container">
                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                                <label for="user_id">Students:</label>
                                <select id="user_id" name="user_id" required>
                                    <?php
                                    // Fetch available students
                                    $students_query = "SELECT * FROM user_table";
                                    $students_result = mysqli_query($connection, $students_query);
                                    while ($row = mysqli_fetch_assoc($students_result)) {
                                        echo "<option value='" . $row['user_id'] . "'>" . $row['user_id'] . "&emsp;&emsp;&emsp;" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select><br><br>
                                <label for="student_name">Student Name:</label>
                                <input type="text" id="student_name" name="student_name" required><br><br>

                                <label for="student_id">Student ID:</label>
                                <input type="text" id="student_id" name="student_id" required><br><br>

                                <label for="book_id">Book:</label>
                                <select id="book_id" name="book_id" required>
                                    <?php
                                    // Fetch available books
                                    $books_query = "SELECT * FROM books_table WHERE available_books > 0";
                                    $books_result = mysqli_query($connection, $books_query);
                                    while ($row = mysqli_fetch_assoc($books_result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['book_name'] . "</option>";
                                    }
                                    ?>
                                </select><br><br>
                                <input type="submit" value="Issue Book">
                            </form>
                        </div>
                        <style>
                        /* Style for form container */
                        .form-container {
                            max-width: 400px;
                            margin: 0 auto;
                            padding: 20px;
                            background-color: #f4f4f4;
                            border-radius: 5px;
                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        }

                        /* Style for form labels */
                        label {
                            display: block;
                            font-weight: bold;
                            margin-bottom: 5px;
                        }

                        /* Style for form inputs */
                        input[type="text"],
                        select {
                            width: 100%;
                            padding: 8px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                            box-sizing: border-box;
                            margin-bottom: 10px;
                        }

                        /* Style for submit button */
                        input[type="submit"] {
                            width: 100%;
                            background-color: #3498db;
                            color: white;
                            padding: 10px 0;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                        }

                        /* Style for submit button on hover */
                        input[type="submit"]:hover {
                            background-color: #3498de;
                        }

                        /* Style for hidden inputs */
                        input[type="hidden"] {
                            display: none;
                        }
                        </style>

                        <!-- Add your scripts and other body elements here -->
</body>
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

</html>