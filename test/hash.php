<?php

$password = "admin1234";


$hashedPassword = md5($password);


echo "Hashed Password: " . $hashedPassword;


// Define the password
// $password = "sam";

// // Hash the password
// $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
// // Output the hashed password
// echo "Hashed Password: " . $hashedPassword;

// // Define the hashed password retrieved from the database
// $hashedPasswordFromDatabase = '$2y$10$LP8LXPwJF3fnmRWo31EsauVU3laiqThEOWrOaVoFlJBGX5MASs9H2';

// echo "\n";
// // User input password to verify
// $userInputPassword = "sam";

// Verify if the user input password matches the hashed password
// if (password_verify($userInputPassword, $hashedPasswordFromDatabase)) {
//     echo "Password Matched!";
// } else {
//     echo "Invalid Password!";
// }