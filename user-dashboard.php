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

// Close the database connection
mysqli_close($connection);
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

    <h2>Welcome, <?php echo $_SESSION["user_name"]; ?>!</h2>

    <!-- Display user profile information -->
    <p>User ID: <?php echo $_SESSION["user_id"]; ?></p>
    <p>Email: <?php echo $_SESSION["user_email"]; ?></p>
    <p>Gender: <?php echo $_SESSION["user_gender"]; ?></p>
    <p>Membership (in months): <?php echo isset($_SESSION["user_member"]) ? $_SESSION["user_member"] : "NA"; ?></p>

    <!-- Display issued books table -->
    <h3>Issued Books</h3>
    <style>
        .issue-book{
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
    <div class="issue-book">

        <table border="1">
            <tr>
                <th>Serial Number</th>
                <th>Book ID</th>
                <th>Book Name</th>
                <th>Author</th>
                <th>Category</th>
                <th>Issued Date From</th>
                <th>Due Date To</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["serial_number"] . "</td>";
                echo "<td>" . $row["book_id"] . "</td>";
                echo "<td>" . $row["book_name"] . "</td>";
                echo "<td>" . $row["author"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["issued_date_from"] . "</td>";

                // echo "<td>" . $row["due_date_to"] . "</td>";


                // Check if the due date is overdue (15 days from the issue date)
                $due_date = date("Y-m-d", strtotime($row["issued_date_from"] . "+15 days"));
                $today = date("Y-m-d");
                $overdue_class = ($due_date < $today) ? 'overdue' : '';
                echo "<td class='$overdue_class'>" . $due_date . "</td>";

                echo "</tr>";
            }
            ?>
        </table>
    </div>

    <!-- Add your scripts and other body elements here -->
    <a href="logout.php" class="logout-link">Logout</a>

</body>

</html>