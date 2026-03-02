<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('config.php');

// Enable error reporting to see exactly what goes wrong
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];
    $email = $_POST['email'];

    // WoW password hashing (SRP6 for 3.3.5a)
    $hash = sha1(strtoupper($username) . ":" . strtoupper($password));
   // Use only ONE of these lines
$stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email, vpoints) VALUES (?, ?, ?, 0)");
$stmt->bind_param("sss", $username, $hash, $email);
    if ($stmt->execute()) {
        // Send the alert to Discord using the function in config.php
        sendToDiscord("❄️ **A New Hero Arrives!** Account `$username` has just been created!");
        
        echo "Account created successfully! Welcome to Hazardous Server.";
    } else {
        echo "Error: Account name already exists or database error.";
    }
    $stmt->close();
}
?>
