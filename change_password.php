<?php
// change_password.php

require_once 'includes/functions.php';
require_once 'includes/session.php';

// Redirect to login if not logged in
if (!is_logged_in()) {
    redirect('index.php');
}

// Handle password change form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = db_connect();
    $user_id = current_user();
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data (you should use secure password hashing)
    // Here, you should check if the old password matches the current password in the database
    // And also check if the new password matches the confirm password field

    if ($new_password === $confirm_password) {
        // Hash the new password before storing it in the database
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $update_query = "UPDATE users SET password = '$hashed_new_password' WHERE id = '$user_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            echo "Password changed successfully!";
        } else {
            echo "Password change failed.";
        }
    } else {
        echo "New password and confirm password do not match.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Change Password</h1>
        <form method="post" action="">
            <input type="password" name="old_password" placeholder="Current Password" required>
            <input type="password" name="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
            <button type="submit">Change Password</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
