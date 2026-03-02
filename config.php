<?php
$host = 'sql205.infinityfree.com';
$db_user = 'if0_41282500';
$db_pass = 'Darkbishop1109';
$auth_db = 'if0_41282500_wow'; // Changed from $db_name to $auth_db

$conn = new mysqli($host, $db_user, $db_pass, $auth_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

// These must be the FULL names created in the panel
$auth_db = 'if0_41282500_wow'; // e.g., if0_38210000_auth
$char_db = 'if0_41282500_wow'; // e.g., if0_38210000_characters

// Discord Webhook URL
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

// We connect using the $auth_db as the primary database
$conn = new mysqli($host, $db_user, $db_pass, $auth_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sendToDiscord($message) {
    global $webhook_url;
    $data = array('content' => $message);
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    file_get_contents($webhook_url, false, $context)
}function sendToDiscord($message) {
    global $webhook_url;
    $data = array('content' => $message);
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
?>
