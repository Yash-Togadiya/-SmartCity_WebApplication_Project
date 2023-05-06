<?php
    define('HOSTNAME', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
    define('DATABASE', 'SmartCity');

    $connection = new mysqli(HOSTNAME, DB_USER, DB_PASSWORD,DATABASE);
    if ($connection->connect_error) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    // $database = "CREATE DATABASE SmartCity";
    // if ($connection->query($database) === false) {
    //     die("Error creating database: " . $connection->error);
    // }

    // $users = "CREATE TABLE users (
    //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     name VARCHAR(255) NOT NULL,
    //     email VARCHAR(255) UNIQUE,
    //     mobile BIGINT(10) UNIQUE,
    //     password VARCHAR(30) NOT NULL,
    //     document VARCHAR(30) NOT NULL,
    //     reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    //     otp INT(8),
    // )";
    // if ($connection->query($sql) === false) {
    //     die("Error creating table: " . $connection->error);
    // }
?>