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

// Fixed Discord Function for InfinityFree (Using cURL)
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
?>
