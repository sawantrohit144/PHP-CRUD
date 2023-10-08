<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function current_user() {
    return is_logged_in() ? $_SESSION['user_id'] : null;
}
?>
