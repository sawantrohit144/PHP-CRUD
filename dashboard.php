<!-- dashboard.php -->
<?php
require_once 'includes/functions.php';
require_once 'includes/session.php';

if (!is_logged_in()) {
    redirect('index.php');
}

// Get user data
$conn = db_connect();
$user_id = current_user();
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Process logout
if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    redirect('index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo $user['full_name']; ?>!</h1>
        <p>Username: <?php echo $user['username']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <p><a href="profile.php">Update Profile</a></p>
        <p><a href="change_password.php">Change Password</a></p>
        <p><a href="dashboard.php?logout=true">Logout</a></p>
    </div>
</body>
</html>
