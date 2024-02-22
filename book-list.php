<?php
session_start();

include("db_connection.php");
// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}

// Pagination
$limit = 10; // Number of records per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$query = "SELECT * FROM books_table LIMIT $start, $limit";
$result = mysqli_query($connection, $query);

// Fetch total records for pagination
$total_records_query = "SELECT COUNT(*) FROM books_table";
$total_records_result = mysqli_query($connection, $total_records_query);
$total_records = mysqli_fetch_array($total_records_result)[0];
$total_pages = ceil($total_records / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List - Library Management System</title>
    <!-- <link rel="stylesheet" href="book-list.css"> -->

    <link rel="stylesheet" href="styles/listing_table.css">


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
                        <div class="section">
                            <button onclick="location.href='add-book.php'">Add Book</button>
                        </div>
                        <h2>Book List</h2>


                        <table border="1">
                            <tr>
                                <th>Book ID</th>
                                <th>Book Name</th>
                                <th>Book Author</th>
                                <th>Category</th>
                                <th>Available Books</th>
                                <th>Update/Delete</th>
                                <th>Action</th>

                            </tr>

                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td><a href='edit-book.php?id=" . $row['id'] . "'>" . $row['book_name'] . "</a></td>";
                                echo "<td>" . $row['book_author'] . "</td>";
                                echo "<td>" . $row['category'] . "</td>";
                                echo "<td>" . $row['available_books'] . "</td>";
                                echo "<td>
                        <a href='edit-book.php?id=" . $row['id'] . "'>Edit</a> |
                        <a href='delete-book.php?id=" . $row['id'] . "'>Delete</a>
            </td>";
                                echo "<td><a href='issue-book.php'>Issue Book</a></td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>

                        <div style="display: flex; width:100%; overflow-x:auto">
                            <!-- Pagination -->
                            <?php
                            echo "<ul>";
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<li><a href='book-list.php?page=" . $i . "'>" . $i . "</a></li>";
                            }
                            echo "</ul>";
                            ?>

                        </div>
                        <br><br><br>
                        <!-- Add your scripts and other body elements here -->
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