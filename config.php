<?php
$host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'ascent'; // Your provided password
$auth_db = 'auth';
$char_db = 'characters';

// Discord Webhook URL
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

$conn = new mysqli($host, $db_user, $db_pass);
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
    file_get_contents($webhook_url, false, $context);
}
?>
