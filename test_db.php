<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'sql205.infinityfree.com'; 
$db_user = 'if0_41282500'; 
$db_pass = 'Darkbishop1109'; // If this fails, replace with the 'Show/Hide' password from the panel
$db_name = 'if0_41282500_wow';

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    echo "<h3>Connection Failed</h3>";
    echo "Error Code: " . $conn->connect_errno . "<br>";
    echo "Error Message: " . $conn->connect_error . "<br>";
    echo "<p>Try finding the <b>MySQL Password</b> in your InfinityFree 'Account Details' and paste it above.</p>";
} else {
    echo "<h3 style='color:green'>SUCCESS!</h3>";
    echo "You are officially connected to the WoW Database.";
}
?>
