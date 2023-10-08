<!-- index.php -->
<?php
require_once 'includes/functions.php';
require_once 'includes/session.php';

if (is_logged_in()) {
    redirect('dashboard.php');
}

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = db_connect();
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials (you should use secure password hashing)
    $query = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        redirect('dashboard.php');
    } else {
        echo "Invalid credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
