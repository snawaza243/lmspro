<?php
session_start();
// Check if the admin is not logged in
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin-login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/listing_table.css">

    <title>List of Issued Books</title>
    <!-- <link rel="stylesheet" href="global.css"> -->

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
                            <button onclick="location.href='issue-book.php'">Issue Book</button>
                        </div>
                        <h2>List of Issued Books</h2>

                        <div style="width: 100%; overflow-x: auto;">


                            <table style="width: 100%; margin:auto    ;">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Book ID</th>
                                    <th>Book Name</th>

                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Late Return Fine</th>
                                    <th>Return Book</th>

                                </tr>
                                <?php
                                include 'db_connection.php';

                                // SQL query to retrieve issued books
                                $sql = "SELECT id, student_name, student_id, book_id, book_name, issue_date FROM issuance_table";

                                $result = $connection->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr> <td>" . $row["student_name"] . "</td> <td>" . $row["student_id"] . "</td> <td>" . $row["book_id"] . "</td> <td>" . $row["book_name"] . "</td> <td>" . $row["issue_date"] . "</td>";
                                        // Calculate due date
                                        $due_date = date("Y-m-d", strtotime($row["issue_date"] . "+15 days"));
                                        $today = date("Y-m-d");
                                        $overdue_days = max(0, strtotime($today) - strtotime($due_date)) / (60 * 60 * 24); // Calculate overdue days

                                        if ($overdue_days > 0) {
                                            $overdue_fine = $overdue_days * 10; // 10 rupees per day overdue
                                            $overdue_class = 'overdue';
                                        } else {
                                            $overdue_fine = 0;
                                            $overdue_class = '';
                                        }

                                        // Display due date and fine
                                        echo "<td class='$overdue_class'>" . $due_date . "</td>";
                                        echo "<td>" . ($overdue_fine > 0 ? "₹ $overdue_fine" : "Not fine") . "</td>";
                                        echo "<td><a href='return-book.php?id=" . $row['id'] . "'>Return</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No issued books found</td></tr>";
                                }
                                $connection->close();
                                ?>
                            </table>

                        </div>



</body>

</html>
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