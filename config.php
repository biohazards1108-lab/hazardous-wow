<?php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('config.php'); 
// ... rest of your code
$host = 'sql205.infinityfree.com';
$db_user = 'if0_41282500';
$db_pass = 'Darkbishop1109'; 
$auth_db = 'if0_41282500_wow'; 

$webhook_url = "https://discord.com/api/webhooks/1476721940944388288/BAcRYm0PYlhgfWwuy7QgryZ9JqxHtFkhvrEa7fPSHZGp37nCav32sBzI1acqad1c4sgr";

$conn = new mysqli($host, $db_user, $db_pass, $auth_db);

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
