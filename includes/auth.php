<?php
session_start();

function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

function redirectIfNotAuthenticated() {
    if (!isAuthenticated()) {
        header("Location: login.php");
        exit();
    }
}
?>
