<?php
// Database Credentials
$host = 'sql205.infinityfree.com';
$db_user = 'if0_41282500';
$db_pass = 'Darkbishop1109'; 
$auth_db = 'if0_41282500_wow'; 

// Discord Webhook
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

// Create Connection
$conn = new mysqli($host, $db_user, $db_pass, $auth_db);

// THE TEST YOU ASKED FOR
if ($conn->connect_error) {
    echo "<div style='color:red; font-weight:bold;'>Darn! Connection failed: " . $conn->connect_error . "</div>";
    echo "<p>How to fix: Check if your password 'Darkbishop1109' matches the one in your InfinityFree Hosting Settings.</p>";
} else {
    // Only show this during testing; remove it later so users don't see it
    // echo "<div style='color:green; font-weight:bold;'>Congrats! All is working!</div>";
}

// Fixed Discord Function (Using cURL)
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
// DO NOT ADD A ?> TAG HERE TO PREVENT ERRORS
