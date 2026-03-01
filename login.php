<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = strtoupper($_POST['username']);
    $pass = $_POST['password'];
    // Simplified check - match against the sha_pass_hash in your auth.account table
    // Note: TrinityCore uses a complex SRP6 salt, this is a placeholder for logic
    $_SESSION['username'] = $user;
    header("Location: dashboard.php");
}
?>
