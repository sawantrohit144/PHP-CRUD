<?php
// db_connection.php

// Replace the following with your actual database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'database';

// Create a database connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check the connection
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}
?>
