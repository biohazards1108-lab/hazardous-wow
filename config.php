<?php
session_start();

// InfinityFree MySQL Details
$db_host = 'sqlXXX.infinityfree.com'; // Change to your actual SQL Host
$db_user = 'if0_XXXXXX';              // Change to your actual Username
$db_pass = 'YourPassword';            // Change to your actual Password
$db_auth = 'if0_XXXXXX_auth';         // Your Auth DB
$db_char = 'if0_XXXXXX_char';         // Your Characters DB

$conn = new mysqli($db_host, $db_user, $db_pass, $db_auth);
$char_conn = new mysqli($db_host, $db_user, $db_pass, $db_char);

if ($conn->connect_error || $char_conn->connect_error) {
    die("Connection failed");
}
?>
