<?php
session_start();

$db_host = '127.0.0.1';
$db_user = 'root';
$db_pass = 'ascent';
$db_auth = 'auth';       // Database for accounts
$db_char = 'characters'; // Database for characters

$conn = new mysqli($db_host, $db_user, $db_pass, $db_auth);
$char_conn = new mysqli($db_host, $db_user, $db_pass, $db_char);

// Check connections
if ($conn->connect_error || $char_conn->connect_error) {
    die("Database Connection Failed.");
}
?>
