<?php
session_start();

// Database Configuration
$db_host = '127.0.0.1';
$db_user = 'root'; // Your DB Username
$db_pass = 'ascent'; // Your DB Password
$db_auth = 'auth'; // Your WoW Auth Database

$conn = new mysqli($db_host, $db_user, $db_pass, $db_auth);

// Discord Webhook - Silent Fail if host is unreachable
function send_discord_log($msg) {
    $url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";
    $data = json_encode(["content" => $msg]);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); // Prevent hanging if host is blocked
    curl_setopt($ch, CURLOPT_TIMEOUT, 2);
    @curl_exec($ch); // '@' suppresses errors like 'Could not resolve host'
    curl_close($ch);
}
?>
