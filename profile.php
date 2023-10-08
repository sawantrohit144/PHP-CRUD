<?php
// profile.php

require_once 'includes/functions.php';
require_once 'includes/session.php';

// Redirect to login if not logged in
if (!is_logged_in()) {
    redirect('index.php');
}

// Get user data
$conn = db_connect();
$user_id = current_user();
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle profile update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    // Validate and update the user's profile data in the database
    $update_query = "UPDATE users SET full_name = '$full_name', email = '$email' WHERE id = '$user_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Update successful; refresh the user data
        $query = "SELECT * FROM users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);
        echo "Profile updated successfully!";
    } else {
        echo "Profile update failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Update Profile</h1>
        <form method="post" action="">
            <input type="text" name="full_name" placeholder="Full Name" value="<?php echo $user['full_name']; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $user['email']; ?>" required>
            <button type="submit">Update Profile</button>
        </form>
        <p><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
