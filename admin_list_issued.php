    <?php
    include("db_connection.php");

    // Include your database connection 
    // Fetch all student information with issued books
    $sql = "SELECT u.user_id, u.name AS student_name, COUNT(i.user_id) AS num_books_issued, 
        GROUP_CONCAT(b.book_name) AS book_names, GROUP_CONCAT(i.issue_date) AS issue_dates
 FROM user_table u
 LEFT JOIN issuance_table i ON u.user_id = i.user_id
 LEFT JOIN books_table b ON i.book_id = b.id
 GROUP BY u.user_id, u.name";
    $result = mysqli_query($connection, $sql);

    // Check for query execution error
    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Student List - Library Management System</title>
        <!-- Add your stylesheets and other head elements here -->
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>

        <div class="container">
            <h2>Student List with Issued Books</h2>

            <table border="1">
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Number of Books Issued</th>
                    <th>Book Names</th>
                    <th>Issue Dates</th>
                </tr>

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['num_books_issued'] . "</td>";
                    echo "<td>" . $row['book_names'] . "</td>";
                    echo "<td>" . $row['issue_dates'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

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