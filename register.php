<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = strtoupper($_POST['username']);
    $password = $_POST['password'];
    $email = $_POST['email'];

    // WoW password hashing (SRP6 for 3.3.5a)
    // Note: Most repacks use uppercase username + password for the hash
    $hash = sha1(strtoupper($username) . ":" . strtoupper($password));

    // Insert into DB with 0 vpoints
    $stmt = $conn->prepare("INSERT INTO $auth_db.account (username, sha_pass_hash, email, vpoints) VALUES (?, ?, ?, 0)");
    $stmt->bind_param("sss", $username, $hash, $email);

    if ($stmt->execute()) {
        // DISCORD ALERT
        $webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";
        $data = ["content" => "❄️ **A New Hero Arrives!** Account `$username` has just been created on **Hazardous Server**!"];
        
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        file_get_contents($webhook_url, false, $context);

        echo "Account created successfully! Welcome to Hazardous Server.";
    } else {
        echo "Error: Account name already exists.";
    }
}
?>
