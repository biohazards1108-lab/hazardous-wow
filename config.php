<?php
$host = 'sql205.infinityfree.com';
$db_user = 'if0_41282500';
$db_pass = 'Darkbishop1109'; 
$auth_db = 'if0_41282500_wow'; 

$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

$conn = new mysqli($host, $db_user, $db_pass, $auth_db);

// The Test Logic
if ($conn->connect_error) {
    echo "<h1 style='color:red;'>Darn! Something is wrong.</h1>";
    echo "<p>Fix: Your database password or hostname is incorrect in config.php.</p>";
} else {
    echo "<h1 style='color:green;'>Congrats! All is working!</h1>";
    echo "<p>Your database is connected and ready for players.</p>";
}

function sendToDiscord($message) {
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
// Final check: ensure no text exists below this line without // slashes
