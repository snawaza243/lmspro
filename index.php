<?php
include("db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
        }

        .hero-section {
            background-image: url('path/to/your/image.jpg');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
        }

        .hero-section h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .login-btn {
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        .login-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

    <header>
        <h1>Library Management System</h1>
    </header>

    <div class="hero-section">
        <h1>Welcome to our Library</h1>
        <div class="btn-container">
            <a href="admin-login.php" class="login-btn">Admin Login</a>
            <a href="user-login.php" class="login-btn">User Login</a>
        </div>
    </div>

</body>
</html>
