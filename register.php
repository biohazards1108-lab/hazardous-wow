<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtoupper(trim($_POST['username']));
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);

    $hash = sha1(strtoupper($username) . ":" . strtoupper($password));

    // Database Insert
    $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email, vpoints) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sss", $username, $hash, $email);

    echo "<div style='background:#1a1a1a; color:white; height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; font-family:sans-serif;'>";

    if ($stmt->execute()) {
        echo "<h1 style='color:#00ff00; font-size:50px;'>CONGRATS!</h1>";
        echo "<p style='font-size:20px;'>Account <strong>$username</strong> is ready. All is working!</p>";
        sendToDiscord("❄️ **New Hero:** `$username` has joined Hazardous WoW!");
    } else {
        echo "<h1 style='color:#ff4444; font-size:50px;'>DARN!</h1>";
        echo "<p style='font-size:20px;'>Something went wrong.</p>";
        echo "<p style='color:#aaa;'>How to fix: Check if the username is taken or fields are empty.</p>";
    }

    echo "<a href='index.php' style='color:#00ccff; margin-top:20px;'>Return to Home</a>";
    echo "</div>";
    
    $stmt->close();
}
?>
