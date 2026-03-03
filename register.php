<?php
include('config.php');

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = strtoupper($_POST['username']);
    $pass = strtoupper($_POST['password']);
    $email = $_POST['email'];

    // WoW Encryption (TrinityCore/AzerothCore style)
    $hash = sha1($user . ':' . $pass);

    // Check if user exists
    $check = $conn->prepare("SELECT id FROM account WHERE username = ?");
    $check->bind_param("s", $user);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "Username already taken!";
    } else {
        $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $hash, $email);
        
        if ($stmt->execute()) {
            $message = "Account created! You can now log in.";
            sendToDiscord("New Hero Joined: " . $user);
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Join Hazardous WoW</title>
    <style>
        body { background: #050a14; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .box { background: rgba(255,255,255,0.05); padding: 40px; border: 1px solid #00ccff; border-radius: 10px; text-align: center; }
        input { display: block; width: 100%; margin: 10px 0; padding: 10px; background: #000; border: 1px solid #444; color: white; }
        button { background: #c4950d; border: none; padding: 10px 20px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>CREATE ACCOUNT</h2>
        <?php if($message) echo "<p>$message</p>"; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">START ADVENTURE</button>
        </form>
        <p><a href="index.php" style="color:#00ccff;">Back to Market</a></p>
    </div>
</body>
</html>
