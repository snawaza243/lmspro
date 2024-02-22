<?php
include 'db_connection.php';

// Check if the issued_book_id parameter is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $issued_book_id = $_GET['id'];

    // Fetch details of the issued book
    $issued_book_query = "SELECT * FROM issuance_table WHERE id = $issued_book_id";
    $issued_book_result = $connection->query($issued_book_query);

    if ($issued_book_result->num_rows == 1) {
        $issued_book = $issued_book_result->fetch_assoc();
    } else {
        echo "Invalid issued book ID";
        exit();
    }
} else {
    echo "Invalid request";
    exit();
}

// Handle form submission to mark the book as returned
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update issuance table to mark the book as returned
    $return_query = "DELETE FROM issuance_table WHERE id = $issued_book_id";
    $return_result = $connection->query($return_query);

    if ($return_result) {
        // Update available books count in the books_table
        $book_id = $issued_book['book_id'];
        $update_books_query = "UPDATE books_table SET available_books = available_books + 1 WHERE id = $book_id";
        $update_books_result = $connection->query($update_books_query);

        if ($update_books_result) {
            echo "<script>alert('Book returned successfully.'); window.location.href='issued-books.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error updating available books.'); window.location.href='issued-books.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Error marking book as returned.'); window.location.href='issued-books.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
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
                        <h2>Return Book</h2>
                        <div class="form-container">
                            <form method="post">
                                <label for="student_name">Student Name:</label>
                                <input type="text" id="student_name" name="student_name"
                                    value="<?php echo $issued_book['student_name']; ?>" readonly><br><br>

                                <label for="student_id">Student ID:</label>
                                <input type="text" id="student_id" name="student_id"
                                    value="<?php echo $issued_book['student_id']; ?>" readonly><br><br>

                                <label for="book_id">Book ID:</label>
                                <input type="text" id="book_id" name="book_id"
                                    value="<?php echo $issued_book['book_id']; ?>" readonly><br><br>

                                <label for="issue_date">Issue Date:</label>
                                <input type="text" id="issue_date" name="issue_date"
                                    value="<?php echo $issued_book['issue_date']; ?>" readonly><br><br>

                                <?php
                                // Calculate late fine
                                $due_date = date("Y-m-d", strtotime($issued_book["issue_date"] . "+15 days"));
                                $today = date("Y-m-d");
                                $overdue_days = max(0, strtotime($today) - strtotime($due_date)) / (60 * 60 * 24); // Calculate overdue days

                                $late_fine = 0;
                                if ($overdue_days > 0) {
                                    $late_fine = $overdue_days * 10; // 10 rupees per day overdue
                                    echo "<label for='late_fine'>Late Fine:</label>";
                                    echo "<input type='text' id='late_fine' name='late_fine' value='₹ $late_fine' readonly><br><br>";
                                } else {
                                    echo "<input type='hidden' name='late_fine' value='0'>"; // Hidden field if no late fine
                                }
                                ?>

                                <input type="submit" value="Return Book">
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
                        input[type="text"] {
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

                        <div class="footer">
                            <?php
                            // include 'book-list.php';
                            include 'includes/footer.php';
                            ?>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>

</html>