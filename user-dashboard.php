<?php
// Start session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: user-login.php");
    exit();
}

// Include your database connection file
include("db_connection.php");
// Retrieve the user's issued books
$userId = $_SESSION["user_id"];
$query = "SELECT * FROM issued_books WHERE user_id = '$userId'";
$result = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Library Management System</title>
    <link rel="stylesheet" href="user-dashboard.css">

    <!-- Add your stylesheets and other head elements here -->
</head>

<body>
    <div class="scroll-container">
        <div class="scroll-wrapper">
            <?php
            include 'user_nav.php';
            include 'back.php';
            ?>
            <main class="custom-main-view">
                <section>
                    <div class="container">
                        <h2>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h2>

                        <!-- Display user profile information -->
                        <p>User ID: <?php echo $_SESSION["user_id"]; ?></p>
                        <p>Email: <?php echo $_SESSION["user_email"]; ?></p>
                        <p>Gender: <?php echo $_SESSION["user_gender"]; ?></p>
                        <p>Membership (in months):
                            <?php echo isset($_SESSION["user_member"]) ? $_SESSION["user_member"] : "NA"; ?></p>

                        <!-- Display issued books table -->
                        <h3>Issued Books</h3>



                        <?php
                        if (!isset($_SESSION["user_id"])) {
                            header("Location: login.php"); // Redirect to the login page
                            exit();
                        }

                        $user_id = $_SESSION["user_id"]; // Assuming you have a user_id stored in session

                        $issued_books_query = "SELECT * FROM issuance_table WHERE student_id = $user_id";
                        $issued_books_result = mysqli_query($connection, $issued_books_query);

                        if (mysqli_num_rows($issued_books_result) > 0) {
                            echo "<table>"; // Start of table
                            echo "<tr><th>Book ID</th><th>Book Name</th><th>Book Author</th><th>Category</th><th>Issued Date</th><th>Due Date</th><th>Late Return Fine</th></tr>"; // Table header

                            while ($row = mysqli_fetch_assoc($issued_books_result)) {
                                $book_id = $row["book_id"];

                                // Retrieve book details based on the book_id
                                $book_query = "SELECT * FROM books_table WHERE id = $book_id";
                                $book_result = mysqli_query($connection, $book_query);

                                if ($book_result && mysqli_num_rows($book_result) > 0) {
                                    $book_row = mysqli_fetch_assoc($book_result);
                                    echo "<tr>";
                                    echo "<td>" . $book_row["id"] . "</td>";
                                    echo "<td>" . $book_row["book_name"] . "</td>";
                                    echo "<td>" . $book_row["book_author"] . "</td>";
                                    echo "<td>" . $book_row["category"] . "</td>";
                                    echo "<td>" . $row["issue_date"] . "</td>";

                                    // Calculate due date
                                    $due_date = date("Y-m-d", strtotime($row["issue_date"] . "+15 days"));
                                    $today = date("Y-m-d");
                                    $overdue_days = max(0, strtotime($today) - strtotime($due_date)) / (60 * 60 * 24); // Calculate overdue days

                                    $overdue_fine = 0;
                                    if ($overdue_days > 0) {
                                        $overdue_fine = $overdue_days * 10; // 10 rupees per day overdue
                                    }

                                    // Display due date and fine
                                    $overdue_class = ($due_date < $today) ? 'overdue' : '';
                                    echo "<td class='$overdue_class'>" . $due_date . "</td>";
                                    echo "<td>" . $overdue_fine . " Rupees</td>";
                                    echo "</tr>";
                                }
                            }

                            echo "</table>"; // End of table
                        } else {
                            echo "<p>No books issued yet.</p>";
                        }
                        ?>

                        <!-- Add your scripts and other body elements here -->
                        <a href="logout.php" class="logout-link">Logout</a>
                </section>
            </main>
            <div class="footer">
                <?php
                include 'includes/footer.php';
                ?>
            </div>
        </div>
    </div>


    <style>
    .issue-book {
        width: fit-content;
        overflow-y: auto;
    }


    .home-link {
        background-color: #0056b3;
        padding: 5px 10px;
        color: #fff;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-decoration: none;
    }

    .button-link:hover,
    .logout-link:hover {
        background-color: #c0392b;
        cursor: pointer;


    }

    button,
    .logout-link {
        background-color: #e74c3c;
        padding: 5px 10px;
        color: #fff;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 100px;
        text-decoration: none;
    }

    button:hover,
    .logout-link:hover {
        background-color: #c0392b;
        cursor: pointer;
        text-decoration: none;


    }
    </style>
</body>

</html>