<!-- register.php -->
<?php
require_once 'includes/functions.php';
require_once 'includes/session.php';

if (is_logged_in()) {
    redirect('dashboard.php');
}

// Process registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = db_connect();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $full_name = $_POST['full_name'];

    // Validate and insert user data (you should use secure password hashing)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password, full_name) VALUES ('$username', '$email', '$hashed_password', '$full_name')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        redirect('index.php');
    } else {
        echo "Registration failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Registration</h1>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="full_name" placeholder="Full Name" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login</a></p>
    </div>
</body>
</html>
