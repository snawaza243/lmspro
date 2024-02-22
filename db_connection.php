<?php 
    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASSWORD", "mysql1234");
    define("DB_DATABASE", "lmspro");

    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
    if($connection)
    {
        // echo("Connection success!");

    }
    else{
        die('Connection failed');
    }
?>


    
