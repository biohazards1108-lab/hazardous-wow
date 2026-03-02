<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtoupper(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    // WoW SRP6 Hashing
    $hash = sha1(strtoupper($username) . ":" . strtoupper($password));

    // Database Insert
    $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email, vpoints) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sss", $username, $hash, $email);

    if ($stmt->execute()) {
        echo "<h2 style='color:green;'>Congrats! Your account $username is ready!</h2>";
        echo "<p>You can now log in to the game.</p>";
        sendToDiscord("❄️ **New Hero:** `$username` has successfully registered!");
    } else {
        echo "<h2 style='color:red;'>Darn! Registration failed.</h2>";
        echo "<p>How to fix: This username might already be taken, or the 'account' table is missing a column.</p>";
    }
    $stmt->close();
}
?>
