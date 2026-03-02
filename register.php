<?php
// 1. Error Reporting (to see what's wrong)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Include Config
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtoupper(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // WoW password hashing (SRP6 for 3.3.5a)
    $hash = sha1(strtoupper($username) . ":" . strtoupper($password));

    // 3. Database Insert
    $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email, vpoints) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sss", $username, $hash, $email);

    if ($stmt->execute()) {
        sendToDiscord("❄️ **A New Hero Arrives!** Account `$username` has just been created!");
        echo "Account created successfully! Welcome to Hazardous Server.";
    } else {
        echo "Error: Account name already exists or database error: " . $conn->error;
    }
    $stmt->close();
}
?>
