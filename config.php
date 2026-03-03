<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database Credentials
$host = 'sql205.infinityfree.com';
$db_user = 'if0_41282500';
$db_pass = 'Darkbishop1109';
$auth_db = 'if0_41282500_wow';

$conn = new mysqli($host, $db_user, $db_pass, $auth_db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Discord Logging
$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";
// Discord Webhook URLs
$webhooks = [
    'register' => 'https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr',
    'bugs'     => 'https://discord.com/api/webhooks/1476634364090519622/xcPFqB7Qg3Mip--zu_Y0iYsCbJ6XTsj7Q5AVKPSmestbsuBPFdFfG1zjy-tVtsT4N9XY',
    'level80'  => 'https://discord.com/api/webhooks/1477185331819446384/f2jjOMxl96A4NUH0P_83M0vPJ7kdTUZqbylarW1nffNSVfZbfdheEEe0VB92BFY-YK6a',
    'updates'  => 'https://discord.com/api/webhooks/1477193815109406865/tBZK0h7y0n_e8PyJQXOEoMAv69WtDtp4DYODdmHmATkH_TjG2BKR2lSGkdcee-VEFBfX',
    'donations'=> 'https://discord.com/api/webhooks/1478508059247775958/pyTjBzl6NGlkdyomC35FyIp-uB82StKXqBATzYtu7CWjaXIjtpVgP4_8bq2O2TXXbm8Q'
];
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
