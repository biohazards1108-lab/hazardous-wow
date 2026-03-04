<?php
session_start();

// Real InfinityFree MySQL Details
$db_host = 'sql100.infinityfree.com'; 
$db_user = 'if0_41282500'; 
$db_pass = 'Darkbishop1109'; 
$db_auth = 'if0_41282500_auth'; 

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_auth);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}
?>
