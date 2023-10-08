<?php
function db_connect() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'database';

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Database connection error: " . mysqli_connect_error());
    }

    return $conn;
}

function redirect($url) {
    header("Location: $url");
    exit();
}
?>
