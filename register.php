<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtoupper(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    $hash = sha1(strtoupper($username) . ":" . strtoupper($password));

    $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email, vpoints) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sss", $username, $hash, $email);

    if ($stmt->execute()) {
        sendToDiscord("❄️ **New Hero:** `$username` has joined!");
        echo "Account created successfully!";
    } else {
        echo "Registration failed: " . $conn->error;
    }
    $stmt->close();
}
?>
