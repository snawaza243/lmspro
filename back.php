<?php
// Define a function to generate the back button
function backButton()
{
    echo '<a href="javascript:history.go(-1)" class="fixed-back-button">Go Back</a>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <!-- Add your stylesheets and other head elements here -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add your global styles here */

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            position: relative;
        }



        .fixed-back-button {
            position: fixed;
            bottom: 10px;
            left: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .fixed-back-button:hover {
            background-color: #0056b3;
            color: #fff;

        }

        /* Add your additional styles or modify as needed */


        /* Add your additional styles or modify as needed */
    </style>
</head>

<body>

    <div class="container">
        <!-- Your page content here -->

        <?php
        // Include the back button component
        // include("back-button.php");

        // Call the backButton function to display the back button
        backButton();
        ?>

        <!-- Your page content here -->

    </div>

    <!-- Add your scripts and other body elements here -->

</body>

</html>