<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = strtoupper($_POST['username']);
    $pass = $_POST['password'];
    
    // TrinityCore uses SRP6 for passwords, but for a basic start:
    $p = strtoupper($user) . ':' . strtoupper($pass);
    $hash = sha1($p);

    $stmt = $conn->prepare("INSERT INTO $auth_db.account (username, sha_pass_hash, email) VALUES (?, ?, ?)");
    $email = $user . "@hazardous.com";
    $stmt->bind_param("sss", $user, $hash, $email);
    
    if ($stmt->execute()) {
        sendToDiscord("New Champion Born: " . $user . " has joined the server!");
        echo "Account created successfully!";
    } else {
        echo "Error: Account might already exist.";
    }
}
?>
<form method="POST">
    <input type="text" name="username" placeholder="New Username" required>
    <input type="password" name="password" placeholder="New Password" required>
    <button type="submit">Create Account</button>
</form>
