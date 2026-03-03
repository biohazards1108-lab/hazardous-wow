<?php
require_once 'config.php';
$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = strtoupper($_POST['username']);
    $pass = strtoupper($_POST['password']);
    $email = $_POST['email'];
    $hash = sha1($user . ':' . $pass);

    $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $hash, $email);

    if ($stmt->execute()) {
        $msg = "Account created! You may now login.";
        send_discord_log("New Champion: $user has joined the realm!");
    } else {
        $msg = "Error: Username already exists.";
    }
}
?>
<div class="form-container">
    <h2>Create Account</h2>
    <p><?php echo $msg; ?></p>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email Address" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" class="cta-btn">REGISTER</button>
    </form>
</div>
