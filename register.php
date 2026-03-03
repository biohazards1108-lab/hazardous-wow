<?php
include('config.php');

$message = "";
$msg_type = ""; // To color the message red (error) or green (success)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = strtoupper($_POST['username']);
    $pass = strtoupper($_POST['password']);
    $email = $_POST['email'];

    // WoW Encryption
    $hash = sha1($user . ':' . $pass);

    $check = $conn->prepare("SELECT id FROM account WHERE username = ?");
    $check->bind_param("s", $user);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $message = "COMMAND FAILED: USERNAME ALREADY TAKEN";
        $msg_type = "error";
    } else {
        $stmt = $conn->prepare("INSERT INTO account (username, sha_pass_hash, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user, $hash, $email);
        
        if ($stmt->execute()) {
            $message = "SUCCESS: ACCOUNT CREATED. PREPARE FOR BATTLE.";
            $msg_type = "success";
            // Check if sendToDiscord function exists in config.php
            if (function_exists('sendToDiscord')) {
                sendToDiscord("New Hero Joined: " . $user);
            }
        } else {
            $message = "SYSTEM ERROR: " . $conn->error;
            $msg_type = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hazardous WoW | Join the Scourge</title>
    <style>
        :root {
            --gold: #c4950d;
            --ice: #00ccff;
            --blood: #880000;
        }

        body {
            margin: 0;
            background: #02050a url('https://web.archive.org/web/20101204043250im_/http://www.worldofwarcraft.com/downloads/wallpapers/patch330/patch330-1280x1024.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #bdc3c7;
            font-family: 'Times New Roman', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* --- THE GLOWING REGISTRATION BOX --- */
        .register-box {
            background: rgba(5, 10, 20, 0.9);
            border: 2px solid #333;
            border-top: 5px solid var(--ice);
            padding: 40px;
            width: 400px;
            box-shadow: 0 0 50px #000, 0 0 20px rgba(0, 204, 255, 0.2);
            text-align: center;
        }

        h2 {
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 5px;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px #000;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            background: #000;
            border: 1px solid #444;
            color: var(--ice);
            font-family: monospace;
            box-sizing: border-box;
            outline: none;
        }

        input:focus {
            border-color: var(--ice);
            box-shadow: 0 0 10px rgba(0, 204, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to bottom, #222, #000);
            border: 1px solid var(--gold);
            color: var(--gold);
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            letter-spacing: 2px;
            transition: 0.3s;
        }

        button:hover {
            background: var(--gold);
            color: #000;
            box-shadow: 0 0 15px var(--gold);
        }

        .message {
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: bold;
            padding: 10px;
            text-transform: uppercase;
        }
        .error { color: var(--blood); border: 1px solid var(--blood); }
        .success { color: #1eff00; border: 1px solid #1eff00; }

        .back-link {
            margin-top: 25px;
            display: block;
            color: #555;
            text-decoration: none;
            font-size: 12px;
        }
        .back-link:hover { color: var(--ice); }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Join the Realm</h2>
    
    <?php if($message): ?>
        <div class="message <?php echo $msg_type; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="USERNAME" required autocomplete="off">
        <input type="email" name="email" placeholder="EMAIL ADDRESS" required autocomplete="off">
        <input type="password" name="password" placeholder="PASSWORD" required>
        <button type="submit">Begin Adventure</button>
    </form>

    <a href="index.php" class="back-link">← Return to Market</a>
</div>

</body>
</html>
